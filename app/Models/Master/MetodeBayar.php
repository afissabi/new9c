<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class MetodeBayar extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "metode_bayar";
    protected $primaryKey = "id_metode_pembayaran";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function promo()
    {
        return $this->belongsTo('App\Models\Master\M_promo', 'id_promo');
    }

    public function layanan()
    {
        return $this->belongsTo('App\Models\Master\M_layanan', 'id_layanan');
    }
}
