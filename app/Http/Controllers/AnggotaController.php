<?php

namespace App\Http\Controllers;

use App\Model\Anggota;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $anggota = Anggota::all();
        if ($request->ajax()) {
            return DataTables::of($anggota)
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm edit">Ubah</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Hapus</i></a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
