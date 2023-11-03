<?php

namespace App\Http\Controllers;

use App\Models\M_klinik;
use App\Models\M_operasional;
use App\Models\M_pembayaran;
use App\Models\Master\M_layanan;
use App\Models\Master\M_pasien;
use App\Models\Master\Mapping_layanan;
use App\Models\Master\M_estimasi;
use App\Models\Master\Master;
use App\Models\Master\MetodeBayar;
use App\Models\T_register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use Image;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Member Area";
        View::share(compact('pageTitle'));
    }

    public function dashboard()
    {
        $data = [
            'menu_active'   => 'dashboard',
            'parent_active' => '',
        ];

        return view('member.welcome', $data);
    }

    public function Layanan()
    {
        $layanan = M_layanan::where('tipe','UMUM')->where('status',1)->get();

        $data = [
            'menu_active'   => 'dokter',
            'parent_active' => '',
            'layanan' => $layanan,
        ];

        return view('member.layanan', $data);
    }

    public function lastRegis(Request $request)
    {
        $pasien = Auth::user()->detailUser->pasien->id_pasien;
        
        $last  = '';
        $data = T_register::where('id_pasien',$pasien)->orderBy('updated_at','DESC')->limit($request->need)->get();
        
        if($data){
            foreach ($data as $value) {
                $tanggal = $value->tanggal;
                $bulan = \Carbon\Carbon::parse($value->tanggal)->format('m');

                if($value->tipe == 'PROMO'){
                    $last .= '
                        <div class="alert alert-danger">
                            <div class="row">
                                <div class="col-md-8">
                                    <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                                        <i class="fas fa-tags" style="color: #9b2342;font-size: 20px;"></i>
                                    </span>
                                    <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">'. \App\Helpers\Helper::hariIndo(date('D', strtotime($tanggal))) . ', ' . \Carbon\Carbon::parse($value->tanggal)->format('d') . ' ' . $this->Bulan($bulan) . ' ' . \Carbon\Carbon::parse($value->tanggal)->format('Y') .'</h4>
                                        <span>' . $value->promo->judul_promo . 'AS</span>
                                    </div>
                                </div>
                                <div class="col-md-4">';
                                    if($value->status == 0){
                                        $last .= '<span class="badge badge-info" style="border-radius: 10px;">Menunggu</span>';
                                    }else if ($value->status == 1){
                                        $last .= '<span class="badge badge-success" style="border-radius: 10px;">Diterima</span>';
                                    }else{
                                        $last .= '<span class="badge badge-danger" style="border-radius: 10px;">Ditolak</span>';
                                    }
                                    
                                $last .= '</div>
                            </div>
                        </div>';
                }else{
                    $last .= '
                    <div class="alert alert-primary">
                        <div class="row">
                            <div class="col-md-8">
                                <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                                    <i class="fas fa-tooth" style="color: #001e5c;font-size: 20px;"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">'. \App\Helpers\Helper::hariIndo(date('D', strtotime($tanggal))) . ', ' . \Carbon\Carbon::parse($value->tanggal)->format('d') . ' ' . $this->Bulan($bulan) . ' ' . \Carbon\Carbon::parse($value->tanggal)->format('Y') .'</h4>
                                    <span>' . $value->layan->nama_layanan . '</span>
                                </div>
                            </div>
                            <div class="col-md-4">';
                                if($value->status == 0){
                                    $last .= '<span class="badge badge-info" style="border-radius: 10px;">Status : Menunggu</span>';
                                }else if ($value->status == 1){
                                    $last .= '<span class="badge badge-success" style="border-radius: 10px;">Status : Diterima</span>';
                                }else{
                                    $last .= '<span class="badge badge-danger" style="border-radius: 10px;">Status : Ditolak</span>';
                                }
                                
                            $last .= '</div>
                        </div>
                    </div>';
                }
                
            }
        }else{
            $last  = '<div class="alert alert-danger">
                <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                    <i class="fas fa-tags" style="color: #9b2342;font-size: 20px;"></i>
                </span>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-danger">----</h4>
                    <span>RIWAYAT PENDAFTARAN TIDAK DITEMUKAN</span>
                </div>
            </div>';
        }
        

        echo $last;
    }

    public function lastPay(Request $request)
    {
        $pasien = Auth::user()->detailUser->pasien->id_pasien;

        $last = '';
        $cicil = '';
        $bayar = collect(Master::Bayar($pasien));
        $cicilan = collect(Master::Cicilan($pasien));
        
        foreach ($bayar as $value) {
            $last .= '
            <div class="alert alert-primary">
                <div class="row">
                    <div class="col-md-8">
                        <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                            Rp ' . number_format($value->nilai, 0,",",".") . '
                        </span>
                        <div class="d-flex flex-column">';
                            if($value->is_dp){
                                $last .='<h4 class="mb-1 text-dark"> DP (Uang Muka)</h4>';
                            }else{
                                $last .='<h4 class="mb-1 text-dark">' . $value->jenis_pembayaran . '</h4>';
                            }
                            
                            $last .='<span>' . $value->keterangan . '</span>';
                            if($value->status == 0){
                                $last .= '<span class="badge badge-warning mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Menunggu Pembayaran</span>';
                            } else if ($value->status == 1){
                                $last .= '<span class="badge badge-primary mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Menunggu Konfirmasi Admin</span>'; 
                            }else if ($value->status == 2){
                                $last .= '<span class="badge badge-success mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Pembayaran Diterima</span>'; 
                            }
                            
                            $last .='</div>
                    </div>
                    <div class="col-md-4">';
                    if($value->status == 0){
                        $last .= '
                        <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-danger mb-1 bayar" style="border-radius: 30px; font-size: 9px;">Lakukan Pembayaran</a>
                        <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-info mb-1 konfirm" style="border-radius: 30px;font-size: 9px;">Konfirmasi Pembayaran</a>';
                    }
                    $last .= '</div>
                </div>
            </div>';
        }

        foreach ($cicilan as $value) {
            $cicil .= '
            <div class="alert alert-warning">
                <div class="row">
                    <div class="col-md-8">
                        <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                            Rp ' . number_format($value->nilai, 0,",",".") . '
                        </span>
                        <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark"> CICILAN KE - '. $value->cicilan_ke .'</h4>';
                            
                            $cicil .='<span>' . $value->keterangan . '</span>';
                            if($value->status == 0){
                                $cicil .= '<span class="badge badge-warning mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Menunggu Pembayaran</span>';
                            } else if ($value->status == 1){
                                $cicil .= '<span class="badge badge-primary mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Menunggu Konfirmasi Admin</span>'; 
                            } else if ($value->status == 2){
                                $cicil .= '<span class="badge badge-warning mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Pembayaran Diterima</span>'; 
                            }
                            
                            $cicil .='</div>
                    </div>
                    <div class="col-md-4">';
                    if($value->status == 0){
                        $cicil .= '
                        <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-danger mb-1 bayar" style="border-radius: 30px; font-size: 9px;">Lakukan Pembayaran</a>
                        <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-info mb-1 konfirm" style="border-radius: 30px;font-size: 9px;">Konfirmasi Pembayaran</a>';
                    }
                    $cicil .= '</div>
                </div>
            </div>';
        }

        $data = [
            "last" => $last,
            "cicil" => $cicil,
        ];

        return response()->json($data);
    }

    public function Bayar(Request $request)
    {
        $cek = M_pembayaran::findOrFail($request->id);

        $data = [
            'nilai' => number_format($cek->nilai, 0,",","."),
            'keterangan' => $cek->keterangan,
            'id_pembayaran' => $cek->id_pembayaran,
        ];

        return response()->json($data);
    }

    public function konfirBayar(Request $request)
    {
        $data = M_pembayaran::findOrFail($request->id_pembayaran);

        if ($request->file('gambar')) {
            $image = $request->file('gambar');
            $destinationPathThum = public_path('/img/bayar/thumbnail');
            $img = Image::make($image->path());
            $imageName =  'byr-' . Carbon::now()->format("Y-m-d") . '-' . $request->id_pembayaran . '.jpg';

            $img->resize(300, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThum . '/' . $imageName);

            $destinationPath = public_path('/img/bayar/');
            $image->move($destinationPath, $imageName);
            $destinationPathori = "img/bayar/thumbnail/";
        } else {
            $imageName = 'default.jpg';
            $destinationPathori = "img/";
        }

        $data->tgl_bayar = $request->tgl_bayar;
        $data->status = 1;
        $data->bukti   = $imageName;

        try {
            $data->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'pesan'  => 'Konfirmasi Pembayaran Berhasil Terkirim!',
                'kategori' => $request->kategori,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Konfirmasi Pembayaran Gagal Terkirim!',
                'kategori' => $request->kategori,
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function RiwayatDaftar()
    {
        $data = [
            'menu_active'   => 'Riwayat Pendaftaran',
            'parent_active' => '',
        ];

        return view('member.daftar', $data);
    }

    public function AllDaftar(Request $request)
    {
        try {
            $pasien = Auth::user()->detailUser->pasien->id_pasien;
            
            $data_tables = [];
            
            $datas = T_register::where('id_pasien',$pasien)->orderBy('updated_at','DESC')->get();

            foreach ($datas as $key => $value) {
                $tanggal = $value->tanggal;
                $bulan = \Carbon\Carbon::parse($value->tanggal)->format('m');

                $tanggaldaftar = $value->tanggal_daftar;
                $bulandaftar = \Carbon\Carbon::parse($value->tanggal_daftar)->format('m');

                $data_tables[$key][] = $key + 1;
                $data_tables[$key][] = '<center>' . \App\Helpers\Helper::hariIndo(date('D', strtotime($tanggaldaftar))) . ', ' . \Carbon\Carbon::parse($value->tanggaldaftar)->format('d') . ' ' . $this->Bulan($bulan) . ' ' . \Carbon\Carbon::parse($value->tanggaldaftar)->format('Y') . '</center>';
                $data_tables[$key][] = '<center>' . $value->klinik->nama . '</center>';
                $data_tables[$key][] = '<center>Tanggal : ' . \App\Helpers\Helper::hariIndo(date('D', strtotime($tanggal))) . ', ' . \Carbon\Carbon::parse($value->tanggal)->format('d') . ' ' . $this->Bulan($bulan) . ' ' . \Carbon\Carbon::parse($value->tanggal)->format('Y') . '<br>Jam : ' . substr($value->jam,0,5) . 'WIB</center>';
                if($value->tipe == 'PROMO'){
                    $data_tables[$key][] = '<center>' . $value->promo->judul_promo . '<br><span class="badge badge-info" style="border-radius: 10px;">PROMO</span></center>';
                }else{
                    $data_tables[$key][] = '<center>' . $value->layan->nama_layanan . '</center>';
                }

                if($value->status == 0){
                    $data_tables[$key][] = '<center><span class="badge badge-info" style="border-radius: 10px;">Status : Menunggu</span></center>';
                }else if ($value->status == 1){
                    $data_tables[$key][] = '<center><span class="badge badge-success" style="border-radius: 10px;">Status : Diterima</span></center>';
                }else{
                    $data_tables[$key][] = '<center><span class="badge badge-danger" style="border-radius: 10px;">Status : Ditolak</span></center>';
                }
                
            }

            $data = [
                "data" => $data_tables
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Ditampilkan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    public function RiwayatBayar()
    {
        $data = [
            'menu_active'   => 'Riwayat Pembayaran',
            'parent_active' => '',
        ];

        return view('member.bayar', $data);
    }

    public function AllBayar(Request $request)
    {
        try {
            $pasien = Auth::user()->detailUser->pasien->id_pasien;
            $data_tables = [];
            
            $datas = collect(\App\Models\Master\Master::dataBayarPasien($request, $pasien));
            foreach ($datas as $key => $value) {
                $data_tables[$key][] = $key + 1;
                $data_tables[$key][] = '<center>' . $value->tipe . '</center>';
                if($value->tipe == 'PROMO'){
                    $data_tables[$key][] = '<center>' . $value->judul_promo . '<br><span class="badge badge-info" style="border-radius: 10px;">PROMO</span></center>';
                }else{
                    $data_tables[$key][] = '<center>' . $value->nama_layanan . '</center>';
                }
                
                if($value->status == 0){
                    $data_tables[$key][] = '<center><span class="badge badge-warning mb-1 mt-3 text-dark" style="border-radius: 10px;">Menunggu Pembayaran</span></center>';
                } else if ($value->status == 1){
                    $data_tables[$key][] = '<span class="badge badge-primary mb-1 mt-3 text-dark" style="border-radius: 10px;">Menunggu Konfirmasi Admin</span><br>
                    Tanggal Bayar : ' . \Carbon\Carbon::parse($value->tgl_bayar)->format('d-m-Y') . '<br>
                    <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-success bukti" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-file-invoice-dollar"></i> Bukti Bayar</a>'; 
                }else if ($value->status == 2){
                    $data_tables[$key][] = '<center><span class="badge badge-success mb-1 mt-3 text-dark" style="border-radius: 10px;">Pembayaran Diterima</span><br>
                    <a href="javascript:void(0)" data-id_pembayaran="' . $value->id_pembayaran . '" class="btn btn-success bukti" style="padding: 5px !important;font-size: 10px;"><i class="fas fa-file-invoice-dollar"></i> Bukti Bayar</a></center>'; 
                }

                $data_tables[$key][] = '<center>Rp' . number_format($value->nilai, 0,",",".") . '<br>' . $value->keterangan . '</center>';
            }

            $data = [
                "data" => $data_tables
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan'  => 'Maaf, Data Gagal Ditampilkan!',
                'err'    => $e->getMessage()
            ]);
        }
    }

    private function Bulan($bulan){
        
        if($bulan == '01'){
            $bln = 'Januari';
        }elseif($bulan == '02'){
            $bln = 'Februari';
        }elseif($bulan == '03'){
            $bln = 'Maret';
        }elseif($bulan == '04'){
            $bln = 'April';
        }elseif($bulan == '05'){
            $bln = 'Mei';
        }elseif($bulan == '06'){
            $bln = 'Juni';
        }elseif($bulan == '07'){
            $bln = 'Juli';
        }elseif($bulan == '08'){
            $bln = 'Agustus';
        }elseif($bulan == '09'){
            $bln = 'September';
        }elseif($bulan == '10'){
            $bln = 'Oktober';
        }elseif($bulan == '11'){
            $bln = 'November';
        }elseif($bulan == '12'){
            $bln = 'Desember';
        }

        return $bln;
        
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

        return view('member.regumum', $data);
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

    // public function jamLayanan(Request $request)
    // {
    //     $klinik = M_operasional::where('id_klinik',$request->klinik)->where('hari',$request->hari)->first();
    //     $layan = M_layanan::where('id_layanan',$request->layanan)->first();
    //     $html = '';
    //     $starttime = $klinik->jam_buka;
    //     $endtime = $klinik->jam_tutup;
    //     // $duration = $promo->waktu_layanan;

    //     $array_of_time = array ();
    //     $start_time    = strtotime ($starttime);
    //     $nyartime	   = date("H:i", strtotime('-30 minutes', strtotime($endtime)));
    //     $end_time      = strtotime($nyartime);
    //     $add_mins  = 30 * 60;

    //     while ($start_time <= $end_time)
    //     {
    //         $array_of_time[] = date ("H:i", $start_time);
    //         $start_time += $add_mins;
    //     }
        
    //     $break = M_operasional::where('id_klinik',$request->klinik)->where('hari',$request->hari)->where('status','ISTIRAHAT')->first();
    //     if($break){
    //         $startbreak = $break->jam_buka;
    //         $endbreak = $break->jam_tutup;
    //         // $duration = $promo->waktu_layanan;

    //         $array_of_break = array ();
    //         $start_break    = strtotime ($startbreak);
    //         $nyarbreak	   = date("H:i", strtotime('-30 minutes', strtotime($endbreak)));
    //         $end_break      = strtotime($nyarbreak);
    //         $add_mins_break  = 30 * 60;

    //         while ($start_break <= $end_break)
    //         {
    //             $array_of_break[] = date ("H:i", $start_break);
    //             $start_break += $add_mins_break;
    //         }
    //     }

    //     foreach($array_of_time as $value){
    //         $start_time    = strtotime($value);
    //         $add_mins  = 30 * 60;
    //         $plus = $start_time + $add_mins;
    //         $estimasi = date("H:i", $plus);
    //         $is_disabled = false;

    //         $penuh = $this->PenuhLayanan($request->layanan, $request->klinik, $request->tanggal, $value);
    //          if($break){
    //             if($penuh == 'penuh'){
    //                 $bg = 'bg-red-turquoise';
    //                 $is_disabled = true;
    //                 $a = '';
    //                 $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
    //             }else if(in_array($value, $array_of_break)){
    //                 $bg = 'bg-yellow-turquoise';
    //                 $is_disabled = true;
    //                 $a = '';
    //                 $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
    //             }else{
    //                 $bg = 'bg-green-turquoise';
    //                 $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
    //                 $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
    //             }   
    //         }else{
    //             if($penuh == 'penuh'){
    //                 $bg = 'bg-red-turquoise';
    //                 $is_disabled = true;
    //                 $a = '';
    //                 $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
    //             }else{
    //                 $bg = 'bg-green-turquoise';
    //                 $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
    //                 $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
    //             }
    //         }

    //         $html .= '<div class="tile '. $bg .'" style="width:130px; height:110px;" data-disabled="' . $is_disabled . '">
    //             '.$a.'
    //                 <div class="tile-body" style="overflow:initial;font-weight: bold;color:black">
    //                     '.$i.'
    //                 </div>
    //                 <div class="tile-object" style="background: #2F3A60;">
    //                     <h5 style="text-align:center;color:#ffff;margin-bottom: 0px !important;margin-top: 4px;">'. $value . ' WIB</h5>
    //                 </div>
    //             </a>
    //         </div>';
    //     }

    //     $kembali = '<a href="javascript:void(0)" onClick="klinik()" class="menu-link px-3 btn-warning mb-1 tanggal" style="padding: 10px;color: #fff;"><i class="fas fa-arrow-circle-left"></i> Kembali</a>';
    //     // echo $html;

    //     $data = [
    //         "html" => $html,
    //         "rawat" => $layan->nama_layanan,
    //         "kembali" => $kembali,
    //     ];

    //     return response()->json($data);
    // }
    public function jamLayanan(Request $request)
    {
        // JAM OPERASIONAL
        $klinik = M_operasional::where('id_klinik',$request->klinik)->where('hari',$request->hari)->first();
        $layan = M_layanan::where('id_layanan',$request->layanan)->first();
        $estimate = M_estimasi::where('id_layanan',$request->layanan)->where('id_klinik', $request->klinik)->first();

        $html = '';
        $starttime = $klinik->jam_buka;
        $endtime = $klinik->jam_tutup;
        // $duration = $promo->waktu_layanan;

        
        if($estimate){
            $array_of_time = array ();
            $start_time    = strtotime ($starttime);
            $nyartime	   = date("H:i", strtotime('-'.$estimate->estimasi_waktu.' minutes', strtotime($endtime)));
            $end_time      = strtotime($nyartime);
            $add_mins  = $estimate->estimasi_waktu * 60;
        }else{
            $array_of_time = array ();
            $start_time    = strtotime ($starttime);
            $nyartime	   = date("H:i", strtotime('-30 minutes', strtotime($endtime)));
            $end_time      = strtotime($nyartime);
            $add_mins  = 30 * 60;
        }
        

        while ($start_time <= $end_time)
        {
            $array_of_time[] = date ("H:i", $start_time);
            $start_time += $add_mins;
        }

        $breaks = M_operasional::where('id_klinik',$request->klinik)->where('hari',$request->hari)->where('status','ISTIRAHAT')->get();
        // if($break){
        //     $startbreak = $break->jam_buka;
        //     $endbreak = $break->jam_tutup;
        //     // $duration = $promo->waktu_layanan;

        //     $array_of_break = array ();
        //     $start_break    = strtotime ($startbreak);
        //     $nyarbreak	   = date("H:i", strtotime('-30 minutes', strtotime($endbreak)));
        //     $end_break      = strtotime($nyarbreak);
        //     $add_mins_break  = 30 * 60;

        //     while ($start_break <= $end_break)
        //     {
        //         $array_of_break[] = date ("H:i", $start_break);
        //         $start_break += $add_mins_break;
        //     }
        // }

        foreach($array_of_time as $value){
            $start_time    = strtotime($value);
            if($estimate){
                $add_mins  = $estimate->estimasi_waktu * 60;
            }else{
                $add_mins  = 30 * 60;
            }
            
            $plus = $start_time + $add_mins;
            $estimasi = date("H:i", $plus);
            $is_disabled = false;

            if($estimate){
                $jumdu = $estimate->jumlah_du;
            }else{
                $jumdu = 2;
            }

            $penuh = $this->PenuhLayanan($request->layanan, $request->klinik, $request->tanggal, $value, $jumdu);
            $bg = '';
            $a = '';
            $i = '';

            foreach ($breaks as $break) {
                $start_break = strtotime($break->jam_buka);
                if($estimate){
                    $end_break = strtotime(date("H:i", strtotime('-'.$estimate->estimasi_waktu.' minutes', strtotime($break->jam_tutup))));
                }else{
                    $end_break = strtotime(date("H:i", strtotime('-30 minutes', strtotime($break->jam_tutup))));
                }
                

                if ($start_time >= $start_break && $start_time <= $end_break) {
                    // Waktu yang bersamaan dengan jadwal istirahat
                    $bg = 'bg-yellow-turquoise';
                    $is_disabled = true;
                    $a = '';
                    $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
                    break; // Keluar dari loop breaks karena sudah ditemukan istirahat yang cocok
                }
            }
            // if($break){
            //     if($penuh == 'penuh'){
            //         $bg = 'bg-red-turquoise';
            //         $is_disabled = true;
            //         $a = '';
            //         $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
            //     }
            //     else if(in_array($value, $array_of_break)){
            //         $bg = 'bg-yellow-turquoise';
            //         $is_disabled = true;
            //         $a = '';
            //         $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
            //     }
            //     else{
            //         $bg = 'bg-green-turquoise';
            //         $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
            //         $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
            //     }   
            // }else{
                // if($penuh == 'penuh'){
                //     $bg = 'bg-red-turquoise';
                //     $is_disabled = true;
                //     $a = '';
                //     $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
                // }else{
                //     $bg = 'bg-green-turquoise';
                //     $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
                //     $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
                // }
            // }
            if (empty($bg)) {
                if ($penuh == 'penuh') {
                    $bg = 'bg-red-turquoise';
                    $is_disabled = true;
                    $a = '';
                    $i = '<i class="fas fa-times-circle" style="margin-top: 0px !important;"></i>';
                } else {
                    $bg = 'bg-green-turquoise';
                    $a = '<a class="register" href="javascript:void(0)" data-id_klinik="' . $request->klinik . '" data-id_layanan="' . $request->layanan . '" data-tanggal="' . $request->tanggal . '" data-jam="' . $value . '">';
                    $i = '<i class="fas fa-clock" style="margin-top: 0px !important;"></i>';
                }
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
                <label class="col-lg-3 col-form-label text-lg-end required">Nama Pasien :</label>
                <div class="col-lg-6">
                    <input type="hidden" class="form-control" name="id_pasien" value="'. $detail->id_pasien .'">
                    <input type="text" class="form-control" name="nama_pasien" value="'. $user->name .'">
                </div>
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
        // $cek = M_pasien::where('email',$request->id_pasien)->first();
        $id_reg = DB::table('t_register')->max('id_t_register') + 1;
        
        $jam = $request->jam.':00';
        $cekreg = T_register::where('id_layanan',$request->layanan)->where('id_klinik',$request->klinik)->where('id_pasien',$request->id_pasien)->where('tanggal',$request->tanggal)->where('jam',$jam)->first();

        $reg = new T_register();
        $reg->status = 0;
        
        $reg->tipe = 'LAYANAN';
        $reg->id_layanan = $request->layanan;
        $reg->id_pasien = $request->id_pasien;
        $reg->id_klinik = $request->klinik;
        $reg->tanggal_daftar = date('Y-m-d');
        $reg->tanggal = $request->tanggal;
        $reg->jam = $request->jam;
        $reg->id_metode = $request->tipe_bayar;
        
        
        $metode = MetodeBayar::where('id_metode_pembayaran',$request->tipe_bayar)->first();
        
        $bayar = new M_pembayaran();
        $bayar->id_t_register = $id_reg;
        $bayar->id_pasien = $request->id_pasien;
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
                $cicil->id_pasien = $request->id_pasien;
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
        return view('member.thanks');
    }

}
