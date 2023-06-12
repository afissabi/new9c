<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_artikel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "m_artikel";
    protected $primaryKey = "id_artikel";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
