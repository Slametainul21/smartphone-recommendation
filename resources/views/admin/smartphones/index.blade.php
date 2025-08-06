@extends('layouts.admin')

@section('title', 'Kelola Smartphone')
@section('page-title', 'Kelola Smartphone')

@section('content')
<!-- Header -->
<div class="card mb-4">
    <div style="display: flex; justify-content: between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">
                Daftar Smartphone
            </h2>
            <p style="color: var(--gray-600); font-size: 14px;">
                Kelola database smartphone ({{ $smartphones->total() }} smartphone)
            </p>
        </div>
        
        <a href="{{ route('admin.smartphones.create') }}" class="btn btn-primary">
            + Tambah Smartphone
        </a>
    </div>
</div>

<!-- Search dan Filter -->
<div class="card mb-4">
    <form method="GET" action="{{ route('admin.smartphones.index') }}">
        <div style="display: grid; grid-template-columns: 1fr 180px 150px 150px 100px 100px; gap: 16px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="search" class="form-label">Pencarian</label>
                <input 
                    type="text" 
                    id="search" 
                    name="search" 
                    class="form-input" 
                    placeholder="Cari brand, model, nama..."
                    value="{{ request('search') }}"
                >
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label for="category_id" class="form-label">Kategori</label>
                <select id="category_id" name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label for="price_range" class="form-label">Harga</label>
                <select id="price_range" name="price_range" class="form-select">
                    <option value="">Semua Harga</option>
                    <option value="0-3000000" {{ request('price_range') === '0-3000000' ? 'selected' : '' }}>< 3 Juta</option>
                    <option value="3000000-5000000" {{ request('price_range') === '3000000-5000000' ? 'selected' : '' }}>3-5 Juta</option>
                    <option value="5000000-8000000" {{ request('price_range') === '5000000-8000000' ? 'selected' : '' }}>5-8 Juta</option>
                    <option value="8000000-15000000" {{ request('price_range') === '8000000-15000000' ? 'selected' : '' }}>8-15 Juta</option>
                    <option value="15000000-99999999" {{ request('price_range') === '15000000-99999999' ? 'selected' : '' }}>> 15 Juta</option>
                </select>
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-secondary">🔍</button>
            <a href="{{ route('admin.smartphones.index') }}" class="btn btn-outline">🔄</a>
        </div>
    </form>
</div>

<!-- Tabel Data -->
<div class="table-container">
    @if($smartphones->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Smartphone</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Spesifikasi</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($smartphones as $smartphone)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            @if($smartphone->image_url)
                                <img src="{{ $smartphone->image_url }}" alt="{{ $smartphone->full_name }}" 
                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid var(--gray-200);">
                            @else
                                <div style="width: 50px; height: 50px; background: var(--gray-100); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                                    📱
                                </div>
                            @endif
                            <div>
                                <div style="font-weight: 600; color: var(--gray-900);">{{ $smartphone->full_name }}</div>
                                <div style="color: var(--gray-600); font-size: 14px;">{{ $smartphone->brand }} • {{ $smartphone->model }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="background: var(--light-blue); color: var(--primary-blue); padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                            {{ $smartphone->category->name }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--gray-900);">{{ $smartphone->formatted_price }}</div>
                    </td>
                    <td>
                        <div style="font-size: 13px; color: var(--gray-600);">
                            <div>RAM: {{ $smartphone->ram }}GB • Storage: {{ $smartphone->storage }}GB</div>
                            <div>Battery: {{ $smartphone->battery }}mAh • Camera: {{ $smartphone->camera }}MP</div>
                        </div>
                    </td>
                    <td>
                        @if($smartphone->is_active)
                            <span style="color: var(--success); font-weight: 600; font-size: 14px;">✅ Aktif</span>
                        @else
                            <span style="color: var(--error); font-weight: 600; font-size: 14px;">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.smartphones.show', $smartphone) }}" class="btn btn-sm btn-secondary" title="Detail">👁️</a>
                            <a href="{{ route('admin.smartphones.edit', $smartphone) }}" class="btn btn-sm btn-secondary" title="Edit">✏️</a>
                            <form action="{{ route('admin.smartphones.destroy', $smartphone) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus smartphone ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background: var(--error); color: white;" title="Hapus">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div style="padding: 20px; border-top: 1px solid var(--gray-200);">
            {{ $smartphones->appends(request()->query())->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 60px 20px;">
            <div style="font-size: 64px; margin-bottom: 16px;">📱</div>
            <h3 style="color: var(--gray-600); margin-bottom: 8px;">Belum Ada Smartphone</h3>
            <p style="color: var(--gray-500); margin-bottom: 24px;">Mulai dengan menambahkan smartphone pertama.</p>
            <a href="{{ route('admin.smartphones.create') }}" class="btn btn-primary">+ Tambah Smartphone Pertama</a>
        </div>
    @endif
</div>
@endsection