<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
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

        $roles = Role::all();
        return view(
            'roles.index',
            compact(
                'session_auth',
                'session_name',
                'roles'
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

        $permissions = Permission::get();

        return view(
            'roles.create',
            compact(
                'session_auth',
                'session_name',
                'permissions'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($rol)
    {
        $role = Role::findById($rol);
        $permissions = Permission::all();
        $groupedPermissions = [];

        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->name);
            $group = $parts[0];
            if (!isset($groupedPermissions[$group])) {
                $groupedPermissions[$group] = [];
            }
            $groupedPermissions[$group][] = $permission;
        }

        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $rol)
            ->pluck('role_has_permissions.permission_id')
            ->all();

        $filteredGroupedPermissions = [];
        foreach ($groupedPermissions as $group => $permissions) {
            $filteredPermissions = array_filter($permissions, function ($permission) use ($rolePermissions) {
                return in_array($permission->id, $rolePermissions);
            });
            if (!empty($filteredPermissions)) {
                $filteredGroupedPermissions[$group] = $filteredPermissions;
            }
        }
        // return $filteredGroupedPermissions;
        return response()->json([
            'role' => $role,
            'filteredGroupedPermissions' => $filteredGroupedPermissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($rol)
    {
        $session_auth = auth()->user();
        $session_name = "";

        if ($session_auth->id == 1 && $session_auth->username == 'AdminCMF') {
            $session_name = $session_auth->username;
        } else {
            $session_name = $session_auth->nombre;
        }

        $role = Role::findById($rol);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $rol)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view(
            'roles.edit',
            compact(
                'session_auth',
                'session_name',
                'role',
                'permissions',
                'rolePermissions'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $rol)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::findById($rol);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
