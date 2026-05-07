@extends('layouts.app')

@section('title', 'Checkout - AmikomEventHub')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-20">
    <div class="mb-12">
        {{-- Perbaikan: Penambahan tanda kutip yang kurang dan penyesuaian nama route --}}
        <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 font-bold flex items-center gap-2 mb-6 hover:translate-x-[-4px] transition-transform">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Detail Event
        </a>
        <h1 class="text-4xl font-black tracking-tight text-slate-800">Checkout</h1>
        <p class="text-slate-500 mt-2 font-medium">Lengkapi data Anda untuk mendapatkan tiket resmi.</p>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
            <h3 class="text-xl font-bold mb-6 border-b border-slate-50 pb-4 flex items-center gap-2 text-slate-800">
                <span class="w-2 h-2 bg-indigo-600 rounded-full"></span>
                Pesanan Anda
            </h3>
            <div class="flex gap-6 items-start">
                @if($event->poster_path)
                    <img src="{{ asset('storage/' . $event->poster_path) }}" alt="{{ $event->title }}" class="w-24 h-32 rounded-2xl object-cover shadow-md">
                @else
                    <div class="w-24 h-32 rounded-2xl bg-indigo-50 flex items-center justify-center text-4xl">🎪</div>
                @endif
                
                <div class="flex-1">
                    <h4 class="font-black text-xl text-slate-800 leading-tight mb-1">{{ $event->title }}</h4>
                    <p class="text-slate-500 font-bold text-sm">
                        {{ \Carbon\Carbon::parse($event->date)->translatedFormat('d M Y') }} • {{ $event->location }}
                    </p>
                    <div class="mt-4 inline-block px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-black">
                        1 x {{ $event->price == 0 ? 'GRATIS' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            @php
                $service_fee = 5000;
                $total_bayar = $event->price + $service_fee;
            @endphp

            <div class="mt-8 pt-6 border-t border-dashed border-slate-200 space-y-3">
                <div class="flex justify-between text-slate-500 font-bold">
                    <span>Harga Tiket</span>
                    <span class="text-slate-800">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-slate-500 font-bold text-sm">
                    <span>Biaya Layanan (Platform)</span>
                    <span class="text-slate-800">Rp {{ number_format($service_fee, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-3xl font-black mt-4 pt-6 border-t border-slate-100 text-slate-800">
                    <span>Total Bayar</span>
                    <span class="text-indigo-600">Rp {{ number_format($total_bayar, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('ticket') }}" method="GET" class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
            <h3 class="text-xl font-black mb-8 flex items-center gap-3 text-slate-800">
                <span class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </span>
                Data Pemesan
            </h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-black text-slate-400 mb-2 uppercase tracking-[0.1em]">Nama Lengkap Sesuai Identitas</label>
                    <input type="text" name="name" required placeholder="Contoh: Hafizh Academic"
                        class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-600 outline-none transition font-bold text-slate-800">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-slate-400 mb-2 uppercase tracking-[0.1em]">Email Aktif</label>
                        <input type="email" name="email" required placeholder="hafizh@example.com"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-600 outline-none transition font-bold text-slate-800">
                        <p class="text-[10px] text-indigo-500 mt-3 font-black uppercase">* E-Ticket dikirim ke email ini</p>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 mb-2 uppercase tracking-[0.1em]">Nomor WhatsApp</label>
                        <input type="tel" name="phone" required placeholder="081234567xxx"
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-600 outline-none transition font-bold text-slate-800">
                    </div>
                </div>

                <button type="submit"
                    class="block w-full py-5 bg-indigo-600 text-white rounded-2xl font-black text-xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transform hover:-translate-y-1 active:scale-95 transition-all text-center">
                    Bayar & Konfirmasi
                </button>
                
                <div class="flex items-center justify-center gap-2 text-slate-400">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                    <p class="text-xs font-bold">Pembayaran Aman & Terenkripsi</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection