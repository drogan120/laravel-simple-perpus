@extends('templates.master')
@section('title','Buku')
@section('head')
<link rel="stylesheet" href="{{ asset('paper-admin\plugin\datatables\media\css\dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<h5 class="text-secondary">
    DAFTAR BUKU
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
                            <th>JUDUL</th>
                            <th>PENGARANG</th>
                            <th>PENERBIT</th>
                            <th>ISBN</th>
                            <th>NOMOR CETAK</th>
                            <th>JUMLAH HALAMAN</th>
                            <th>TAHUN TERBIT</th>
                            <th>SINOPSIS</th>
                            <th>COVER</th>
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
	      	ajax: '{{ route('buku.index') }}',
	      	columns: [
	      		{data: 'judul'},
	      		{data: 'pengarang'},
	      		{data: 'penerbit'},
	      		{data: 'isbn'},
	      		{data: 'nomor_cetak'},
	      		{data: 'jumlah_halaman'},
	      		{data: 'tahun_terbit'},
	      		{data: 'Sinopsis'},
	      		{data: 'Cover'},
              ],
	    });
</script>
@endsection
