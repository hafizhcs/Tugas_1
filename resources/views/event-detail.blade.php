@extends('layouts.app')

@section('title', $event->title . ' - AmikomEventHub')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">

    <div class="lg:col-span-1">
        <div class="sticky top-32">
            @if($event->poster_path)
                <img src="{{ asset('storage/' . $event->poster_path) }}" 
                    alt="{{ $event->title }}" 
                    class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white object-cover aspect-[3/4]">
            @else
                <div class="w-full aspect-[3/4] rounded-[2.5rem] bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center shadow-2xl border-8 border-white text-8xl">
                    🎪
                </div>
            @endif

            {{-- Penyelenggara --}}
            <div class="mt-8 p-6 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                <h4 class="font-bold text-slate-400 text-xs uppercase tracking-widest mb-4">Penyelenggara</h4>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black shadow-lg shadow-indigo-100">
                        AE
                    </div>
                    <div>
                        <p class="font-bold text-slate-800">AmikomEventHub</p>
                        <div class="flex items-center gap-1 text-indigo-600">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"></path></svg>
                            <p class="text-[10px] font-black uppercase">Verified Organizer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-10">
        <div class="space-y-4">
            <span class="inline-block px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-xs font-black uppercase tracking-[0.2em]">
                {{ $event->category->name ?? 'Event' }}
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-slate-800 leading-tight tracking-tight">
                {{ $event->title }}
            </h1>
            
            <div class="flex flex-wrap gap-y-4 gap-x-8 text-slate-500 font-bold text-sm">
                <div class="flex items-center gap-2.5">
                    <div class="p-2 bg-slate-50 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span>{{ \Carbon\Carbon::parse($event->date)->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="p-2 bg-slate-50 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="p-2 bg-slate-50 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <span>{{ $event->location }}</span>
                </div>
            </div>
        </div>

        <hr class="border-slate-100">

        {{-- Deskripsi --}}
        <div>
            <h3 class="text-2xl font-black text-slate-800 mb-4 flex items-center gap-3">
                <span class="w-1.5 h-8 bg-indigo-600 rounded-full"></span>
                Tentang Event
            </h3>
            <div class="prose prose-indigo max-w-none text-slate-600 leading-relaxed font-medium">
                {{ $event->description }}
            </div>
        </div>

        {{-- Tiket Box --}}
        <div class="bg-indigo-600 rounded-[3rem] p-8 md:p-12 text-white shadow-2xl shadow-indigo-200 relative overflow-hidden group">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <p class="text-indigo-200 font-black uppercase tracking-[0.2em] text-xs mb-3">Harga Tiket Mulai Dari</p>
                    @if($event->price == 0)
                        <h2 class="text-6xl font-black tracking-tighter">GRATIS</h2>
                    @else
                        <div class="flex items-baseline gap-2">
                            <span class="text-2xl font-bold text-indigo-200">Rp</span>
                            <h2 class="text-6xl font-black tracking-tighter">
                                {{ number_format($event->price, 0, ',', '.') }}
                            </h2>
                        </div>
                    @endif
                    
                    <div class="mt-6 inline-flex items-center gap-2 px-4 py-2 bg-indigo-700/50 rounded-xl border border-indigo-500/30">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <p class="text-indigo-100 text-sm font-bold">
                            Sisa stok: <span class="text-white underline">{{ $event->stock }} Tiket</span>
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-auto">
                    @if($event->stock > 0)
                        {{-- Perbaikan: Tanda kutip diperbaiki dari "{{ route('checkout, $event->id') }}" --}}
                        <a href="{{ route('checkout', $event->id) }}" 
                            class="block text-center px-10 py-6 bg-white text-indigo-600 rounded-2xl font-black text-xl hover:bg-slate-50 transform hover:-translate-y-1 transition-all shadow-xl active:scale-95">
                            Pesan Sekarang
                        </a>
                    @else
                        <button disabled class="w-full px-10 py-6 bg-indigo-500 text-indigo-200 rounded-2xl font-black text-xl cursor-not-allowed opacity-50">
                            Tiket Habis
                        </button>
                    @endif
                </div>
            </div>
            
            {{-- Ornamen Dekoratif --}}
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-indigo-400/20 rounded-full blur-3xl"></div>
        </div>

        {{-- Kebijakan --}}
        <div class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100">
            <h3 class="text-lg font-black text-slate-800 mb-6 uppercase tracking-wider">Kebijakan Tiket</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <p class="text-sm font-bold text-slate-600 leading-tight">E-Ticket dikirim otomatis setelah bayar.</p>
                </div>
                <div class="flex items-start gap-3 p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-sm font-bold text-slate-600 leading-tight">Scan tiket di lokasi (Self Check-in).</p>
                </div>
                <div class="flex items-start gap-3 p-4 bg-rose-50 rounded-2xl border border-rose-100 md:col-span-2">
                    <div class="w-8 h-8 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-sm font-black text-rose-600 leading-tight">Penting: Tiket yang sudah dibeli TIDAK DAPAT dikembalikan (Non-refundable).</p>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection