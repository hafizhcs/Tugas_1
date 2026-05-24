@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-slate-700">Nama Kategori</label>
            <input type="text" name="name" id="name" class="mt-1 px-4 py-2 border rounded-lg w-full"
                   value="{{ old('name', $category->name) }}" required>
        </div>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg">Update</button>
        <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 bg-slate-200 rounded-lg">Batal</a>
    </form>
</div>
@endsection
