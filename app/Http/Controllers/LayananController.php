<?php

namespace App\Http\Controllers;

use App\Models\BankPencarian;
use App\Models\M_klinik;
use App\Models\Master\Dokter_layanan;
use App\Models\Master\M_jabatan;
use App\Models\Master\M_layanan;
use App\Models\Master\M_pegawai;
use App\Models\Master\Mapping_layanan;
use App\Models\Master\MetodeBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class LayananController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Data Klinik";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        return view('master.layanan');
    }

    public function datatable(Request $request)
    {
        $datas = M_layanan::orderBy('updated_at','DESC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = '<center><img src="' . asset($value->path . $value->icon) . '" style="width: 100px;"></center>';
            $data_tables[$key][] = '<center>' . $value->nama_layanan . '</center>';

            if($value->status == 0){
                $data_tables[$key][] = '<center><span class="badge badge-danger">Tidak Aktif</span></center>';
            }else if ($value->status == 1){
                $data_tables[$key][] = '<center><span class="badge badge-info">Aktif</span></center>';
            }

            $data_tables[$key][] = '<center>Rp ' . number_format($value->harga, 0,",",".") . '</center>';
            // $data_tables[$key][] = '<center>
            //     <a href="javascript:void(0)" class="klinik text-dark" data-id_layanan="' . $value->id_layanan . '"><i class="fa fa-edit text-info"></i> Mapping Klinik</a><br>
            //     <a href="javascript:void(0)" class="dokter text-dark" data-id_layanan="' . $value->id_layanan . '"><i class="fa fa-edit text-info"></i> Mapping Dokter</a>
            // </center>';

            $metode = '';
            $metode .= '<table class="table table-striped gy-5 gs-7 border rounded">
                    <thead style="border: 1px solid;text-align: center;background: #ddd;">
                        <tr>
                            <td>Metode</td>
                            <td>DP</td>
                            <td>Tenor</td>
                            <td>Cicilan</td>
                            <td>Hapus</td>
                        </tr>
                    </thead>
                    <tbody style="border: 1px solid;text-align: center;">';
            $metode .= $this->JenisBayar($value->id_layanan);
            $metode .= '</tbody></table><br>
            <center><a href="javascript:void(0)" class="metode btn btn-info" data-id_layanan="' . $value->id_layanan . '"><i class="fa fa-edit"></i> Metode Bayar</a></center>';

            $data_tables[$key][] = $metode;


            $aksi = '';
            $aksi .= '<center>';
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_layanan="' . $value->id_layanan . '"><i class="fa fa-edit text-info"></i> Edit</a>';
            $aksi .= '&nbsp; <a href="#!" onClick="hapusLayanan(' . $value->id_layanan . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            if($value->status == 1){
                $aksi .= '<label class="form-check form-switch form-check-custom form-check-solid"><span class="form-check-label text-muted fs-6">Tidak &nbsp;</span> ';
                $aksi .= '<input class="form-check-input w-30px h-20px" type="checkbox" onClick="layananAktif(' . $value->id_layanan . ')" checked="true" id="is_aktif"/>';
                $aksi .= '<span class="form-check-label text-muted fs-6">Aktif</span></label>';
            }else if ($value->status == 0){
                $aksi .= '<label class="form-check form-switch form-check-custom form-check-solid"><span class="form-check-label text-muted fs-6">Tidak &nbsp;</span>';
                $aksi .= '<input class="form-check-input w-30px h-20px" type="checkbox" onClick="layananAktif(' . $value->id_layanan . ')" id="is_aktif"/>';
                $aksi .= '<span class="form-check-label text-muted fs-6">Aktif</span></label>';
            }
            $aksi .= '</center>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    private function JenisBayar($id_layanan){
        $cek = MetodeBayar::where('id_layanan',$id_layanan)->get();

        $tr = '';
        foreach($cek as $value){
            if($value->jenis_pembayaran == 'CASH'){
                $tr .= '<tr>
                    <td>'. $value->jenis_pembayaran .'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="#!" onClick="hapusMetode(' . $value->id_metode_pembayaran . ')"><i class="fa fa-trash text-danger"></i></a></td>
                </tr>';
            }else{
                $tr .= '<tr>
                    <td>'. $value->jenis_pembayaran .'</td>
                    <td>'. number_format($value->dp, 0,",",".") .'</td>
                    <td>'. $value->tenor .'x</td>
                    <td>'. number_format($value->cicilan, 0,",",".") .'</td>
                    <td><a href="#!" onClick="hapusMetode(' . $value->id_metode_pembayaran . ')"><i class="fa fa-trash text-danger"></i></a></td>
                </tr>';
            }
            
        }

        return $tr;
    }

    public function store(Request $request)
    {
        $data = new M_layanan();
        $id = M_layanan::max('id_layanan') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/layanan/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'ly-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.jpg';

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/layanan/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/layanan/thumbnail/";
        } else {
            $imageName = 'default.jpg';
            $destinationPathori = "img/";
        }

        $data->nama_layanan = $request->nama_layanan;
        $data->slug_layanan  = Str::slug($request->nama_layanan);
        $data->keterangan   = $request->keterangan;
        $data->harga        = str_replace('.', '', trim($request->harga));
        $data->status       = 1;
        $data->icon         = $imageName;
        $data->path         = $destinationPathori;

        $bank = New BankPencarian();
        $bank->slug = Str::slug($request->nama_layanan);
        $bank->judul = $request->nama_layanan;
        $bank->kategori = 'LAYANAN';
        $bank->url = 'layanan';
        $bank->save();

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
        $edit = M_layanan::findOrFail($request->layanan);
        
        $data = [
            'edit' => $edit,
            'harga' => number_format($edit->harga, 0,",","."),
        ];
        
        return response()->json($data);
    }

    public function ubah(Request $request)
    {
        $data = M_layanan::findOrfail($request->id_layanan);

        $cekbank = BankPencarian::where('slug',$data->slug_judul)->where('kategori','PROMO')->first();
        if($cekbank){
            $bank = $cekbank;
        }else{
            $bank = new BankPencarian();
        }
        $bank->slug = Str::slug($request->nama_layanan);
        $bank->judul = $request->nama_layanan;
        $bank->kategori = 'LAYANAN';
        $bank->url = 'layanan';
        $bank->save();


        $id = $data->id_layanan;
        
        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/layanan/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'pgw-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.jpg';

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/layanan/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/layanan/thumbnail/";
            // $imagePath = public_path("/img/pegawai/$imageName");
            // $base64 = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        } else {
            $imageName = $data->icon;
            $destinationPathori = $data->path;
        }

        $data->nama_layanan = $request->nama_layanan;
        $data->slug_layanan  = Str::slug($request->nama_layanan);
        $data->keterangan   = $request->keterangan;
        $data->harga        = str_replace('.', '', trim($request->harga));
        $data->status       = 1;
        $data->icon         = $imageName;
        $data->path         = $destinationPathori;

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

        $data = M_layanan::findOrFail($request->id);

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
        $layanan = M_layanan::findOrfail($request->layanan);

        $datas = M_klinik::all();
        $html  = '';
        
        foreach ($datas as $value) {
            $cek = $this->cekKlinik($value->id_klinik, $request->layanan);
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
            'id_layanan' => $layanan->id_layanan,
            'html'  => $html,
        ];
        return response()->json($data);
    }

    private function cekKlinik($id_klinik, $id_layanan){
        $cek = Mapping_layanan::where('id_klinik',$id_klinik)->where('id_layanan', $id_layanan)->first();

        return $cek;
    }

    public function saveklinik(Request $request)
    {
        for ($i = 0; $i < count($request->klinik); $i++) {
            if (isset($request->klinik[$i])) {

                $cek = Mapping_layanan::where("id_klinik", $request->klinik[$i])->where("id_layanan", $request->id_layanan)->first();
                if($cek){
                    $data = $cek;
                }else{
                    $data = new Mapping_layanan();
                }

                $data->id_layanan = $request->id_layanan;
                $data->id_klinik = $request->klinik[$i];

                $data->save();
            }
        }

        Mapping_layanan::whereNotIn('id_klinik', $request->klinik)->where("id_layanan", $request->id_layanan)->delete();

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

    public function dokter(Request $request){
        
        $jabatan = M_jabatan::where('nama_jabatan', 'dokter')->first();
        $datas = M_pegawai::where('jabatan',$jabatan->id_jabatan)->get();

        $html  = '';
        
        foreach ($datas as $value) {
            
            $cek = $this->cekDokter($value->id_pegawai, $request->layanan);

            if($cek){
                $html .= '
                <div class="col-lg-4 mb-5">
                    <div class="bg-info" style="padding: 7px;border-radius: 5px;color: #fff;">
                        <input class="form-check-input" type="checkbox" name="dokter[]" checked="true" value="' . $value->id_pegawai . '"/> ' . $value->nama_pegawai . '
                    </div>
                </div>';
            }else{
                $html .= '
                <div class="col-lg-4 mb-5">
                    <div class="bg-info" style="padding: 7px;border-radius: 5px;color: #fff;">
                        <input class="form-check-input" type="checkbox" name="dokter[]" value="' . $value->id_pegawai . '"/> ' . $value->nama_pegawai . '
                    </div>
                </div>';
            }
        }

        $data = [
            'id_layanan' => $request->layanan,
            'html'  => $html,
        ];
        return response()->json($data);
    }

    private function cekDokter($id_pegawai, $id_layanan){
        $cek = Dokter_layanan::where('id_pegawai',$id_pegawai)->where('id_layanan', $id_layanan)->first();

        return $cek;
    }

    public function savedokter(Request $request)
    {
        for ($i = 0; $i < count($request->dokter); $i++) {
            if (isset($request->dokter[$i])) {

                $cek = Dokter_layanan::where("id_pegawai", $request->dokter[$i])->where("id_layanan", $request->id_layanan)->first();
                if($cek){
                    $data = $cek;
                }else{
                    $data = new Dokter_layanan();
                }

                $data->id_layanan = $request->id_layanan;
                $data->id_pegawai = $request->dokter[$i];

                $data->save();
            }
        }

        Dokter_layanan::whereNotIn('id_pegawai', $request->dokter)->where("id_layanan", $request->id_layanan)->delete();

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

    public function aktif(Request $request)
    {
        $data = M_layanan::findOrFail($request->id);
        $data->status = 1;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Status Aktif..',
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
        $data = M_layanan::findOrFail($request->id);
        $data->status = 0;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Status Tidak Aktif..',
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

    public function selectLayanan(Request $request){
        
        $datas = M_layanan::orderBy('updated_at','DESC')->get();

        $html  = '<option value="">- PILIH JENIS TIPE -</option>';
        
        foreach ($datas as $value) {
            $html .= '<option value="' . $value->id_layanan . '">' . $value->nama_layanan . '</option>';
        }

        echo $html;
    }

    public function tambahmetodeBayar(Request $request)
    {
        $data = new MetodeBayar();

        $data->id_layanan = $request->id_layanan;
        $data->jenis_pembayaran   = $request->jenis_pembayaran;
        if($request->jenis_pembayaran == 'CICILAN'){
            $data->dp      = str_replace('.', '', trim($request->dp));
            $data->tenor   = $request->tenor;
            $data->cicilan = str_replace('.', '', trim($request->cicilan));
        }else{
            $data->dp      = 0;
            $data->cicilan = 0;
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

    public function destroyMetode(Request $request)
    {

        $data = MetodeBayar::findOrFail($request->id);

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
