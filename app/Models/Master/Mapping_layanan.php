<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Mapping_layanan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "mapping_layanan";
    protected $primaryKey = "id_mapping_layanan";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function klinik()
    {
        return $this->belongsTo('App\Models\M_klinik', 'id_klinik');
    }
    
    public function layan()
    {
        return $this->belongsTo('App\Models\Master\M_layanan', 'id_layanan');
    }
}
