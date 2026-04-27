<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $fillable = ['kode', 'nama', 'nilai', 'kriteria_id'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
