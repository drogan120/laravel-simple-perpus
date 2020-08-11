<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                })
                ->rawColumns(['aksi', ''])
                ->make(true);
        }
        return view('peminjaman.index', compact('data'));
    }
}
