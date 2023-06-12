<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class MenuRole extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "menu_role";
    protected $primaryKey = "id_menu_role";
    protected $fillable = ['role_id', 'menu_id', 'created_by', 'updated_by', 'deleted_by', 'created_at','updated_at','deleted_at'];

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
