<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankPencarian extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "bank_pencarian";
    protected $primaryKey = "id_bank_cari";

    protected $dates = ["deleted_at"];
    public $timestamps = true;
}
