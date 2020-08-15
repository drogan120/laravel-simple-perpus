<?php

namespace App\Http\Controllers;

use App\Exports\AdminExport;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = Admin::all();

        if ($request->ajax()) {
            return DataTables::of($admin)
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm edit">Ubah</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Hapus</i></a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.index', compact('admin'));
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
        $admin = Admin::updateOrCreate(['id' => $request->id], [
            'nama_lengkap'           => $request->nama,
            'email'           => $request->email,
            'telepon'           => $request->telepon,
            'alamat'           => $request->alamat,

        ]);
        return response()->json([
            'success'   => 'Data berhasil disimpan!',
            'data'      => $admin
        ], 200);
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        return response()->json($admin);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return response()->json([
            'success'   => 'Data berhasil disimpan!',
            'data'      => $admin
        ], 200);
    }

    public function importexcel()
    {
    }

    public function exportexcel()
    {
        return Excel::download(new AdminExport, 'admin.xlsx');
    }
}
