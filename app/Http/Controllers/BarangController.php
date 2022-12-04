<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
// MPDF
use Mpdf\Mpdf as PDF;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Barang::select('*'))
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('barangs.edit', $data->id) . '" class="btn btn-primary btn-xs">Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="' . route('barangs.destroy', $data->id) . '" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">Delete</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        } else {
            $barangs = Barang::all();
            return view('barangs.index', [
                'barangs' => $barangs
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barangs.create');
    }

    // create & download PDF
    public function createPDF()
    {
        // Setup Title
        $title = 'Daftar Barang';

        // Setup Data Get Only 10 Data
        $barangs = Barang::orderBy('id', 'asc')->take(10)->get();
        // $barangs = Barang:all();

        // Setup PDF
        $pdf = new PDF();

        // Setup HTML
        $html = view('barangs.pdf', compact('barangs'));

        // Setup PDF
        $pdf->WriteHTML($html);
        $pdf->Output('Daftar Barang.pdf', 'D');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            try{
                $request->validate([
                    'nama_barang' => 'required',
                    'kode_barang' => 'required',
                    'stok_barang' => 'required',
                    'status_barang' => 'required',
                ]);
                if ($request->stok_barang < 0) {
                    throw new \Exception('Stok barang tidak boleh kurang dari 0');
                }
            }catch(\Exception $e){
                Log::channel('create_barang')->error('Data kosong atau tidak valid', [
                    'error' => $e->getMessage(),
                ]);
                return redirect()->route('barangs.create')->with('error_message', 'Data kosong atau tidak valid');
            }

            $array = $request->only([
                'kode_barang', 'nama_barang', 'stok_barang', 'status_barang'
            ]);
            $array['kode_barang'] = strtoupper($array['kode_barang']);
            $array['nama_barang'] = strtoupper($array['nama_barang']);
            $array['status_barang'] = strtoupper($array['status_barang']);

            $barang = Barang::create($array);
            // File Log
            Log::channel('create_barang')->info('Barang berhasil ditambahkan', [
                'id' => $barang->id,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'stok_barang' => $barang->stok_barang,
                'status_barang' => $barang->status_barang
            ]);
            // Activity Log
            activity()->log('Barang berhasil ditambahkan');
            return redirect()->route('barangs.index')->with('success_message', 'Berhasil menambahkan barang baru');
        } catch (\Exception $e) {
            Log::channel('create_barang')->error('Barang gagal ditambahkan', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barangs.create')->with('error_message', 'Kode atau Nama barang sudah ada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $barang = Barang::findOrFail($id);
            return view('barangs.edit', [
                'barang' => $barang
            ]);
        } catch (\Exception $e) {
            Log::channel('update_barang')->error('Barang gagal diupdate', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barangs.index')->with('error_message', 'Gagal mengedit barang');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            try {
                $barang = Barang::findOrFail($id);
                $request->validate([
                    'kode_barang' => 'required',
                    'nama_barang' => 'required',
                    'stok_barang' => 'required',
                    'status_barang' => 'required'
                ]);
                if ($request->stok_barang < 0) {
                    return redirect()->route('barangs.index')->with('error_message', 'Stok barang tidak boleh kurang dari 0');
                }
            } catch (\Throwable $e) {
                Log::channel('update_barang')->error('Barang gagal diupdate', [
                    'error' => $e->getMessage()
                ]);
                return redirect()->route('barangs.index')->with('error_message', 'Gagal mengedit barang');
            }

            $array = $request->only([
                'kode_barang', 'nama_barang', 'stok_barang', 'status_barang'
            ]);
            $array['kode_barang'] = strtoupper($array['kode_barang']);
            $array['nama_barang'] = strtoupper($array['nama_barang']);
            $array['status_barang'] = strtoupper($array['status_barang']);
            $barang->update($array);
            Log::channel('update_barang')->info('Barang berhasil diupdate', [
                'id' => $barang->id,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'stok_barang' => $barang->stok_barang,
                'status_barang' => $barang->status_barang
            ]);
            return redirect()->route('barangs.index')->with('success_message', 'Berhasil mengupdate barang');
        } catch (\Exception $e) {
            Log::channel('update_barang')->error('Barang gagal diupdate', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barangs.index')->with('error_message', 'Gagal mengupdate barang');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $barang = Barang::findOrFail($id);
            $barang->delete();
            Log::channel('delete_barang')->info('Barang berhasil dihapus', [
                'id' => $barang->id,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'stok_barang' => $barang->stok_barang,
                'status_barang' => $barang->status_barang
            ]);
            return redirect()->route('barangs.index')->with('success_message', 'Berhasil menghapus barang');
        } catch (\Exception $e) {
            Log::channel('delete_barang')->error('Barang gagal dihapus', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barangs.index')->with('error_message', 'Gagal menghapus barang');
        }
    }
}
