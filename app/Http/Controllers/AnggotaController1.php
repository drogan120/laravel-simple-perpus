<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaExport;
use App\Imports\AnggotaImport;
use App\Model\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
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

    public function store(Request $request)
    {
        $input  = $request->all();
        $rule   = [
            'nama'         => 'required',
            'email'        => 'required',
            'telepon'      => 'required',
            'alamat'       => 'required',

        ];
        $validation = Validator::make($input, $rule);
        if ($validation->fails()) {
            return response()->json([
                'error' => 'Kesalahan saat mengisi form!'
            ], 422);
        }
        $anggota = Anggota::updateOrCreate(['id' => $request->id], [
            'nama_lengkap'           => $request->nama,
            'email'           => $request->email,
            'telepon'           => $request->telepon,
            'alamat'           => $request->alamat,

        ]);
        return response()->json([
            'success'   => 'Data berhasil disimpan!',
            'data'      => $anggota
        ], 200);
    }

    public function show($id)
    {
        $anggota = Anggota::find($id);
        foreach ($anggota->buku as $key => $data) {

            // dd($data);
        }
        return view('anggota.profile', compact('anggota'));
    }

    public function edit($id)
    {
        $anggota = Anggota::find($id);
        return response()->json($anggota);
    }

    public function update()
    {
    }

    public function destroy($id)
    {
        $anggota =  Anggota::find($id);
        $anggota->delete();
        return response()->json([
            'success'   => 'Data berhasil hapus!',
            'data'      => $anggota
        ], 200);
    }

    function importExcel(Request $request)
    {
        Excel::import(new AnggotaImport, $request->file('data_anggota_excel'));
        return redirect('/anggota')->with('success', 'Data berhasil di import');
    }

    public function exportExcel()
    {
        return Excel::download(new AnggotaExport, 'anggota.xlsx');
    }
}
