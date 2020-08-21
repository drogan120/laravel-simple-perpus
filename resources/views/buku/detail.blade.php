@extends('templates.master')
@section('title','Detail '.$buku->judul)

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('paper-admin/assets/img/header.jpg') }}" alt="{{ $buku->cover }}" class="bg-dark"
                    height="500" width="500">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5 pr-1">
                        <div class="form-group">
                            <label>Judul </label>
                            <input type="text" class="form-control" value="{{ $buku->judul }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" value="{{ $buku->pengarang }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Penerbit</label>
                            <input type="text" class="form-control" value="{{ $buku->penerbit }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pr-1">
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" class="form-control" value="{{ $buku->isbn }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 pr-1">
                        <div class="form-group">
                            <label>Jumlah Halaman</label>
                            <input type="text" class="form-control" value="{{ $buku->jumlah_halaman }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="text" class="form-control" value="{{ $buku->tahun_terbit }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label>Nomor Cetak</label>
                            <input type="text" class="form-control" value="{{ $buku->nomor_cetak }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Sinopsis</label>
                            <textarea class="form-control textarea" readonly>{{ $buku->sinopsis }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center mx-auto">
                    <a href="#" class="btn btn-round btn-success">Request Pinjam</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
