@extends('templates.master')
@section('title','admin')
@section('content')
@foreach (admin as $item)
<ul>
    <li>{{ $item->iteration }}</li>
</ul>
@endforeach
@endsection
