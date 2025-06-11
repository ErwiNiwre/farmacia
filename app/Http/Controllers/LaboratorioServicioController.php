<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Clasificacion;
use App\Models\LaboratorioServicio;
use DataTables;

class LaboratorioServicioController extends Controller
{
    use SoftDeletes;
    public function index()
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }




        $laboratorioServicio = LaboratorioServicio::all();
        return view(
            'laboratorioServicios.index',
            compact(
                'session_auth',
                'session_name',
                'laboratorioServicio'
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
        $permissions = LaboratorioServicio::get();

        return view(
            'laboratorioServicios.create',
            compact(
                'session_auth',
                'session_name',
                'permissions',
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
        $laboratorioServicio->save();
        return redirect()->route('laboratorioServicios.index');
    }

    public function getListLaboratorioServicio()
    {
        $listServicios= DB::table('laboratorio_servicios')
            ->select(
                'laboratorio_servicios.id as id',
                'laboratorio_servicios.servicio',
                'laboratorio_servicios.precio',
                'clasificaciones.clasificacion as clasificacion'
            )
           ->join('clasificaciones', 'clasificaciones.id', '=', 'laboratorio_servicios.clasificacion_id')
            ->whereNull('laboratorio_servicios.deleted_at')
            ->orderBy('laboratorio_servicios.id', 'desc')
            ->get();



        return DataTables::of($listServicios)
            ->addColumn('action', function ($listServicios) {
                $buttons = [];

                $buttons[] = '<a href="' . route('laboratorioServicios.edit', $listServicios->id) . '" class="btn btn-secondary" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                $buttons[] = '<a onclick="return confirm(\'Esta seguro que desea eliminar el registo?\')" href="' . route('laboratorioServicios.destroy', $listServicios->id) . '" class="waves-effect waves-light btn btn-danger mb-5" title="Eliminar"><i class="fa fa-bitbucket" aria-hidden="true"></i></a>';
                 return implode(' ', $buttons);
            })
            ->toJson();
    }

    public function edit($id)
    {

        //

        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $laboratorioServicio = LaboratorioServicio::find($id);
         $clasificaciones = Clasificacion::All();
        $permissions = LaboratorioServicio::get();

        // return $especialidad;
        return view(
            'laboratorioServicios.edit',
            compact(
               'session_auth',
                'session_name',
                'permissions',
                'clasificaciones',
                'laboratorioServicio'
            )
        );
    }


      public function update(Request $request, $id)
    {
        // print_r($request->all());
        // exit;
        $request->validate([
            'servicio' => 'required',
            'precio' => 'required',

        ]);
             $session_auth = auth()->user();
        $session_name = "";
        //Se referencia al usuario Logueado
     if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }


        // Paciente registro
        $laboratorioServicio = LaboratorioServicio::find($id);
        // return $paciente;
        $laboratorioServicio->servicio = $request->servicio;
        $laboratorioServicio->clasificacion_id = $request->clasificacion_id;
        $laboratorioServicio->precio =  $request->precio;

        $laboratorioServicio->save();

        return redirect()->route('laboratorioServicios.index');

    }

        public function destroy($id)
    {
        //
         
 
        $laboratorioServicio = LaboratorioServicio::find($id);
        // $laboratorioServicio->eliminacion_usuario = $sesion_nombre;
        // $laboratorioServicio->save();
       
        $laboratorioServicio->delete();

        return redirect()->route('laboratorioServicios.index');
    }

}
