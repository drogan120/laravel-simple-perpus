<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = "anggota";
    protected $fillable = ['nama_lengkap', 'email', 'telepon', 'alamat'];
}
