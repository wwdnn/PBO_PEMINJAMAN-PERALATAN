<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetugasPeralatan;

class PetugasPeralatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:petugas_peralatan');
    }

    public function index()
    {
        // get current authenticated user
        $petugas = auth()->user();
        return view('petugas_peralatan.home')->with('petugas', $petugas);
    }
    
    public function getEmailPetugas()
    {
        $petugas = PetugasPeralatan::all();
        return $petugas;
    }
}
