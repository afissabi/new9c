<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class M_user extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "users";
    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function hasRole()
    {
        return $this->belongsTo('App\Models\ModelHasRoles', 'id');
    }
}
