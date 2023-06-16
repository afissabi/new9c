<?php

namespace App\Models\Master;

use App\Models\ModelHasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Master extends Model
{
    use HasFactory;

    public function scopeTotalUser($query)
    {
        $user = Auth::user();
        $roles = ModelHasRoles::where('model_id',$user->id)->first();

        if($roles->role_id == 1){
            return \DB::select("
                SELECT
                    COUNT(id) as total,
                    COUNT( CASE WHEN is_aktif IS NULL THEN id END ) AS aktif,
                    COUNT( CASE WHEN is_aktif IS NOT NULL THEN id END ) AS tidak_aktif
                FROM
                    users
                WHERE
                    deleted_at IS NULL
            ");
        }else{
            return \DB::select("
                SELECT
                    COUNT(id) as total,
                    COUNT( CASE WHEN is_aktif IS NULL THEN id END ) AS aktif,
                    COUNT( CASE WHEN is_aktif IS NOT NULL THEN id END ) AS tidak_aktif
                FROM
                    users
                    JOIN model_has_roles mhr ON mhr.model_id = users.id
                WHERE
                    deleted_at IS NULL
                    AND mhr.role_id != 1
            ");
        }
        
    }

    public function scopeKlinik($query)
    {
        
        return \DB::select("
            select * from m_klinik where deleted_at IS NULL order by (case tipe when 'UTAMA' then 1 when 'CABANG' then 2 end)   
        ");
        
    }

    public function scopedataRegister($query, Request $request)
    {
        $tipe = '';
        $jenis = '';
        $status = '';
        $join = '';
        $na = '';

        if($request->tipe){
            $tipe = "AND tr.tipe = '$request->tipe'";
            if($request->tipe == 'PROMO'){
                $na = "mp.judul_promo,";
                $join = "JOIN m_promo mp ON mp.id_m_promo = tr.id_promo";
            }else{
                $na = "ml.nama_layanan,";
                $join = "JOIN m_layanan ml ON ml.id_layanan = tr.id_layanan";
            }
        }

        if($request->jenis){
            if($request->tipe == 'PROMO'){
                $jenis = "AND tr.id_promo = $request->jenis";
            }else{
                $jenis = "AND tr.id_layanan = $request->jenis";
            }
            
        }

        if($request->status){
            $status = "AND tr.status = '$request->status'";
        }

        return \DB::select("
            SELECT
                tr.*,
                mk.nama as nama_klinik,
                $na
                nama_pasien,
                ps.telp as telp_pasien,
                ps.email as email_pasien,
                mb.jenis_pembayaran,
                mb.tenor
            FROM
                t_register tr
                JOIN m_pasien ps ON ps.id_pasien = tr.id_pasien
                JOIN m_klinik mk ON mk.id_klinik = tr.id_klinik
                LEFT JOIN metode_bayar mb ON mb.id_metode_pembayaran = tr.id_metode
                $join
            WHERE
                tr.deleted_at IS NULL 
                $tipe
                $jenis
                $status
        ");
        
    }

    public function scopedataBayar($query, Request $request)
    {
        $tipe = '';
        $jenis = '';
        $status = '';
        $join = '';
        $na = '';
        $tanggal = '';

        if($request->tipe){
            $tipe = "AND tr.tipe = '$request->tipe'";
            if($request->tipe == 'PROMO'){
                $na = "pr.judul_promo,";
                $join = "JOIN m_promo pr ON pr.id_m_promo = tr.id_promo";
            }else{
                $na = "ml.nama_layanan,";
                $join = "JOIN m_layanan ml ON ml.id_layanan = tr.id_layanan";
            }
        }else{
            $na = "pr.judul_promo,ml.nama_layanan,";
            $join = "LEFT JOIN m_promo pr ON pr.id_m_promo = tr.id_promo
            LEFT JOIN m_layanan ml ON ml.id_layanan = tr.id_layanan";
        }

        if($request->jenis){
            if($request->tipe == 'PROMO'){
                $jenis = "AND tr.id_promo = $request->jenis";
            }else{
                $jenis = "AND tr.id_layanan = $request->jenis";
            }
            
        }

        if($request->status != null){
            $status = "AND mp.status = $request->status";
        }

        if($request->tgl_akhir){
            $tanggal = "AND tgl_bayar BETWEEN '$request->tgl_awal' AND '$request->tgl_akhir'";
        }

        return \DB::select("
            SELECT
                mp.id_pembayaran,
                tr.tipe,
                $na
                nama_pasien,
                ps.telp as telp_pasien,
                ps.email as email_pasien,
                mp.status,
                mp.is_dp,
                mp.cicilan_ke,
                mp.tgl_bayar,
                mp.keterangan,
                mp.bukti,
                mp.nilai
            FROM
                m_pembayaran mp
                JOIN t_register tr ON tr.id_t_register = mp.id_t_register
                JOIN m_pasien ps ON ps.id_pasien = mp.id_pasien
                $join
            WHERE
                mp.deleted_at IS NULL
                AND tr.deleted_at IS NULL
                $tipe
                $jenis
                $status
                $tanggal
        ");
        
    }

    public function scopeBayar($query, $pasien)
    {
        return \DB::select("
            SELECT
                mp.*,
                tr.id_pasien
            FROM
                m_pembayaran mp
                JOIN t_register tr ON tr.id_t_register = mp.id_t_register
            WHERE
                mp.deleted_at IS NULL
                AND tr.deleted_at IS NULL
                AND tr.id_pasien = $pasien
                AND is_dp = 't'
                AND mp.status != 2
                OR
                mp.deleted_at IS NULL
                AND tr.deleted_at IS NULL
                AND tr.id_pasien = $pasien
                AND is_dp IS NULL
                AND mp.status != 2
        ");
        
    }

    public function scopeCicilan($query, $pasien)
    {
        return \DB::select("
            SELECT
                mp.*,
                tr.id_pasien 
            FROM
                m_pembayaran mp
                JOIN t_register tr ON tr.id_t_register = mp.id_t_register 
            WHERE
                mp.deleted_at IS NULL 
                AND tr.deleted_at IS NULL 
                AND tr.id_pasien = $pasien
                AND jenis_pembayaran = 'CICILAN'
                AND is_dp = 'f'
                AND mp.status != 2
        ");
        
    }


}
