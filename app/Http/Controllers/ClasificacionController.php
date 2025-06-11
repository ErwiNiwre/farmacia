<?php

namespace App\Http\Controllers;
use App\Models\AccionTerapeutica;
use App\Models\Concentracion;
use App\Models\Marca;
use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\UnidadMedida;
use App\Models\Clasificacion;
use Illuminate\Http\Request;


class ClasificacionController extends Controller
{
   public function index()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $clasificacion = Clasificacion::all();
        return view(
            'clasificaciones.index',
            compact(
                'session_auth',
                'session_name',
                'clasificacion'
            )
        );
    }

    public function create()
    {

        exit;
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

         $permissions = Permission::get();

        return view(
            'clasificaciones.create',
            compact(
                'session_auth',
                'session_name',
                'permissions'
            )
        );
    }
}
