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
            $rol_usuario = $rol_usuario->roles()->first()->name;
        }

        switch ( $rol_usuario )
        {
            case 'Super Administrador':
            case 'Empleado':
                return redirect()->route('admin.dashboard.index');
                break;
            case 'Docente':
                return redirect()->route('docente.dashboard.index');
                break;
            case 'Estudiante':
                return redirect()->route('estudiante.dashboard.index');
                break;
            default:
                return abort('404');
                break;
        }
    }
}
