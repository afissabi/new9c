<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class DetailUser extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "detail_user";
    protected $primaryKey = "id_detail_user";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function lurah()
    {
        return $this->belongsTo('App\Models\Master\M_kelurahan', 'id_kel');
    }

    public function camat()
    {
        return $this->belongsTo('App\Models\Master\M_kecamatan', 'id_kec');
    }

    public function pasien()
    {
        return $this->belongsTo('App\Models\Master\M_pasien', 'id_pasien');
    }

    public function corp()
    {
        return $this->belongsTo('App\Models\Master\M_perusahaan', 'id_perusahaan');
    }
}
