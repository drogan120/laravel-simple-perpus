<?php

namespace App\Imports;

use App\Model\Anggota;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnggotaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $data) {
            if ($key >= 1) {
                $anggota = [
                    'nama_lengkap' => $data[1],
                    'email' => $data[2],
                    'telepon' => $data[3],
                    'alamat' => $data[4],
                ];
                Anggota::create($anggota);
            }
        }
    }
}
