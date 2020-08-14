@extends('templates.master')
@section('title','Anggota')
@section('head')
<link rel="stylesheet" href="{{ asset('paper-admin\plugin\datatables\media\css\dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<h5 class="text-secondary">
    Daftar Anggota
</h5>
<div class="card">
    <div class="card-header">
        <div class="d-inline">
            <div class="float-right">
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                    data-target="#ModalImportExport">
                    Import / Export
                </button>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="create"></i> Tambah</a>
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

{{-- Modal Buku --}}
<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-header"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" name="form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" name="judul" id="judul">
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" name="pengarang" class="form-control" id="pengarang">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control" id="penerbit">
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" id="isbn">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_cetak">No. Cetak</label>
                                <input type="text" name="nomor_cetak" class="form-control" id="nomor_cetak">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah_halaman">Jumlah Halaman</label>
                                <input type="number" name="jumlah_halaman" class="form-control" id="jumlah_halaman">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input type="year" name="tahun_terbit" class="form-control" id="tahun_terbit">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sinopsis">Sinopsis</label>
                        <textarea name="sinopsis" id="sinopsis" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" name="cover" id="cover" class="form-control btn btn-info">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                <button type="submit" class="btn btn-sm btn-primary float-right" id="save">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Import-Export-->
<div class="modal fade" id="ModalImportExport" tabindex="-1" role="dialog" aria-labelledby="ModalImportExportTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalImportExportTitle">Import / Export Anggota</h5>
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
                                <a href="{{ route('anggota.exportexcel')}}" class="btn btn-sm btn-danger">Export
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
	      	ajax: '{{ route('anggota.index') }}',
	      	columns: [
	      		{data: 'nama_lengkap'},
	      		{data: 'email'},
	      		{data: 'telepon'},
	      		{data: 'aksi'},
              ],
	    });
</script>
@endsection
