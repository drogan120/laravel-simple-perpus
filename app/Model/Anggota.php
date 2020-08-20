<?php

namespace App\Model;

use App\Model\Buku;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = "anggota";
    protected $fillable = ['nama_lengkap', 'user_id', 'email', 'telepon', 'alamat'];


    public function buku()
    {
        return $this->belongsToMany(Buku::class)->withPivot('tanggal_pinjam', 'tanggal_kembali');
    }
}
