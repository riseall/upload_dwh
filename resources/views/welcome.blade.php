@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
    <h2 class="card-label"> Selamat Datang, <strong> {{ Auth::user()->name }}!</strong>
        <span class="d-block text-muted pt-2 font-size-lg">Ini adalah halaman utama</span>
    </h2>
@endsection
