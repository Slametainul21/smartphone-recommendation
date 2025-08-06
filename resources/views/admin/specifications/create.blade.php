@extends('layouts.admin')

@section('title', 'Tambah Spesifikasi')
@section('page-title', 'Tambah Spesifikasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Tambah Spesifikasi Baru</h2>
        <p class="card-subtitle">Buat spesifikasi baru untuk algoritma rekomendasi</p>
    </div>

    <form action="{{ route('admin.specifications.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Nama Spesifikasi *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-input @error('name') border-error @enderror" 
                value="{{ old('name') }}"
                placeholder="Contoh: Kamera, Baterai, Performa"
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
                <option value="">Pilih Tipe Spesifikasi</option>
                <option value="performance" {{ old('type') === 'performance' ? 'selected' : '' }}>
                    Performance - Performa dan kecepatan
                </option>
                <option value="camera" {{ old('type') === 'camera' ? 'selected' : '' }}>
                    Camera - Kualitas kamera dan fotografi
                </option>
                <option value="battery" {{ old('type') === 'battery' ? 'selected' : '' }}>
                    Battery - Daya tahan baterai
                </option>
                <option value="design" {{ old('type') === 'design' ? 'selected' : '' }}>
                    Design - Desain dan build quality
                </option>
                <option value="connectivity" {{ old('type') === 'connectivity' ? 'selected' : '' }}>
                    Connectivity - Konektivitas dan jaringan
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
                    value="{{ old('weight', 0.20) }}"
                    min="0" 
                    max="1" 
                    step="0.01"
                    style="flex: 1;"
                    oninput="updateWeightDisplay(this.value)"
                >
                <div style="min-width: 80px; text-align: center;">
                    <div id="weight-display" style="font-size: 18px; font-weight: 700; color: var(--primary-blue);">20%</div>
                    <div style="font-size: 12px; color: var(--gray-600);">Pengaruh</div>
                </div>
            </div>
            <div style="color: var(--gray-600); font-size: 14px; margin-top: 8px;">
                Tentukan seberapa besar pengaruh spesifikasi ini dalam algoritma rekomendasi (0% = tidak berpengaruh, 100% = sangat berpengaruh)
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
                placeholder="Jelaskan apa fungsi dan kegunaan spesifikasi ini..."
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
                <span class="form-label" style="margin-bottom: 0;">Spesifikasi Aktif</span>
            </label>
            <div style="color: var(--gray-600); font-size: 14px; margin-top: 4px;">
                Spesifikasi aktif akan digunakan dalam form rekomendasi
            </div>
        </div>

        <div style="display: flex; gap: 16px; margin-top: 32px;">
            <button type="submit" class="btn btn-primary">
                💾 Simpan Spesifikasi
            </button>
            <a href="{{ route('admin.specifications.index') }}" class="btn btn-secondary">
                ❌ Batal
            </a>
        </div>
    </form>
</div>

<!-- Preview Card -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Preview Spesifikasi</h3>
    </div>
    
    <div id="preview-card" style="padding: 20px; background: var(--gray-50); border-radius: 8px;">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
            <div id="preview-icon" style="font-size: 32px;">⚙️</div>
            <div>
                <div id="preview-name" style="font-size: 18px; font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">
                    Nama Spesifikasi
                </div>
                <div id="preview-type" style="color: var(--gray-600); font-size: 14px;">
                    Tipe Spesifikasi
                </div>
            </div>
        </div>
        
        <div style="margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <span style="color: var(--gray-700); font-weight: 600;">Bobot Algoritma:</span>
                <div style="display: flex; align-items: center; gap: 8px; flex: 1;">
                    <div style="background: var(--gray-200); border-radius: 4px; height: 8px; flex: 1; overflow: hidden;">
                        <div id="preview-weight-bar" style="background: var(--primary-blue); height: 100%; width: 20%; transition: width 0.3s ease;"></div>
                    </div>
                    <span id="preview-weight-text" style="font-weight: 600; color: var(--primary-blue); min-width: 40px;">20%</span>
                </div>
            </div>
        </div>
        
        <div id="preview-description" style="color: var(--gray-600); font-size: 14px; font-style: italic;">
            Deskripsi spesifikasi akan muncul di sini...
        </div>
        
        <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--gray-300);">
            <span id="preview-status" style="padding: 4px 8px; border-radius: 4px; font-size: 12px; background: var(--light-blue); color: var(--primary-blue);">
                ✅ Aktif
            </span>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
// Update weight display
function updateWeightDisplay(value) {
    const percentage = Math.round(value * 100);
    document.getElementById('weight-display').textContent = percentage + '%';
    updatePreview();
}

document.addEventListener('DOMContentLoaded', function() {
    const inputs = {
        name: document.getElementById('name'),
        type: document.getElementById('type'),
        weight: document.getElementById('weight'),
        description: document.getElementById('description'),
        is_active: document.querySelector('input[name="is_active"]')
    };
    
    const previews = {
        icon: document.getElementById('preview-icon'),
        name: document.getElementById('preview-name'),
        type: document.getElementById('preview-type'),
        weightBar: document.getElementById('preview-weight-bar'),
        weightText: document.getElementById('preview-weight-text'),
        description: document.getElementById('preview-description'),
        status: document.getElementById('preview-status')
    };
    
    const typeIcons = {
        'performance': '🚀',
        'camera': '📷',
        'battery': '🔋',
        'design': '🎨',
        'connectivity': '📶'
    };
    
    const typeNames = {
        'performance': 'Performance - Performa dan kecepatan',
        'camera': 'Camera - Kualitas kamera dan fotografi',
        'battery': 'Battery - Daya tahan baterai',
        'design': 'Design - Desain dan build quality',
        'connectivity': 'Connectivity - Konektivitas dan jaringan'
    };
    
    function updatePreview() {
        // Update name
        previews.name.textContent = inputs.name.value || 'Nama Spesifikasi';
        
        // Update type and icon
        const selectedType = inputs.type.value;
        previews.icon.textContent = typeIcons[selectedType] || '⚙️';
        previews.type.textContent = typeNames[selectedType] || 'Tipe Spesifikasi';
        
        // Update weight
        const weight = parseFloat(inputs.weight.value) || 0;
        const percentage = Math.round(weight * 100);
        previews.weightBar.style.width = percentage + '%';
        previews.weightText.textContent = percentage + '%';
        
        // Update description
        previews.description.textContent = inputs.description.value || 'Deskripsi spesifikasi akan muncul di sini...';
        
        // Update status
        if (inputs.is_active.checked) {
            previews.status.innerHTML = '✅ Aktif';
            previews.status.style.background = 'var(--light-blue)';
            previews.status.style.color = 'var(--primary-blue)';
        } else {
            previews.status.innerHTML = '❌ Nonaktif';
            previews.status.style.background = '#fef2f2';
            previews.status.style.color = '#991b1b';
        }
    }
    
    // Event listeners
    Object.values(inputs).forEach(input => {
        if (input) {
            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
        }
    });
    
    // Initial preview
    updatePreview();
});
</script>
@endsection