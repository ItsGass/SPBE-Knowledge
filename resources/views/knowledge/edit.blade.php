@extends('layouts.app')

@section('title', 'Edit Knowledge: ' . $knowledge->title)

@section('content')
    <div class="card">
        <h2 class="card-title-header mb-4">
            <i class="fas fa-edit"></i> Edit Dokumen Knowledge:
            <span style="color: var(--poco-text); font-size: 1.2rem; font-weight: 700;">
                {{ $knowledge->title ?? 'N/A' }}
            </span>
        </h2>

        <form method="POST" action="{{ route('knowledge.update', $knowledge->id) }}">
            @csrf
            @method('PUT')

            {{-- Status --}}
            <div class="mb-4 p-3" style="border: 1px solid var(--poco-border); border-radius: 8px; background: #f8f8f8;">
                <p class="mb-0" style="font-size: 14px; color: var(--poco-secondary-text);">
                    Status Dokumen Saat Ini:
                    <span style="background-color: {{ $knowledge->status?->color ?? '#999' }}; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold; margin-left: 10px;">
                        {{ $knowledge->status?->name ?? 'Belum Ditentukan' }}
                    </span>
                    <span class="ms-4">Dibuat oleh: {{ $knowledge->creator?->name ?? 'Sistem' }}</span>
                </p>
            </div>

            <div class="row">

                {{-- Kolom kiri --}}
                <div class="col-md-6 border-end">
                    <h5 style="color: var(--poco-yellow); border-bottom: 2px solid var(--poco-border); padding-bottom: 5px;">
                        Informasi Dasar
                    </h5>

                    <div class="mb-3">
                        <label for="title">Judul Dokumen *</label>
                        <input type="text" id="title" name="title" class="form-control"
                               value="{{ old('title', $knowledge->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="author">Penulis</label>
                        <input type="text" id="author" name="author" class="form-control"
                               value="{{ old('author', $knowledge->author) }}">
                    </div>

                    <div class="mb-3">
                        <label for="instansi">Instansi</label>
                        <input type="text" id="instansi" name="instansi" class="form-control"
                               value="{{ old('instansi', $knowledge->instansi) }}">
                    </div>

                    <div class="mb-3">
                        <label for="publish_date">Tanggal Publikasi</label>
                        <input type="date" id="publish_date" name="publish_date" class="form-control"
                               value="{{ old('publish_date', $knowledge->publish_date) }}">
                    </div>
                </div>

                {{-- Kolom kanan --}}
                <div class="col-md-6">
                    <h5 style="color: var(--poco-yellow); border-bottom: 2px solid var(--poco-border); padding-bottom: 5px;">
                        Klasifikasi & Tautan
                    </h5>

                    <div class="mb-3">
                        <label>Format Konten</label>
                        <select name="format" class="form-select">
                            @php $formats = ['dokumen','gambar','video','tautan','lain-lain']; @endphp
                            @foreach ($formats as $f)
                                <option value="{{ $f }}" {{ $knowledge->format === $f ? 'selected' : '' }}>
                                    {{ ucfirst($f) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Lingkup Penerapan</label>
                        <select name="scope_id" class="form-select">
                            <option value="">-- Pilih --</option>
                            @foreach ($scopes as $scope)
                                <option value="{{ $scope->id }}" {{ $knowledge->scope_id == $scope->id ? 'selected' : '' }}>
                                    {{ $scope->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Status Dokumen</label>
                        <select name="status_id" class="form-select">
                            <option value="">-- Pilih --</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" {{ $knowledge->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="url">URL Eksternal</label>
                        <input type="url" id="url" name="url" class="form-control"
                               value="{{ old('url', $knowledge->url) }}">
                    </div>
                </div>

            </div>

            <hr class="my-4">

            {{-- Description / TinyMCE --}}
            <div class="mb-4">
                <h5 style="color: var(--poco-yellow); border-bottom: 2px solid var(--poco-border); padding-bottom: 5px;">
                    Isi Dokumen
                </h5>
                <textarea id="description" name="description" rows="12" class="form-control">
                    {{ old('description', $knowledge->description) }}
                </textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
            </div>

        </form>

    </div>
@endsection

@push('scripts')
{{-- TinyMCE --}}
<script src="https://cdn.tiny.cloud/1/fpmqcb5xvvz9sfa2v384dn73x5v1cjnl0mx4s972dbqwjj7q/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#description',
        height: 420,
        menubar: false,
        plugins: 'lists link image table code',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
        content_style: 'body { font-family: Arial, sans-serif; font-size:14px; }'
    });
</script>
@endpush
