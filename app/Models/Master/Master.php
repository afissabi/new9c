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
}
