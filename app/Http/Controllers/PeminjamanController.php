<?php

namespace App\Http\Controllers;

use App\Exports\PeminjamanExport;
use App\Http\Requests\PeminjamanRequest;
use App\Model\Anggota;
use App\Model\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('anggota')->join('peminjaman', 'anggota.id', '=', 'peminjaman.anggota_id')->join('buku', 'buku.id', '=', 'peminjaman.buku_id')->get();


        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm edit">Ubah</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Hapus</i></a>';
                    return $btn;
                })->addColumn('sisa_waktu', function ($row) {

                    $datek = strtotime($row->tanggal_kembali);
                    $date2 = strtotime(date('Y-m-d'));
                    $selisih = $date2 - $datek;
                    $selisih = $selisih / 86400;

                    if ($selisih > 0) {
                        $sisa = '<p class="bg-danger rounded text-center"> + ' . $selisih . ' Hari </p>';
                        return $sisa;
                    } else {
                        $selisih2 = $datek - $date2;
                        $sisa = '<p class="bg-success rounded text-center">' . $selisih2 / 86400 . ' Hari</p>';
                        return $sisa;
                    }
                })->addColumn('denda', function ($row) {

                    $datek = strtotime($row->tanggal_kembali);
                    $date2 = strtotime(date('Y-m-d'));
                    $selisih = $date2 - $datek;
                    $selisih = $selisih / 86400;
                    $denda = $selisih * 10000;
                    $info = 'Rp. ' . number_format($denda);
                    if ($denda <= 0) {
                        return "Rp. 0,00 ";
                    }
                    return $info;
                })
                ->rawColumns(['aksi', 'sisa_waktu'])
                ->make(true);
        }
        return view('peminjaman.index', compact('data'));
    }

    public function create(PeminjamanRequest $request)
    {
        $buku = Buku::find($request->isbn);
        $anggota = Anggota::find($request->id_anggota);
        $tanggal_kembali = date('Y-m-d', strtotime('+' . $request->durasi . ' days', strtotime($request->tanggal_pinjam)));
        $data = [
            'anggota_id'        => $anggota->id,
            'buku_id'           => $buku->id,
            'tanggal_pinjam'    => $request->tanggal_pinjam,
            'tanggal_kembali'    => $tanggal_kembali,
        ];
        return view('peminjaman.proses', compact('buku', 'anggota'));
    }

    public function importExcel()
    {
    }
    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }
}
