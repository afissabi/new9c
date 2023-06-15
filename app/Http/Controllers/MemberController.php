<?php

namespace App\Http\Controllers;

use App\Models\M_pembayaran;
use App\Models\Master\Master;
use App\Models\T_register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
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
                                $last .= '<span class="badge badge-warning mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Pembayaran Diterima</span>'; 
                            }
                            
                            $last .='</div>
                    </div>
                    <div class="col-md-4">';
                    if($value->status == 0){
                        $last .= '
                        <a href="" class="btn btn-danger mb-1" style="border-radius: 30px; font-size: 9px;">Lakukan Pembayaran</a>
                        <a href="" class="btn btn-info mb-1" style="border-radius: 30px;font-size: 9px;">Konfirmasi Pembayaran</a>';
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
                                $cicil .= '<span class="badge badge-warning mb-1 mt-3 text-dark" style="border-radius: 10px;">Status : Pembayaran Diterima</span>'; 
                            }
                            
                            $cicil .='</div>
                    </div>
                    <div class="col-md-4">';
                    if($value->status == 0){
                        $cicil .= '
                        <a href="" class="btn btn-danger mb-1" style="border-radius: 30px; font-size: 9px;">Lakukan Pembayaran</a>
                        <a href="" class="btn btn-info mb-1" style="border-radius: 30px;font-size: 9px;">Konfirmasi Pembayaran</a>';
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



}
