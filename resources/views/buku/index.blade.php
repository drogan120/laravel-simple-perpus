@extends('templates.master')
@section('title','Buku')
@section('head')
<link rel="stylesheet" href="{{ asset('paper-admin\plugin\datatables\media\css\dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<h5 class="text-secondary">
    Daftar Buku
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
                            <th>JUDUL</th>
                            <th>PENGARANG</th>
                            <th>PENERBIT</th>
                            <th>SINOPSIS</th>
                            <th>COVER</th>
                            <th>AKSI</th>
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
                <h4 class="modal-title" id="modal-header"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary float-right" id="save">Simpan</button>
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
                <h5 class="modal-title" id="ModalImportExportTitle">Import / Export Buku</h5>
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
                                <a href="{{ route('buku.exportexcel')}}" class="btn btn-sm btn-danger">Export Excel</a>
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
	      	ajax: '{{ route('buku.index') }}',
	      	columns: [
	      		{data: 'judul'},
	      		{data: 'pengarang'},
	      		{data: 'penerbit'},
	      		{data: 'sinopsis'},
	      		{data: 'cover'},
	      		{data: 'aksi'},
              ],
	    });

    // Click Modal
    $('#create').click(function()  {
        $('#save').html('Simpan');
        $('#id').val('');
        $('#form').trigger('reset');
        $('#modal-header').html('Tambah Buku Baru');
        $('#modal').modal('show');
    });

    $('body').on('click','.edit',function () {
        let id = $(this).data('id');
        $.get('{{ route('buku.index') }}'+'/'+ id +'/edit', function(data){
            $('#modal-header').html('Ubah Buku');
            $('#save').html('Ubah');
            $('#modal').modal('show');
            $('#id').val(data.id);
            $('#nim').val(data.nim);
            $('#nama').val(data.nama);
            $('#email').val(data.email);
            $('#jenis_kelamin').val(data.jenis_kelamin);
            $('#telepon').val(data.telepon);
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tanggal_lahir').val(data.tanggal_lahir);
            $('#mata_kuliah').val(data.mata_kuliah);
            $('#alamat').val(data.alamat);

        });
    });

    $('body').on('click', '.delete', function(){
        var id = $(this).data('id');
        Swal.fire({
        title: 'Hapus data ?',
        text: "Data tidak dapat di kembalikan jika di hapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!',
        cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: '{{ url('buku') }}'+ '/' + id,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function(data) {
                        table.draw();
                        Swal.fire(
                            'Berhasil!',
                            data.success,
                            'success'
                        )
                    },
                    error: function (data) {
                        console.log('Error', data);
                    }
                });
            }
        })
    });
</script>
@if (session()->has('success'))
<script>
    Swal.fire('Berhasil!','{{session('success')}}','success');
</script>
@endif

@endsection
