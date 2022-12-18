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
        // Setup Data Get Only 10 Data
        $barang = Barang::orderBy('id', 'asc')->get();
        $petugas = auth()->user()->nama_petugas;
        $tanggal = date('d-m-Y');
        $waktu = date('H:i:s');
        $jumlahBarang = Barang::count();
        
        // Setup PDF
        $pdf = new PDF();

        $pdf->debug = true;

        // Setup HTML
        $html = view('barang.pdf')
        ->with('barang', $barang)
        ->with('petugas', $petugas)
        ->with('tanggal', $tanggal)
        ->with('waktu', $waktu)
        ->with('jumlahBarang', $jumlahBarang)
        ->render();

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
                    'kode_barang' => 'required|unique:products',
                    'nama_barang' => 'required',
                    'stok_barang' => 'required|numeric',
                    'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,svg',
                ]);
            }catch(\Exception $e){
                $validator = $this->checkData($request);

                Log::channel('create_barang')->error('Gagal Menyimpan Data', [
                    'error' => $e->getMessage(),
                ]);
                
                return redirect()->route('barang.create')
                ->with('error_message', 'Gagal Menyimpan Data')
                ->withInput()
                ->withErrors($validator);
            }

            // Store Data to Array
            $array = $request->only([
                'kode_barang', 'nama_barang', 'stok_barang', 'status_barang', 'gambar_barang'
            ]);
            $array['kode_barang'] = strtoupper($array['kode_barang']);
            $array['nama_barang'] = strtoupper($array['nama_barang']);
            $array['status_barang'] = 'Tersedia';
            $array['stok_barang'] = (int) $array['stok_barang'];

            // Upload Gambar
            $image = $request->file('gambar_barang');
            $new_image_name = date('YmdHi'). '-' .$image->getClientOriginalName();
            $image->move(public_path('upload'), $new_image_name);
            $array['gambar_barang'] = $new_image_name;

            // Store Data to Database
            $barang = Barang::create($array);

            // File Log
            Log::channel('create_barang')->info('Barang berhasil ditambahkan', [
                'id' => $barang->id,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'stok_barang' => $barang->stok_barang,
                'status_barang' => $barang->status_barang,
                'gambar_barang' => $barang->gambar_barang
            ]);

            // Activity Log
            $activity = activity('Create Barang')
            ->performedOn($barang)
            ->causedBy(auth()->user())
            ->withProperties([
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'stok_barang' => $barang->stok_barang,
                'status_barang' => $barang->status_barang,
                'gambar_barang' => $barang->gambar_barang
            ])
            ->log('Menambahkan Barang');
            $activity->subject_name = $activity->subject_type::find($activity->subject_id)->nama_barang;
            $activity->causer_name = $activity->causer_type::find($activity->causer_id)->nama_petugas;
            $activity->save();

            // Redirect
            return redirect()->route('barang.index')->with('success_message', 'Berhasil menambahkan barang baru');
        } catch (\Exception $e) {
            dd($e);
            Log::channel('create_barang')->error('Gagal Menyimpan Data', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('barang.create')
            ->with('error_message', 'Gagal Menyimpan Data');
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
            $barang->gambar_barang = asset('upload/'.$barang->gambar_barang);
            return view('barang.edit', [
                'barang' => $barang
            ]);
        } catch (\Exception $e) {
            Log::channel('update_barang')->error('Gagal mengedit barang: Barang Tidak Ditemukan', [
                'error' => $e->getMessage()
            ]);

            return redirect()->route('barang.index')->with('error_message', 'Gagal mengedit barang: Barang Tidak Ditemukan');
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
                    'kode_barang' => 'required|unique:products,kode_barang,'.$barang->id,
                    'nama_barang' => 'required',
                    'stok_barang' => 'required',
                    'gambar_barang' => 'image|mimes:jpeg,png,jpg,svg',
                ]);
            } catch (\Throwable $e) {
                Log::channel('update_barang')->error('Barang gagal diupdate', [
                    'error' => $e->getMessage()
                ]);
                
                $validator = $this->checkUpdateData($request);
                dd($e);

                return redirect()->route('barang.edit', $id)
                ->with('error_message', 'Gagal Menyimpan: Data kosong atau tidak valid')
                ->withErrors($validator);
            }

            $array = $request->only([
                'kode_barang', 'nama_barang', 'stok_barang', 'status_barang', 'gambar_barang'
            ]);
            $array['kode_barang'] = strtoupper($array['kode_barang']);
            $array['nama_barang'] = strtoupper($array['nama_barang']);
            $array['stok_barang'] = (int) $array['stok_barang'];

            if ($array['stok_barang'] > 0) {
                $array['status_barang'] = 'Tersedia';
            } else {
                $array['status_barang'] = 'Habis';
            }

            // Upload Gambar
            if ($request->hasFile('gambar_barang')) {
                // Upload New Image
                $image = $request->file('gambar_barang');
                $new_image_name = date('YmdHi'). '-' .$image->getClientOriginalName();
                $image->move(public_path('upload'), $new_image_name);
                $array['gambar_barang'] = $new_image_name;

                // Delete Old Image
                if (file_exists('upload/'.$barang->gambar_barang)) {
                    unlink('upload/'.$barang->gambar_barang);
                }
            } else {
                // Keep Old Image
                $array['gambar_barang'] = $barang->gambar_barang;
            }
            
            // Save Updated Data
            $barang->update($array);

            // File Log
            Log::channel('update_barang')->info('Barang berhasil diupdate', [
                'id' => $barang->id,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'stok_barang' => $barang->stok_barang,
                'status_barang' => $barang->status_barang,
                'gambar_barang' => $barang->gambar_barang
            ]);

            // Activity Log
            $activity = activity('Update Barang')
                ->performedOn($barang)
                ->causedBy(auth()->user())
                ->withProperties([
                    'kode_barang' => $barang->kode_barang,
                    'nama_barang' => $barang->nama_barang,
                    'stok_barang' => $barang->stok_barang,
                    'status_barang' => $barang->status_barang,
                    'gambar_barang' => $barang->gambar_barang
                ])
                ->log('Mengupdate Barang');
            $activity->subject_name = $activity->subject_type::find($activity->subject_id)->nama_barang;
            $activity->causer_name = $activity->causer_type::find($activity->causer_id)->nama_petugas;
            $activity->save();

            return redirect()->route('barang.index')->with('success_message', 'Berhasil mengupdate barang dengan kode '.$barang->kode_barang.'');
        } catch (\Exception $e) {
            dd($e);
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

            // Delete Old Image
            if (file_exists('upload/'.$barang->gambar_barang)) {
                unlink('upload/'.$barang->gambar_barang);
            }

            $barang->delete();

            // File Log
            Log::channel('delete_barang')->info('Barang berhasil dihapus', [
                'id' => $barang->id,
                'kode_barang' => $barang->kode_barang,
                'nama_barang' => $barang->nama_barang,
                'stok_barang' => $barang->stok_barang,
                'status_barang' => $barang->status_barang,
                'gambar_barang' => $barang->gambar_barang
            ]);

            // Activity Log
            $activity = activity('Delete Barang')
                ->performedOn($barang)
                ->causedBy(auth()->user())
                ->withProperties([
                    'kode_barang' => $barang->kode_barang,
                    'nama_barang' => $barang->nama_barang,
                    'stok_barang' => $barang->stok_barang,
                    'status_barang' => $barang->status_barang,
                    'gambar_barang' => $barang->gambar_barang
                ])
                ->log('Menghapus Barang');
            $activity->subject_name = $activity->properties['nama_barang'];
            $activity->causer_name = $activity->causer_type::find($activity->causer_id)->nama_petugas;
            $activity->save();
            
            return redirect()->route('barang.index')->with('success_message', 'Berhasil menghapus barang dengan kode '.$barang->kode_barang.'');
        } catch (\Exception $e) {
            Log::channel('delete_barang')->error('Barang gagal dihapus', [
                'error' => $e->getMessage()
            ]);
            return redirect()->route('barang.index')->with('error_message', 'Gagal menghapus barang');
        }
    }

    public function checkData(Request $request)
    {
        // declare array variable
        $validator = array();

        // check all request is not empty
        if ($request->kode_barang == null){
            $validator['kode_barang'] = 'Kode barang tidak boleh kosong';
        } else if (Barang::where('kode_barang', $request->kode_barang)->exists()){
            $validator['kode_barang'] = 'Kode barang sudah ada';
        }

        if ($request->nama_barang == null){
            $validator['nama_barang'] = 'Nama barang tidak boleh kosong';
        }

        if ($request->stok_barang == null){
            $validator['stok_barang'] = 'Stok barang tidak boleh kosong';
        } else if ($request->stok_barang <= 0){
            $validator['stok_barang'] = 'Stok barang tidak boleh kurang dari atau sama dengan 0';
        }

        if ($request->status_barang == null){
            $validator['status_barang'] = 'Status barang tidak boleh kosong';
        }

        if ($request->gambar_barang == null){
            $validator['gambar_barang'] = 'Gambar barang tidak boleh kosong';
        } // check format png, jpg, jpeg, svg 
        else if ($request->gambar_barang->getClientOriginalExtension() != 'png' && $request->gambar_barang->getClientOriginalExtension() != 'jpg' && $request->gambar_barang->getClientOriginalExtension() != 'jpeg' && $request->gambar_barang->getClientOriginalExtension() != 'svg'){
            $validator['gambar_barang'] = 'Format gambar harus png, jpg, jpeg, svg';
        }
        

        // return validator
        return $validator;
    }

    public function checkUpdateData(Request $request)
    {
        // declare array variable
        $validator = array();

        // check all request is not empty
        if ($request->kode_barang == null){
            $validator['kode_barang'] = 'Kode barang tidak boleh kosong';
        } 

        if ($request->nama_barang == null){
            $validator['nama_barang'] = 'Nama barang tidak boleh kosong';
        }

        if ($request->stok_barang == null){
            $validator['stok_barang'] = 'Stok barang tidak boleh kosong';
        } else if ($request->stok_barang < 0){
            $validator['stok_barang'] = 'Stok barang tidak boleh kurang dari 0';
        }

        if ($request->gambar_barang != null){
            if ($request->gambar_barang->getClientOriginalExtension() != 'png' && $request->gambar_barang->getClientOriginalExtension() != 'jpg' && $request->gambar_barang->getClientOriginalExtension() != 'jpeg' && $request->gambar_barang->getClientOriginalExtension() != 'svg'){
            $validator['gambar_barang'] = 'Format gambar harus png, jpg, jpeg, svg';
            }
        }

        // return validator
        return $validator;
    }
}
