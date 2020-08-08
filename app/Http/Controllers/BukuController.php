<?php

namespace App\Http\Controllers;

use App\Model\Buku;
use Illuminate\Http\Request;
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
}
