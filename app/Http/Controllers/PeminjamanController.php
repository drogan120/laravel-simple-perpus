<?php

namespace App\Http\Controllers;

use App\AnggotaBuku;
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
    public function index(PeminjamanRequest $request)
    {
        $data = DB::table('anggota_buku')->join('buku', 'buku.id', '=', 'anggota_buku.buku_id')->join('anggota', 'anggota.id', '=', 'anggota_buku.anggota_id')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="' . url('anggota') . '/' . $row->anggota_id . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm edit">PROFILE</a>';
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
        return view('peminjaman.proses', compact('buku', 'anggota'));
    }

    public function store(PeminjamanRequest $peminjamanRequest)
    {

        $tanggal_kembali = date('Y-m-d', strtotime('+' . $peminjamanRequest->durasi . ' days', strtotime($peminjamanRequest->tanggal_pinjam)));
        $data = [
            'anggota_id'        => $peminjamanRequest->anggota_id,
            'buku_id'           => $peminjamanRequest->buku_id,
            'tanggal_pinjam'    => $peminjamanRequest->tanggal_pinjam,
            'tanggal_kembali'    => $tanggal_kembali,
        ];

        AnggotaBuku::create($data);
        return redirect('/peminjaman')->with('success', 'Data berhasil di tambahkan');
    }
    public function importExcel()
    {
    }
    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }
}
