<?php

namespace App\Http\Controllers;

// Request
use Illuminate\Http\Request;
// Models
use App\Models\Product as Barang;
// Log
use Illuminate\Support\Facades\Log;
// MPDF
use Mpdf\Mpdf as PDF;
// Datatables
use App\DataTables\BarangDataTable;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BarangDataTable $dataTable)
    {
        return $dataTable->render('barang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    // create & download PDF
    public function createPDF()
    {
        // Setup Title
        $title = 'Daftar Barang';

        // Setup Data Get Only 10 Data
        $barang = Barang::orderBy('id', 'asc')->take(10)->get();
        // $barang = Barang:all();

        // Setup PDF
        $pdf = new PDF();

        // Setup HTML
        $html = view('barang.pdf', compact('barang'));

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
                return redirect()->route('barang.create')->with('error_message', 'Data kosong atau tidak valid');
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
            return redirect()->route('barang.index')->with('success_message', 'Berhasil menambahkan barang baru');
        } catch (\Exception $e) {
            Log::channel('create_barang')->error('Barang gagal ditambahkan', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barang.create')->with('error_message', 'Kode atau Nama barang sudah ada');
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
            return view('barang.edit', [
                'barang' => $barang
            ]);
        } catch (\Exception $e) {
            Log::channel('update_barang')->error('Barang gagal diupdate', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barang.index')->with('error_message', 'Gagal mengedit barang');
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
                    return redirect()->route('barang.index')->with('error_message', 'Stok barang tidak boleh kurang dari 0');
                }
            } catch (\Throwable $e) {
                Log::channel('update_barang')->error('Barang gagal diupdate', [
                    'error' => $e->getMessage()
                ]);
                return redirect()->route('barang.index')->with('error_message', 'Gagal mengedit barang');
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
            return redirect()->route('barang.index')->with('success_message', 'Berhasil mengupdate barang');
        } catch (\Exception $e) {
            Log::channel('update_barang')->error('Barang gagal diupdate', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barang.index')->with('error_message', 'Gagal mengupdate barang');
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
            return redirect()->route('barang.index')->with('success_message', 'Berhasil menghapus barang');
        } catch (\Exception $e) {
            Log::channel('delete_barang')->error('Barang gagal dihapus', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barang.index')->with('error_message', 'Gagal menghapus barang');
        }
    }
}
