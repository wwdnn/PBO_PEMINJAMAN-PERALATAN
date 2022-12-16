<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinjamanDetail;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\DataTables\PengembalianDataTable;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Mpdf\Tag\Dd;

class PengembalianController extends Controller
{
    public function pengembalian(PengembalianDataTable $dataTable)
    {
        return $dataTable->render('petugas_peralatan.pengembalianBarang');
    }

    public function detailPengembalian(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();

        $pinjaman_details = PinjamanDetail::where('id_pinjaman', $peminjaman->id)->where('status_pinjam_barang', 'Terpinjam')->get();

        if(count($pinjaman_details) == 0)
        {
            // update status peminjaman
            $peminjaman->status_peminjaman = "Dikembalikan";
            $peminjaman->save();
            Alert::success('Berhasil', 'Barang Sudah Dikembalikan');
            return redirect('/petugas_peralatan/pengembalian-barang');
        }
        else
        {
            return view('petugas_peralatan.detailPengembalian', compact('peminjaman', 'pinjaman_details'));
        }

        
    }

    public function pengembalianBarang(Request $request)
    {   
        //tanggal pengembalian
        $tanggal_pengembalian = Carbon::now()->format('Y-m-d');
        // update stok barang
        $pinjaman_detail = PinjamanDetail::where('id_barang', $request->id_barang)->first();

        if($request->jumlah_barang_dikembalikan > $pinjaman_detail->jumlah_barang)
        {
            Alert::error('Maaf', 'Jumlah Barang Yang Dikembalikan Tidak Boleh Lebih Dari Jumlah Barang Yang Dipinjam');
            return redirect()->back();
        }
        else if ($request->jumlah_barang_dikembalikan <= 0){
            Alert::error('Maaf', 'Jumlah Barang Yang Dikembalikan Tidak Boleh Kurang Dari 1');
            return redirect()->back();
        }
        
        if($request->status == "Dikembalikan")
        {
            $product = Product::where('id', $request->id_barang)->first();
            $product->stok_barang = $product->stok_barang + $request->jumlah_barang_dikembalikan;
            $product->save();

            // update status pinjam barang
            if($pinjaman_detail->jumlah_barang == $request->jumlah_barang_dikembalikan)
            {
                $pinjaman_detail->status_pinjam_barang = "Dikembalikan";
                $pinjaman_detail->save();
            }
            else
            {
                $pinjaman_detail->jumlah_barang = $pinjaman_detail->jumlah_barang - $request->jumlah_barang_dikembalikan;
                $pinjaman_detail->save();
            }

            // save to database pengembalian
            $pengembalian = new Pengembalian();
            $pengembalian->id_petugas_peralatan = $request->id_petugas_peralatan;
            $pengembalian->id_barang = $request->id_barang;
            $pengembalian->tanggal_pengembalian = $tanggal_pengembalian;
            $pengembalian->jumlah_barang_dikembalikan = $request->jumlah_barang_dikembalikan;
            // $pengembalian->save();

            Alert::success('Berhasil', 'Barang Berhasil Dikembalikan');
        }
        else
        {
            Alert::error('Maaf', 'Barang Belum Dikembalikan');
        }
        return redirect()->back();
    }
}
