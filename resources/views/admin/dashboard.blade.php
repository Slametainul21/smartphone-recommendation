@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 32px;">
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 14px; color: var(--gray-600); margin-bottom: 4px;">Total Smartphones</div>
                <div style="font-size: 32px; font-weight: 700; color: var(--primary-blue);">{{ $stats['total_smartphones'] }}</div>
            </div>
            <div style="font-size: 48px;">📱</div>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 14px; color: var(--gray-600); margin-bottom: 4px;">Smartphones Aktif</div>
                <div style="font-size: 32px; font-weight: 700; color: var(--success);">{{ $stats['active_smartphones'] }}</div>
            </div>
            <div style="font-size: 48px;">✅</div>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 14px; color: var(--gray-600); margin-bottom: 4px;">Total Kategori</div>
                <div style="font-size: 32px; font-weight: 700; color: var(--warning);">{{ $stats['total_categories'] }}</div>
            </div>
            <div style="font-size: 48px;">📂</div>
        </div>
    </div>

    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <div style="font-size: 14px; color: var(--gray-600); margin-bottom: 4px;">Spesifikasi</div>
                <div style="font-size: 32px; font-weight: 700; color: var(--primary-blue-dark);">{{ $stats['total_specifications'] }}</div>
            </div>
            <div style="font-size: 48px;">⚙️</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">Quick Actions</h2>
        <p class="card-subtitle">Aksi cepat untuk mengelola sistem</p>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <a href="#" class="btn btn-primary">
            ➕ Tambah Smartphone
        </a>
        <a href="#" class="btn btn-secondary">
            📂 Kelola Kategori
        </a>
        <a href="#" class="btn btn-secondary">
            ⚙️ Atur Spesifikasi
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline">
            🏠 Lihat Website
        </a>
    </div>
</div>

<!-- System Info -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Sistem</h3>
        </div>
        
        <div style="space-y: 12px;">
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                <span style="color: var(--gray-600);">Framework:</span>
                <span style="font-weight: 600;">Laravel {{ app()->version() }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                <span style="color: var(--gray-600);">PHP Version:</span>
                <span style="font-weight: 600;">{{ phpversion() }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-200);">
                <span style="color: var(--gray-600);">Algorithm:</span>
                <span style="font-weight: 600;">Content-Based Filtering</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                <span style="color: var(--gray-600);">Last Update:</span>
                <span style="font-weight: 600;">{{ date('d M Y') }}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Status Database</h3>
        </div>
        
        <div style="text-align: center; padding: 24px 0;">
            <div style="font-size: 48px; color: var(--success); margin-bottom: 16px;">✅</div>
            <div style="font-size: 18px; font-weight: 600; color: var(--success); margin-bottom: 8px;">
                Database Connected
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">
                Semua koneksi berjalan normal
            </div>
        </div>
    </div>
</div>
@endsection