<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Buku;

class BukuController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        return  response()->json(
            [
                'buku' => $buku,
                'response' => 200
            ]
        );
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return  response()->json(
            [
                'buku' => $buku,
                'response' => 200
            ]
        );
    }
}
