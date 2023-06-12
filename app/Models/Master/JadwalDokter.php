<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class JadwalDokter extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "jadwal_dokter";
    protected $primaryKey = "id_jadwal_dokter";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function dokter()
    {
        return $this->belongsTo('App\Models\Master\M_pegawai', 'id_pegawai');
    }

    public function klinik()
    {
        return $this->belongsTo('App\Models\M_klinik', 'id_klinik');
    }
}
