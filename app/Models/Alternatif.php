<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = ['objek_id'];

    public function objek()
    {
        return $this->belongsTo(Objek::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
