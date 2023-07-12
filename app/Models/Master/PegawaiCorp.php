<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class PegawaiCorp extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "pegawai_corp";
    protected $primaryKey = "id_pegawai_corp";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function corp()
    {
        return $this->belongsTo('App\Models\Master\M_perusahaan', 'id_perusahaan');
    }
}
