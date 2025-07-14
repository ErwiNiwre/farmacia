<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Clasificacion;
use App\Models\LaboratorioServicio;
use Carbon\Carbon;
use DataTables;

class LaboratorioServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:laboratorioServicio.index|laboratorioServicio.create|laboratorioServicio.show', ['only' => ['index']]);
        $this->middleware('permission:laboratorioServicio.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:laboratorioServicio.show', ['only' => ['show']]);
        $this->middleware('permission:laboratorioServicio.destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $laboratorio_servicios = DB::table('laboratorio_servicios')
            ->select(
                'laboratorio_servicios.id',
                'servicio',
                'precio',
                'clasificacion'
            )
            ->join('clasificaciones', 'clasificaciones.id', '=', 'laboratorio_servicios.clasificacion_id')
            ->whereNull('laboratorio_servicios.deleted_at')
            ->get()->map(function ($laboratorio_servicio) {
                return [
                    'id'              => $laboratorio_servicio->id,
                    'servicio'        => $laboratorio_servicio->servicio,
                    'precio'        => $laboratorio_servicio->precio,
                    'clasificacion' => $laboratorio_servicio->clasificacion,
                    'edit_url'           => route('laboratorioServicios.edit', $laboratorio_servicio->id),
                ];
            });

        return view(
            'laboratorioServicios.index',
            compact(
                'session_auth',
                'session_name',
                'laboratorio_servicios'
            )
        );
    }

    public function create()
    {

        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $clasificacion = Clasificacion::All();

        return view(
            'laboratorioServicios.create',
            compact(
                'session_auth',
                'session_name',
                'clasificacion'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'servicio' => 'required',
            'precio' => 'required',
        ]);
        $laboratorioServicio = new LaboratorioServicio();
        $laboratorioServicio->servicio = $request->servicio;
        $laboratorioServicio->precio = $request->precio;
        $laboratorioServicio->clasificacion_id = $request->clasificacion_id;
        $laboratorioServicio->created_by = auth()->id();
        $laboratorioServicio->created_at = Carbon::now();
        $laboratorioServicio->save();
        return redirect()->route('laboratorioServicios.index');
    }

    public function show($id)
    {
        $laboratorio_servicio = LaboratorioServicio::find($id);
        $clasificacion = Clasificacion::find($laboratorio_servicio->clasificacion_id);

        if (!$laboratorio_servicio) {
            return response()->json([
                'status' => 404,
                'message' => 'No hay datos del Servicio.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => [
                'laboratorio_servicio' => $laboratorio_servicio,
                'clasificacion' => $clasificacion
            ]
        ]);
    }

    public function edit($id)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $laboratorioServicio = LaboratorioServicio::find($id);
        $clasificaciones = Clasificacion::All();

        return view(
            'laboratorioServicios.edit',
            compact(
                'session_auth',
                'session_name',
                'clasificaciones',
                'laboratorioServicio'
            )
        );
    }


    public function update(Request $request, $id)
    {
        $laboratorioServicio = LaboratorioServicio::find($id);
        $laboratorioServicio->servicio = $request->servicio;
        $laboratorioServicio->clasificacion_id = $request->clasificacion_id;
        $laboratorioServicio->precio =  $request->precio;

        $laboratorioServicio->updated_by = auth()->id();
        $laboratorioServicio->updated_at = Carbon::now();
        $laboratorioServicio->save();

        return redirect()->route('laboratorioServicios.index');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $laboratorioServicio = LaboratorioServicio::find($id);

            if (!$laboratorioServicio) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Laboratorio Servicio no encontrado.'
                ], 404);
            }

            $laboratorioServicio->deleted_by = auth()->id();
            $laboratorioServicio->save();

            $laboratorioServicio->delete();

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Laboratorio Servicio eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'Ocurrió un error al eliminar el Laboratorio Servicio.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
