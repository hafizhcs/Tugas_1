@extends('layouts.app')

@section('title', 'AmikomEventHub - Temukan Event Seru!')

@section('content')

<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1 Event Platform AMIKOM</span>
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
        </h1>
        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat.
        </p>
        <div class="flex gap-4">
            <a href="#events" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                Mulai Jelajah
            </a>
            <a href="{{ route('bantuan') }}" class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                Cara Pesan
            </a>
        </div>
    </div>
    <div class="flex-1 relative">
        <div class="bg-gradient-to-br from-indigo-100 to-purple-100 rounded-[2rem] aspect-[4/5] flex items-center justify-center shadow-2xl">
            <div class="text-center p-8">
                <div class="text-8xl mb-4">🎟️</div>
                <p class="text-2xl font-black text-indigo-700">{{ $events->count() }}+ Event</p>
                <p class="text-slate-500 font-medium">Menunggu kamu!</p>
            </div>
        </div>
    </div>
</section>

<!-- Events Section -->
<section id="events" class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
            <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru!</p>
        </div>
    </div>

    {{-- ===== FILTER KATEGORI (Pertemuan 6) ===== --}}
    <div class="flex flex-wrap gap-3 mb-10">
        {{-- Tombol "Semua Kategori" --}}
        <a href="{{ route('home') }}"
            class="px-5 py-2.5 rounded-xl font-bold transition border-2
            {{ $activeCategory == '' ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-400 hover:text-indigo-600' }}">
            Semua Kategori
        </a>

        {{-- Tombol per Kategori (dinamis dari database) --}}
        @foreach($categories as $cat)
        <a href="{{ route('home', ['category' => $cat->slug]) }}"
            class="px-5 py-2.5 rounded-xl font-bold transition border-2
            {{ $activeCategory == $cat->slug ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-400 hover:text-indigo-600' }}">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    {{-- ===== GRID EVENT CARDS ===== --}}
    @if($events->isEmpty())
    <div class="text-center py-20">
        <div class="text-6xl mb-4">😕</div>
        <h3 class="text-2xl font-bold text-slate-700 mb-2">Tidak ada event ditemukan</h3>
        <p class="text-slate-500 mb-6">Coba pilih kategori lain atau lihat semua event.</p>
        <a href="{{ route('home') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">
            Lihat Semua Event
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($events as $event)
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
            {{-- Poster --}}
            <div class="relative overflow-hidden aspect-[3/4]">
                @if($event->poster_path)
                    <img src="{{ asset('storage/' . $event->poster_path) }}"
                        alt="{{ $event->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                        <span class="text-6xl">🎪</span>
                    </div>
                @endif

                {{-- Badge Kategori --}}
                <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                    {{ $event->category->name ?? 'Event' }}
                </div>

                {{-- Badge Gratis --}}
                @if($event->price == 0)
                <div class="absolute top-4 right-4 px-3 py-1 bg-green-500 text-white rounded-lg text-xs font-bold uppercase">
                    GRATIS
                </div>
                @endif
            </div>

            {{-- Konten Card --}}
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition leading-tight">
                    {{ $event->title }}
                </h3>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-1">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }} WIB</span>
                </div>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $event->location }}</span>
                </div>
                <div class="flex justify-between items-center pt-4 border-t">
                    <div>
                        <span class="text-2xl font-black text-indigo-600">
                            {{ $event->price == 0 ? 'GRATIS' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                        </span>
                        <p class="text-xs text-slate-400">{{ $event->stock }} tiket tersisa</p>
                    </div>
                    <a href="{{ route('events.show', $event->id) }}"
                        class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</section>

@endsection