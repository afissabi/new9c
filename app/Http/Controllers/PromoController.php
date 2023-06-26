<?php

namespace App\Http\Controllers;

use App\Models\BankPencarian;
use App\Models\M_klinik;
use App\Models\Master\M_promo;
use App\Models\Master\Mapping_promo;
use App\Models\Master\MetodeBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use DB;
use Image;
use Str;

class PromoController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Data Promo";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        return view('master.promo');
    }

    public function datatable(Request $request)
    {
        $datas = M_promo::orderBy('updated_at','DESC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            if($value->is_best == 0){
                $data_tables[$key][] = '<center><span class="badge badge-danger">Tidak</span></center>';
            }else if ($value->is_best == 1){
                $data_tables[$key][] = '<center><span class="badge badge-info">Ya</span></center>';
            }
            $data_tables[$key][] = '<center>' . \Carbon\Carbon::parse($value->tgl_awal)->format('d-m-Y') . ' - ' . \Carbon\Carbon::parse($value->tgl_akhir)->format('d-m-Y') . '</center>';
            $data_tables[$key][] = '<center><img src="' . asset('img/promo/thumbnail/' . $value->gambar) . '" style="width: 100px;"></center>';
            $data_tables[$key][] = '<center>' . $value->judul_promo . '</center>';
            $data_tables[$key][] = $value->isi_promo;

            if($value->status == 0){
                $data_tables[$key][] = '<center><span class="badge badge-danger">Tidak Aktif</span></center>';
            }else if ($value->status == 1){
                $data_tables[$key][] = '<center><span class="badge badge-info">Aktif</span></center>';
            }

            $data_tables[$key][] = '<center>Rp ' . number_format($value->harga, 0,",",".") . '</center>';

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
            $metode .= $this->JenisBayar($value->id_m_promo);
            $metode .= '</tbody></table><br>
            <center><a href="javascript:void(0)" class="metode btn btn-info" data-id_promo="' . $value->id_m_promo . '"><i class="fa fa-edit"></i> Metode Bayar</a></center>';

            $data_tables[$key][] = $metode;

            $data_tables[$key][] = '<center>
                <a href="javascript:void(0)" class="klinik text-dark" data-id_promo="' . $value->id_m_promo . '"><i class="fa fa-edit text-info"></i> Mapping Klinik</a><br>
            </center>';
            

            $aksi = '';
            $aksi .= '<center>';
            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_promo="' . $value->id_m_promo . '"><i class="fa fa-edit text-info"></i> Edit</a>';
            $aksi .= '&nbsp; <a href="#!" onClick="hapusPromo(' . $value->id_m_promo . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            if($value->status == 1){
                $aksi .= '<label class="form-check form-switch form-check-custom form-check-solid"><span class="form-check-label text-muted fs-6">Tidak &nbsp;</span> ';
                $aksi .= '<input class="form-check-input w-30px h-20px" type="checkbox" onClick="TidakAktif(' . $value->id_m_promo . ')" checked="true" id="is_aktif"/>';
                $aksi .= '<span class="form-check-label text-muted fs-6">Aktif</span></label>';
            }else if ($value->status == 0){
                $aksi .= '<label class="form-check form-switch form-check-custom form-check-solid"><span class="form-check-label text-muted fs-6">Tidak &nbsp;</span>';
                $aksi .= '<input class="form-check-input w-30px h-20px" type="checkbox" onClick="Aktif(' . $value->id_m_promo . ')" id="is_aktif"/>';
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

    private function JenisBayar($id_promo){
        $cek = MetodeBayar::where('id_promo',$id_promo)->get();

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
        $data = new M_promo();
        $id = M_promo::max('id_m_promo') + 1;

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/promo/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'pr-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.jpg';

            $img->resize(200, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/promo/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/promo/thumbnail/";
        } else {
            $imageName = 'default.jpg';
            $destinationPathori = "img/";
        }

        $data->judul_promo = $request->judul;
        $data->slug_judul  = Str::slug($request->judul);
        $data->isi_promo   = $request->isi;
        $data->tgl_awal    = $request->tgl_awal;
        $data->tgl_akhir   = $request->tgl_akhir;
        $data->is_best     = $request->best;
        $data->harga       = str_replace('.', '', trim($request->harga));
        $data->status      = 1;
        $data->gambar      = $imageName;
        $data->path        = $destinationPathori;

        $bank = New BankPencarian();
        $bank->slug = Str::slug($request->judul);
        $bank->judul = $request->judul;
        $bank->kategori = 'PROMO';
        $bank->url = 'promo/' . Str::slug($request->judul);
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
        $edit = M_promo::findOrFail($request->promo);
        
        $data = [
            'edit' => $edit,
            'harga' => number_format($edit->harga, 0,",","."),
        ];
        
        return response()->json($data);
    }

    public function tambahmetodeBayar(Request $request)
    {
        $data = new MetodeBayar();

        $data->id_promo = $request->id_promo;
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

    public function ubah(Request $request)
    {
        $data = M_promo::findOrfail($request->id_promo);
        $cekbank = BankPencarian::where('slug',$data->slug_judul)->where('kategori','PROMO')->first();
        if($cekbank){
            $bank = $cekbank;
        }else{
            $bank = new BankPencarian();
        }
        $bank->slug = Str::slug($request->judul);
        $bank->judul = $request->judul;
        $bank->kategori = 'PROMO';
        $bank->url = 'promo/' . Str::slug($request->judul);
        $bank->save();
        
        $id = $data->id_m_promo;
        
        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/promo/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'pr-' . Carbon::now()->format("Y-m-d") . '-' . $id . '.jpg';

            $img->resize(200, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/promo/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/promo/thumbnail/";
            // $imagePath = public_path("/img/pegawai/$imageName");
            // $base64 = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        } else {
            $imageName = $data->gambar;
            $destinationPathori = $data->path;
        }

        $data->judul_promo = $request->judul;
        $data->slug_judul  = Str::slug($request->judul);
        $data->isi_promo   = $request->isi;
        $data->tgl_awal    = $request->tgl_awal;
        $data->tgl_akhir   = $request->tgl_akhir;
        $data->is_best     = $request->best;
        $data->harga       = str_replace('.', '', trim($request->harga));
        $data->status      = 1;
        $data->gambar      = $imageName;
        $data->path        = $destinationPathori;

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

        $data = M_promo::findOrFail($request->id);

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

    public function klinik(Request $request){
        $promo = M_promo::findOrfail($request->promo);

        $datas = M_klinik::all();
        $html  = '';
        
        foreach ($datas as $value) {
            $cek = $this->cekKlinik($value->id_klinik, $request->promo);
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
            'id_promo' => $promo->id_m_promo,
            'html'  => $html,
        ];
        return response()->json($data);
    }

    private function cekKlinik($id_klinik, $id_promo){
        $cek = Mapping_promo::where('id_klinik',$id_klinik)->where('id_promo', $id_promo)->first();

        return $cek;
    }

    public function saveklinik(Request $request)
    {
        for ($i = 0; $i < count($request->klinik); $i++) {
            if (isset($request->klinik[$i])) {

                $cek = Mapping_promo::where("id_klinik", $request->klinik[$i])->where("id_promo", $request->id_promo)->first();
                if($cek){
                    $data = $cek;
                }else{
                    $data = new Mapping_promo();
                }

                $data->id_promo = $request->id_promo;
                $data->id_klinik = $request->klinik[$i];

                $data->save();
            }
        }

        Mapping_promo::whereNotIn('id_klinik', $request->klinik)->where("id_promo", $request->id_promo)->delete();

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
        $data = M_promo::findOrFail($request->id);
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
        $data = M_promo::findOrFail($request->id);
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

    public function selectPromo(Request $request){
        
        $datas = M_promo::orderBy('updated_at','DESC')->get();

        $html  = '<option value="">- PILIH JENIS TIPE -</option>';
        
        foreach ($datas as $value) {
            $html .= '<option value="' . $value->id_m_promo . '">' . $value->judul_promo . '</option>';
        }

        echo $html;
    }


}
