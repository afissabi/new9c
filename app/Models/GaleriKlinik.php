<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class GaleriKlinik extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "galeri_klinik";
    protected $primaryKey = "id_galeri_klinik";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
