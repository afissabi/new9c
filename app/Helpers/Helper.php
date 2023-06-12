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
    public static function menuAllowTo($parentId = 0, $arrayParent = array())
    {
        $user = Auth::user();
        
        // $roles = $user->roles;
        $roles = ModelHasRoles::where('model_id',$user->id)->first();
        $roleId = $roles->pluck('role_id');
        
        $menuRole = MenuRole::where('role_id', $roles->role_id)->get();
        $idMenuRole = $menuRole->pluck('menu_id');
        $recursiveMenu = M_menu::where('tipe','bo')->whereIn('id_menu', $idMenuRole->all())->orderBy('urutan', 'ASC')->get();

        if ($parentId == 0) {
            foreach ($recursiveMenu as $item) {
                if (($item->parent_id != 0) && !in_array($item->parent_id, $arrayParent)) {
                    $arrayParent[] = $item->parent_id;
                }
            }
        }

        $html = "";
        foreach ($recursiveMenu as $menu) {
            if ($menu->parent_id == $parentId) {
                $menuUrl = url("$menu->url_menu");
                if (in_array($menu->id_menu, $arrayParent)) {
                    $html .= "<div data-kt-menu-trigger='click' class='menu-item menu-accordion'>";
                    $html .= "<span class='menu-link'>
                    <span class='menu-bullet'>
                        <i class='$menu->icon'></i>
                    </span>
                    <span class='menu-title'>&nbsp;&nbsp;$menu->nama_menu</span>
                    <span class='menu-arrow'></span>
                </span>";
                } elseif ($menu->is_single == 1) {
                    $html .= '<div class="menu-item">';
                    $html .= "
                    <a class='menu-link' href='$menuUrl'>
                        <span class='menu-bullet'>
                            <i class='$menu->icon'></i>
                        </span>
                        <span class='menu-title'>&nbsp;&nbsp; $menu->nama_menu</span>
                    </a>";
                } else {
                    $html .= '<div class="menu-item">';
                    $html .= "
                    <a class='menu-link' href='$menuUrl'>
                        <span class='menu-bullet'>
                            <span class='bullet bullet-dot'></span>
                        </span>
                        <span class='menu-title'> $menu->nama_menu</span>
                    </a>";
                }
                if (in_array($menu->id_menu, $arrayParent)) {
                    $html .= "<div class='menu-sub menu-sub-accordion'>";
                    $html .= self::menuAllowTo($menu->id_menu, $arrayParent);
                    $html .= '</div>';
                }
                $html .= '</div>';
            }
        }
        return $html;
    }

    public static function menuFront()
    {
        $frontMenu = M_menu::where('tipe', 'fo')->where('parent_id',null)->orderBy('urutan', 'ASC')->get();
        
        $html = "";
        $menu_active = "";
        $active = "";
        
        foreach ($frontMenu as $menu) {
            $menuUrl = url("$menu->url_menu");

            if($menu->drop_down == 't'){
                $html .= "<div class='nav-item dropdown'>
                    <a href='#' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>$menu->nama_menu</a>
                    <div class='dropdown-menu m-0'>";
                        $child = M_menu::where('tipe', 'fo')->where('parent_id',$menu->id_menu)->orderBy('urutan', 'ASC')->get();
                        foreach ($child as $menu) {
                            $menuUrl = url("$menu->url_menu");
                            $html .= "<a href='$menuUrl' class='dropdown-item'>$menu->nama_menu</a>";
                        }
                    $html .='</div>
                </div>';
            }else{
                if($menu_active == $menu->nama_menu){
                    $active = 'active';
                }
                $html .= "<a href='$menuUrl' class='nav-item nav-link $active'>$menu->nama_menu</a>";
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

    public static function Kota($id_prov, $id_kab){
        $datas = M_kota::where('id_m_setup_prop',$id_prov)->where('id_m_setup_kab',$id_kab)->first();

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

    public static function compareArray($arrayOld, $arrayNew)
    {
        $output = [];
        // $arrayOld = [
        //     'nama' => 'ABC',
        //     'alamat' => 'DEF',
        //     'usia' => 10
        // ];
        // $arrayNew = [
        //     'nama' => 'DEF',
        //     'alamat' => 'DEF',
        //     'rt' => 1
        // ];
        $data_before = [];
        $data_after = [];
        $keysOld = array_keys($arrayOld);
        $keysNew = array_keys($arrayNew);
        $keys = [];
        
        // loop arrayOld
        for ($i = 0; $i < count($arrayOld); $i++)
        {
            $key = $keysOld[$i];
            $include = in_array($key, $keys);
            if (!$include)
            {
                $keys[] = $key;
            }
        }

        // loop arrayNew
        for ($i = 0; $i < count($arrayNew); $i++)
        {
            $key = $keysNew[$i];
            $include = in_array($key, $keys);
            if (!$include)
            {
                $keys[] = $key;
            }
        }

        // loop all array
        for ($i = 0; $i < count($keys); $i++)
        {
            $key = $keys[$i];
            $old = array_key_exists($key, $arrayOld);
            $new = array_key_exists($key, $arrayNew);
            if ($old && $new)
            {
                // all has value
                if ($arrayOld[$key] != $arrayNew[$key])
                {
                    $data_before[$key] = $arrayOld[$key];
                    $data_after[$key] = $arrayNew[$key];
                }
            }
            elseif ($old && !$new)
            {
                // old has value
                // skip
            }
            elseif (!$old && $new)
            {
                // new has value
                // skip
                // $data_before[$key] = null;
                // $data_after[$key] = $arrayNew[$key];
            }
        }
        $output = (object) [
            'arrayOld' => $arrayOld,
            'arrayNew' => $arrayNew,
            'keys' => $keys,
            'data_before' => $data_before,
            'data_after' => $data_after
        ];
        return $output;
    }

    public static function hariIndo($hariInggris)
    {
        switch ($hariInggris) {
            case 'Sun':
                return 'Minggu';
            case 'Mon':
                return 'Senin';
            case 'Tue':
                return 'Selasa';
            case 'Wed':
                return 'Rabu';
            case 'Thu':
                return 'Kamis';
            case 'Fri':
                return 'Jumat';
            case 'Sat':
                return 'Sabtu';
            default:
                return 'hari tidak valid';
        }
    }

    public static function bulansort($bulan)
    {
        switch ($bulan) {
            case 1:
                $bulan = "Jan";
                break;
            case 2:
                $bulan = "Feb";
                break;
            case 3:
                $bulan = "Mar";
                break;
            case 4:
                $bulan = "Apr";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Jun";
                break;
            case 7:
                $bulan = "Jul";
                break;
            case 8:
                $bulan = "Agus";
                break;
            case 9:
                $bulan = "Sept";
                break;
            case 10:
                $bulan = "Okt";
                break;
            case 11:
                $bulan = "Nov";
                break;
            case 12:
                $bulan = "Des";
                break;
        }
        return $bulan;
    }


}
