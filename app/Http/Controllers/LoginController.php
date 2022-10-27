<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('dashboard.index');

    }

    public function authenticate(Request $request)
    {
        $nim_nidn = $request->NIM_NIDN;

        $data = User::where('NIM_NIDN', $nim_nidn)->first();
        if($data){ 
            if($data->status == 1){
                Session::put('name', $data->name);
                return redirect('/dashboard');
            }else{
                return redirect('/')->with('alert','NIM/NIDN ANDA TIDAK AKTIF!');
            }
        }else{
            return redirect('/')->with('alert','NIM/NIDN ANDA TIDAK TERDAFTAR!');
        }
    }
}
