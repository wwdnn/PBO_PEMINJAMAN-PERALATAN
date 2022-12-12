<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinjamanDetail;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Product;
use Alert;


class PengembalianController extends Controller
{
    public function pengembalian()
    {
        $peminjamans = Peminjaman::where('status_peminjaman', 'Terpinjam')->get();
        return view('petugas_peralatan.pengembalianBarang', compact('peminjamans'));
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
        $tanggal_pengembalian = Cursor::now()->format('Y-m-d');
        // update stok barang
        $pinjaman_detail = PinjamanDetail::where('id_barang', $request->id_barang)->first();
        
        if($request->status == "Dikembalikan")
        {
            $product = Product::where('id', $request->id_barang)->first();
            $product->stok_barang = $product->stok_barang + $pinjaman_detail->jumlah_barang;
            $product->save();

            // update status pinjam barang
            $pinjaman_detail->status_pinjam_barang = $request->status;
            $pinjaman_detail->save();

            // save to database pengembalian
            $pengembalian = new Pengembalian();
            $pengembalian->id_petugas_peralatan = $pinjaman_detail->id_pinjaman;
            $pengembalian->id_barang = $request->id_barang;
            $pengembalian->tanggal_pengembalian = $tanggal_pengembalian;
            
        }
        return redirect()->back();
    }
}
