<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Http\Requests\BukuRequest;
use App\Imports\BukuImport;
use App\Model\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::all();

        if ($request->ajax()) {
            return DataTables::of($buku)->addColumn('aksi', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm">Ubah</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Hapus</a>';
                return $btn;
            })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('buku.index', compact('buku'));
    }

    public function store(BukuRequest $request)
    {
        $buku = Buku::updateOrCreate(['id' => $request->id], [
            'judul'           => $request->judul,
            'pengarang'          => $request->pengarang,
            'penerbit'          => $request->penerbit,
            'isbn'         => $request->isbn,
            'nomor_cetak' => $request->nomor_cetak,
            'jumlah_halaman'       => $request->jumlah_halaman,
            'tahun_terbit'  => $request->tahun_terbit,
            'sinopsis' => $request->sinopsis,
        ]);
        return response()->json([
            'success'   => 'Data berhasil disimpan!',
            'data'      => $buku
        ], 200);
    }

    function edit($id)
    {
        $buku =  Buku::find($id);
        return response()->json($buku);
    }

    public function show($id)
    {
        $buku =  Buku::findOrFail($id);
        return view('buku.detail', compact('buku'));
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return response()->json([
            'success'   => 'Data berhasil dihapus!'
        ], 200);
    }

    public function importExcel(Request $request)
    {

        Excel::import(new BukuImport, $request->file('data_buku_excel'));
        return redirect('/buku')->with('success', 'Buku berhasil di import');
    }

    public function exportExcel()
    {
        return Excel::download(new BukuExport, 'buku.xlsx');
    }
}
