<?php

namespace App\Http\Controllers;

use App\Exports\AdminExport;
use App\Http\Requests\AdminRequest;
use App\Imports\AdminImport;
use App\Model\Admin;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(AdminRequest $request)
    {
        $admin = Admin::all();

        if ($request->ajax()) {
            return DataTables::of($admin)
                ->addColumn('nama', function ($row) {
                    $nama = '<a href="' . url('admin') . '/' . $row->id . '">' . $row->nama_lengkap . '</a>';
                    return $nama;
                })
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning btn-sm edit">Ubah</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm delete">Hapus</i></a>';
                    return $btn;
                })
                ->rawColumns(['aksi', 'nama'])
                ->make(true);
        }
        return view('admin.index', compact('admin'));
    }

    public function store(AdminRequest $request)
    {
        $input  = $request->all();
        $user = new \App\User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('password');
        $user->role = "admin";
        $user->remember_token = \Str::random(60);
        $user->save();

        $admin = Admin::updateOrCreate(['id' => $request->id], [
            'user_id'         => $user->id,
            'nama_lengkap'    => $request->nama,
            'email'           => $request->email,
            'telepon'         => $request->telepon,
            'alamat'          => $request->alamat,

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

    public function show($id)
    {
        $profile = Admin::findOrFail($id);
        return view('admin.profile', compact('profile'));
    }
    public function importExcel(AdminRequest $request)
    {
        Excel::import(new AdminImport, $request->file('import_admin_excel'));
        return redirect('/admin')->with('success', 'data berhasil di import');
    }

    public function exportExcel()
    {
        return Excel::download(new AdminExport, 'admin.xlsx');
    }
}
