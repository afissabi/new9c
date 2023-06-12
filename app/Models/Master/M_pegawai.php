<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "m_pegawai";
    protected $primaryKey = "id_pegawai";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function jabat()
    {
        return $this->belongsTo('App\Models\Master\M_jabatan', 'jabatan');
    }

    // QUERY TOTAL PEGAWAI
    public function scopeTotalPegawai($query)
    {
        return \DB::select("
            SELECT
                COUNT(id_pegawai) as total,
                COUNT( CASE WHEN status IS NULL THEN id_pegawai END ) AS aktif,
                COUNT( CASE WHEN status IS NOT NULL THEN id_pegawai END ) AS tidak_aktif
            FROM
                m_pegawai
            WHERE
                deleted_at IS NULL
        ");
    }
}
