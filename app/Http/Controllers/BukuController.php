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
            return DataTables::of($buku)->make(true);
        }

        return view('buku.index', compact('buku'));
    }

    public function exportexcel()
    {
        return Excel::download(new BukuExport, 'buku.xlsx');
    }
}
