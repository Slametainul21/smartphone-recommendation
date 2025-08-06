@extends('layouts.admin')

@section('title', 'Tambah Smartphone')
@section('page-title', 'Tambah Smartphone')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Tambah Smartphone Baru</h2>
        <p class="card-subtitle">Tambahkan smartphone baru ke database</p>
    </div>

    <form action="{{ route('admin.smartphones.store') }}" method="POST">
        @csrf
        
        <!-- Informasi Dasar -->
        <div style="border-bottom: 1px solid var(--gray-200); margin-bottom: 24px; padding-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 600; color: var(--gray-900); margin-bottom: 16px;">📝 Informasi Dasar</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="brand" class="form-label">Brand *</label>
                    <input 
                        type="text" 
                        id="brand" 
                        name="brand" 
                        class="form-input @error('brand') border-error @enderror" 
                        value="{{ old('brand') }}"
                        placeholder="Samsung, Xiaomi, Oppo, dll"
                        required
                        autofocus
                    >
                    @error('brand') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="model" class="form-label">Model *</label>
                    <input 
                        type="text" 
                        id="model" 
                        name="model" 
                        class="form-input @error('model') border-error @enderror" 
                        value="{{ old('model') }}"
                        placeholder="Galaxy A26, Redmi Note 14, dll"
                        required
                    >
                    @error('model') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Kategori *</label>
                <select id="category_id" name="category_id" class="form-select @error('category_id') border-error @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Harga -->
        <div style="border-bottom: 1px solid var(--gray-200); margin-bottom: 24px; padding-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 600; color: var(--gray-900); margin-bottom: 16px;">💰 Informasi Harga</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="price_min" class="form-label">Harga Minimum (Rp) *</label>
                    <input 
                        type="number" 
                        id="price_min" 
                        name="price_min" 
                        class="form-input @error('price_min') border-error @enderror" 
                        value="{{ old('price_min') }}"
                        placeholder="3000000"
                        min="0"
                        required
                    >
                    @error('price_min') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="price_max" class="form-label">Harga Maximum (Rp) *</label>
                    <input 
                        type="number" 
                        id="price_max" 
                        name="price_max" 
                        class="form-input @error('price_max') border-error @enderror" 
                        value="{{ old('price_max') }}"
                        placeholder="4000000"
                        min="0"
                        required
                    >
                    @error('price_max') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <!-- Spesifikasi -->
        <div style="border-bottom: 1px solid var(--gray-200); margin-bottom: 24px; padding-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 600; color: var(--gray-900); margin-bottom: 16px;">⚙️ Spesifikasi Teknis</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="ram" class="form-label">RAM (GB) *</label>
                    <select id="ram" name="ram" class="form-select @error('ram') border-error @enderror" required>
                        <option value="">Pilih RAM</option>
                        <option value="4" {{ old('ram') == 4 ? 'selected' : '' }}>4 GB</option>
                        <option value="6" {{ old('ram') == 6 ? 'selected' : '' }}>6 GB</option>
                        <option value="8" {{ old('ram') == 8 ? 'selected' : '' }}>8 GB</option>
                        <option value="12" {{ old('ram') == 12 ? 'selected' : '' }}>12 GB</option>
                        <option value="16" {{ old('ram') == 16 ? 'selected' : '' }}>16 GB</option>
                        <option value="18" {{ old('ram') == 18 ? 'selected' : '' }}>18 GB</option>
                    </select>
                    @error('ram') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="storage" class="form-label">Storage (GB) *</label>
                    <select id="storage" name="storage" class="form-select @error('storage') border-error @enderror" required>
                        <option value="">Pilih Storage</option>
                        <option value="64" {{ old('storage') == 64 ? 'selected' : '' }}>64 GB</option>
                        <option value="128" {{ old('storage') == 128 ? 'selected' : '' }}>128 GB</option>
                        <option value="256" {{ old('storage') == 256 ? 'selected' : '' }}>256 GB</option>
                        <option value="512" {{ old('storage') == 512 ? 'selected' : '' }}>512 GB</option>
                        <option value="1024" {{ old('storage') == 1024 ? 'selected' : '' }}>1 TB</option>
                    </select>
                    @error('storage') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="battery" class="form-label">Baterai (mAh) *</label>
                    <input 
                        type="number" 
                        id="battery" 
                        name="battery" 
                        class="form-input @error('battery') border-error @enderror" 
                        value="{{ old('battery') }}"
                        placeholder="5000"
                        min="1000"
                        max="10000"
                        required
                    >
                    @error('battery') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="camera" class="form-label">Kamera (MP) *</label>
                    <input 
                        type="number" 
                        id="camera" 
                        name="camera" 
                        class="form-input @error('camera') border-error @enderror" 
                        value="{{ old('camera') }}"
                        placeholder="108"
                        min="1"
                        max="300"
                        required
                    >
                    @error('camera') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 600; color: var(--gray-900); margin-bottom: 16px;">📋 Informasi Tambahan</h3>
            
            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea 
                    id="description" 
                    name="description" 
                    class="form-textarea @error('description') border-error @enderror" 
                    rows="4"
                    placeholder="Deskripsi singkat tentang smartphone ini..."
                >{{ old('description') }}</textarea>
                @error('description') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="image_url" class="form-label">URL Gambar</label>
                <input 
                    type="url" 
                    id="image_url" 
                    name="image_url" 
                    class="form-input @error('image_url') border-error @enderror" 
                    value="{{ old('image_url') }}"
                    placeholder="https://example.com/smartphone-image.jpg"
                >
                @error('image_url') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
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
                    <span class="form-label" style="margin-bottom: 0;">Smartphone Aktif</span>
                </label>
                <div style="color: var(--gray-600); font-size: 14px; margin-top: 4px;">
                    Smartphone aktif akan muncul dalam rekomendasi
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 16px; margin-top: 32px;">
            <button type="submit" class="btn btn-primary">💾 Simpan Smartphone</button>
            <a href="{{ route('admin.smartphones.index') }}" class="btn btn-secondary">❌ Batal</a>
        </div>
    </form>
