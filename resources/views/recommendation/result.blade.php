@extends('layouts.app')

@section('title', 'Hasil Rekomendasi - Smartphone Ideal Anda')

@section('content')
<!-- Hero Results Section -->
<section style="background: linear-gradient(135deg, var(--success), #10b981); color: white; padding: 60px 0;">
    <div class="container">
        <div style="text-align: center;">
            <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 16px;">
                🎉 Rekomendasi Smartphone Untuk Anda!
            </h1>
            <p style="font-size: 18px; opacity: 0.9; margin-bottom: 24px;">
                Berdasarkan preferensi Anda, kami menemukan {{ $recommendations->count() }} smartphone yang cocok
            </p>
            <div style="background: rgba(255,255,255,0.2); border-radius: 12px; padding: 16px; display: inline-block;">
                <div style="font-size: 14px; opacity: 0.9; margin-bottom: 4px;">Diproses menggunakan</div>
                <div style="font-size: 18px; font-weight: 600;">Content-Based Filtering Algorithm</div>
            </div>
        </div>
    </div>
</section>

<!-- Results Section -->
<section style="padding: 60px 0;">
    <div class="container">
        @if($recommendations->count() > 0)
            <!-- Summary Info -->
            <div class="card mb-4" style="background: var(--extra-light-blue); border: 1px solid var(--light-blue);">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="font-size: 48px;">🎯</div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 600; color: var(--primary-blue); margin-bottom: 4px;">
                            Pencarian Berhasil!
                        </h3>
                        <p style="color: var(--gray-700); margin-bottom: 8px;">
                            Ditemukan {{ $recommendations->count() }} smartphone yang sesuai dengan kriteria Anda
                        </p>
                        <div style="display: flex; gap: 16px; font-size: 14px; color: var(--gray-600);">
                            <span>📱 Kategori: {{ $request->category_id ? \App\Models\Category::find($request->category_id)->name : 'Semua' }}</span>
                            <span>💰 Budget: {{ $priceRanges[$request->price_range] ?? 'Custom' }}</span>
                            <span>⚡ Algoritma: Cosine Similarity</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ranking Results -->
            <div style="display: grid; gap: 24px;">
                @foreach($recommendations as $index => $recommendation)
                    @php $smartphone = $recommendation['smartphone']; @endphp
                    <div class="card recommendation-card" style="position: relative; overflow: hidden; transition: all 0.3s ease;">
                        <!-- Ranking Badge -->
                        <div style="position: absolute; top: -8px; left: -8px; background: var(--primary-blue); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px; box-shadow: var(--shadow-md);">
                            {{ $index + 1 }}
                        </div>

                        <!-- Similarity Score Bar -->
                        <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: var(--gray-200);">
                            <div style="height: 100%; width: {{ $recommendation['similarity_percentage'] }}%; background: linear-gradient(90deg, var(--success), var(--primary-blue)); transition: width 1s ease;"></div>
                        </div>

                        <div style="display: flex; gap: 24px; align-items: start; padding: 24px; padding-top: 32px;">
                            <!-- Smartphone Image -->
                            <div style="flex-shrink: 0;">
                                @if($smartphone->image_url)
                                    <img src="{{ $smartphone->image_url }}" alt="{{ $smartphone->full_name }}" 
                                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 1px solid var(--gray-200);">
                                @else
                                    <div style="width: 120px; height: 120px; background: var(--gray-100); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 48px;">
                                        📱
                                    </div>
                                @endif
                            </div>

                            <!-- Smartphone Info -->
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 12px;">
                                    <div>
                                        <h3 style="font-size: 24px; font-weight: 700; color: var(--gray-900); margin-bottom: 4px;">
                                            {{ $smartphone->full_name }}
                                        </h3>
                                        <div style="display: flex; gap: 8px; margin-bottom: 8px;">
                                            <span style="background: var(--light-blue); color: var(--primary-blue); padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                                {{ $smartphone->category->name }}
                                            </span>
                                            <span style="background: var(--gray-100); color: var(--gray-700); padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                                {{ $smartphone->brand }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Similarity Score -->
                                    <div style="text-align: center; background: var(--success); color: white; padding: 12px; border-radius: 12px; min-width: 100px;">
                                        <div style="font-size: 24px; font-weight: 700;">{{ $recommendation['similarity_percentage'] }}%</div>
                                        <div style="font-size: 12px; opacity: 0.9;">Kecocokan</div>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div style="font-size: 20px; font-weight: 700; color: var(--primary-blue); margin-bottom: 16px;">
                                    {{ $smartphone->formatted_price }}
                                </div>

                                <!-- Specs Grid -->
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 16px; margin-bottom: 16px;">
                                    <div style="text-align: center; padding: 12px; background: var(--gray-50); border-radius: 8px;">
                                        <div style="font-size: 20px; margin-bottom: 4px;">🧠</div>
                                        <div style="font-weight: 600; color: var(--gray-900);">{{ $smartphone->ram }} GB</div>
                                        <div style="font-size: 12px; color: var(--gray-600);">RAM</div>
                                    </div>
                                    
                                    <div style="text-align: center; padding: 12px; background: var(--gray-50); border-radius: 8px;">
                                        <div style="font-size: 20px; margin-bottom: 4px;">💾</div>
                                        <div style="font-weight: 600; color: var(--gray-900);">{{ $smartphone->storage }} GB</div>
                                        <div style="font-size: 12px; color: var(--gray-600);">Storage</div>
                                    </div>
                                    
                                    <div style="text-align: center; padding: 12px; background: var(--gray-50); border-radius: 8px;">
                                        <div style="font-size: 20px; margin-bottom: 4px;">🔋</div>
                                        <div style="font-weight: 600; color: var(--gray-900);">{{ $smartphone->battery }} mAh</div>
                                        <div style="font-size: 12px; color: var(--gray-600);">Baterai</div>
                                    </div>
                                    
                                    <div style="text-align: center; padding: 12px; background: var(--gray-50); border-radius: 8px;">
                                        <div style="font-size: 20px; margin-bottom: 4px;">📷</div>
                                        <div style="font-weight: 600; color: var(--gray-900);">{{ $smartphone->camera }} MP</div>
                                        <div style="font-size: 12px; color: var(--gray-600);">Kamera</div>
                                    </div>
                                </div>

                                <!-- Why Recommended -->
                                <div style="background: var(--extra-light-blue); padding: 16px; border-radius: 8px; border-left: 4px solid var(--primary-blue);">
                                    <div style="font-weight: 600; color: var(--primary-blue); margin-bottom: 8px;">
                                        🤔 Mengapa Direkomendasikan?
                                    </div>
                                    <div style="color: var(--gray-700); font-size: 14px; line-height: 1.6;">
                                        @if($recommendation['similarity_percentage'] >= 90)
                                            <strong>Perfect Match!</strong> Smartphone ini hampir sempurna sesuai dengan semua kriteria yang Anda inginkan.
                                        @elseif($recommendation['similarity_percentage'] >= 80)
                                            <strong>Excellent Match!</strong> Smartphone ini sangat sesuai dengan mayoritas kriteria Anda.
                                        @elseif($recommendation['similarity_percentage'] >= 70)
                                            <strong>Good Match!</strong> Smartphone ini cukup sesuai dengan kebutuhan utama Anda.
                                        @else
                                            <strong>Fair Match!</strong> Smartphone ini memenuhi beberapa kriteria penting Anda.
                                        @endif
                                        
                                        Cocok untuk kategori <strong>{{ $smartphone->category->name }}</strong> dengan spek yang seimbang.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <!-- No Results -->
            <div style="text-align: center; padding: 80px 20px;">
                <div style="font-size: 80px; margin-bottom: 24px;">😔</div>
                <h2 style="font-size: 28px; font-weight: 700; color: var(--gray-700); margin-bottom: 16px;">
                    Tidak Ada Hasil yang Sesuai
                </h2>
                <p style="color: var(--gray-600); font-size: 18px; margin-bottom: 32px; max-width: 500px; margin-left: auto; margin-right: auto;">
                    Maaf, tidak ada smartphone yang sesuai dengan kriteria Anda saat ini. 
                    Coba ubah preferensi atau rentang harga untuk hasil yang lebih baik.
                </p>
                <a href="{{ route('recommendation.form') }}" class="btn btn-primary btn-lg">
                    🔄 Coba Lagi dengan Kriteria Lain
                </a>
            </div>
        @endif

        <!-- Action Buttons -->
        @if($recommendations->count() > 0)
            <div style="text-align: center; margin-top: 48px; padding: 32px; background: var(--gray-50); border-radius: 12px;">
                <h3 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 16px;">
                    Sudah Menemukan yang Cocok?
                </h3>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('recommendation.form') }}" class="btn btn-outline">
                        🔄 Cari dengan Kriteria Baru
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        🏠 Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('extra-css')
<style>
.recommendation-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.recommendation-card:nth-child(1) {
    border: 2px solid var(--success);
}

.recommendation-card:nth-child(2) {
    border: 2px solid var(--primary-blue);
}

.recommendation-card:nth-child(3) {
    border: 2px solid var(--warning);
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.recommendation-card {
    animation: slideInUp 0.6s ease forwards;
}

.recommendation-card:nth-child(1) { animation-delay: 0.1s; }
.recommendation-card:nth-child(2) { animation-delay: 0.2s; }
.recommendation-card:nth-child(3) { animation-delay: 0.3s; }
</style>
@endsection

@section('extra-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate similarity bars
    setTimeout(() => {
        document.querySelectorAll('.recommendation-card').forEach((card, index) => {
            const bar = card.querySelector('[style*="width:"]');
            if (bar) {
                bar.style.width = bar.style.width; // Trigger animation
            }
        });
    }, 500);
    
    // Add click tracking for recommendations
    document.querySelectorAll('.recommendation-card').forEach((card, index) => {
        card.addEventListener('click', function() {
            console.log('User clicked recommendation #' + (index + 1));
            // Add analytics tracking here if needed
        });
    });
});
</script>
@endsection