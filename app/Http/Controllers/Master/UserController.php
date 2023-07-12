<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\DetailUser;
use App\Models\M_klinik;
use App\Models\Master\M_user;
use App\Models\Master\Master;
use App\Models\Master\Role;
use App\Models\ModelHasRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class UserController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Master User";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        $user = Auth::user();
        $klinik = M_klinik::all();
        $roles = ModelHasRoles::where('model_id',$user->id)->first();

        if($roles->role_id == 1){
            $role = Role::all();
        }else{
            $role = Role::where('id','!=', 1 )->get();
        }
        $totalUser = collect(Master::TotalUser());

        $data = [
            'role' => $role,
            'klinik' => $klinik,
            'totalUser' => $totalUser,
        ];

        return view('master.user',$data);
    }

    public function datatable()
    {
        $user = Auth::user();
        $roles = ModelHasRoles::where('model_id',$user->id)->first();
        // ARRAY ROLE_ID
        $roleId = $roles->pluck('model_id');

        if($roles->role_id == 1){
            $datas = User::orderBy('id')->get();
        }else{
            $datas = User::where('id','!=', 1 )->orderBy('id')->get();
        }

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = '<center>' . $key + 1 . '</center>';
            $data_tables[$key][] = '<center>' . $value->name . '</center>';
            $data_tables[$key][] = '<center>' . $value->username . '</center>';
            $data_tables[$key][] = '<center>' . $this->roleName($value->id) . '</center>';
            
            if ($value->is_aktif == 1) {
                $data_tables[$key][] = '<span class="badge badge-danger">NON AKTIF</span>';
            } else {
                $data_tables[$key][] = '<span class="badge badge-success">AKTIF</span>';
            }
            
            $aksi = '';
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_user="' . $value->id . '"><i class="fa fa-edit text-info"></i> Edit</a>';
            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';
            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    private function roleName($model_id){
        $cek = ModelHasRoles::where('model_id',$model_id)->first();

        return $cek->role->name;
    }

    public function store(Request $request)
    {
        $data = new User();
        $id = User::max('id') + 1;

        $data->name = $request->nama;
        $data->username = $request->username;
        $data->is_aktif = $request->is_aktif ? null : 1;
        $data->password = Hash::make($request->password);
        // NAMBAH DETAIL USER
        $detail = new DetailUser();
        $detail->user_id = $id;
        $detail->id_klinik = $request->klinik;
        $detail->save();

        $has = new ModelHasRoles;
        $has->model_id = $id;
        $has->model_type = 'App\Models\User';
        $has->role_id  = $request->role;
        $has->save();

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->user);
        $role = ModelHasRoles::where('model_id',$request->user)->first();

        $data = [
            'user' => $user,
            'role' => $role,
        ];

        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = User::findOrFail($request->id_user);

        $data->name = $request->nama;
        $data->username = $request->username;
        $data->is_aktif = $request->is_aktif ? null : 1;
        if($request->password){
            $data->password = Hash::make($request->password);
        }
        
        // NAMBAH DETAIL USER
        $detail = DetailUser::where('user_id',$request->id_user)->first();
        $detail->id_klinik = $request->klinik;
        $detail->save();

        $has = ModelHasRoles::where('model_id',$request->id_user)->first();
        $has->model_id = $data->id;
        $has->model_type = 'App\Models\User';
        $has->role_id  = $request->role;
        $has->save();

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {

        $data = M_menu::findOrFail($request->id);

        if ($data->delete()) {

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Terhapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Terhapus!',
            ]);
        }
    }
}
