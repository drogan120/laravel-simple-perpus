<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Model\Buku;
use Illuminate\Http\Request;
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

    public function exportexcel()
    {
        return Excel::download(new BukuExport, 'buku.xlsx');
    }

    function edit($id)
    {
        $buku =  Buku::find($id);
        return response()->json($buku);
    }

    public function destroy($id)
    {
        $dosen = Buku::find($id);
        $dosen->delete();
        return response()->json([
            'success'   => 'Data berhasil dihapus!'
        ], 200);
    }
}
