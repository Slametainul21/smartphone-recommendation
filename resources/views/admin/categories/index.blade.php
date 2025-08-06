@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<!-- Header dengan Search dan Filter -->
<div class="card mb-4">
    <div style="display: flex; justify-content: between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">
                Daftar Kategori Smartphone
            </h2>
            <p style="color: var(--gray-600); font-size: 14px;">
                Kelola kategori penggunaan smartphone ({{ $categories->total() }} kategori)
            </p>
        </div>
        
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>
</div>

<!-- Search dan Filter -->
<div class="card mb-4">
    <form method="GET" action="{{ route('admin.categories.index') }}">
        <div style="display: grid; grid-template-columns: 1fr 200px 150px 120px; gap: 16px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="search" class="form-label">Pencarian</label>
                <input 
                    type="text" 
                    id="search" 
                    name="search" 
                    class="form-input" 
                    placeholder="Cari nama atau deskripsi..."
                    value="{{ request('search') }}"
                >
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-secondary">
                🔍 Cari
            </button>
            
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
                🔄 Reset
            </a>
        </div>
    </form>
</div>

<!-- Tabel Data -->
<div class="table-container">
    @if($categories->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah HP</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>
                        <div style="font-weight: 600; color: var(--gray-900);">{{ $category->name }}</div>
                    </td>
                    <td>
                        <div style="color: var(--gray-600); font-size: 14px;">
                            {{ Str::limit($category->description ?? 'Tidak ada deskripsi', 50) }}
                        </div>
                    </td>
                    <td>
                        <span class="badge" style="background: var(--light-blue); color: var(--primary-blue); padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                            {{ $category->smartphones_count ?? 0 }} HP
                        </span>
                    </td>
                    <td>
                        @if($category->is_active)
                            <span style="color: var(--success); font-weight: 600; font-size: 14px;">✅ Aktif</span>
                        @else
                            <span style="color: var(--error); font-weight: 600; font-size: 14px;">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td style="color: var(--gray-600); font-size: 14px;">
                        {{ $category->created_at->format('d M Y') }}
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-secondary" title="Lihat Detail">
                                👁️
                            </a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-secondary" title="Edit">
                                ✏️
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background: var(--error); color: white;" title="Hapus">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div style="padding: 20px; border-top: 1px solid var(--gray-200);">
            {{ $categories->appends(request()->query())->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 60px 20px;">
            <div style="font-size: 64px; margin-bottom: 16px;">📂</div>
            <h3 style="color: var(--gray-600); margin-bottom: 8px;">Belum Ada Kategori</h3>
            <p style="color: var(--gray-500); margin-bottom: 24px;">
                Mulai dengan menambahkan kategori smartphone pertama Anda.
            </p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                + Tambah Kategori Pertama
            </a>
        </div>
    @endif
</div>
@endsection