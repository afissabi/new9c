<?php

namespace App\Http\Controllers;

use App\Models\Master\M_kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Dashboard";
        View::share(compact('pageTitle'));
    }

    public function dashboard()
    {
        $data = [
            'menu_active'   => 'dashboard',
            'parent_active' => '',
        ];
        return view('dashboard', $data);
    }

    public function pilihKota(Request $request)
    {
        $datas = M_kota::where('id_m_setup_prop', $request->prov)->get();

        $html  = '';
        $html .= '<option value="">- Pilih Kota -</option>';
        foreach ($datas as $value) {
            $html .= '<option value="' . $value->id_kab . '" ' . $see['id_kec'] == $see->id_kec ? 'selected' : '' . '>' . $value->nm_kab . '</option>';
        }
        echo $html;
    }

}
