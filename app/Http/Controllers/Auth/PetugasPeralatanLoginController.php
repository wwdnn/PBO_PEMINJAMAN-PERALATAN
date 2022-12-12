<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Hash;
>>>>>>> main


class PetugasPeralatanLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:petugas_peralatan', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.petugas_peralatan_login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to log the user in
        if (Auth::guard('petugas_peralatan')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('petugas_peralatan.dashboard'));
        } else {
            dd(Auth::guard('petugas_peralatan')->attempt(['username' => $request->username, 'password' => $request->password]));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username'));
    }

    public function logout()
    {
        Auth::guard('petugas_peralatan')->logout();
<<<<<<< HEAD
        return redirect()->route('petugas_peralatan.login');
=======
        return redirect('/petugas_peralatan');
>>>>>>> main
    }
}
