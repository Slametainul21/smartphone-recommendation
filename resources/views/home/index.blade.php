@extends('layouts.app')

@section('title', 'Beranda - Temukan Smartphone Ideal Anda')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">
                Temukan Smartphone <br>
                <span style="background: linear-gradient(45deg, #ffffff, #dbeafe); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Ideal Anda
                </span>
            </h1>
            <p class="hero-subtitle">
                Sistem rekomendasi cerdas menggunakan algoritma <strong>Content-Based Filtering</strong> 
                untuk memberikan saran smartphone yang tepat berdasarkan kebutuhan dan preferensi Anda.
            </p>
            <div class="hero-cta">
                <a href="{{ route('recommendation.form') }}" class="btn btn-lg" style="background: white; color: var(--primary-blue);">
                    🚀 Mulai Rekomendasi
                </a>
                <a href="#features" class="btn btn-lg btn-outline" style="color: white; border-color: white;" onclick="smoothScroll('#features')">
                    📖 Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section style="background: white; padding: 40px 0; border-bottom: 1px solid var(--gray-200);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 32px; text-align: center;">
            <div>
                <div style="font-size: 36px; font-weight: 800; color: var(--primary-blue); margin-bottom: 8px;">
                    {{ $totalSmartphones ?? 0 }}+
                </div>
                <div style="color: var(--gray-600); font-weight: 500;">Smartphone</div>
            </div>
            <div>
                <div style="font-size: 36px; font-weight: 800; color: var(--primary-blue); margin-bottom: 8px;">
                    {{ $totalCategories ?? 0 }}
                </div>
                <div style="color: var(--gray-600); font-weight: 500;">Kategori</div>
            </div>
            <div>
                <div style="font-size: 36px; font-weight: 800; color: var(--primary-blue); margin-bottom: 8px;">
                    98%
                </div>
                <div style="color: var(--gray-600); font-weight: 500;">Akurasi</div>
            </div>
            <div>
                <div style="font-size: 36px; font-weight: 800; color: var(--primary-blue); margin-bottom: 8px;">
                    &lt;3s
                </div>
                <div style="color: var(--gray-600); font-weight: 500;">Waktu Proses</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" id="features">
    <div class="container">
        <div class="features-header">
            <h2 class="section-title">Mengapa Pilih Sistem Kami?</h2>
            <p class="section-subtitle">
                Teknologi Content-Based Filtering terdepan untuk rekomendasi smartphone yang akurat dan personal
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card card">
                <div class="feature-icon">🎯</div>
                <h3 class="feature-title">Akurat & Presisi</h3>
                <p class="feature-description">
                    Menggunakan algoritma <strong>Cosine Similarity</strong> untuk menghitung kecocokan 
                    antara preferensi Anda dengan spesifikasi smartphone secara matematis.
                </p>
            </div>
            
            <div class="feature-card card">
                <div class="feature-icon">⚡</div>
                <h3 class="feature-title">Cepat & Real-time</h3>
                <p class="feature-description">
                    Hasil rekomendasi dalam hitungan detik dengan pemrosesan data yang efisien 
                    dan algoritma yang telah dioptimasi.
                </p>
            </div>
            
            <div class="feature-card card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-title">Personal & Adaptif</h3>
                <p class="feature-description">
                    Rekomendasi disesuaikan dengan kebutuhan spesifik Anda berdasarkan prioritas 
                    fitur yang paling penting bagi gaya hidup Anda.
                </p>
            </div>
            
            <div class="feature-card card">
                <div class="feature-icon">🔬</div>
                <h3 class="feature-title">Berbasis Ilmiah</h3>
                <p class="feature-description">
                    Implementasi penelitian Content-Based Filtering dengan normalisasi data 
                    dan pembobotan yang telah teruji secara akademis.
                </p>
            </div>
            
            <div class="feature-card card">
                <div class="feature-icon">💰</div>
                <h3 class="feature-title">Sesuai Budget</h3>
                <p class="feature-description">
                    Filter berdasarkan rentang harga yang sesuai dengan budget Anda, 
                    dari smartphone entry-level hingga flagship premium.
                </p>
            </div>
            
            <div class="feature-card card">
                <div class="feature-icon">🌟</div>
                <h3 class="feature-title">Multi-Kategori</h3>
                <p class="feature-description">
                    Mendukung berbagai kategori penggunaan: Gaming, Fotografi, Bisnis, 
                    Daily Use, dan kebutuhan khusus lainnya.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section style="background: var(--gray-50); padding: 80px 0;">
    <div class="container">
        <div class="features-header">
            <h2 class="section-title">Cara Kerja Sistem</h2>
            <p class="section-subtitle">
                Proses sederhana dalam 3 langkah untuk mendapatkan rekomendasi terbaik
            </p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; margin-top: 64px;">
            <div style="text-align: center;">
                <div style="width: 80px; height: 80px; background: var(--primary-blue); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: bold; margin: 0 auto 24px;">1</div>
                <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 16px; color: var(--gray-900);">Input Preferensi</h3>
                <p style="color: var(--gray-600); line-height: 1.7;">
                    Pilih kategori penggunaan, rentang harga, dan tingkat kepentingan fitur seperti kamera, baterai, performa, dan lainnya.
                </p>
            </div>
            
            <div style="text-align: center;">
                <div style="width: 80px; height: 80px; background: var(--primary-blue); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: bold; margin: 0 auto 24px;">2</div>
                <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 16px; color: var(--gray-900);">Pemrosesan AI</h3>
                <p style="color: var(--gray-600); line-height: 1.7;">
                    Sistem menghitung similarity menggunakan algoritma Cosine Similarity untuk mencocokkan preferensi dengan database smartphone.
                </p>
            </div>
            
            <div style="text-align: center;">
                <div style="width: 80px; height: 80px; background: var(--primary-blue); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: bold; margin: 0 auto 24px;">3</div>
                <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 16px; color: var(--gray-900);">Hasil Rekomendasi</h3>
                <p style="color: var(--gray-600); line-height: 1.7;">
                    Dapatkan daftar smartphone yang paling sesuai dengan kebutuhan Anda, lengkap dengan skor kecocokan dan alasan rekomendasi.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-dark)); color: white; padding: 80px 0;">
    <div class="container" style="text-align: center;">
        <h2 style="font-size: 36px; font-weight: 700; margin-bottom: 16px;">
            Siap Menemukan Smartphone Ideal Anda?
        </h2>
        <p style="font-size: 18px; margin-bottom: 32px; opacity: 0.9;">
            Gunakan sistem rekomendasi kami dan temukan smartphone yang tepat dalam hitungan detik!
        </p>
        <a href="{{ route('recommendation.form') }}" class="btn btn-lg" style="background: white; color: var(--primary-blue); font-size: 18px; padding: 20px 40px;">
            🚀 Mulai Sekarang - Gratis!
        </a>
    </div>
</section>
@endsection