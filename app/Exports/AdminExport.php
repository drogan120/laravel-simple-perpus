<?php

namespace App\Exports;

use App\Model\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return  Admin::all();
    }
    public function headings(): array
    {
        return [
            'id_admin',
            'nama_lengkap',
            'email',
            'telepon',
            'alamat',
            'created_at',
            'updated_at',
        ];
    }
}
