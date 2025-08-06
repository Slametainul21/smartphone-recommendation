@extends('layouts.app')

@section('title', 'Admin Login - Smartphone Recommendation')

@section('content')
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background: var(--gray-50);">
    <div class="container-sm">
        <div class="card" style="max-width: 400px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 32px;">
                <div style="font-size: 48px; margin-bottom: 16px;">🔐</div>
                <h1 style="font-size: 28px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px;">
                    Admin Login
                </h1>
                <p style="color: var(--gray-600);">
                    Masuk untuk mengakses dashboard admin
                </p>
            </div>

            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-input" 
                        value="{{ old('username') }}"
                        placeholder="Masukkan username"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input" 
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    🚀 Masuk ke Dashboard
                </button>
            </form>

            <div style="text-align: center; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                <p style="color: var(--gray-500); font-size: 14px;">
                    Demo: username = <code>admin</code>, password = <code>admin123</code>
                </p>
                <a href="{{ route('home') }}" style="color: var(--primary-blue); text-decoration: none; font-size: 14px;">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection