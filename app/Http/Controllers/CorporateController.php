<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\M_klinik;
use App\Models\M_operasional;
use App\Models\M_pembayaran;
use App\Models\Master\M_layanan;
use App\Models\Master\M_pasien;
use App\Models\Master\M_perusahaan;
use App\Models\Master\Mapping_layanan;
use Illuminate\Http\Request;
use App\Models\Master\Master;
use App\Models\Master\MetodeBayar;
use App\Models\Master\PegawaiCorp;
use App\Models\ModelHasRoles;
use App\Models\T_register;
use App\Models\User;
use Illuminate\Support\Facades\View;
use DB;
use DateInterval;
use DatePeriod;
use DateTime;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CorporateController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Corporate Area";
        View::share(compact('pageTitle'));
    }

    public function dashboard()
    {
        $data = [
            'menu_active'   => 'dashboard',
            'parent_active' => '',
        ];

        return view('corporate.welcome', $data);
    }

    public function Layanan()
    {
        $layanan = M_layanan::where('tipe','REKANAN')->where('status',1)->get();

        $data = [
            'menu_active'   => 'dokter',
            'parent_active' => '',
            'layanan' => $layanan,
        ];

        return view('corporate.layanan', $data);
    }

    public function pegawai()
    {
        $user = Auth::user();
        $detail = $user->detailUser;
        $corp = M_perusahaan::where('id_perusahaan',$detail->id_perusahaan)->first();

        $data = [
            'menu_active'   => 'daftar-pegawai',
            'parent_active' => '',
            'corp' => $corp,
        ];

        return view('corporate.pegawai', $data);
    }

    public function pegawaidatatable()
    {
        $user = Auth::user();
        $detail = $user->detailUser;
        $datas = PegawaiCorp::where('id_perusahaan',$detail->id_perusahaan)->OrderBy('nama_pegawai', 'ASC')->get();

        $data_tables = [];
        foreach ($datas as $key => $value) {
            $data_tables[$key][] = $key + 1;
            $data_tables[$key][] = $value->nama_pegawai;
            $data_tables[$key][] = '<center>' . \Carbon\Carbon::parse($value->tgl_lahir)->format('d-m-Y') . '</center>';
            $data_tables[$key][] = $value->alamat_pegawai;
            $data_tables[$key][] = $value->telp;
            $data_tables[$key][] = $value->email;
            $aksi = '<center>';

            $aksi .= '&nbsp;<a href="javascript:void(0)" class="edit text-dark" data-id_pegawai="' . $value->id_pegawai_corp . '"><i class="fa fa-edit text-info"></i> Edit</a>';
            $aksi .= '</center>';
            // $aksi .= '&nbsp; <a href="#!" onClick="hapusPegawai(' . $value->id_pegawai_corp . ')"><i class="fa fa-trash text-danger"></i> Hapus</a>';

            $data_tables[$key][] = $aksi;
        }

        $data = [
            "data" => $data_tables
        ];

        return response()->json($data);
    }

    public function pegawaistore(Request $request)
    {
        $user = Auth::user();
        $detail = $user->detailUser;

        $data = new PegawaiCorp();
        $data->id_perusahaan  = $detail->id_perusahaan;
        $data->nama_pegawai   = $request->nama_pegawai;
        $data->alamat_pegawai = $request->alamat;
        $data->tgl_lahir      = $request->tgl_lahir;
        $data->telp           = $request->telp;
        $data->email          = $request->email;

        $id_pegawai = DB::table('pegawai_corp')->max('id_pegawai_corp') + 1;
        // MASUK KE M_PASIEN
        $pasien = new M_pasien();
        $pasien->nama_pasien = $request->nama_pegawai;
        $pasien->email = $request->email;
        $pasien->telp  = $request->telp;
        $pasien->id_pegawai  = $id_pegawai;
        $pasien->id_perusahaan  = $detail->id_perusahaan;

        try {
            $pasien->save();
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

    public function pegawaiedit(Request $request)
    {
        $data = PegawaiCorp::findOrFail($request->pegawai);
        
        return response()->json($data);
    }

    public function pegawaiubah(Request $request)
    {
        $user = Auth::user();
        $detail = $user->detailUser;

        $data = PegawaiCorp::findOrfail($request->id_pegawai);
        $data->id_perusahaan  = $detail->id_perusahaan;
        $data->nama_pegawai   = $request->nama_pegawai;
        $data->alamat_pegawai = $request->alamat;
        $data->tgl_lahir      = $request->tgl_lahir;
        $data->telp           = $request->telp;
        $data->email          = $request->email;

        $pasien = M_pasien::where('id_pegawai',$request->id_pegawai)->first();
        $pasien->nama_pasien = $request->nama_pegawai;
        $pasien->email = $request->email;
        $pasien->telp  = $request->telp;

        try {
            $pasien->save();
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

    public function pegawaidestroy(Request $request)
    {

        $data = PegawaiCorp::findOrFail($request->id);

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


    // PENDAFTARAN LAYANAN REGULER
    public function pendaftaran(Request $request)
    {
        $nama_layanan = '';
        $id_layanan = '';
        
        if($request->slug != 'zero-service'){
            $layanan = M_layanan::where('slug_layanan', $request->slug)->first();
            $nama_layanan = $layanan->nama_layanan;
            // $id_layanan = $layanan->id_layanan;
            $id_layanan = decrypt($request->layanan);
        }
        // $promo = M_promo::where('slug_judul',$slug)->first();
        
        $data = [
            'menu_active'   => 'Promo',
            'parent_active' => '',
            'nama_layanan'  => $nama_layanan,
            'id_layanan'  => $id_layanan,
        ];

        return view('corporate.regumum', $data);
    }

    public function klinikLayanan(Request $request)
    {
        $klinik = '';

        if($request->layanan){
            $datas = Mapping_layanan::where('id_layanan',$request->layanan)->get();
            
            foreach ($datas as $value) {
                $klinik .= '
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #2F3A60 !important;color: #fff;">
                        <div class="">
                            <img src="' . asset('front/img/maps.png') .'" style="width: 90px;background: #fff;border-radius: 50%;">
                        </div>
                        <h4 class="mb-3" style="color:#fff">' . $value->klinik->nama . '</h4>
                        <p class="m-0">' . $value->klinik->alamat . '<br>' . $value->klinik->kota .'</p>
                        <a class="btn btn-lg btn-primary rounded tanggal" href="javascript:void(0)" data-id_klinik="' . $value->id_klinik . '" data-id_layanan="' . $value->id_layanan . '" style="width: -webkit-fill-available !important;border-radius: 40px 0px 0px 40px !important;">
                            <i class="bi bi-arrow-right"></i> PILIH
                        </a>
                    </div>
                    <svg viewBox="0 0 500 200">
                        <path d="M 0 30 C 150 100 280 0 500 20 L 500 0 L 0 0" fill="#2F3A60"></path>
                    </svg>
                </div>';
            }
        }else{
            $datas = M_klinik::all();
            
            foreach ($datas as $value) {
                $klinik .= '
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #2F3A60 !important;color: #fff;">
                        <div class="">
                            <img src="' . asset('front/img/maps.png') .'" style="width: 90px;background: #fff;border-radius: 50%;">
                        </div>
                        <h4 class="mb-3" style="color:#fff">' . $value->nama . '</h4>
                        <p class="m-0">' . $value->alamat . '<br>' . $value->kota .'</p>
                        <a class="btn btn-lg btn-primary rounded layanan" href="javascript:void(0)" data-id_klinik="' . $value->id_klinik . '" style="width: -webkit-fill-available !important;border-radius: 40px 0px 0px 40px !important;">
                            <i class="bi bi-arrow-right"></i> PILIH
                        </a>
                    </div>
                    <svg viewBox="0 0 500 200">
                        <path d="M 0 30 C 150 100 280 0 500 20 L 500 0 L 0 0" fill="#2F3A60"></path>
                    </svg>
                </div>';
            }
        }
        
        echo $klinik;
    }

    public function listLayanan(Request $request)
    {
        $layanan = '';

        $layanan .= '';

        $datas = Mapping_layanan::where('id_klinik',$request->klinik)->get();
        
        foreach ($datas as $item) {
            $layanan .= '
            <div class="col-lg-3 col-md-6 v_cari_layanan" data-filter-name="'. strtolower($item->layan->nama_layanan) .'" style="margin-right:10px;margin-bottom:10px;">
                <div class="service-item rounded d-flex flex-column align-items-center justify-content-center text-center" style="background: #00378b;border-radius: 55px 30px !important;">
                    <div class="service-icon" style="transform: none;">
                        <img src="' . asset($item->layan->path . $item->layan->icon) .'" style="width: 100px;border-radius: 50%;">
                    </div>
                    <h4 class="mb-3" style="color: #fff;">' . $item->layan->nama_layanan .'</h4>
                    <p class="m-0" style="color: #d8ff00;">' . $item->layan->keterangan .'</p>
                    <a class="btn btn-lg btn-primary rounded tanggal" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $item->id_layanan . '">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>';
        }
        
        $kembali = '<a href="javascript:void(0)" onClick="klinik()" class="menu-link px-3 btn-warning mb-1" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';

        $data = [
            "html" => $layanan,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function tanggalLayanan(Request $request)
    {
        $layan = M_layanan::where('id_layanan',$request->layanan)->first();
        
        // SETTING TANGGAL
        $begin = new DateTime('now');
        $akhir = date('d-m-Y', strtotime('now' . "+20 days"));

        $end = new DateTime($akhir);
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        
        $tanggal = [];
        $hari = [];

        $html = '';

        foreach ($period as $dt) {
            $is_disabled = false;
            // $tanggal[] = $dt->format("d");
            // $hari[] = \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d'))));
            $tutup = $this->Tutup($request->klinik, \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))));
            if($tutup){
                $bg = 'bg-red-turquoise';
                $is_disabled = true;
                $a = '';
            }else{
                $bg = 'bg-green-turquoise';
                $a = '<a class="jam" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="'.$dt->format('Y-m-d').'" data-hari="' . strtoupper(\App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d'))))) . '">';
            }

            $html .= '
                <div class="tile '.$bg.' jadwal" style="background: #8ACCFF; width:130px; height:110px;" data-tanggal="'.$dt->format('Y-m-d').'" data-disabled="' . $is_disabled . '">
                    '. $a .'
                        <div class="corner" style="float: left; font-weight: bold; color:#fff">
                            <span>' . \App\Helpers\Helper::hariIndo(date('D', strtotime($dt->format('Y-m-d')))) . '</span>
                        </div>
                        <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                            <i style="font-style:normal;">' . $dt->format("d") . '</i>
                        </div>
                        <div class="tile-object">
                            <div class="name">' . \App\Helpers\Helper::bulansort($dt->format("m")) . '</div>
                            <div class="number">'.$dt->format("Y").'</div>
                        </div>
                    </a>
                </div>
            ';
        }

        $kembali = '<a href="javascript:void(0)" onClick="klinik()" class="menu-link px-3 btn-warning mb-1" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "rawat" => $layan->nama_layanan,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function jamLayanan(Request $request)
    {
        $klinik = M_operasional::where('id_klinik',$request->klinik)->where('hari',$request->hari)->first();
        $layan = M_layanan::where('id_layanan',$request->layanan)->first();
        $html = '';
        $starttime = $klinik->jam_buka;
        $endtime = $klinik->jam_tutup;
        // $duration = $promo->waktu_layanan;

        $array_of_time = array ();
        $start_time    = strtotime ($starttime);
        $nyartime	   = date("H:i", strtotime('-30 minutes', strtotime($endtime)));
        $end_time      = strtotime($nyartime);
        $add_mins  = 30 * 60;

        while ($start_time <= $end_time)
        {
            $array_of_time[] = date ("H:i", $start_time);
            $start_time += $add_mins;
        }
        
        foreach($array_of_time as $value){
            $start_time    = strtotime($value);
            $add_mins  = 30 * 60;
            $plus = $start_time + $add_mins;
            $estimasi = date("H:i", $plus);
            $is_disabled = false;

            $penuh = $this->PenuhLayanan($request->layanan, $request->klinik, $request->tanggal, $value);
            if($penuh == 'penuh'){
                $bg = 'bg-red-turquoise';
                $is_disabled = true;
                $a = '';
                $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
            }else{
                $bg = 'bg-green-turquoise';
                $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
                $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
            }

            $html .= '<div class="tile '. $bg .'" style="width:130px; height:110px;" data-disabled="' . $is_disabled . '">
                '.$a.'
                    <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
                        '.$i.'
                    </div>
                    <div class="tile-object" style="background: #2F3A60;">
                        <h5 style="text-align:center;color:#ffff;margin-bottom: 0px !important;margin-top: 4px;">'. $value . ' WIB</h5>
                    </div>
                </a>
            </div>';
        }

        $kembali = '<a href="javascript:void(0)" onClick="klinik()" class="menu-link px-3 btn-warning mb-1 tanggal" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "rawat" => $layan->nama_layanan,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    private function penuhLayanan($layanan, $klinik, $tanggal, $jam){
        $waktu = $jam.':00';
        $cek = T_register::where('id_layanan',$layanan)->where('id_klinik',$klinik)->where('tanggal',$tanggal)->where('jam',$waktu)->where('status',1)->count();
        
        $penuh = '';

        if($cek >= 2){
            $penuh = 'penuh';
        }

        return $penuh;

    }

    public function formLayanan(Request $request)
    {
        $user = Auth::user();
        $detail = $user->detailUser;

        $klinik = M_klinik::where('id_klinik',$request->klinik)->first();
        $layanan = M_layanan::where('id_layanan',$request->layanan)->first();
        $metode = MetodeBayar::where('id_layanan',$request->layanan)->get();
        
        $pegawai = PegawaiCorp::where('id_perusahaan',$detail->id_perusahaan)->get();
        
        $html = '';
        $tabel = '';
        $tabel .= '
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr style="background: #2F3A60;color: #fff;">
                        <th colspan="4"><center>DETAIL PENDAFTARAN ANDA</center></th>
                    </tr>
                    <tr style="background: #2F3A60;color: #fff;">
                        <th scope="col"><center>LAYANAN</center></th>
                        <th scope="col"><center>KLINIK</center></th>
                        <th scope="col"><center>TANGGAL</center></th>
                        <th scope="col"><center>JAM</center></th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="">
                        <td scope="col"><center>' . $layanan->nama_layanan . '</center></td>
                        <td scope="col"><center>' . $klinik->nama . '<br>' . $klinik->alamat . '</center></td>
                        <td scope="col"><center>' . \App\Helpers\Helper::hariIndo(\Carbon\Carbon::parse($request->tanggal)->format('D')) . '<br>' . \Carbon\Carbon::parse($request->tanggal)->format('d-m-Y'). '</center></td>
                        <td scope="col"><center>' . $request->jam . ' WIB</center></td>
                    </tr>
                </tbody>
            </table>';
        
        $html .= '
            <input type="hidden" class="form-control" name="layanan" value="' . $request->layanan . '">
            <input type="hidden" class="form-control" name="klinik" value="' . $request->klinik . '">
            <input type="hidden" class="form-control" name="tanggal" value="' . $request->tanggal . '">
            <input type="hidden" class="form-control" name="jam" value="'. $request->jam .'">
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Nama Pegawai :</label>
                <div class="col-lg-6">
                <select class="form-control" data-control="select2" nama="pegawai">
                    <option>-Pilih Pegawai-</option>
                ';

                foreach($pegawai as $value){
                    $html .='<option value="' . $value->id_pegawai_corp . '">' . $value->nama_pegawai . '</option>';
                }

            $html .='</select></div>
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Tipe Pembayaran :</label>
                <div class="col-lg-6">
                    <select class="form-select" name="tipe_bayar" id="tipe_bayar" onchange="pilihMetode();" required>
                    <option value="">-Pilih Metode Pembayaran-</option>
                    ';
                    foreach($metode as $value){
                        if($value->jenis_pembayaran == 'CASH'){
                            $html .= '<option value="' . $value->id_metode_pembayaran . '">' . $value->jenis_pembayaran . '</option>';
                        }else{
                            $html .= '<option value="' . $value->id_metode_pembayaran . '">' . $value->jenis_pembayaran . ' ' . $value->tenor . 'x </option>';
                        }
                        
                    }
            $html .= '</select>
                </div>
            </div>
            <div class="row mb-2" id="total_bayar">
                
            </div>
            <div class="row mb-2">
                <label class="col-lg-3 col-form-label text-lg-end required">Catatan :</label>
                <div class="col-lg-6" style="text-align: justify;color: #fff;background: #2F3A60;">
                    <p>Jika pembayaran segera dilakukan maka jadwal akan dikeep untuk anda. Namun jika pembayaran di klinik jadwal dapat berubah sewaktu-waktu...</p>
                    <p>Konfirmasi pembayaran ke admin klinik di : ' . $klinik->admin . '</p>
                </div>
            </div>';
    

        $kembali = '<a href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_promo="' . $request->promo . '" class="menu-link px-3 btn-warning mb-1 tanggal" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
        // echo $html;

        $data = [
            "html" => $html,
            "tabel" => $tabel,
            "kembali" => $kembali,
        ];

        return response()->json($data);
    }

    public function getMetodeBayarLayanan(Request $request)
    {
        $bayar  = '';
        $tipe = MetodeBayar::where('id_metode_pembayaran',$request->tipe)->first();

        if($tipe->jenis_pembayaran == 'CASH'){
            $bayar .= '<label class="col-lg-3 col-form-label text-lg-end required">Total :</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" name="total" placeholder="Total" value="'. number_format($tipe->layanan->harga, 0,",",".") .'" readonly>
            </div>';
        }else{
            $bayar .= '<label class="col-lg-3 col-form-label text-lg-end required">Total :</label>
            <div class="col-lg-3">
                <p>Total DP</p>
                <input type="text" class="form-control" name="dp" placeholder="Total DP" value="'.number_format($tipe->dp, 0,",",".").'" readonly>
            </div>
            <div class="col-lg-2">
                <p>Tenor</p>
                <input type="text" class="form-control" name="tenor" placeholder="Tenor" value="'.number_format($tipe->tenor, 0,",",".").'" readonly>
            </div>
            <div class="col-lg-3">
                <p>Cicilan</p>
                <input type="text" class="form-control" name="cicilan" placeholder="Cicilan" value="'.number_format($tipe->cicilan, 0,",",".").'" readonly>
            </div>';
        }
        

        echo $bayar;
    }

    public function layananDaftar(Request $request)
    {
        $cek = M_pasien::where('id_pegawai',$request->pegawai)->first();
        $id_reg = DB::table('t_register')->max('id_t_register') + 1;
        $jam = $request->jam.':00';
        $cekreg = T_register::where('id_layanan',$request->layanan)->where('id_klinik',$request->klinik)->where('id_pegawai',$request->pegawai)->where('tanggal',$request->tanggal)->where('jam',$jam)->first();
        
        if($cekreg){
            $reg = $cekreg;
        }else{
            $reg = new T_register();
            $reg->status = 0;
        }
        
        $reg->tipe = 'LAYANAN CORPORATE';
        $reg->id_layanan = $request->layanan;
        $reg->id_pasien = $cek->id_pasien;
        $reg->is_corp = 1;
        $reg->id_pegawai = $request->pegawai;
        $reg->id_klinik = $request->klinik;
        $reg->tanggal_daftar = date('Y-m-d');
        $reg->tanggal = $request->tanggal;
        $reg->jam = $request->jam;
        $reg->id_metode = $request->tipe_bayar;
        
        
        $metode = MetodeBayar::where('id_metode_pembayaran',$request->tipe_bayar)->first();
        
        $bayar = new M_pembayaran();
        $bayar->id_t_register = $id_reg;
        $bayar->id_pasien = $cek->id_pasien;
        $bayar->tipe = $request->tipe_bayar;
        $bayar->jenis_pembayaran = $metode->jenis_pembayaran;
        if($metode->jenis_pembayaran == 'CASH'){
            $bayar->nilai = str_replace('.', '', trim($request->total));
            $bayar->keterangan = 'Pembayaran Cash Layanan ' . $metode->layanan->nama_layanan;
        }else{
            $bayar->nilai = str_replace('.', '', trim($request->dp));
            $bayar->is_dp = 't';
            $bayar->keterangan = 'Pembayaran DP Cicilan Layanan ' . $metode->layanan->nama_layanan;
            for ($j = 1; $j <= $request->tenor; $j++) {
                $cicil = new M_pembayaran;
                $cicil->id_t_register = $id_reg;
                $cicil->id_pasien = $cek->id_pasien;
                $cicil->tipe = $request->tipe_bayar;
                $cicil->jenis_pembayaran = $metode->jenis_pembayaran;
                $cicil->nilai = str_replace('.', '', trim($request->cicilan));
                $cicil->is_dp = 'f';
                $cicil->status = 0;
                $cicil->keterangan = 'Pembayaran Cicilan Ke-' . $j . ' Layanan ' . $metode->layanan->nama_layanan;
                $cicil->cicilan_ke = $j;
                $cicil->save();
            }
        }
        
        $bayar->status = 0;

        try {
            $reg->save();
            $bayar->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Pendaftaran Berhasil Disimpan!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Pendaftaran Gagal Tersimpan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    private function Tutup($id_klinik, $hari){
        $cek = M_operasional::where('id_klinik',$id_klinik)->where('hari',$hari)->where('status','TUTUP')->first();

        return $cek;
    }

    public function thanks()
    {
        return view('corporate.thanks');
    }
}
