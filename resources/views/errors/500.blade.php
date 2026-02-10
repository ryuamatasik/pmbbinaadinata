@extends('errors.layout')

@section('title', 'Terjadi Kesalahan')

@section('code', '500')

@section('message', 'Gangguan Server')

@section('description', 'Maaf, terjadi kesalahan internal pada server kami. Tim teknis kami sedang berusaha memperbaikinya.')

@section('image')
    <div
        class="size-32 md:size-40 bg-yellow-50 dark:bg-yellow-900/20 rounded-full flex items-center justify-center animate-float">
        <span class="material-symbols-outlined text-6xl md:text-8xl text-yellow-500">cloud_off</span>
    </div>
@endsection