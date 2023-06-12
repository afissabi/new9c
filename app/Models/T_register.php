<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Wildside\Userstamps\Userstamps;

class T_register extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use Userstamps;

    protected $table = "t_register";
    protected $primaryKey = "id_t_register";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function promo()
    {
        return $this->belongsTo('App\Models\Master\M_promo', 'id_promo');
    }

    public function klinik()
    {
        return $this->belongsTo('App\Models\M_klinik', 'id_klinik');
    }

    public function layan()
    {
        return $this->belongsTo('App\Models\Master\M_layanan', 'id_layanan');
    }

    public function pasien()
    {
        return $this->belongsTo('App\Models\Master\M_pasien', 'id_pasien');
    }

    public function metode()
    {
        return $this->belongsTo('App\Models\Master\MetodeBayar', 'id_metode');
    }

}
