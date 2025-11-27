@extends('layouts.app') 

@section('title', 'Buat Admin Baru')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Class 'card' otomatis mengambil gaya Hitam-Kuning dari layouts.app --}}
            <div class="card">
                <div class="card-header">
                    <h4>Buat Admin Baru</h4>
                </div>
                <div class="card-body">
                    {{-- Pastikan route 'admin.store' sudah terdaftar di routes/web.php --}}
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        
                        {{-- Field Nama --}}
                        <div class="mb-3">
                            {{-- Label akan berwarna putih/terang --}}
                            <label for="name" class="form-label">Nama</label>
                            {{-- Class 'form-control' otomatis mengambil gaya Hitam dengan border/focus Kuning --}}
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Field Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Field Role --}}
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- Field Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Field Konfirmasi Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        
                        {{-- PERUBAHAN: btn-success menjadi btn-primary (Kuning) untuk aksi utama --}}
                        <button type="submit" class="btn btn-primary">Daftarkan Admin</button>
                        
                        {{-- Class 'btn-secondary' (Gelap) untuk aksi sekunder --}}
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection