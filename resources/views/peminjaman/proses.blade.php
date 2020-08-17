@extends('templates.master')
@section('title','Proses Peminjaman')
@section('content')
<h5 class="text-secondary">
    Proses Peminjaman
</h5>
<div class="row">
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="{{ asset('paper-admin/assets/img/damir-bosnjak.jpg') }}">
            </div>
            <div class="card-body">
                <div class="author">
                    <a href="#">
                        <img class="avatar border-gray" src="{{ asset('paper-admin/assets/img/mike.jpg') }}" alt="...">
                        <h5 class="title">{{ $anggota->nama_lengkap }}</h5>
                    </a>
                    <p class="description">
                        {{ $anggota->email }}
                    </p>
                </div>
                <p class="description text-center">
                    {{ $anggota->alamat }}
                </p>
            </div>
            <div class="card-footer">
                <hr>
                <div class="button-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-6 ml-auto">
                            <h5>12<br><small>Files</small></h5>
                        </div>
                        <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                            <h5>2GB<br><small>Used</small></h5>
                        </div>
                        <div class="col-lg-3 mr-auto">
                            <h5>24,6$<br><small>Spent</small></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-user">
            <div class="card-body">
                <form>
                    @csrf
                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Judul </label>
                                <input type="text" class="form-control" value="{{ $buku->judul }}">
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Pengarang</label>
                                <input type="text" class="form-control" value="{{ $buku->pengarang }}">
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Penerbit</label>
                                <input type="email" class="form-control" value="{{ $buku->penerbit }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label>ISBN</label>
                                <input type="text" class="form-control" value="{{ $buku->isbn }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Jumlah Halaman</label>
                                <input type="text" class="form-control" value="{{ $buku->jumlah_halaman }}">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Tahun Terbit</label>
                                <input type="text" class="form-control" value="{{ $buku->tahun_terbit }}">
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Nomor Cetak</label>
                                <input type="text" class="form-control" value="{{ $buku->nomor_cetak }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sinopsis</label>
                                <textarea class="form-control textarea">{{ $buku->sinopsis }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
