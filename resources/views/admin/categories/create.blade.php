@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Tambah Kategori Baru</h2>
        <p class="card-subtitle">Buat kategori penggunaan smartphone baru</p>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Nama Kategori *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-input @error('name') border-error @enderror" 
                value="{{ old('name') }}"
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
            >{{ old('description') }}</textarea>
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
                    {{ old('is_active', true) ? 'checked' : '' }}
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
                💾 Simpan Kategori
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                ❌ Batal
            </a>
        </div>
    </form>
</div>

<!-- Preview Card -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Preview Kategori</h3>
    </div>
    
    <div id="preview-card" style="padding: 20px; background: var(--gray-50); border-radius: 8px; margin-top: 16px;">
        <div style="font-weight: 600; color: var(--gray-900); margin-bottom: 8px;" id="preview-name">
            Nama Kategori
        </div>
        <div style="color: var(--gray-600); font-size: 14px;" id="preview-description">
            Deskripsi kategori akan muncul di sini...
        </div>
        <div style="margin-top: 12px;">
            <span id="preview-status" style="padding: 4px 8px; border-radius: 4px; font-size: 12px; background: var(--light-blue); color: var(--primary-blue);">
                ✅ Aktif
            </span>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const activeInput = document.querySelector('input[name="is_active"]');
    
    const previewName = document.getElementById('preview-name');
    const previewDescription = document.getElementById('preview-description');
    const previewStatus = document.getElementById('preview-status');
    
    function updatePreview() {
        // Update nama
        previewName.textContent = nameInput.value || 'Nama Kategori';
        
        // Update deskripsi
        previewDescription.textContent = descriptionInput.value || 'Deskripsi kategori akan muncul di sini...';
        
        // Update status
        if (activeInput.checked) {
            previewStatus.innerHTML = '✅ Aktif';
            previewStatus.style.background = 'var(--light-blue)';
            previewStatus.style.color = 'var(--primary-blue)';
        } else {
            previewStatus.innerHTML = '❌ Nonaktif';
            previewStatus.style.background = '#fef2f2';
            previewStatus.style.color = '#991b1b';
        }
    }
    
    // Event listeners
    nameInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    activeInput.addEventListener('change', updatePreview);
    
    // Initial preview
    updatePreview();
});
</script>
@endsection