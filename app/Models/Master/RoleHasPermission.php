<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;

    protected $table = "role_has_permissions";
    protected $primaryKey = "permission_id";
    protected $fillable = ['role_id', 'permission_id'];
}
