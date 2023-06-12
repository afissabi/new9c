<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "roles";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'name', 'created_at','updated_at','deleted_at'];

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
