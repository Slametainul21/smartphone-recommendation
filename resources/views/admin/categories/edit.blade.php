@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Kategori: {{ $category->name }}</h2>
        <p class="card-subtitle">Perbarui informasi kategori smartphone</p>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Nama Kategori *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-input @error('name') border-error @enderror" 
                value="{{ old('name', $category->name) }}"
                placeholder="Contoh: Gaming, Fotografi, Bisnis"
                required
                autofocus
            >
            @error('name')
                <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea 
                id="description" 
                name="description" 
                class="form-textarea @error('description') border-error @enderror" 
                rows="4"
                placeholder="Deskripsi singkat tentang kategori ini..."
            >{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input 
                    type="checkbox" 
                    name="is_active" 
                    value="1" 
                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                    style="width: 18px; height: 18px;"
                >
                <span class="form-label" style="margin-bottom: 0;">Kategori Aktif</span>
            </label>
            <div style="color: var(--gray-600); font-size: 14px; margin-top: 4px;">
                Kategori aktif akan muncul di form rekomendasi
            </div>
        </div>

        <div style="display: flex; gap: 16px; margin-top: 32px;">
            <button type="submit" class="btn btn-primary">
                💾 Perbarui Kategori
            </button>
            <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-secondary">
                👁️ Lihat Detail
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                ← Kembali
            </a>
        </div>
    </form>
</div>

<!-- Info Statistics -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Statistik Kategori</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px;">
        <div style="text-align: center; padding: 16px;">
            <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue);">
                {{ $category->smartphones_count ?? 0 }}
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Smartphone</div>
        </div>
        <div style="text-align: center; padding: 16px;">
            <div style="font-size: 24px; font-weight: 700; color: var(--success);">
                {{ $category->created_at->format('d M Y') }}
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Dibuat</div>
        </div>
        <div style="text-align: center; padding: 16px;">
            <div style="font-size: 24px; font-weight: 700; color: var(--warning);">
                {{ $category->updated_at->format('d M Y') }}
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Diperbarui</div>
        </div>
    </div>
</div>
@endsection