<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objek extends Model
{
    protected $fillable = ['nama'];

    public function alternatifs()
    {
        return $this->hasMany(Alternatif::class);
    }
}
