@extends('templates.master')
@section('title','Buku')
@section('head')
<link rel="stylesheet" href="{{ asset('paper-admin\plugin\datatables\media\css\dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('paper-admin\plugin\sweetalert2-theme-bootstrap-4\bootstrap-4.min.css') }}">
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
                                    <form enctype="multipart/form-data" action="{{ route('buku.importexcel')}}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group btn btn-danger">
                                            <label for="importexcel">Import Excel</label>
                                            <input type="file" class="form-control" name="data_buku_excel">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('foot')
<script src="{{ asset('paper-admin\plugin\datatables\media\js\jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('paper-admin\plugin\datatables\media\js\dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('paper-admin\plugin\sweetalert2\sweetalert2.min.js') }}"></script>
<script src="{{ asset('paper-admin\plugin\toastr\toastr.min.js') }}"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

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

 // Fungsi Save
 $('#save').click(function(e){
        e.preventDefault();
        $(this).html('Menyimpan...');
        $.ajax({
            data: $('#form').serialize(),
            url: '{{ route('buku.store') }}',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                $('#save').html('Simpan');
                $('#form').trigger('reset');
                $('#modal').modal('hide');
                table.draw();
                Toast.fire({
                    icon: 'success',
                    title: data.success
                })
            },
            error: function(data){
                console.log('Error', data);
            }
        })
    });


    $('body').on('click','.edit',function () {
        let id = $(this).data('id');
        $.get('{{ route('buku.index') }}'+'/'+ id +'/edit', function(data){
            $('#modal-header').html('Ubah Buku');
            $('#save').html('Ubah');
            $('#modal').modal('show');
            $('#id').val(data.id);
            $('#judul').val(data.judul);
            $('#pengarang').val(data.pengarang);
            $('#penerbit').val(data.penerbit);
            $('#isbn').val(data.isbn);
            $('#nomor_cetak').val(data.nomor_cetak);
            $('#jumlah_halaman').val(data.jumlah_halaman);
            $('#tahun_terbit').val(data.tahun_terbit);
            $('#sinopsis').html(data.sinopsis);

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
        confirmButtonText: 'Hapus !',
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
                        Toast.fire(
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
