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
                    'user_id' => $data[2],
                    'email' => $data[3],
                    'telepon' => $data[4],
                    'alamat' => $data[5],
                ];
                Anggota::create($anggota);
            }
        }
    }
}
