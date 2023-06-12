<?php

namespace App\Http\Controllers;

use App\Models\BankPencarian;
use App\Models\M_klinik;
use App\Models\Master\M_jabatan;
use App\Models\Master\M_pegawai;
use App\Models\Master\Mapping_pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class pegawaiController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Data Klinik";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        $klinik = M_klinik::where('is_aktif',null)->get();
        $jabatan = M_jabatan::all();
        $total  = collect(M_pegawai::TotalPegawai());

        $data = [
            'klinik' => $klinik,
            'total' => $total,
            'jabatan' => $jabatan,
        ];

        return view('master.pegawai', $data);
    }

    public function datatable()
    {
        $datas = M_pegawai::OrderBy('id_pegawai', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center><img src="' . asset($value->path . $value->foto) . '" style="width: 80px;border-radius:50%"></center>';
            $data_tables[$key][] = $value->nik_pegawai;
            $data_tables[$key][] = $value->nama_pegawai;
            // $data_tables[$key][] = 'jabatan';
            if ($value->jabatan) {
                if($this->cekJabatan($value->jabatan) == null){
                    $data_tables[$key][] = '<center>Jabatan tidak aktif</center>';
                }else{
                    $data_tables[$key][] = '<center>' . $value->jabat->nama_jabatan . '<br><p style="font-size:10px">' . $value->spesialis . '</p></center>';
                }
            } else {
                $data_tables[$key][] = '<center>Belum dipilih</center>';
            }

            if ($value->status) {
                $data_tables[$key][] = '<center><span class="badge badge-danger">Tidak Aktif</span></center>';
            } else {
                $data_tables[$key][] = '<center><span class="badge badge-primary">Aktif</span></center>';
            }

            $data_tables[$key][] = '<a href="javascript:void(0)" class="klinik text-dark" data-id_pegawai="' . $value->id_pegawai . '"><i class="fa fa-edit text-info"></i> Mapping Klinik</a>';

            $aksi = '';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_pegawai="' . $value->id_pegawai . '"><i class="fa fa-edit text-info"></i> Edit</a>';

            $aksi .= '&nbsp; <a href="#!" onClick="hapusPegawai(' . $value->id_pegawai . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    private function cekJabatan($id_jabatan){
        $cek = M_jabatan::where('id_jabatan',$id_jabatan)->first();

        return $cek;
    }

    public function store(Request $request)
    {
        $data = new M_pegawai();
        $id = M_pegawai::max('id_pegawai') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/pegawai/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'pgw-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.png';

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/pegawai/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/pegawai/thumbnail/";
            // $imagePath = public_path("/img/pegawai/$imageName");
            // $base64 = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        } else {
            $imageName = 'default.jpg';
            $destinationPathori = "img/";
            // $imagePath = public_path("/img/default.jpg");
            // $base64 = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        }

        $data->nik_pegawai    = $request->nik;
        $data->nama_pegawai   = $request->nama_pegawai;
        $data->slug           = Str::slug($request->nama_pegawai);
        $data->alamat_pegawai = $request->alamat;
        $data->tgl_lahir      = $request->tgl_lahir;
        $data->status         = $request->status;
        $data->telp           = $request->telp;
        $data->email          = $request->email;
        $data->profil         = $request->profil;
        $data->jabatan        = $request->jabatan;
        $data->spesialis      = $request->spesialis;
        $data->foto           = $imageName;
        $data->path           = $destinationPathori;
        // $data->base64         = $base64;
        if($request->jabatan == 3){
            $bank = New BankPencarian();
            $bank->slug = Str::slug($request->nama_pegawai);
            $bank->judul = $request->nama_pegawai;
            $bank->kategori = 'DOKTER';
            $bank->url = 'tim-dokter/jadwal/' . Str::slug($request->nama_pegawai);
            $bank->save();
        }

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
        $data = M_pegawai::findOrFail($request->pegawai);
        
        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_pegawai::findOrfail($request->id_pegawai);
        if($request->jabatan == 3){
            $cekbank = BankPencarian::where('slug',$data->slug_judul)->where('kategori','PROMO')->first();
            if($cekbank){
                $bank = $cekbank;
            }else{
                $bank = new BankPencarian();
            }
            $bank->slug = Str::slug($request->nama_pegawai);
            $bank->judul = $request->nama_pegawai;
            $bank->kategori = 'DOKTER';
            $bank->url = 'tim-dokter/jadwal/' . Str::slug($request->nama_pegawai);
            $bank->save();
        }
        
        $id = $data->id_pegawai;
        
        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/pegawai/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'pgw-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.png';

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/pegawai/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/pegawai/thumbnail/";
            // $imagePath = public_path("/img/pegawai/$imageName");
            // $base64 = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        } else {
            $imageName = $data->foto;
            $destinationPathori = $data->path;
            // $imagePath = public_path("/img/default.jpg");
            // $base64 = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        }

        $data->nik_pegawai    = $request->nik;
        $data->nama_pegawai   = $request->nama_pegawai;
        $data->slug           = Str::slug($request->nama_pegawai);
        $data->alamat_pegawai = $request->alamat;
        $data->tgl_lahir      = $request->tgl_lahir;
        $data->status         = $request->status;
        $data->telp           = $request->telp;
        $data->email          = $request->email;
        $data->profil         = $request->profil;
        $data->jabatan        = $request->jabatan;
        $data->spesialis      = $request->spesialis;
        $data->foto           = $imageName;
        $data->path           = $destinationPathori;
        // $data->base64         = $base64;

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

        $data = M_pegawai::findOrFail($request->id);

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

    public function klinik(Request $request){
        $pegawai = M_pegawai::findOrfail($request->pegawai);

        $datas = M_klinik::all();
        $html  = '';

        foreach ($datas as $value) {
            $cek = $this->cekKlinik($value->id_klinik, $request->pegawai);

            if($cek){
                $html .= '
                <div class="col-lg-4 mb-5">
                    <input class="form-check-input" type="checkbox" name="klinik[]" checked="true" value="' . $value->id_klinik . '"/> ' . $value->nama . '
                </div>';
            }else{
                $html .= '
                <div class="col-lg-4 mb-5">
                    <input class="form-check-input" type="checkbox" name="klinik[]" value="' . $value->id_klinik . '"/> ' . $value->nama . '
                </div>';
            }
        }

        $data = [
            'id_pegawai' => $request->pegawai,
            'id_jabatan' => $pegawai->jabatan,
            'html'  => $html,
        ];
        return response()->json($data);
    }

    private function cekKlinik($id_klinik, $id_pegawai){
        $cek = Mapping_pegawai::where('id_klinik',$id_klinik)->where('id_pegawai', $id_pegawai)->first();

        return $cek;
    }

    public function saveklinik(Request $request)
    {
        for ($i = 0; $i < count($request->klinik); $i++) {
            if (isset($request->klinik[$i])) {

                $cek = Mapping_pegawai::where("id_klinik", $request->klinik[$i])->where("id_pegawai", $request->id_pegawai)->first();
                if($cek){
                    $data = $cek;
                }else{
                    $data = new Mapping_pegawai();
                }

                $data->id_pegawai = $request->id_pegawai;
                $data->id_jabatan = $request->id_jabatan_klinik;
                $data->id_klinik = $request->klinik[$i];

                $data->save();
            }
        }

        Mapping_pegawai::whereNotIn('id_klinik', $request->klinik)->where("id_pegawai", $request->id_pegawai)->delete();

        try {
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

    // JABATAN
    public function jabatan(){
        $datas = M_jabatan::all();
        $html  = '';

        $html .= '
            <div class="col-md-3 mb-5">
                <a href="#" class="tambah btn btn-info" data-bs-toggle="modal" data-bs-target="#kt_tambah_jabatan">
                    + <h5 style="font-size: 9px;margin-top: -17px;">Jabatan</h5>
                </a>
            </div>';

        foreach ($datas as $value) {
            $html .= '
            <div class="col-md-3 mb-5">
                <div class="d-flex bg-info px-6" style="width: 100%;width: 100%;margin: 5px;border-radius: 0.475rem;height: 73px;">
                    <div style="display: flex;margin-top: 11px;color: #fff;">
                        <div class="bulat" id="bulat_catin">' . $this->jumJabatan($value->id_jabatan) . '</div>
                        <span class="d-flex flex-column align-items-start ms-2">
                            <span class="fs-7 fw-bolder">'. $value->nama_jabatan .'</span>
                            <span class="fs-9">' . $value->keterangan . '</span>
                        </span>
                        <div class="tombol-hapus">
                            <a href="javascript:void(0)" data-id_jabatan="' . $value->id_jabatan . '" class="edit mb-3" style="color:#fff"><span class="fs-3 fw-bolder fa fa-edit"></span></a>
                            <a href="#!" onClick="hapusJabatan(' . $value->id_jabatan . ')" class="mb-3" style="color:#fff"><span class="fs-3 fw-bolder fa fa-trash"></span></a>
                        </div>
                    </div>
                </div>
            </div>';
        }

        echo $html;
    }

    private function jumJabatan($id_jabatan){
        // $hitung = Mapping_pegawai::where('id_jabatan',$id_jabatan)->count();
        $hitung = M_pegawai::where('jabatan',$id_jabatan)->count();

        return $hitung;
    }

    public function storeJabatan(Request $request)
    {
        $data = new M_jabatan();

        $data->nama_jabatan = $request->nama;
        $data->keterangan   = $request->keterangan;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Jabatan Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Jabatan Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function editJabatan(Request $request)
    {
        $data   = M_jabatan::findOrFail($request->jabatan);
        
        return response()->json($data);
    }

    public function ubahJabatan(Request $request)
    {
        $data = M_jabatan::findOrFail($request->id_jabatan);

        $data->nama_jabatan = $request->nama;
        $data->keterangan   = $request->keterangan;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Jabatan Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Jabatan Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function destroyJabatan(Request $request)
    {

        $data = M_jabatan::findOrFail($request->id);

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
