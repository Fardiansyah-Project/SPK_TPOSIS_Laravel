<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = ['kode', 'nama', 'bobot', 'atribut', 'keterangan'];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
