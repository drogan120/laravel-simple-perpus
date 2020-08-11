@extends('templates.master')
@section('title','Peminjaman')
@section('head')
<link rel="stylesheet" href="{{ asset('paper-admin\plugin\datatables\media\css\dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<h5 class="text-secondary">
    DAFTAR Pinjaman
</h5>
<div class="card">
    <div class="card-header">
        <div class="d-inline">
            <div class="float-right">
                <a href="#" class="btn btn-sm btn-warning">IMPORT</a>
                <a href="#" class="btn btn-sm btn-danger">EXPORT</a>
                <a href="#" class="btn btn-sm btn-primary">TAMBAH</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Judul Buku</th>
                            <th>TELEPON</th>
                            <th>Email</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Sisa Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('foot')
<script src="{{ asset('paper-admin\plugin\datatables\media\js\jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('paper-admin\plugin\datatables\media\js\dataTables.bootstrap4.min.js') }}"></script>
<script>
    let table = $('#datatable').DataTable({
	      	serverSide: true,
	      	processing: true,
	      	ajax: '{{ route('peminjaman.index') }}',
	      	columns: [
	      		{data: 'nama_lengkap'},
	      		{data: 'judul'},
	      		{data: 'telepon'},
	      		{data: 'email'},
	      		{data: 'tanggal_pinjam'},
	      		{data: 'tanggal_kembali'},
	      		{data: 'sisa_waktu'},
	      		{data: 'aksi'},
              ],
	    });
</script>
@endsection
