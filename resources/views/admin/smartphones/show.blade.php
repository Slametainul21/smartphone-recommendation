@extends('layouts.admin')

@section('title', 'Detail Smartphone')
@section('page-title', 'Detail Smartphone')

@section('content')
<!-- Header Info -->
<div class="card mb-4">
    <div style="display: flex; gap: 24px; align-items: start;">
        @if($smartphone->image_url)
            <img src="{{ $smartphone->image_url }}" alt="{{ $smartphone->full_name }}" 
                 style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 1px solid var(--gray-200);">
        @else
            <div style="width: 120px; height: 120px; background: var(--gray-100); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 48px;">
                📱
            </div>
        @endif
        
        <div style="flex: 1;">
            <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 16px;">
                <div>
                    <h1 style="font-size: 28px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px;">
                        {{ $smartphone->full_name }}
                        @if($smartphone->is_active)
                            <span style="color: var(--success); font-size: 20px;">✅</span>
                        @else
                            <span style="color: var(--error); font-size: 20px;">❌</span>
                        @endif
                    </h1>
                    <div style="display: flex; gap: 12px; margin-bottom: 12px;">
                        <span style="background: var(--light-blue); color: var(--primary-blue); padding: 6px 12px; border-radius: 6px; font-size: 14px; font-weight: 600;">
                            {{ $smartphone->category->name }}
                        </span>
                        <span style="background: var(--gray-100); color: var(--gray-700); padding: 6px 12px; border-radius: 6px; font-size: 14px;">
                            {{ $smartphone->brand }}
                        </span>
                    </div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue); margin-bottom: 16px;">
                        {{ $smartphone->formatted_price }}
                    </div>
                </div>
                
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('admin.smartphones.edit', $smartphone) }}" class="btn btn-primary">✏️ Edit</a>
                    <a href="{{ route('admin.smartphones.index') }}" class="btn btn-secondary">← Kembali</a>
                </div>
            </div>
            
            @if($smartphone->description)
                <p style="color: var(--gray-600); line-height: 1.6; margin-bottom: 16px;">{{ $smartphone->description }}</p>
            @endif
            
            <div style="display: flex; gap: 16px; font-size: 14px; color: var(--gray-500);">
                <span>📅 Dibuat: {{ $smartphone->created_at->format('d M Y H:i') }}</span>
                <span>🔄 Diperbarui: {{ $smartphone->updated_at->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Spesifikasi Utama -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">⚙️ Spesifikasi Teknis</h2>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px;">
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">🧠</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue); margin-bottom: 4px;">{{ $smartphone->ram }} GB</div>
            <div style="color: var(--gray-600); font-size: 14px;">RAM</div>
        </div>
        
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">💾</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue); margin-bottom: 4px;">{{ $smartphone->storage }} GB</div>
            <div style="color: var(--gray-600); font-size: 14px;">Storage</div>
        </div>
        
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">🔋</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--success); margin-bottom: 4px;">{{ $smartphone->battery }} mAh</div>
            <div style="color: var(--gray-600); font-size: 14px;">Baterai</div>
        </div>
        
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">📷</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--warning); margin-bottom: 4px;">{{ $smartphone->camera }} MP</div>
            <div style="color: var(--gray-600); font-size: 14px;">Kamera</div>
        </div>
    </div>
</div>

<!-- Info Kategori -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">📂 Informasi Kategori</h2>
    </div>
    
    <div style="display: flex; gap: 20px; align-items: center;">
        <div>
            <h3 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 8px;">
                {{ $smartphone->category->name }}
            </h3>
            <p style="color: var(--gray-600); margin-bottom: 16px;">
                {{ $smartphone->category->description ?? 'Tidak ada deskripsi kategori.' }}
            </p>
            <div style="display: flex; gap: 16px; font-size: 14px;">
                <span style="color: var(--gray-500);">📊 Total smartphone dalam kategori: <strong>{{ $smartphone->category->smartphones->count() }}</strong></span>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.categories.show', $smartphone->category) }}" class="btn btn-outline">
                👁️ Lihat Kategori
            </a>
        </div>
    </div>
</div>

<!-- Actions -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">🚀 Aksi Cepat</h2>
    </div>
    
    <div style="display: flex; gap: 16px; flex-wrap: wrap;">
        <a href="{{ route('admin.smartphones.edit', $smartphone) }}" class="btn btn-primary">
            ✏️ Edit Smartphone
        </a>
        <a href="{{ route('admin.smartphones.create') }}" class="btn btn-secondary">
            + Tambah Smartphone Baru
        </a>
        <a href="{{ route('admin.smartphones.index') }}?category_id={{ $smartphone->category_id }}" class="btn btn-outline">
            📂 Lihat Smartphone Sejenis
        </a>
        <form action="{{ route('admin.smartphones.destroy', $smartphone) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus smartphone ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" style="background: var(--error); color: white;">
                🗑️ Hapus Smartphone
            </button>
        </form>
    </div>
</div>
@endsection