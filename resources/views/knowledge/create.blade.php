@extends('layouts.app') 
{{-- Ganti 'layouts.app' dengan nama layout utama Anda --}}

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-yellow-500 border-b-2 border-yellow-500 pb-2">Buat Knowledge Baru</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg p-6">
        {{-- Ganti 'knowledge.store' dengan route POST yang benar --}}
        <form method="POST" action="{{ route('knowledge.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Kolom 1: Informasi Dasar --}}
                <div>
                    {{-- 1. TITLE --}}
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Dokumen/Konten (title)</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('title') border-red-500 @enderror" required>
                        @error('title')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2. AUTHOR --}}
                    <div class="mb-4">
                        <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Penulis (author)</label>
                        <input type="text" id="author" name="author" value="{{ old('author') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('author') border-red-500 @enderror">
                        @error('author')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 3. INSTANSI --}}
                    <div class="mb-4">
                        <label for="instansi" class="block text-gray-700 text-sm font-bold mb-2">Instansi Penerbit (instansi)</label>
                        <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('instansi') border-red-500 @enderror">
                        @error('instansi')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- 4. PUBLISH DATE --}}
                    <div class="mb-4">
                        <label for="publish_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Publikasi (publish_date)</label>
                        <input type="date" id="publish_date" name="publish_date" value="{{ old('publish_date', date('Y-m-d')) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('publish_date') border-red-500 @enderror">
                        @error('publish_date')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kolom 2: Metadata dan Status --}}
                <div>
                    {{-- 5. FORMAT (ENUM) --}}
                    <div class="mb-4">
                        <label for="format" class="block text-gray-700 text-sm font-bold mb-2">Format Konten (format)</label>
                        <select id="format" name="format"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('format') border-red-500 @enderror">
                            {{-- Nilai diambil dari ENUM di DB: 'dokumen', 'gambar', 'video', 'tautan', 'lain-lain' --}}
                            @php
                                $formats = ['dokumen', 'gambar', 'video', 'tautan', 'lain-lain'];
                            @endphp
                            @foreach ($formats as $f)
                                <option value="{{ $f }}" {{ old('format') == $f ? 'selected' : '' }}>{{ ucfirst($f) }}</option>
                            @endforeach
                        </select>
                        @error('format')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 6. SCOPE ID (FK) --}}
                    <div class="mb-4">
                        <label for="scope_id" class="block text-gray-700 text-sm font-bold mb-2">Lingkup Penerapan (scope_id)</label>
                        {{-- Asumsi $scopes dikirim dari Controller --}}
                        <select id="scope_id" name="scope_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('scope_id') border-red-500 @enderror">
                            <option value="">-- Pilih Lingkup --</option>
                            {{-- Simulasikan data scope: ganti $scopes dengan variabel dari controller Anda --}}
                            @foreach ($scopes ?? [['id' => 1, 'name' => 'Nasional'], ['id' => 2, 'name' => 'Provinsi X']] as $scope)
                                <option value="{{ $scope['id'] }}" {{ old('scope_id') == $scope['id'] ? 'selected' : '' }}>{{ $scope['name'] }}</option>
                            @endforeach
                        </select>
                        @error('scope_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 7. STATUS ID (FK) --}}
                    <div class="mb-4">
                        <label for="status_id" class="block text-gray-700 text-sm font-bold mb-2">Status Dokumen (status_id)</label>
                        {{-- Asumsi $statuses dikirim dari Controller --}}
                        <select id="status_id" name="status_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('status_id') border-red-500 @enderror">
                            <option value="">-- Pilih Status --</option>
                            {{-- Simulasikan data status: ganti $statuses dengan variabel dari controller Anda --}}
                            @foreach ($statuses ?? [['id' => 1, 'name' => 'Draft'], ['id' => 2, 'name' => 'Published']] as $status)
                                <option value="{{ $status['id'] }}" {{ old('status_id') == $status['id'] ? 'selected' : '' }}>{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 8. URL (Opsional) --}}
                    <div class="mb-4">
                        <label for="url" class="block text-gray-700 text-sm font-bold mb-2">Tautan Eksternal (url) - Opsional</label>
                        <input type="url" id="url" name="url" value="{{ old('url') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('url') border-red-500 @enderror">
                        <p class="text-gray-500 text-xs italic mt-1">Isi jika Format adalah 'tautan' atau sumber eksternal.</p>
                        @error('url')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div> {{-- End Grid --}}
            
            {{-- 9. DESCRIPTION (TEXTAREA) --}}
            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi/Isi Ringkas (description)</label>
                <textarea id="description" name="description" rows="6"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150">
                    Simpan Knowledge
                </button>
            </div>
        </form>
    </div>
</div>
@endsection