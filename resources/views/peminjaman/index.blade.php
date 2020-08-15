@extends('templates.master')
@section('title','Peminjaman')
@section('head')
<link rel="stylesheet" href="{{ asset('paper-admin\plugin\datatables\media\css\dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<h5 class="text-secondary">
    Daftar Peminjaman
</h5>
<div class="card">
    <div class="card-header">
        <div class="d-inline">
            <div class="float-right">
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                    data-target="#ModalImportExport">
                    Import / Export
                </button>
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
                            <th>Sisa Waktu</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import-Export-->
<div class="modal fade" id="ModalImportExport" tabindex="-1" role="dialog" aria-labelledby="ModalImportExportTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalImportExportTitle">Import / Export peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-secondary">
                                    Export
                                </h4>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('peminjaman.exportexcel')}}" class="btn btn-sm btn-danger">Export
                                    Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-secondary">
                                    Import
                                </h4>
                                <div class="card-body">
                                    <form enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="importexcel">Import Excel</label>
                                            <input type="text" class="form-control" name="importexcel">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-info">Import</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary">Save changes</button>
                </div>
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
	      		{data: 'sisa_waktu'},
	      		{data: 'denda'},
	      		{data: 'aksi'},
              ],
	    });
</script>
@endsection
