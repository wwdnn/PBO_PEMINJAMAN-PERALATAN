<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // login berdasarkan nim_nidn
        $user = User::where('NIM_NIDN', $request->NIM_NIDN)->first();
        if ($user) {
            return redirect()->to('pageUser');
        } else {
            return redirect()->back()->with('alert', 'NIM/NIDN tidak terdaftar');
        }

    }
}
