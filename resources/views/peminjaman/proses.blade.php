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
                    <a href="{{ url('anggota/'.$anggota->id) }}">
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
                <form method="POST" action="{{ route('peminjaman.store') }}">
                    @csrf
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
                    <div class="row" class="d-inline">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_pinjam">Tangggal Pinjam</label>
                                <input type="date" name="tanggal_pinjam" class="form-control"
                                    value="{{ date('Y-m-d') }}" readonly>
                                <input type="hidden" name="anggota_id" value="{{$anggota->id}}">
                                <input type="hidden" name="buku_id" value="{{$buku->id}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="durasi">Durasi Peminjaman</label>
                                <select name="durasi" id="durasi" class="form-control">
                                    <option value="1">1 Hari</option>
                                    <option value="2">2 Hari</option>
                                    <option value="3">3 Hari</option>
                                    <option value="4">4 Hari</option>
                                    <option value="5">5 Hari</option>
                                    <option value="6">6 Hari</option>
                                    <option value="7">7 Hari</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            @if (!$anggota->buku->count() >= 1)
                            <button type="submit" class="btn btn-primary btn-round">Approve</button>
                            @else
                            <a href="{{ url('anggota/'.$anggota->id) }}" class="btn btn-danger btn-round">Anggota Belum
                                Mengembalikan Buku</a>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
