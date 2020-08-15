<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()

    {
        $admin = Admin::all();
        return view('admin.index', compact('admin'));
    }
}
