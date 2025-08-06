@extends('layouts.admin')

@section('title', 'Detail Spesifikasi')
@section('page-title', 'Detail Spesifikasi')

@section('content')
<!-- Header Info -->
<div class="card mb-4">
    <div style="display: flex; align-items: start; gap: 20px;">
        @php
            $typeIcons = [
                'performance' => '🚀',
                'camera' => '📷', 
                'battery' => '🔋',
                'design' => '🎨',
                'connectivity' => '📶'
            ];
            $typeNames = [
                'performance' => 'Performance',
                'camera' => 'Camera',
                'battery' => 'Battery', 
                'design' => 'Design',
                'connectivity' => 'Connectivity'
            ];
        @endphp
        
        <div style="font-size: 64px;">
            {{ $typeIcons[$specification->type] ?? '⚙️' }}
        </div>
        
        <div style="flex: 1;">
            <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 16px;">
                <div>
                    <h1 style="font-size: 28px; font-weight: 700; color: var(--gray-900); margin-bottom: 8px;">
                        {{ $specification->name }}
                        @if($specification->is_active)
                            <span style="color: var(--success); font-size: 20px;">✅</span>
                        @else
                            <span style="color: var(--error); font-size: 20px;">❌</span>
                        @endif
                    </h1>
                    <div style="display: flex; gap: 12px; margin-bottom: 12px;">
                        <span style="background: var(--light-blue); color: var(--primary-blue); padding: 6px 12px; border-radius: 6px; font-size: 14px; font-weight: 600;">
                            {{ $typeNames[$specification->type] ?? $specification->type }}
                        </span>
                        <span style="background: var(--gray-100); color: var(--gray-700); padding: 6px 12px; border-radius: 6px; font-size: 14px;">
                            ID: {{ $specification->id }}
                        </span>
                    </div>
                </div>
                
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('admin.specifications.edit', $specification) }}" class="btn btn-primary">✏️ Edit</a>
                    <a href="{{ route('admin.specifications.index') }}" class="btn btn-secondary">← Kembali</a>
                </div>
            </div>
            
            @if($specification->description)
                <p style="color: var(--gray-600); line-height: 1.6; margin-bottom: 16px;">{{ $specification->description }}</p>
            @else
                <p style="color: var(--gray-500); font-style: italic; margin-bottom: 16px;">Tidak ada deskripsi.</p>
            @endif
            
            <div style="display: flex; gap: 16px; font-size: 14px; color: var(--gray-500);">
                <span>📅 Dibuat: {{ $specification->created_at->format('d M Y H:i') }}</span>
                <span>🔄 Diperbarui: {{ $specification->updated_at->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Bobot Algoritma -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">⚖️ Bobot dalam Algoritma</h2>
        <p class="card-subtitle">Pengaruh spesifikasi ini dalam sistem rekomendasi</p>
    </div>
    
    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 24px;">
        <div style="flex: 1;">
            <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 8px;">
                <span style="font-weight: 600; color: var(--gray-700);">Bobot Spesifikasi</span>
                <span style="font-size: 24px; font-weight: 700; color: var(--primary-blue);">
                    {{ number_format($specification->weight * 100, 1) }}%
                </span>
            </div>
            <div style="background: var(--gray-200); border-radius: 8px; height: 12px; overflow: hidden;">
                <div style="background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-light)); height: 100%; width: {{ $specification->weight * 100 }}%; transition: width 0.3s ease;"></div>
            </div>
        </div>
    </div>
    
    <div style="background: var(--extra-light-blue); padding: 16px; border-radius: 8px; color: var(--gray-700);">
        <div style="margin-bottom: 8px;"><strong>Interpretasi Bobot:</strong></div>
        @if($specification->weight >= 0.8)
            <p>🔥 <strong>Sangat Tinggi</strong> - Spesifikasi ini memiliki pengaruh dominan dalam rekomendasi</p>
        @elseif($specification->weight >= 0.6)
            <p>📈 <strong>Tinggi</strong> - Spesifikasi ini sangat berpengaruh dalam hasil rekomendasi</p>
        @elseif($specification->weight >= 0.4)
            <p>📊 <strong>Sedang</strong> - Spesifikasi ini cukup berpengaruh dalam algoritma</p>
        @elseif($specification->weight >= 0.2)
            <p>📉 <strong>Rendah</strong> - Spesifikasi ini sedikit berpengaruh dalam rekomendasi</p>
        @else
            <p>⚪ <strong>Sangat Rendah</strong> - Spesifikasi ini hampir tidak berpengaruh</p>
        @endif
    </div>
</div>

<!-- Statistik Penggunaan -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">📊 Statistik Spesifikasi</h2>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px;">
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">⚖️</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--primary-blue); margin-bottom: 4px;">
                {{ number_format($specification->weight, 3) }}
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Bobot Desimal</div>
        </div>
        
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">📈</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--success); margin-bottom: 4px;">
                {{ number_format($specification->weight * 100, 1) }}%
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Persentase</div>
        </div>
        
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">🎯</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--warning); margin-bottom: 4px;">
                @if($specification->is_active) Aktif @else Nonaktif @endif
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Status</div>
        </div>
        
        <div style="text-align: center; padding: 20px; background: var(--gray-50); border-radius: 8px;">
            <div style="font-size: 32px; margin-bottom: 8px;">📅</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--gray-700); margin-bottom: 4px;">
                {{ $specification->created_at->diffForHumans() }}
            </div>
            <div style="color: var(--gray-600); font-size: 14px;">Dibuat</div>
        </div>
    </div>
</div>

<!-- Info Algoritma -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">🧠 Dampak pada Algoritma</h2>
    </div>
    
    <div style="background: var(--gray-50); padding: 20px; border-radius: 8px;">
        <h4 style="color: var(--gray-900); margin-bottom: 16px;">Cara Spesifikasi Ini Bekerja:</h4>
        
        <div style="display: grid; gap: 16px;">
            <div style="display: flex; align-items: start; gap: 12px;">
                <div style="background: var(--primary-blue); color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; flex-shrink: 0;">1</div>
                <div>
                    <div style="font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">Input Pengguna</div>
                    <div style="color: var(--gray-600); font-size: 14px;">Pengguna memberikan rating 1-5 untuk kepentingan {{ $specification->name }}</div>
                </div>
            </div>
            
            <div style="display: flex; align-items: start; gap: 12px;">
                <div style="background: var(--primary-blue); color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; flex-shrink: 0;">2</div>
                <div>
                    <div style="font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">Pembobotan</div>
                    <div style="color: var(--gray-600); font-size: 14px;">Rating dikali dengan bobot {{ $specification->weight }} ({{ number_format($specification->weight * 100, 1) }}%)</div>
                </div>
            </div>
            
            <div style="display: flex; align-items: start; gap: 12px;">
                <div style="background: var(--primary-blue); color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; flex-shrink: 0;">3</div>
                <div>
                    <div style="font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">Perhitungan Similarity</div>
                    <div style="color: var(--gray-600); font-size: 14px;">Cosine Similarity menghitung kecocokan dengan smartphone yang tersedia</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Actions -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">🚀 Aksi Cepat</h2>
    </div>
    
    <div style="display: flex; gap: 16px; flex-wrap: wrap;">
        <a href="{{ route('admin.specifications.edit', $specification) }}" class="btn btn-primary">
            ✏️ Edit Spesifikasi
        </a>
        <a href="{{ route('admin.specifications.create') }}" class="btn btn-secondary">
            + Tambah Spesifikasi Baru
        </a>
        <a href="{{ route('admin.specifications.index') }}" class="btn btn-outline">
            📋 Lihat Semua Spesifikasi
        </a>
        <form action="{{ route('admin.specifications.destroy', $specification) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus spesifikasi ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" style="background: var(--error); color: white;">
                🗑️ Hapus Spesifikasi
            </button>
        </form>
    </div>
</div>
@endsection