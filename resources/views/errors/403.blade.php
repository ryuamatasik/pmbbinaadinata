@extends('errors.layout')

@section('title', 'Akses Ditolak')

@section('code', '403')

@section('message', 'Akses Dibatasi')

@section('description', 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan login dengan akun yang sesuai.')

@section('image')
    <div
        class="size-32 md:size-40 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center animate-float">
        <span class="material-symbols-outlined text-6xl md:text-8xl text-red-500">lock_person</span>
    </div>
@endsection