<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $data = DB::table('anggota')->join('peminjaman', 'anggota.id', '=', 'peminjaman.anggota_id')->join('buku', 'buku.id', '=', 'peminjaman.buku_id')->get();
        dd($data);
    }

    public function headings(): array
    {
        return [
            'nama',
            'email',
            'telepon',
            'alamat',
            'judul_buku',
            'pengarang',
            'penerbit',
            'isbn',
            'nomor_cetak',
            'jumlah_halaman',
            'tahun_terbit',
            'tanggal_pinjam',
            'tanggal_kembali',
        ];
    }
}
