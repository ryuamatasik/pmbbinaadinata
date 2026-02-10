@extends('errors.layout')

@section('title', 'Halaman Tidak Ditemukan')

@section('code', '404')

@section('message', 'Oops! Halaman Hilang')

@section('description', 'Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau link yang Anda tuju salah.')

@section('image')
    <div
        class="size-32 md:size-40 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center animate-float">
        <span class="material-symbols-outlined text-6xl md:text-8xl text-primary">explore_off</span>
    </div>
@endsection