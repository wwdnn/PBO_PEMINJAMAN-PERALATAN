<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageUserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.show', compact('products'));
    }

}
