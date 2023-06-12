<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BankPencarian;
use App\Models\Website\M_artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class ArtikelController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Website - Artikel";
        View::share(compact('pageTitle'));
    }

    public function index($kategori)
    {
        $artikel = M_artikel::orderBy('updated_at','DESC')->get();
        $active_blog = '';
        $active_sosial = '';
        $active_acara = '';

        if($kategori == 'blog'){
            $active_blog = 'active';
        }else if($kategori == 'misi-sosial'){
            $active_sosial = 'active';
        }else if($kategori == 'acara'){
            $active_acara = 'active';
        }

        $data = [
            'artikel' => $artikel,
            'kategori' => $kategori,
            'active_blog' => $active_blog,
            'active_sosial' => $active_sosial,
            'active_acara' => $active_acara,
        ];

        return view('website.artikel', $data);
    }

    public function create($kategori)
    {
        $active_blog = '';
        $active_sosial = '';
        $active_acara = '';

        if($kategori == 'blog'){
            $active_blog = 'active';
        }else if($kategori == 'misi-sosial'){
            $active_sosial = 'active';
        }else if($kategori == 'acara'){
            $active_acara = 'active';
        }

        $data = [
            'kategori' => $kategori,
            'active_blog' => $active_blog,
            'active_sosial' => $active_sosial,
            'active_acara' => $active_acara,
        ];

        return view('website.artikelcreate',$data);
    }

    public function datatable(Request $request)
    {
        $datas = M_artikel::where('kategori',$request->kategori)->orderBy('updated_at','DESC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            if($value->is_jadwal){
                $data_tables[$key][] = '<center><i class="fas fa-stopwatch"></i><br>' .  \Carbon\Carbon::parse($value->jadwal)->format('d-m-Y') . '</center>';
            }else{
                $data_tables[$key][] = '<center>-</center>';
            }

            if($value->is_tayang == 0){
                $data_tables[$key][] = '<center><span class="badge badge-info">Menunggu Jadwal Tayang</span></center>';
            }else if ($value->is_tayang == 1){
                $data_tables[$key][] = '<center><span class="badge badge-success">Tayang</span></center>';
            }else if ($value->is_tayang == 2){
                $data_tables[$key][] = '<center><span class="badge badge-danger">Tidak Tayang</span></center>';
            }

            $data_tables[$key][] = '<center>' . $value->judul . '</center>';
            $data_tables[$key][] = '<center>' . substr($value->konten, 0, 100) . '...</center>';
            $data_tables[$key][] = '<center><img src="' . asset($value->path . $value->gambar) . '" style="width: 100px;"></center>';

            $aksi = '';
            $aksi .= '<center>';
            $aksi .= '&nbsp;<a href="'. url('/website/artikel/edit/' . $value->slug_judul) .'" class="text-dark"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapusKonten(' . $value->id_artikel . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            if($value->is_tayang == 1){
                $aksi .= '<label class="form-check form-switch form-check-custom form-check-solid"><span class="form-check-label text-muted fs-6">Tidak &nbsp;</span> ';
                $aksi .= '<input class="form-check-input w-30px h-20px" type="checkbox" onClick="klinikAktif(' . $value->id_artikel . ')" checked="true" id="is_aktif"/>';
                $aksi .= '<span class="form-check-label text-muted fs-6">Tayang</span></label>';
            }else if ($value->is_tayang == 2){
                $aksi .= '<label class="form-check form-switch form-check-custom form-check-solid"><span class="form-check-label text-muted fs-6">Tidak &nbsp;</span>';
                $aksi .= '<input class="form-check-input w-30px h-20px" type="checkbox" onClick="klinikAktif(' . $value->id_artikel . ')" id="is_aktif"/>';
                $aksi .= '<span class="form-check-label text-muted fs-6">Tayang</span></label>';
            }
            $aksi .= '</center>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = new M_artikel();
        $id = M_artikel::max('id_artikel') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $imageName =  'art-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.jpg';

            $destinationPath = public_path('/img/artikel/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/artikel/";
        } else {
            $imageName = 'default.jpg';
            $destinationPathori = "img/";
        }

        if($request->is_jadwal == 1){
            $tayang = 0;
        }else{
            $tayang = 1;
        }


        $data->judul = $request->judul;
        $data->slug_judul = Str::slug($request->judul);
        $data->konten   = $request->konten;
        $data->gambar   = $imageName;
        $data->path     = $destinationPathori;
        $data->kategori = $request->kategori;
        $data->is_jadwal = $request->is_jadwal;
        $data->jadwal = $request->jadwal;
        $data->is_tayang = $tayang;

        $bank = New BankPencarian();
        $bank->slug = Str::slug($request->judul);
        $bank->judul = $request->judul;
        $bank->kategori = strtoupper($request->kategori);
        $bank->url = 'read-artikel/' . $request->kategori . '/' . Str::slug($request->judul);
        $bank->save();

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
                'kategori' => $request->kategori,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'kategori' => $request->kategori,
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function edit($slug)
    {
        $artikel = M_artikel::where('slug_judul',$slug)->first();

        $active_blog = '';
        $active_sosial = '';
        $active_acara = '';

        if($artikel->kategori == 'blog'){
            $active_blog = 'active';
        }else if($artikel->kategori == 'misi-sosial'){
            $active_sosial = 'active';
        }else if($artikel->kategori == 'acara'){
            $active_acara = 'active';
        }

        $data = [
            'artikel' => $artikel,
            'kategori' => $artikel->kategori,
            'active_blog' => $active_blog,
            'active_sosial' => $active_sosial,
            'active_acara' => $active_acara,
        ];

        return view('website.artikeledit', $data);
        
    }

    public function ubah(Request $request)
    {
        $data = M_artikel::findOrFail($request->artikel);
        $cekbank = BankPencarian::where('slug',$data->slug_judul)->where('kategori',$request->kategori)->first();
        
        if($cekbank){
            $bank = $cekbank;
        }else{
            $bank = new BankPencarian();
        }
        $bank->slug = Str::slug($request->judul);
        $bank->judul = $request->judul;
        $bank->kategori = strtoupper($request->kategori);
        $bank->url = 'read-artikel/' . $request->kategori . '/' . Str::slug($request->judul);
        $bank->save();

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $imageName =  'art-' . Carbon::now()->format("Y-m-d") . '-' . $request->artikel . '.jpg';

            $destinationPath = public_path('/img/artikel/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/artikel/";
        } else {
            $imageName = $data->gambar;
            $destinationPathori = $data->path;
        }

        if($request->is_jadwal == 1){
            $tayang = 0;
        }else{
            $tayang = 1;
        }


        $data->judul = $request->judul;
        $data->slug_judul = Str::slug($request->judul);
        $data->konten   = $request->konten;
        $data->gambar   = $imageName;
        $data->path     = $destinationPathori;
        $data->kategori = $request->kategori;
        $data->is_jadwal = $request->is_jadwal;
        $data->jadwal = $request->jadwal;
        $data->is_tayang = $tayang;

        

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Data Berhasil Disimpan!',
                'kategori' => $request->kategori,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Tersimpan!',
                'kategori' => $request->kategori,
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $data = M_artikel::findOrFail($request->id);

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

    public function aktif(Request $request)
    {
        $data = M_artikel::findOrFail($request->id);
        $data->is_tayang = 1;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Artikel telah tayang...',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Perubahan Gagal!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function tidakaktif(Request $request)
    {
        $data = M_artikel::findOrFail($request->id);
        $data->is_tayang = 2;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Artikel tidak tayang...',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Perubahan Gagal!',
                'err'    => $e->getMessage()
            ]);
        }
    }



}
