<?php

namespace App\Http\Controllers;

use App\Models\AccionTerapeutica;
use App\Models\Concentracion;
use App\Models\Marca;
use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $productos = Producto::all();
        return view(
            'productos.index',
            compact(
                'session_auth',
                'session_name',
                'productos'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $concentraciones = Concentracion::get();
        $marcas = Marca::get();
        $presentaciones = Presentacion::get();
        $accionTerapeuticas = AccionTerapeutica::get();
        $unidadMedidas = UnidadMedida::get();

        return view(
            'productos.create',
            compact(
                'session_auth',
                'session_name',
                'concentraciones',
                'marcas',
                'presentaciones',
                'accionTerapeuticas',
                'unidadMedidas'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
