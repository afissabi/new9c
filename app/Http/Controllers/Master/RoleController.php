<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\M_menu;
use App\Models\Master\MenuRole;
use App\Models\Master\ModelHasPermission;
use App\Models\Master\Permission;
use App\Models\Master\Role;
use App\Models\Master\RoleHasPermission;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Master Role";
        View::share(compact('pageTitle'));
    }

    public function datatable(Request $request)
    {
        // $this->checkRolePermission('config_role_index');

        if ($request->ajax()) {
            $data = Role::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<center><a href="' . url("master/role/edit", $data->id) . '" class="btn btn-primary mb-2">Update</a> <br>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function index(Request $request)
    {
        // $this->checkRolePermission('config_role_index');
        return view('master.role.index');
    }

    public function create(Request $request)
    {
        // $this->checkRolePermission('config_role_create');

        $permission = Permission::select('*')->get();
        $menu = M_menu::select('*')->where('tipe','bo')->get();

        $data = [
            "permission" => $permission,
            "menu" => $menu,
        ];

        return view('master.role.create', $data);
    }

    public function edit(Request $request)
    {
        // $this->checkRolePermission('config_role_update');

        $role = Role::find($request->id);
        $permission = Permission::select('*')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $request->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        $menuRole = M_menu::selectRaw("m_menu.*, menu_id")->leftJoin(DB::raw("(select * from menu_role where role_id = $role->id and deleted_at is null) menu_role"), "m_menu.id_menu", "=", "menu_role.menu_id")->where('tipe','bo')->get();

        $data = [
            "role" => $role,
            "permission" => $permission,
            "rolePermissions" => $rolePermissions,
            "menuRole" => $menuRole
        ];
        return view('master.role.update', $data);
    }

    public function store(Request $request)
    {
        // $this->checkRolePermission('config_role_create');

        DB::beginTransaction();
        try {

            $data = new Role;
            $data->name = $request->name;
            $data->save();

            foreach ($request->menu as $item) {
                $dataMenu = new MenuRole;
                $dataMenu->role_id = $data->id;
                $dataMenu->menu_id = $item;
                $dataMenu->save();
            }

            if($request->permission){
                foreach ($request->permission as $item) {
                    $dataPermission = new RoleHasPermission;
                    $dataPermission->role_id = $data->id;
                    $dataPermission->permission_id = $item;
                    $dataPermission->save();
                }
            }
            
            // $data->syncPermissions($request->permission);

            $data = [
                "nextURL" => url('/master/role/')
            ];

            DB::commit();
            return $this->successJson("Yayy, Data berhasil disimpan", $data, null);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->failedJson("Oops, ada kesalahan sistem, mohon hubungi admin", $e->getMessage(), null);
        }
    }

    public function update(Request $request)
    {
        // $this->checkRolePermission('config_role_update');
        DB::beginTransaction();
        try {
            $data = Role::find($request->id);
            $data->name = $request->name;
            $data->save();
            // $data->syncPermissions($request->permission);

            foreach ($request->menu as $item) {
                MenuRole::updateOrCreate(
                    ['menu_id' => $item, "role_id" => $data->id],
                    ['menu_id' => $item]
                );
            }

            if($request->permission){
                foreach ($request->permission as $item) {
                    RoleHasPermission::updateOrCreate(
                        ['permission_id' => $item, "role_id" => $data->id],
                        ['permission_id' => $item]
                    );
                }
            }

            MenuRole::whereNotIn("menu_id", $request->menu)->where("role_id", $request->id)->delete();

            $data = [
                "nextURL" => url('/master/role/')
            ];

            DB::commit();
            return $this->successJson("Yayy, Data berhasil disimpan", $data, null);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->failedJson("Oops, ada kesalahan sistem, mohon hubungi admin", $e->getMessage(), null);
        }
    }
}
