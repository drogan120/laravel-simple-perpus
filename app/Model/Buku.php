<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "buku";
    protected $guarded = [];

    public function anggota()
    {

        return $this->belongsToMany(Anggota::class)->withPivot('judul');
    }
}
