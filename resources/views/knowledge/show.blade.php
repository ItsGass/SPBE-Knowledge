@extends('layouts.app') 
{{-- Menggunakan layout utama Anda (layouts.app) --}}

@section('title', $knowledge->title ?? 'Detail Knowledge')

@section('content')
<div class="card">
    <h2 class="card-title-header mb-4">
        {{ $knowledge->title ?? 'Dokumen Tidak Ditemukan' }}
    </h2>
    
    @if ($knowledge)
    <div class="row mb-4">
        <div class="col-md-6">
            <p><strong>Penulis:</strong> {{ $knowledge->author ?? 'N/A' }}</p>
            <p><strong>Instansi:</strong> {{ $knowledge->instansi ?? 'N/A' }}</p>
            <p><strong>Tanggal Publikasi:</strong> {{ $knowledge->publish_date ? \Carbon\Carbon::parse($knowledge->publish_date)->format('d M Y') : 'N/A' }}</p>
        </div>
        <div class="col-md-6 text-end">
            <p><strong>Status:</strong> 
                {{-- Gunakan null safe operator pada status --}}
                <span class="badge" style="background-color: {{ $knowledge->status?->color ?? '#666' }}; color: white;">
                    {{ $knowledge->status?->name ?? 'Unknown' }}
                </span>
            </p>
            <p><strong>Lingkup:</strong> {{ $knowledge->scope?->name ?? 'Global' }}</p>
            {{-- Gunakan null safe operator pada creator --}}
            <p><strong>Dibuat oleh:</strong> {{ $knowledge->creator?->name ?? 'Sistem' }}</p>
        </div>
    </div>

    <div class="card-body mt-4">
        <h4 class="mb-3">Deskripsi / Konten</h4>
        {{-- 💡 PERBAIKAN: Menggunakan {!! ... !!} agar HTML dari TinyMCE DIBACA OLEH BROWSER --}}
        <div class="p-3" style="border: 1px solid var(--poco-border); border-radius: 5px; background: #fff; min-height: 200px;">
            {!! $knowledge->description ?? '<p>Tidak ada deskripsi/konten tersedia.</p>' !!} 
            
            @if ($knowledge->url)
                <p class="mt-3">
                    <a href="{{ $knowledge->url }}" target="_blank" class="btn-action" style="background: var(--poco-yellow); color: var(--poco-text); font-weight: bold;">
                        <i class="fas fa-external-link-alt"></i> Akses Sumber Eksternal
                    </a>
                </p>
            @endif
        </div>
    </div>

    @auth
        {{-- Tombol Edit hanya untuk Admin/SuperAdmin --}}
        @if (in_array(Auth::user()?->role, ['superadmin', 'admin']))
        <div class="mt-4 text-end">
            <a href="{{ route('knowledge.edit', $knowledge->id) }}" class="btn-action">
                <i class="fas fa-edit"></i> Edit Dokumen
            </a>
        </div>
        @endif
    @endauth

    @else
    <div class="alert-error">Dokumen tidak ditemukan atau akses ditolak.</div>
    @endif
</div>
@endsection