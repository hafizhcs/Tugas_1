@extends('layouts.admin')

@section('title', 'Kelola Event - Admin')
@section('page_title', 'Kelola Event')
@section('page_subtitle', 'Buat dan atur acara seru Anda di sini.')

@section('content')

<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.events.create') }}"
        class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
        + Tambah Event Baru
    </a>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4 w-16">No</th>
                    <th class="px-8 py-4">Poster</th>
                    <th class="px-8 py-4">Event</th>
                    <th class="px-8 py-4">Tanggal & Lokasi</th>
                    <th class="px-8 py-4">Harga / Stok</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">

                @forelse($events as $index => $event)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6 font-bold text-slate-400">
                        {{ $events->firstItem() + $index }}
                    </td>
                    <td class="px-8 py-6">
                        @if($event->poster_path)
                            <img src="{{ asset('storage/' . $event->poster_path) }}"
                                alt="{{ $event->title }}"
                                class="w-16 h-20 rounded-xl object-cover shadow-sm">
                        @else
                            <div class="w-16 h-20 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-800">{{ $event->title }}</p>
                        <p class="text-xs text-slate-400 mt-1">
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded-lg font-bold">
                                {{ $event->category->name ?? 'Tanpa Kategori' }}
                            </span>
                        </p>
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-medium text-slate-700">
                            {{-- Perbaikan: Menggunakan Carbon::parse untuk menghindari error string --}}
                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                        </p>
                        <p class="text-xs text-slate-400 mt-1">{{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB</p>
                        <p class="text-xs text-slate-500 mt-1">📍 {{ $event->location }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-bold text-indigo-600">
                            {{ $event->price == 0 ? 'GRATIS' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-slate-400 mt-1">Stok: {{ $event->stock }} tiket</p>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('admin.events.edit', $event->id) }}"
                                class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition"
                                title="Edit Event">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>

                            {{-- Tombol Delete --}}
                            <form action="{{ route('admin.events.destroy', $event->id) }}"
                                method="POST"
                                onsubmit="return confirm('⚠️ Yakin ingin menghapus event \'{{ $event->title }}\'? Tindakan ini tidak bisa dibatalkan!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition"
                                    title="Hapus Event">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="px-8 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="font-bold text-lg">Belum ada event yang ditambahkan.</p>
                            <a href="{{ route('admin.events.create') }}" class="text-indigo-600 font-bold hover:underline">
                                + Tambah event pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-8 py-6 bg-slate-50/50 border-t flex justify-between items-center">
        <p class="text-sm text-slate-500 font-medium">
            Menampilkan {{ $events->firstItem() ?? 0 }}–{{ $events->lastItem() ?? 0 }}
            dari {{ $events->total() }} event
        </p>
        {{ $events->links() }}
    </div>
</div>

@endsection