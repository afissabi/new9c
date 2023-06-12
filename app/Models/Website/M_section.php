<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "m_section";
    protected $primaryKey = "id_section";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function menu()
    {
        return $this->belongsTo('App\Models\Master\M_menu', 'id_menu');
    }
}
