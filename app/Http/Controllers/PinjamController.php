<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\PinjamanDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Alert;
use Illuminate\Support\Facades\Auth;

class PinjamController extends Controller
{
    public function index($id)
    {
        $products = Product::where('id', $id)->first();
        return view('products.detailProduct', compact('products'));
    }

    public function pinjam(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $tanggal = Carbon::now();

        // Validasi jumlah barang yang dipinjam
        if ($request->jumlah_barang > $product->stok_barang) {
            Alert::error('Gagal Dipinjam', 'Jumlah Barang Yang Dipinjam Melebihi Stok Barang');
            return redirect()->back();
        }

        // Cek Validasi
        $cek_pinjaman = Peminjaman::where('id_user', Auth::user()->id)->where('status_peminjaman', 0)->first();

        if(empty($cek_pinjaman))
        {
            // simpan ke database
            $pinjaman = new Peminjaman();
            $pinjaman->id_user = Auth::user()->id;
            $pinjaman->status_peminjaman = 0;
            $pinjaman->tanggal_peminjaman = $tanggal;
            $pinjaman->save();
        }


        // simpan ke database pesanan details
        $Pinjaman_baru = Peminjaman::where('id_user', Auth::user()->id)->where('status_peminjaman', 0)->first();

        // cek pesanan detail
        $cek_pinjaman_detail = PinjamanDetail::where('id_barang', $product->id)->where('id_pinjaman', $Pinjaman_baru->id)->first();

        if(empty($cek_pinjaman_detail))
        {
            $pinjaman_detail = new PinjamanDetail();
            $pinjaman_detail->id_pinjaman = $Pinjaman_baru->id;
            $pinjaman_detail->id_barang = $product->id;
            $pinjaman_detail->jumlah_barang = $request->jumlah_barang;
            $pinjaman_detail->save();
        }
        else
        {
            $pinjaman_detail = PinjamanDetail::where('id_barang', $product->id)->where('id_pinjaman', $Pinjaman_baru->id)->first();

            $pinjaman_detail->jumlah_barang = $pinjaman_detail->jumlah_barang + $request->jumlah_barang;

            // update jumlah
            $pinjaman_detail->update();
        }

        // alert success
        alert()->success('Berhasil Dipinjam','Barang Berhasil Dimasukkan Ke Keranjang');

        return redirect('cart-peminjaman');

    }

    public function cart()
    {
        $peminjaman = Peminjaman::where('id_user', Auth::user()->id)->where('status_peminjaman', 0)->first();

        if(!empty($peminjaman))
        {
            $pinjaman_details = PinjamanDetail::where('id_pinjaman', $peminjaman->id)->get();
            return view('cart.index', compact('peminjaman','pinjaman_details'));
        }
        else
        {
            return view('cart.index');
        }
    }

    public function delete($id)
    {
        $pinjaman_detail = PinjamanDetail::where('id', $id)->first();
        $peminjaman = Peminjaman::where('id', $pinjaman_detail->id_pinjaman)->first();
        $pinjaman_detail->delete();

        Alert::error('Berhasil Dihapus', 'Barang Yang Dipinjam Berhasil Dihapus');
        return redirect('cart-peminjaman');
    }

    public function deleteAll()
    {

        $peminjaman = Peminjaman::where('id_user', Auth::user()->id)->where('status_peminjaman', 0)->first();
        $pinjaman_details = PinjamanDetail::where('id_pinjaman', $peminjaman->id)->delete();

        return redirect('cart-peminjaman');
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();

        $peminjaman = Peminjaman::where('id_user', Auth::user()->id)->where('status_peminjaman',0)->first();
        
        $id_pinjaman = $peminjaman->id;
        $peminjaman->status_peminjaman = 1;
        $peminjaman->update(); 
        
        $pinjaman_details = PinjamanDetail::where('id_pinjaman', $id_pinjaman)->get();

        foreach ($pinjaman_details as $pinjaman_detail) {
            $product = Product::where('id', $pinjaman_detail->id_barang)->first();
            $product->stok_barang = $product->stok_barang - $pinjaman_detail->jumlah_barang;
            $product->update();
        }

        Alert::success('Pinjaman Barang Berhasil', 'Barang yang anda pinjam berhasil dipinjam');
        return redirect('cart-peminjaman');

    }
}
