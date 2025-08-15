@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
    <h2 class="card-label"> <strong>Selamat Datang</strong>, {{ Auth::user()->name }}!
        <span class="d-block text-muted pt-2 font-size-lg">Ini adalah halaman utama</span>
    </h2>
@endsection
