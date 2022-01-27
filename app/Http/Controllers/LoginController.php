<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $empresa = Empresa::first();

        return view('auth.login', compact('empresa'));
    }

    public function login(Request $request)
    {
        $credenciales = $this->validate(request(), [
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        if ( Auth::attempt($credenciales) )
        {
            return redirect()->route('dashboard');
        }

        return back()
		->withErrors(['user' => trans('auth.failed')])
		->withInput(request(['user']));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
