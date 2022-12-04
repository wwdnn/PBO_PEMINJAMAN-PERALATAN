<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasPeralatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:petugas_peralatan');
    }

    public function index()
    {
        return view('petugas_peralatan.index');
    }
}
