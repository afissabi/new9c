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

    public function home()
    {
        $data = [
            'menu_active'   => 'SELAMAT DATANG',
            'pageTitle' => 'SELAMAT DATANG',
            'parent_active' => '',
        ];
        return view('home', $data);
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

    public function promoRekap(Request $request)
    {
        try {
            $data_tables = [];
            
            $datas = collect(\App\Models\Master\Master::promoRekap($request));

            foreach ($datas as $key => $value) {
                $data_tables[$key][] = $key + 1;
                $data_tables[$key][] = '<center>' . $value->judul_promo . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->menunggu, 0,",",".") . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->diterima, 0,",",".") . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->tolak, 0,",",".") . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->total, 0,",",".") . '</center>';
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

    public function layananRekap(Request $request)
    {
        try {
            $data_tables = [];
            
            $datas = collect(\App\Models\Master\Master::layananRekap($request));

            foreach ($datas as $key => $value) {
                $data_tables[$key][] = $key + 1;
                $data_tables[$key][] = '<center>' . $value->nama_layanan . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->menunggu, 0,",",".") . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->diterima, 0,",",".") . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->tolak, 0,",",".") . '</center>';
                $data_tables[$key][] = '<center>' . number_format($value->total, 0,",",".") . '</center>';
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

}