</div>

<!-- Preview -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Preview Smartphone</h3>
    </div>
    
    <div id="preview-card" style="padding: 20px; background: var(--gray-50); border-radius: 8px;">
        <div style="display: flex; align-items: center; gap: 16px;">
            <div style="width: 80px; height: 80px; background: var(--gray-200); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
                📱
            </div>
            <div>
                <div id="preview-name" style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">
                    Nama Smartphone
                </div>
                <div id="preview-category" style="color: var(--gray-600); margin-bottom: 8px;">
                    Kategori
                </div>
                <div id="preview-price" style="font-weight: 600; color: var(--primary-blue);">
                    Harga
                </div>
            </div>
        </div>
        <div id="preview-specs" style="margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--gray-300); font-size: 14px; color: var(--gray-600);">
            Spesifikasi akan muncul di sini...
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = {
        brand: document.getElementById('brand'),
        model: document.getElementById('model'),
        category_id: document.getElementById('category_id'),
        price_min: document.getElementById('price_min'),
        price_max: document.getElementById('price_max'),
        ram: document.getElementById('ram'),
        storage: document.getElementById('storage'),
        battery: document.getElementById('battery'),
        camera: document.getElementById('camera')
    };
    
    const previews = {
        name: document.getElementById('preview-name'),
        category: document.getElementById('preview-category'),
        price: document.getElementById('preview-price'),
        specs: document.getElementById('preview-specs')
    };
    
    function updatePreview() {
        // Update nama
        const brand = inputs.brand.value || 'Brand';
        const model = inputs.model.value || 'Model';
        previews.name.textContent = `${brand} ${model}`;
        
        // Update kategori
        const categoryText = inputs.category_id.options[inputs.category_id.selectedIndex].text;
        previews.category.textContent = categoryText !== 'Pilih Kategori' ? categoryText : 'Kategori';
        
        // Update harga
        const priceMin = parseInt(inputs.price_min.value) || 0;
        const priceMax = parseInt(inputs.price_max.value) || 0;
        let priceText = 'Harga';
        if (priceMin && priceMax) {
            if (priceMin === priceMax) {
                priceText = `Rp ${priceMin.toLocaleString('id-ID')}`;
            } else {
                priceText = `Rp ${priceMin.toLocaleString('id-ID')} - Rp ${priceMax.toLocaleString('id-ID')}`;
            }
        } else if (priceMin) {
            priceText = `Rp ${priceMin.toLocaleString('id-ID')}`;
        }
        previews.price.textContent = priceText;
        
        // Update specs
        const specs = [];
        if (inputs.ram.value) specs.push(`RAM: ${inputs.ram.value}GB`);
        if (inputs.storage.value) specs.push(`Storage: ${inputs.storage.value}GB`);
        if (inputs.battery.value) specs.push(`Battery: ${inputs.battery.value}mAh`);
        if (inputs.camera.value) specs.push(`Camera: ${inputs.camera.value}MP`);
        
        previews.specs.textContent = specs.length > 0 ? specs.join(' • ') : 'Spesifikasi akan muncul di sini...';
    }
    
    // Event listeners
    Object.values(inputs).forEach(input => {
        input.addEventListener('input', updatePreview);
        input.addEventListener('change', updatePreview);
    });
    
    // Initial preview
    updatePreview();
});
</script>
@endsection