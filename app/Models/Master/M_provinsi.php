<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_provinsi extends Model
{
    use HasFactory;
    protected $table = "m_setup_prop";
    protected $primaryKey = "id_m_setup_prop";
}
