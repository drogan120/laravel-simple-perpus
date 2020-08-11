<?php

namespace App\Exports;

use App\Model\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Buku::all();
    }

    public function headings(): array
    {
        return [
            'id_buku',
            'judul_buku',
            'pengarang',
            'penerbit',
            'isbn',
            'nomor_cetak',
            'jumlah_halaman',
            'tahun_terbit',
            'sinopsis',
            'cover',
        ];
    }
}
