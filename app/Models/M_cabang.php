<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_cabang extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "m_cabang";
    protected $primaryKey = "id_cabang";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
