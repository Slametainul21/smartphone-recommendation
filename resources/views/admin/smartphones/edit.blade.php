@extends('layouts.admin')

@section('title', 'Edit Smartphone')
@section('page-title', 'Edit Smartphone')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Smartphone: {{ $smartphone->full_name }}</h2>
        <p class="card-subtitle">Perbarui informasi smartphone</p>
    </div>

    <form action="{{ route('admin.smartphones.update', $smartphone) }}" method="POST">
        @csrf
        @method('PUT')
        
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
                        value="{{ old('brand', $smartphone->brand) }}"
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
                        value="{{ old('model', $smartphone->model) }}"
                        required
                    >
                    @error('model') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Kategori *</label>
                <select id="category_id" name="category_id" class="form-select @error('category_id') border-error @enderror" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $smartphone->category_id) == $category->id ? 'selected' : '' }}>
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
                        value="{{ old('price_min', $smartphone->price_min) }}"
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
                        value="{{ old('price_max', $smartphone->price_max) }}"
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
                        <option value="4" {{ old('ram', $smartphone->ram) == 4 ? 'selected' : '' }}>4 GB</option>
                        <option value="6" {{ old('ram', $smartphone->ram) == 6 ? 'selected' : '' }}>6 GB</option>
                        <option value="8" {{ old('ram', $smartphone->ram) == 8 ? 'selected' : '' }}>8 GB</option>
                        <option value="12" {{ old('ram', $smartphone->ram) == 12 ? 'selected' : '' }}>12 GB</option>
                        <option value="16" {{ old('ram', $smartphone->ram) == 16 ? 'selected' : '' }}>16 GB</option>
                        <option value="18" {{ old('ram', $smartphone->ram) == 18 ? 'selected' : '' }}>18 GB</option>
                    </select>
                    @error('ram') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="storage" class="form-label">Storage (GB) *</label>
                    <select id="storage" name="storage" class="form-select @error('storage') border-error @enderror" required>
                        <option value="64" {{ old('storage', $smartphone->storage) == 64 ? 'selected' : '' }}>64 GB</option>
                        <option value="128" {{ old('storage', $smartphone->storage) == 128 ? 'selected' : '' }}>128 GB</option>
                        <option value="256" {{ old('storage', $smartphone->storage) == 256 ? 'selected' : '' }}>256 GB</option>
                        <option value="512" {{ old('storage', $smartphone->storage) == 512 ? 'selected' : '' }}>512 GB</option>
                        <option value="1024" {{ old('storage', $smartphone->storage) == 1024 ? 'selected' : '' }}>1 TB</option>
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
                        value="{{ old('battery', $smartphone->battery) }}"
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
                        value="{{ old('camera', $smartphone->camera) }}"
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
                >{{ old('description', $smartphone->description) }}</textarea>
                @error('description') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="image_url" class="form-label">URL Gambar</label>
                <input 
                    type="url" 
                    id="image_url" 
                    name="image_url" 
                    class="form-input @error('image_url') border-error @enderror" 
                    value="{{ old('image_url', $smartphone->image_url) }}"
                >
                @error('image_url') <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1" 
                        {{ old('is_active', $smartphone->is_active) ? 'checked' : '' }}
                        style="width: 18px; height: 18px;"
                    >
                    <span class="form-label" style="margin-bottom: 0;">Smartphone Aktif</span>
                </label>
            </div>
        </div>

        <div style="display: flex; gap: 16px; margin-top: 32px;">
            <button type="submit" class="btn btn-primary">💾 Perbarui Smartphone</button>
            <a href="{{ route('admin.smartphones.show', $smartphone) }}" class="btn btn-secondary">👁️ Lihat Detail</a>
            <a href="{{ route('admin.smartphones.index') }}" class="btn btn-outline">← Kembali</a>
        </div>
    </form>
</div>
@endsection