<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_perusahaan extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use Userstamps;

    protected $table = "m_perusahaan";
    protected $primaryKey = "id_perusahaan";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
