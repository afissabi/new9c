<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Dokter_layanan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "dokter_layanan";
    protected $primaryKey = "id_dokter_layanan";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function layan()
    {
        return $this->belongsTo('App\Models\Master\M_layanan', 'id_layanan');
    }

    public function dokter()
    {
        return $this->belongsTo('App\Models\Master\M_pegawai', 'id_pegawai');
    }
}
