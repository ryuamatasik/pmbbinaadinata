@php
    $title = 'Detail Pengumuman';
@endphp

@extends('layouts.student')

@section('content')
    <div class="flex flex-col max-w-[1280px] mx-auto px-6 lg:px-12 py-8 gap-8">
        <div class="flex items-center gap-4 animate-fade-in-up">
            <a href="{{ route('mahasiswa.dashboard') }}"
                class="p-2 rounded-full bg-white dark:bg-surface-dark border border-gray-100 dark:border-gray-800 text-gray-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <p class="text-sm font-medium text-primary uppercase tracking-wide">Pengumuman</p>
                <h1 class="text-2xl md:text-3xl font-black tracking-tight text-[#111318] dark:text-white">
                    {{ $pengumuman->judul }}</h1>
            </div>
        </div>

        <div
            class="bg-white dark:bg-surface-dark rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6 md:p-8 animate-fade-in-up delay-100">
            <div class="flex items-center gap-2 mb-6 text-sm text-gray-500">
                <span class="material-symbols-outlined text-sm">calendar_month</span>
                <span>Dipublikasikan pada {{ $pengumuman->created_at->translatedFormat('d F Y') }}</span>
            </div>

            <div class="prose prose-slate dark:prose-invert max-w-none">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-800">
                <p class="text-sm text-gray-500 italic">
                    Hormat kami,<br>
                    <strong>Panitia PMB Bina Adinata</strong>
                </p>
            </div>
        </div>
    </div>
@endsection