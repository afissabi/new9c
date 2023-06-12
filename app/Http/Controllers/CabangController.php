<?php

namespace App\Http\Controllers;

use App\Models\M_cabang;
use App\Models\Master\M_kota;
use App\Models\Master\M_provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CabangController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Data Cabang";
        View::share(compact('pageTitle'));
    }

    public function index()
    {
        $prov = M_provinsi::orderBy('nm_prop')->get();
        $kota = M_kota::join('m_setup_prop', 'm_setup_prop.id_m_setup_prop', '=', 'm_setup_kab.id_m_setup_prop')->get();

        $data = [
            'prov' => $prov,
            'kota' => $kota,
        ];

        return view('cabang', $data);
    }
}
