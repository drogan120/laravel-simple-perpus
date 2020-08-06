@extends('templates.master')
@section('title','Anggota')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-secondary">
            DAFTAR ANGGOTA
        </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
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
<script>
    let table = $('#datatable').DataTable({
	      	serverSide: true,
	      	processing: true,
	      	ajax: '{{ route('dosen.index') }}',
	      	columns: [
	      		{data: 'nim'},
	      		{data: 'nama'},
	      		{data: 'email'},
	      		{data: 'telepon'},
	      		{data: 'tempat_lahir'},
	      		{data: 'alamat'},

	      		{data: 'aksi'},
              ],
	    });
</script>
@endsection
