<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_menu extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "m_menu";
    protected $primaryKey = "id_menu";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function menu()
    {
        return $this->belongsTo('App\Models\Master\M_menu', 'parent_id');
    }
}
