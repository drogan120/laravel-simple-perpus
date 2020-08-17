@extends('templates.master')
@section('title','Profile')
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
                        <div class="col-lg-12 col-md-12 col-12 ml-auto">
                            <h5>Jumlah Pinjaman<br>{{ $anggota->buku->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-user">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota->buku as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->pengarang }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ $buku->tanggal_pinjam }}</td>
                            <td>{{ $buku->tanggal_kembali }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
