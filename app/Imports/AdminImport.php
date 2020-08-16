<?php

namespace App\Imports;

use App\Model\Admin;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AdminImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $data) {
            if ($key >= 1) {
                $admin = [
                    'nama_lengkap' => $data[1],
                    'email' => $data[2],
                    'telepon' => $data[3],
                    'alamat' => $data[4],
                ];
                Admin::create($admin);
            }
        }
    }
}
