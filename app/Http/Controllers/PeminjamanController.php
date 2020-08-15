<?php

namespace App\Http\Controllers;

use App\Exports\PeminjamanExport;
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
                    return $info;
                })
                ->rawColumns(['aksi', 'sisa_waktu'])
                ->make(true);
        }
        return view('peminjaman.index', compact('data'));
    }



    public function importexcel()
    {
    }
    public function exportexcel()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }
}
