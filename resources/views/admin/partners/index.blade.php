@extends('layouts.admin')

@section('title', 'Kelola Partner')
@section('page_title', 'Kelola Partner')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="mb-4">
    <form action="{{ route('admin.partners.index') }}" method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari partner..."
               class="px-4 py-2 border rounded-lg w-64 focus:ring focus:ring-indigo-300">
        <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Search
        </button>
    </form>
</div>

    <a href="{{ route('admin.partners.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg">+ Tambah Partner</a>
</div>


<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 text-slate-400 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Logo</th>
                <th class="px-6 py-3">Kategori</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partners as $partner)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-3">{{ $partner->id }}</td>
                <td class="px-6 py-3">{{ $partner->name }}</td>
                <td class="px-6 py-3">
                    @if($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="h-12">
                    @else
                        <span class="text-slate-400">Tidak ada logo</span>
                    @endif
                </td>
                <td class="px-6 py-3">{{ $partner->category->name ?? '-' }}</td>
                <td class="px-6 py-3 flex gap-2">
                    <a href="{{ route('admin.partners.edit', $partner->id) }}"
                       class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded">Edit</a>
                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus partner ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-600 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-6 text-center text-slate-400">Belum ada partner.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $partners->links() }}
</div>
@endsection
