<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Mapping_pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "mapping_pegawai";
    protected $primaryKey = "id_mapping_pegawai";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function clinic()
    {
        return $this->belongsTo('App\Models\M_klinik', 'id_klinik');
    }
}
