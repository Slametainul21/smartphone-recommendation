@extends('layouts.admin')

@section('title', 'Kelola Spesifikasi')
@section('page-title', 'Kelola Spesifikasi')

@section('content')
<div class="card mb-4">
    <div style="display: flex; justify-content: between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">
                Kelola Spesifikasi & Bobot
            </h2>
            <p style="color: var(--gray-600); font-size: 14px;">
                Atur spesifikasi dan bobot untuk algoritma rekomendasi ({{ $specifications->total() }} spesifikasi)
            </p>
        </div>
        
        <a href="{{ route('admin.specifications.create') }}" class="btn btn-primary">
            + Tambah Spesifikasi
        </a>
    </div>
</div>

<div class="table-container">
    @if($specifications->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Spesifikasi</th>
                    <th>Tipe</th>
                    <th>Bobot</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($specifications as $spec)
                <tr>
                    <td>
                        <div style="font-weight: 600; color: var(--gray-900);">{{ $spec->name }}</div>
                    </td>
                    <td>
                        @php
                            $typeIcons = [
                                'performance' => '🚀',
                                'camera' => '📷',
                                'battery' => '🔋',
                                'design' => '🎨',
                                'connectivity' => '📶'
                            ];
                            $typeNames = [
                                'performance' => 'Performa',
                                'camera' => 'Kamera',
                                'battery' => 'Baterai',
                                'design' => 'Desain',
                                'connectivity' => 'Konektivitas'
                            ];
                        @endphp
                        <span style="display: inline-flex; align-items: center; gap: 4px;">
                            {{ $typeIcons[$spec->type] ?? '⚙️' }}
                            {{ $typeNames[$spec->type] ?? $spec->type }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="background: var(--gray-200); border-radius: 4px; height: 8px; width: 60px; overflow: hidden;">
                                <div style="background: var(--primary-blue); height: 100%; width: {{ $spec->weight * 100 }}%;"></div>
                            </div>
                            <span style="font-weight: 600; color: var(--primary-blue);">{{ number_format($spec->weight * 100, 0) }}%</span>
                        </div>
                    </td>
                    <td>
                        <div style="color: var(--gray-600); font-size: 14px;">
                            {{ Str::limit($spec->description ?? 'Tidak ada deskripsi', 40) }}
                        </div>
                    </td>
                    <td>
                        @if($spec->is_active)
                            <span style="color: var(--success); font-weight: 600;">✅ Aktif</span>
                        @else
                            <span style="color: var(--error); font-weight: 600;">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.specifications.edit', $spec) }}" class="btn btn-sm btn-secondary">✏️</a>
                            <form action="{{ route('admin.specifications.destroy', $spec) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus spesifikasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background: var(--error); color: white;">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="padding: 20px; border-top: 1px solid var(--gray-200);">
            {{ $specifications->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 60px 20px;">
            <div style="font-size: 64px; margin-bottom: 16px;">⚙️</div>
            <h3 style="color: var(--gray-600); margin-bottom: 8px;">Belum Ada Spesifikasi</h3>
            <p style="color: var(--gray-500); margin-bottom: 24px;">Tambahkan spesifikasi untuk algoritma rekomendasi.</p>
            <a href="{{ route('admin.specifications.create') }}" class="btn btn-primary">➕ Tambah Spesifikasi Pertama</a>
        </div>
    @endif
</div>

<!-- Info Bobot -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">ℹ️ Informasi Bobot Algoritma</h3>
    </div>
    
    <div style="background: var(--light-blue); padding: 16px; border-radius: 8px; color: var(--gray-700);">
        <div style="margin-bottom: 12px;"><strong>Cara Kerja Bobot:</strong></div>
        <ul style="margin-left: 20px; line-height: 1.8;">
            <li>Bobot 0% = Spesifikasi tidak berpengaruh dalam rekomendasi</li>
            <li>Bobot 50% = Spesifikasi berpengaruh sedang</li>
            <li>Bobot 100% = Spesifikasi sangat berpengaruh dalam rekomendasi</li>
            <li>Total bobot tidak harus 100%, sistem akan menormalisasi otomatis</li>
        </ul>
    </div>
</div>
@endsection