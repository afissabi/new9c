<?php

namespace App\Helpers;

use App\Models\Master\M_kota;
use App\Models\Master\M_menu;
use App\Models\Master\M_provinsi;
use App\Models\T_warga_kependudukan;
use App\Models\Master\MenuRole;
use App\Models\MenuRole as ModelsMenuRole;
use App\Models\ModelHasRoles;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function menuFront()
    {
        $frontMenu = M_menu::where('tipe', 'fo')->where('parent_id',null)->orderBy('urutan', 'ASC')->get();
        
        $html = "";
        
        foreach ($frontMenu as $menu) {
            if($menu->drop_down == 't'){
                $html .= '<div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">' . $menu->nama_menu . '</a>
                    <div class="dropdown-menu m-0">';
                        $child = M_menu::where('tipe', 'fo')->where('parent_id',$menu->id_menu)->orderBy('urutan', 'ASC')->get();
                        foreach ($child as $menu) {
                            $html .= '<a href="" class="dropdown-item">' . $menu->nama_menu . '</a>';
                        }
                    $html .='</div>
                </div>';
            }else{
                $html .= '<a href="" class="nav-item nav-link active">' . $menu->nama_menu . '</a>';
            }
        }

        return $html;
    }

    // Fungsi untuk menghitung usia (Tahun) parameter Tanggal Lahir
    public static function usia($tglLahir)
    {
        $waktuawal  = date_create($tglLahir);
        $waktuakhir = date_create();
        $diff  = date_diff($waktuawal, $waktuakhir);
        return $diff->y;
    }

    // Fungsi untuk menghitung usia (Bulan) parameter Tanggal Lahir
    public static function usia_bulan($tglLahir)
    {
        $waktuawal  = date_create($tglLahir);
        $waktuakhir = date_create();
        $diff  = date_diff($waktuawal, $waktuakhir);
        return $diff->m;
    }

    // Fungsi untuk menghitung usia (Hari) parameter Tanggal Lahir
    public static function usia_hari($tglLahir)
    {
        $waktuawal  = date_create($tglLahir);
        $waktuakhir = date_create();
        $diff  = date_diff($waktuawal, $waktuakhir);
        return $diff->d;
    }

    // Fungsi untuk mensensor identitas (6 Angka Terakhir)
    public static function sensorIdentitas($identitas)
    {
        $count = strlen($identitas);
        if ($count > 10) {
            $output = substr_replace($identitas, str_repeat('X', $count - 10), 10, $count - 6);
            return $output;
        } else {
            return null;
        }
    }

    public static function Provinsi($id){
        $datas = M_provinsi::findOrFail($id);

        return $datas;
    }

    public static function Kota($id_kota, $id_kab){
        $datas = M_kota::where('id_m_setup_prop',$id_kota)->where('id_m_setup_kab',$id_kab)->first();

        return $datas;
    }


    // Fungsi untuk mensensor identitas (6 Huruf Terakhir)
    public static function sensorNama($identitas)
    {
        $count = strlen($identitas);
        if ($count > 2) {
            $output = substr_replace($identitas, str_repeat('x', $count - 2), 2, $count - 2);
            return $output;
        } else {
            return null;
        }
    }

    public static function numberToAbjad($number)
    {
        $alphabet = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG','BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI'
        );
        return $alphabet[$number];
    }

    public static function convertFloat($value)
    {
        return floatval($value);
    }

    // Fungsi merubah bulan (angka) menjadi nama bulan Indonesia
    public static function bulan()
    {
        return [
            "Januari" => [
                "nama" => "Januari",
                "angka" => "1"
            ],
            "Februari" => [
                "nama" => "Februari",
                "angka" => "2"
            ],
            "Maret" => [
                "nama" => "Maret",
                "angka" => "3"
            ],
            "April" => [
                "nama" => "April",
                "angka" => "4"
            ],
            "Mei" => [
                "nama" => "Mei",
                "angka" => "5"
            ],
            "Juni" => [
                "nama" => "Juni",
                "angka" => "6"
            ],
            "Juli" => [
                "nama" => "Juli",
                "angka" => "7"
            ],
            "Agustus" => [
                "nama" => "Agustus",
                "angka" => "8"
            ],
            "September" => [
                "nama" => "September",
                "angka" => "9"
            ],
            "Oktober" => [
                "nama" => "Oktober",
                "angka" => "10"
            ],
            "November" => [
                "nama" => "November",
                "angka" => "11"
            ],
            "Desember" => [
                "nama" => "Desember",
                "angka" => "12"
            ],
        ];
    }


}
