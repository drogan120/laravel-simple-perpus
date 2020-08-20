<?php

namespace App\Exports;

use App\Model\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnggotaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Anggota::all();
    }

    public function headings(): array
    {
        return [
            'id_anggota',
            'nama_lengkap',
            'user_id',
            'email',
            'telepon',
            'alamat',
            'created_at',
            'updated_at',
        ];
    }
}
