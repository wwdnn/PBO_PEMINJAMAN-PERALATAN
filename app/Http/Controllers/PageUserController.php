<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageUserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pageUser', compact('products'));
    }
    
    public function show($id)
    {
        $products = Product::where('id', $id)->first();
        return response()->json($products);
    }

    public function pinjam(Request $request, $id)
    {
        $products = Product::where('id', $id)->first();
        $products->update([
            'stok' => $products->stok - $request->jumlah
        ]);
        return response()->json($products);
    }
}
