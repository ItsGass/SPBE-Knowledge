@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4" 
        style="color: var(--poco-yellow); font-weight: 700; border-left: 5px solid var(--poco-yellow); padding-left: 15px;">
        Profil Pengguna
    </h2>

    <div class="card p-4" style="border-radius: 12px;">
        
        <div class="d-flex align-items-center gap-4">
            <img src="https://ui-avatars.com/api/?name={{ $user->name }}" 
                 style="width: 90px; height: 90px; border-radius: 50%;" alt="Avatar">

            <div>
                <h3 class="mb-1">{{ $user->name }}</h3>
                <p class="mb-1">{{ $user->email }}</p>
                <p class="mb-0 fw-bold" style="color: var(--poco-yellow);">
                    Role: {{ ucfirst($user->role) }}
                </p>
            </div>
        </div>

        <hr class="my-3">

        <h4 class="fw-bold">Informasi Akun</h4>

        <ul>
            <li>Email : {{ $user->email }}</li>
            <li>Dibuat : {{ $user->created_at->format('d M Y') }}</li>
            <li>Terakhir update : {{ $user->updated_at->format('d M Y') }}</li>
        </ul>
    </div>
</div>
@endsection
