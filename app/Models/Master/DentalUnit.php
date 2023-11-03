<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DentalUnit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "dental_unit";
    protected $primaryKey = "id_dental_unit";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function layanan()
    {
        return $this->belongsTo('App\Models\Master\M_layanan', 'id_layanan');
    }
}
