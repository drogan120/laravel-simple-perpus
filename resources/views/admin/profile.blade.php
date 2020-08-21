@extends('templates.master')
@section('title','Profile '.$profile->nama_lengkap)
@section('content')
<h5 class="text-secondary">
    Information
</h5>
<div class="row">
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="{{ asset('paper-admin/assets/img/damir-bosnjak.jpg') }}">
            </div>
            <div class="card-body">
                <div class="author">
                    <a href="{{ url('anggota/'.$profile->id) }}">
                        <img class="avatar border-gray" src="{{ asset('paper-admin/assets/img/mike.jpg') }}" alt="...">
                        <h5 class="title">{{ $profile->nama_lengkap }}</h5>
                    </a>
                    <p class="description">
                        {{ $profile->email }}
                    </p>
                </div>
                <p class="description text-center">
                    {{ $profile->alamat }}
                </p>
            </div>
            <div class="card-footer">
                <hr>
                <div class="button-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 ml-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-user">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection
