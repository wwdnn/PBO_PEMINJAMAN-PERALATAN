<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Alert;
use Illuminate\Http\Request;

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

}
