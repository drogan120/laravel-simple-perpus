<?php

namespace App\Http\Controllers;

use App\Model\Anggota;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $anggota = Anggota::all();
        if ($request->ajax()) {
            return DataTable::of($anggota)
                ->addIndexColumn()
                ->editColumn('tempat_lahir', function ($row) {
                    $tempat = '' . $row->tempat_lahir . ',';
                    $ttl = $tempat . ' ' . Carbon::parse($row->tgl_lahir)->format('d-m-Y') . '';
                    return $ttl;
                })
                ->rawColumns(['tempat_lahir'])
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm edit"><i class="fa fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>';
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
