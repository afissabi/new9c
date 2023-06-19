<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\M_menu;
use App\Models\Website\Konten_section;
use App\Models\Website\M_section;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class SectionController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Website - Section Page";
        View::share(compact('pageTitle'));
    }

    public function indexMaster()
    {
        $pageTitle = "Master - Section";
        $menu = M_menu::where('tipe','fo')->where('status_menu',1)->get();
        $section = M_section::all();

        $data = [
            'menu' => $menu,
            'section' => $section,
            'pageTitle' => $pageTitle,
        ];

        return view('master.section', $data);
    }

    public function datatableMaster()
    {
        $datas = M_section::orderBy('name_section')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = '<center>' . $key + 1 . '</center>';
            $data_tables[$key][] = '<center>' . $value->menu->nama_menu . '</center>';
            $data_tables[$key][] = '<center>' . $value->name_section . '</center>';
            $data_tables[$key][] = '<center>' . $value->part . '</center>';

            if($value->is_ulang == 't'){ 
                $data_tables[$key][] = '<center>Berulang</center>';
            }else{
                $data_tables[$key][] = '<center>Tidak</center>';
            }
            
            $data_tables[$key][] = '<center>' . $value->keterangan . '</center>';
            
            $aksi = '';
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_section="' . $value->id_section . '"><i class="fa fa-edit text-info"></i> Edit</a>';
            $aksi .= '&nbsp; <a href="#!" onClick="hapus(' . $value->id_section . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';
            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function storeMaster(Request $request)
    {
        $data = new M_section();

        $data->id_menu = $request->menu;
        $data->name_section = $request->name_section;
        $data->part = $request->part;
        $data->is_ulang = $request->is_ulang;
        $data->keterangan = $request->keterangan;
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

    public function editMaster(Request $request)
    {
        $data   = M_section::findOrFail($request->section);

        return response()->json($data);
    }

    public function ubahMaster(Request $request)
    {
        $data = M_section::findOrFail($request->id_section);

        $data->id_menu = $request->menu;
        $data->name_section = $request->name_section;
        $data->part = $request->part;
        $data->is_ulang = $request->is_ulang;
        $data->keterangan = $request->keterangan;

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

    public function destroyMaster(Request $request)
    {

        $data = M_section::findOrFail($request->id);

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

    public function index()
    {
        $menu = M_menu::where('parent_id',20)->where('status_menu',1)->get();
        $section = M_section::all();

        $data = [
            'menu' => $menu,
            'section' => $section,
        ];

        return view('website.section', $data);
    }

    public function datatable()
    {
        $datas = Konten_section::all();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center>' . $value->sect->menu->nama_menu . '</center>';
            $data_tables[$key][] = '<center>' . $value->sect->name_section . '</center>';
            $data_tables[$key][] = '<center>' . $value->sect->part . '</center>';
            $data_tables[$key][] = '<center>' . $value->judul . '</center>';
            $data_tables[$key][] = '<center>' . $value->konten . '</center>';
            $data_tables[$key][] = '<center>' . $value->link . '</center>';
            
            $data_tables[$key][] = '<center><img src="' . asset($value->path . $value->gambar) . '" style="width: 100px;"></center>';

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_konten_section="' . $value->id_konten_section . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapusKonten(' . $value->id_konten_section . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $ulang = M_section::where('id_section',$request->section)->where('is_ulang','t')->first();
        
        if($ulang){
            $data = new Konten_section();
        }else{
            $cek = Konten_section::where('id_section',$request->section)->first();
            if($cek){
                $data = $cek;
            }else{
                $data = new Konten_section();
            }
        }
        
        $id = Konten_section::max('id_konten_section') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $imageName =  'sct-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.jpg';

            $destinationPath = public_path('/img/section/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/section/";
        } else {
            $imageName = 'default.jpg';
            $destinationPathori = "img/";
        }

        $data->id_section = $request->section;
        $data->judul   = $request->judul;
        $data->konten   = $request->konten;
        $data->link   = $request->link;
        $data->gambar   = $imageName;
        $data->path     = $destinationPathori;

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
        $data = Konten_section::where('id_konten_section',$request->konten)->first();
        
        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = Konten_section::where('id_konten_section',$request->id_konten_section)->first();
        $id = $data->id_konten_section;
        
        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $imageName =  'sct-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.jpg';

            $destinationPath = public_path('/img/section/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/section/";
        } else {
            $imageName = $data->gambar;
            $destinationPathori = $data->path;
        }

        $data->id_section = $request->section;
        $data->judul   = $request->judul;
        $data->konten   = $request->konten;
        $data->link   = $request->link;
        $data->gambar   = $imageName;
        $data->path     = $destinationPathori;

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

        $data = Konten_section::findOrFail($request->id);

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
