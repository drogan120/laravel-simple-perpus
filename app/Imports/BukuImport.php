<?php

namespace App\Imports;

use App\Model\Buku;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BukuImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $data) {
            if ($key >= 1) {
                $buku = [
                    'judul' => $data[1],
                    'pengarang' => $data[2],
                    'penerbit' => $data[3],
                    'isbn' => $data[4],
                    'nomor_cetak' => $data[5],
                    'jumlah_halaman' => $data[6],
                    'tahun_terbit' => $data[7],
                    'sinopsis' => $data[8],
                    'cover' => $data[9],
                ];
                Buku::create($buku);
            }
        }
    }
}
