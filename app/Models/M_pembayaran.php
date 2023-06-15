<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Wildside\Userstamps\Userstamps;

class M_pembayaran extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use Userstamps;

    protected $table = "m_pembayaran";
    protected $primaryKey = "id_pembayaran";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function reg()
    {
        return $this->belongsTo('App\Models\T_register', 'id_t_register');
    }
}
