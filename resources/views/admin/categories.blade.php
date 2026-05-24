@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page_title', 'Kelola Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold">Daftar Kategori</h2>
    <a href="{{ route('admin.categories.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg">+ Tambah Kategori</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 text-slate-400 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Dibuat</th>
                <th class="px-6 py-3">Diupdate</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-3">{{ $category->id }}</td>
                <td class="px-6 py-3">{{ $category->name }}</td>
                <td class="px-6 py-3">{{ $category->created_at->format('d M Y H:i') }}</td>
                <td class="px-6 py-3">{{ $category->updated_at->format('d M Y H:i') }}</td>
                <td class="px-6 py-3 flex gap-2">
                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                       class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus kategori ini?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-rose-50 text-rose-600 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-6 text-center text-slate-400">Belum ada kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection
