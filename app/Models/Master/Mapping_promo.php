<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Mapping_promo extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "mapping_promo";
    protected $primaryKey = "id_mapping_promo";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function klinik()
    {
        return $this->belongsTo('App\Models\M_klinik', 'id_klinik');
    }

    public function promo()
    {
        return $this->belongsTo('App\Models\Master\M_promo', 'id_promo');
    }
}
