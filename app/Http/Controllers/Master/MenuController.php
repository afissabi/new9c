<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\M_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;

class MenuController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Master Menu";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        $menu = M_menu::where('status_menu', 1)->where('parent_id',null)->get();

        $data = [
            'all' => $menu,
        ];

        return view('master.menu',$data);
    }

    public function datatable()
    {
        $datas = M_menu::orderBy('parent_id')->orderBy('urutan')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = '<center>' . $key + 1 . '</center>';
            $data_tables[$key][] = '<center>' . $value->urutan . '</center>';
            $data_tables[$key][] = $value->nama_menu;
            $data_tables[$key][] = '<center>' . $value->icon . '<br><i class="' . $value->icon . '"></i></center>';
            if ($value->status_menu == 1) {
                $data_tables[$key][] = '<span class="badge badge-success">AKTIF</span>';
            } else {
                $data_tables[$key][] = '<span class="badge badge-danger">NON AKTIF</span>';
            }

            if ($value->tipe == 'bo') {
                $data_tables[$key][] = '<span class="badge badge-danger">BACK OFFICE (BO)</span>';
            } else {
                $data_tables[$key][] = '<span class="badge badge-info">FRONT OFFICE (FO)</span>';
            }

            
            $aksi = '';
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_menu="' . $value->id_menu . '"><i class="fa fa-edit text-info"></i> Edit</a>';
            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_menu . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';
            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = new M_menu;

        $data->nama_menu = $request->nama_menu;
        $data->status_menu = $request->aktif_menu ? 1 : 0;
        $data->url_menu = $request->url_menu;
        $data->parent_id = $request->parent;
        $data->urutan = $request->urutan;
        $data->icon = $request->icon;
        $data->tipe = $request->tipe;

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
        $data   = M_menu::findOrFail($request->menu);

        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_menu::findOrFail($request->id_menu);

        $data->nama_menu = $request->nama_menu;
        $data->status_menu = $request->aktif_menu ? 1 : 0;
        $data->url_menu = $request->url_menu;
        $data->parent_id = $request->parent;
        $data->urutan = $request->urutan;
        $data->icon = $request->icon;
        $data->tipe = $request->tipe;

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
