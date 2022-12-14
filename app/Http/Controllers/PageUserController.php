<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Alert;
use Illuminate\Http\Request;
use App\DataTables\MahasiswaDataTable;
use App\DataTables\DosenDataTable;

class PageUserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.show', compact('products'));
    }

    public function search(Request $request)
    {
       if($request->has('search'))
       {
            $products = Product::where('nama_barang', 'LIKE', '%'.$request->search.'%')->get();
            if(count($products) == 0)
            {
                Alert::error('Maaf', 'Barang Tidak Ditemukan');
                $products = Product::all();
            }
       }
        else
        {
            $products = Product::all();
        }
     
        return view('products.show', compact('products'));
    }

    public function getUser(MahasiswaDataTable $dataTable)
    {
        return $dataTable->render('petugas_peralatan.mahasiswa');
    }

    public function getDosen(DosenDataTable $dataTable)
    {
        return $dataTable->render('petugas_peralatan.dosen');
    }
}
