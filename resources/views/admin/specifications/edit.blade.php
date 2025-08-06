@extends('layouts.admin')

@section('title', 'Edit Spesifikasi')
@section('page-title', 'Edit Spesifikasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Spesifikasi: {{ $specification->name }}</h2>
        <p class="card-subtitle">Perbarui spesifikasi dan bobot algoritma</p>
    </div>

    <form action="{{ route('admin.specifications.update', $specification) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Nama Spesifikasi *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-input @error('name') border-error @enderror" 
                value="{{ old('name', $specification->name) }}"
                required
                autofocus
            >
            @error('name')
                <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type" class="form-label">Tipe Spesifikasi *</label>
            <select id="type" name="type" class="form-select @error('type') border-error @enderror" required>
                <option value="performance" {{ old('type', $specification->type) === 'performance' ? 'selected' : '' }}>
                    🚀 Performance - Performa dan kecepatan
                </option>
                <option value="camera" {{ old('type', $specification->type) === 'camera' ? 'selected' : '' }}>
                    📷 Camera - Kualitas kamera dan fotografi
                </option>
                <option value="battery" {{ old('type', $specification->type) === 'battery' ? 'selected' : '' }}>
                    🔋 Battery - Daya tahan baterai
                </option>
                <option value="design" {{ old('type', $specification->type) === 'design' ? 'selected' : '' }}>
                    🎨 Design - Desain dan build quality
                </option>
                <option value="connectivity" {{ old('type', $specification->type) === 'connectivity' ? 'selected' : '' }}>
                    📶 Connectivity - Konektivitas dan jaringan
                </option>
            </select>
            @error('type')
                <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="weight" class="form-label">Bobot Algoritma *</label>
            <div style="display: flex; align-items: center; gap: 16px;">
                <input 
                    type="range" 
                    id="weight" 
                    name="weight" 
                    class="@error('weight') border-error @enderror" 
                    value="{{ old('weight', $specification->weight) }}"
                    min="0" 
                    max="1" 
                    step="0.01"
                    style="flex: 1;"
                    oninput="updateWeightDisplay(this.value)"
                >
                <div style="min-width: 80px; text-align: center;">
                    <div id="weight-display" style="font-size: 18px; font-weight: 700; color: var(--primary-blue);">
                        {{ number_format($specification->weight * 100, 0) }}%
                    </div>
                    <div style="font-size: 12px; color: var(--gray-600);">Pengaruh</div>
                </div>
            </div>
            <div style="color: var(--gray-600); font-size: 14px; margin-top: 8px;">
                Bobot saat ini: <strong>{{ number_format($specification->weight * 100, 1) }}%</strong> dari total algoritma
            </div>
            @error('weight')
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
            >{{ old('description', $specification->description) }}</textarea>
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
                    {{ old('is_active', $specification->is_active) ? 'checked' : '' }}
                    style="width: 18px; height: 18px;"
                >
                <span class="form-label" style="margin-bottom: 0;">Spesifikasi Aktif</span>
            </label>
        </div>

        <div style="display: flex; gap: 16px; margin-top: 32px;">
            <button type="submit" class="btn btn-primary">
                💾 Perbarui Spesifikasi
            </button>
            <a href="{{ route('admin.specifications.show', $specification) }}" class="btn btn-secondary">
                👁️ Lihat Detail
            </a>
            <a href="{{ route('admin.specifications.index') }}" class="btn btn-outline">
                ← Kembali
            </a>
        </div>
    </form>
</div>

<!-- History Changes -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">📊 Informasi Perubahan</h3>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <div style="text-align: center; padding: 16px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue); margin-bottom: 4px;">
                {{ number_format($specification->weight * 100, 1) }}%
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Bobot Saat Ini</div>
        </div>
        
        <div style="text-align: center; padding: 16px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 24px; font-weight: 700; color: var(--success); margin-bottom: 4px;">
                {{ $specification->created_at->format('d M Y') }}
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Dibuat</div>
        </div>
        
        <div style="text-align: center; padding: 16px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 24px; font-weight: 700; color: var(--warning); margin-bottom: 4px;">
                {{ $specification->updated_at->format('d M Y') }}
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Diperbarui</div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
function updateWeightDisplay(value) {
    const percentage = Math.round(value * 100);
    document.getElementById('weight-display').textContent = percentage + '%';
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize weight display
    const weightInput = document.getElementById('weight');
    updateWeightDisplay(weightInput.value);
});
</script>
@endsection