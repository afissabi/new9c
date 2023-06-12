<?php

namespace App\Models\Umum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Umum extends Model
{
    use HasFactory;

    public function scopeSlider($query)
    {
        return \DB::select("
            SELECT
                part,
                konten,
                gambar,
                path
            FROM
                m_section ms
                JOIN konten_section ks ON ks.id_section = ms.id_section
            WHERE
                ms.deleted_at IS NULL
                AND ks.deleted_at IS NULL
                AND name_section = 'slider'
                AND part != 1
            ORDER BY part
        ");
    }
}
