@extends('layouts.admin')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@section('content')
<!-- Info Kategori -->
<div class="card mb-4">
    <div style="display: flex; justify-content: between; align-items: start; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-size: 28px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px;">
                {{ $category->name }}
                @if($category->is_active)
                    <span style="color: var(--success); font-size: 16px;">✅</span>
                @else
                    <span style="color: var(--error); font-size: 16px;">❌</span>
                @endif
            </h2>
            <p style="color: var(--gray-600); margin-bottom: 16px; line-height: 1.6;">
                {{ $category->description ?? 'Tidak ada deskripsi.' }}
            </p>
            <div style="display: flex; gap: 16px; font-size: 14px; color: var(--gray-500);">
                <span>📅 Dibuat: {{ $category->created_at->format('d M Y H:i') }}</span>
                <span>🔄 Diperbarui: {{ $category->updated_at->format('d M Y H:i') }}</span>
            </div>
        </div>
        
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
                ✏️ Edit Kategori
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>
    </div>
</div>

<!-- Statistik -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px;">
    <div class="card">
        <div style="text-align: center;">
            <div style="font-size: 36px; font-weight: 700; color: var(--primary-blue); margin-bottom: 8px;">
                {{ $category->smartphones->count() }}
            </div>
            <div style="color: var(--gray-600);">Total Smartphone</div>
        </div>
    </div>
    
    <div class="card">
        <div style="text-align: center;">
            <div style="font-size: 36px; font-weight: 700; color: var(--success); margin-bottom: 8px;">
                {{ $category->smartphones->where('is_active', true)->count() }}
            </div>
            <div style="color: var(--gray-600);">Smartphone Aktif</div>
        </div>
    </div>
    
    <div class="card">
        <div style="text-align: center;">
            <div style="font-size: 36px; font-weight: 700; color: var(--warning); margin-bottom: 8px;">
                {{ $category->smartphones->count() > 0 ? 'Rp ' . number_format($category->smartphones->avg('price_min'), 0, ',', '.') : 'N/A' }}
            </div>
            <div style="color: var(--gray-600);">Rata-rata Harga</div>
        </div>
    </div>
</div>

<!-- Daftar Smartphone dalam Kategori -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Smartphone dalam Kategori Ini</h3>
        <p class="card-subtitle">{{ $category->smartphones->count() }} smartphone ditemukan</p>
    </div>
    
    @if($category->smartphones->count() > 0)
        <div class="table-container" style="margin-top: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Smartphone</th>
                        <th>Harga</th>
                        <th>Spesifikasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->smartphones as $smartphone)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--gray-900);">{{ $smartphone->full_name }}</div>
                            <div style="color: var(--gray-600); font-size: 14px;">{{ $smartphone->brand }} - {{ $smartphone->model }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $smartphone->formatted_price }}</div>
                        </td>
                        <td>
                            <div style="font-size: 14px; color: var(--gray-600);">
                                RAM: {{ $smartphone->ram }}GB • 
                                Storage: {{ $smartphone->storage }}GB • 
                                Battery: {{ $smartphone->battery }}mAh
                            </div>
                        </td>
                        <td>
                            @if($smartphone->is_active)
                                <span style="color: var(--success); font-weight: 600;">✅ Aktif</span>
                            @else
                                <span style="color: var(--error); font-weight: 600;">❌ Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.smartphones.show', $smartphone) }}" class="btn btn-sm btn-secondary">
                                👁️ Lihat
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 40px;">
            <div style="font-size: 48px; margin-bottom: 16px;">📱</div>
            <h4 style="color: var(--gray-600); margin-bottom: 8px;">Belum Ada Smartphone</h4>
            <p style="color: var(--gray-500);">Belum ada smartphone yang menggunakan kategori ini.</p>
        </div>
    @endif
</div>
@endsection