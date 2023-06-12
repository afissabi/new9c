<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Konten_section extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = "konten_section";
    protected $primaryKey = "id_konten_section";

    protected $dates = ["deleted_at"];
    public $timestamps = true;

    public function sect()
    {
        return $this->belongsTo('App\Models\Website\M_section', 'id_section');
    }
}
