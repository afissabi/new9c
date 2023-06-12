<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Wildside\Userstamps\Userstamps;

class M_pasien extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use Userstamps;

    protected $table = "m_pasien";
    protected $primaryKey = "id_pasien";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
