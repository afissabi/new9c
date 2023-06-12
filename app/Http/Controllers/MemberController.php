<?php

namespace App\Http\Controllers;

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
                if($value->tipe == 'PROMO'){
                    $last .= '
                        <div class="alert alert-danger">
                            <span class="svg-icon svg-icon-2hx svg-icon-primary me-3">
                                <i class="fas fa-tags" style="color: #9b2342;font-size: 20px;"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-dark">Senin, 27 Januari 2023</h4>
                                <span>' . $value->promo->judul_promo . '</span>
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
                                    <h4 class="mb-1 text-dark">Senin, 27 Januari 2023</h4>
                                    <span>' . $value->layan->nama_layanan . '</span>
                                </div>
                            </div>
                            <div class="col-md-4">';
                                if($value->status == 0){
                                    $last .= '<span class="badge badge-info">Menunggu</span>';
                                }else if ($value->status == 1){
                                    $last .= '<span class="badge badge-success">Diterima</span>';
                                }else{
                                    $last .= '<span class="badge badge-danger">Ditolak</span>';
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
}
