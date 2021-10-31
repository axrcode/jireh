<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('login.index');
    }

    public function dashboard()
    {
        $rol_usuario = auth()->user();

        if ( !$rol_usuario ) {
            return redirect()->route('login.index');
        } else {
            return redirect()->route('admin.dashboard.index');
        }
    }
}
