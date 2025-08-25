@extends('layouts.app')

@section('title', 'Form Rekomendasi - Temukan Smartphone Ideal Anda')

@section('content')
    {{-- <!-- Hero Section Form -->
<section style="background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-dark)); color: white; padding: 60px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 16px;">
                🎯 Temukan Smartphone Ideal Anda
            </h1>
            <p style="font-size: 18px; opacity: 0.9; max-width: 600px; margin: 0 auto;">
                Isi preferensi Anda di bawah ini, dan sistem akan memberikan rekomendasi smartphone terbaik 
                menggunakan algoritma Content-Based Filtering
            </p>
        </div>
    </div>
</section> --}}

    <!-- Form Section -->
    <section style="padding: 60px 0; background: var(--gray-50);">
        <div class="container-sm">
            <div class="card" style="box-shadow: var(--shadow-lg);">
                <div class="card-header" style="text-align: center;">
                    <h2 class="card-title" style="font-size: 24px;">📝 Preferensi Anda</h2>
                    <p class="card-subtitle">Sistem akan menganalisis pilihan Anda untuk memberikan rekomendasi terbaik</p>
                </div>

                <form action="{{ route('recommendation.result') }}" method="POST" id="recommendation-form">
                    @csrf

                    <!-- Step 1: Basic Preferences -->
                    <div class="form-step active" id="step-1">
                        <div style="border-bottom: 1px solid var(--gray-200); margin-bottom: 32px; padding-bottom: 24px;">
                            <h3 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 8px;">
                                Preferensi Dasar
                            </h3>
                            <p style="color: var(--gray-600); font-size: 14px;">Tentukan budget dan kategori penggunaan
                                smartphone</p>
                        </div>

                        <div class="form-group">
                            <label for="price_range" class="form-label">Rentang Harga *</label>
                            <select id="price_range" name="price_range"
                                class="form-select @error('price_range') border-error @enderror" required>
                                <option value="">Pilih rentang harga yang sesuai</option>
                                @foreach ($priceRanges as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old('price_range') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('price_range')
                                <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                            <div style="color: var(--gray-500); font-size: 14px; margin-top: 4px;">
                                Pilih budget yang sesuai dengan kemampuan finansial Anda
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="form-label">Kategori Penggunaan *</label>
                            <div style="color: var(--gray-500); font-size: 14px; margin-top: 4px;">
                                Pilih salah satu kategori sesuai kebutuhan utama Anda
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                                @foreach ($categories as $category)
                                    <label
                                        style="display: flex; align-items: center; gap: 12px; padding: 16px; border: 2px solid var(--gray-200); border-radius: 8px; cursor: pointer; transition: all 0.2s ease;"
                                        class="category-option">
                                        <input type="radio" name="category_id" value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'checked' : '' }}
                                            style="display: none;">
                                        <div class="category-icon" style="font-size: 24px;">
                                            @if ($category->name == 'Gaming')
                                            @elseif($category->name == 'Fotografi')

                                            @elseif($category->name == 'Bisnis')

                                            @elseif($category->name == 'Budget')

                                            @elseif($category->name == 'Flagship')
                                            @else
                                            @endif
                                        </div>
                                        <div>
                                            <div style="font-weight: 600; color: var(--gray-900);">{{ $category->name }}
                                            </div>
                                            <div style="color: var(--gray-600); font-size: 13px;">
                                                {{ Str::limit($category->description, 40) }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('category_id')
                                <div style="color: var(--error); font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Step 2: Technical Specifications -->
                    <div class="form-step" id="step-2" style="display: none;">
                        <div style="border-bottom: 1px solid var(--gray-200); margin-bottom: 32px; padding-bottom: 24px;">
                            <h3 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 8px;">
                                ⚙️ Spesifikasi Teknis
                            </h3>
                            <p style="color: var(--gray-600); font-size: 14px;">Prioritas kebutuhan RAM dan penyimpanan</p>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                            <div class="form-group">
                                <label for="ram_priority" class="form-label">Prioritas RAM</label>
                                <div style="text-align: center; margin-bottom: 16px;">
                                    <div id="ram-priority-display"
                                        style="font-size: 24px; font-weight: 700; color: var(--primary-blue);">3</div>
                                    <div style="font-size: 14px; color: var(--gray-600);">Tingkat Kepentingan</div>
                                </div>
                                <input type="range" id="ram_priority" name="ram_priority"
                                    value="{{ old('ram_priority', 3) }}" min="1" max="5" step="1"
                                    class="priority-slider" oninput="updatePriorityDisplay('ram', this.value)">
                                <div
                                    style="display: flex; justify-content: between; font-size: 12px; color: var(--gray-500); margin-top: 4px;">
                                    <span>1 - Tidak Penting</span>
                                    <span>5 - Sangat Penting</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="storage_priority" class="form-label">Prioritas Storage</label>
                                <div style="text-align: center; margin-bottom: 16px;">
                                    <div id="storage-priority-display"
                                        style="font-size: 24px; font-weight: 700; color: var(--primary-blue);">3</div>
                                    <div style="font-size: 14px; color: var(--gray-600);">Tingkat Kepentingan</div>
                                </div>
                                <input type="range" id="storage_priority" name="storage_priority"
                                    value="{{ old('storage_priority', 3) }}" min="1" max="5" step="1"
                                    class="priority-slider" oninput="updatePriorityDisplay('storage', this.value)">
                                <div
                                    style="display: flex; justify-content: between; font-size: 12px; color: var(--gray-500); margin-top: 4px;">
                                    <span>1 - Tidak Penting</span>
                                    <span>5 - Sangat Penting</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Feature Priorities -->
                    <div class="form-step" id="step-3" style="display: none;">
                        <div style="border-bottom: 1px solid var(--gray-200); margin-bottom: 32px; padding-bottom: 24px;">
                            <h3 style="font-size: 20px; font-weight: 600; color: var(--gray-900); margin-bottom: 8px;">
                                Prioritas Fitur
                            </h3>
                            <p style="color: var(--gray-600); font-size: 14px;">Seberapa penting fitur-fitur berikut untuk
                                Anda?</p>
                        </div>

                        <div style="display: grid; gap: 24px;">
                            @foreach ($specifications as $spec)
                                <div class="feature-priority-card"
                                    style="border: 1px solid var(--gray-200); border-radius: 12px; padding: 20px;">
                                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                                        <div style="font-size: 32px;">
                                            @if ($spec->type == 'camera')
                                                📷
                                            @elseif($spec->type == 'battery')
                                                🔋
                                            @elseif($spec->type == 'performance')
                                                🚀
                                            @elseif($spec->type == 'design')
                                                🎨
                                            @elseif($spec->type == 'connectivity')
                                                📶
                                            @else
                                                ⚙️
                                            @endif
                                        </div>
                                        <div style="flex: 1;">
                                            <h4
                                                style="font-size: 18px; font-weight: 600; color: var(--gray-900); margin-bottom: 4px;">
                                                {{ $spec->name }}
                                            </h4>
                                            <p style="color: var(--gray-600); font-size: 14px;">
                                                {{ $spec->description ?? 'Fitur penting dalam smartphone' }}
                                            </p>
                                        </div>
                                        <div style="text-align: center; min-width: 80px;">
                                            <div id="spec-{{ $spec->id }}-display"
                                                style="font-size: 24px; font-weight: 700; color: var(--primary-blue);">3
                                            </div>
                                            <div style="font-size: 12px; color: var(--gray-600);">Prioritas</div>
                                        </div>
                                    </div>

                                    <input type="range" name="specifications[{{ $spec->id }}]"
                                        value="{{ old('specifications.' . $spec->id, 3) }}" min="1"
                                        max="5" step="1" class="priority-slider" style="width: 100%;"
                                        oninput="updateSpecPriorityDisplay({{ $spec->id }}, this.value)">
                                    <div
                                        style="display: flex; justify-content: between; font-size: 12px; color: var(--gray-500); margin-top: 8px;">
                                        <span>1 - Tidak Penting</span>
                                        <span>3 - Normal</span>
                                        <span>5 - Sangat Penting</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid var(--gray-200);">
                        <div style="display: flex; align-items: center; position: relative; min-height: 60px;">
                            <!-- Previous Button (Left) -->
                            <button type="button" id="prev-btn" class="btn btn-secondary"
                                style="display: none; position: absolute; left: 0;" onclick="prevStep()">
                                ← Sebelumnya
                            </button>

                            <!-- Step Indicator (Center) -->
                            <div style="flex: 1; display: flex; justify-content: center;">
                                <div id="step-indicator"
                                    style="display: flex; gap: 16px; background: var(--gray-50); padding: 12px 24px; border-radius: 30px; border: 1px solid var(--gray-300);">
                                    <div class="step-dot active" data-step="1" title="Preferensi Dasar"></div>
                                    <div class="step-dot" data-step="2" title="Spesifikasi Teknis"></div>
                                    <div class="step-dot" data-step="3" title="Prioritas Fitur"></div>
                                </div>
                            </div>

                            <!-- Next/Submit Button (Right) -->
                            <div style="position: absolute; right: 0;">
                                <button type="button" id="next-btn" class="btn btn-primary" onclick="nextStep()">
                                    Selanjutnya →
                                </button>

                                <button type="submit" id="submit-btn" class="btn btn-primary" style="display: none;">
                                    🔍 Cari Rekomendasi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Progress Preview -->
            <div class="card mt-4" id="progress-preview" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Preview Preferensi Anda</h3>
                </div>

                <div id="preview-content" style="padding: 20px; background: var(--gray-50); border-radius: 8px;">
                    <div id="preview-basic" style="margin-bottom: 16px;"></div>
                    <div id="preview-specs" style="margin-bottom: 16px;"></div>
                    <div id="preview-features"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-css')
    <style>
        /* Custom Styles untuk Form */
        .form-step {
            transition: all 0.3s ease;
        }

        .category-option input[type="radio"]:checked+.category-icon,
        .category-option:has(input[type="radio"]:checked) {
            border-color: var(--primary-blue);
            background: var(--extra-light-blue);
        }

        .priority-slider {
            width: 100%;
            height: 8px;
            border-radius: 5px;
            background: var(--gray-200);
            outline: none;
            -webkit-appearance: none;
        }

        .priority-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary-blue);
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        .priority-slider::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary-blue);
            cursor: pointer;
            border: none;
            box-shadow: var(--shadow);
        }

        .step-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--gray-300);
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .step-dot.active {
            background: var(--primary-blue);
            transform: scale(1.2);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        .step-dot:not(.active):hover {
            background: var(--gray-400);
            transform: scale(1.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #step-indicator {
                padding: 8px 16px !important;
                gap: 12px !important;
            }

            .step-dot {
                width: 12px;
                height: 12px;
            }

            .btn {
                padding: 10px 16px;
                font-size: 14px;
            }
        }

        .feature-priority-card {
            transition: all 0.2s ease;
        }

        .feature-priority-card:hover {
            border-color: var(--primary-blue);
            box-shadow: var(--shadow-md);
        }
    </style>
@endsection

@section('extra-js')
    <script>
        let currentStep = 1;
        const totalSteps = 3;

        function updatePriorityDisplay(type, value) {
            document.getElementById(type + '-priority-display').textContent = value;
            updatePreview();
        }

        function updateSpecPriorityDisplay(specId, value) {
            document.getElementById('spec-' + specId + '-display').textContent = value;
            updatePreview();
        }

        function nextStep() {
            if (currentStep < totalSteps) {
                // Validate current step
                if (validateStep(currentStep)) {
                    document.getElementById('step-' + currentStep).style.display = 'none';
                    currentStep++;
                    document.getElementById('step-' + currentStep).style.display = 'block';
                    updateStepIndicator();
                    updateButtons();
                    updatePreview();
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                document.getElementById('step-' + currentStep).style.display = 'none';
                currentStep--;
                document.getElementById('step-' + currentStep).style.display = 'block';
                updateStepIndicator();
                updateButtons();
            }
        }

        function validateStep(step) {
            if (step === 1) {
                const priceRange = document.getElementById('price_range').value;
                const category = document.querySelector('input[name="category_id"]:checked');

                if (!priceRange) {
                    alert('Silakan pilih rentang harga');
                    return false;
                }
                if (!category) {
                    alert('Silakan pilih kategori penggunaan');
                    return false;
                }
            }
            return true;
        }

        function updateStepIndicator() {
            document.querySelectorAll('.step-dot').forEach((dot, index) => {
                if (index + 1 <= currentStep) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function updateButtons() {
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');

            prevBtn.style.display = currentStep > 1 ? 'block' : 'none';

            if (currentStep === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'block';
            } else {
                nextBtn.style.display = 'block';
                submitBtn.style.display = 'none';
            }
        }

        function updatePreview() {
            const previewDiv = document.getElementById('progress-preview');
            const previewBasic = document.getElementById('preview-basic');
            const previewSpecs = document.getElementById('preview-specs');
            const previewFeatures = document.getElementById('preview-features');

            if (currentStep >= 2) {
                previewDiv.style.display = 'block';

                // Basic info
                const priceRange = document.getElementById('price_range');
                const category = document.querySelector('input[name="category_id"]:checked');

                let basicHtml = '<div style="margin-bottom: 12px;"><strong>Preferensi Dasar:</strong></div>';
                if (priceRange.value) {
                    basicHtml += '<div>💰 Budget: ' + priceRange.options[priceRange.selectedIndex].text + '</div>';
                }
                if (category) {
                    const categoryLabel = category.closest('.category-option').querySelector('div').textContent.trim();
                    basicHtml += '<div>📱 Kategori: ' + categoryLabel + '</div>';
                }
                previewBasic.innerHTML = basicHtml;

                // Specs info
                if (currentStep >= 2) {
                    const ramPriority = document.getElementById('ram_priority').value;
                    const storagePriority = document.getElementById('storage_priority').value;

                    let specsHtml = '<div style="margin-bottom: 12px;"><strong>Spesifikasi Teknis:</strong></div>';
                    specsHtml += '<div>🧠 RAM: Prioritas ' + ramPriority + '/5</div>';
                    specsHtml += '<div>💾 Storage: Prioritas ' + storagePriority + '/5</div>';
                    previewSpecs.innerHTML = specsHtml;
                }

                // Features info
                if (currentStep >= 3) {
                    let featuresHtml = '<div style="margin-bottom: 12px;"><strong>Prioritas Fitur:</strong></div>';
                    document.querySelectorAll('input[name^="specifications"]').forEach(input => {
                        const specName = input.closest('.feature-priority-card').querySelector('h4').textContent
                            .trim();
                        featuresHtml += '<div>' + specName + ': Prioritas ' + input.value + '/5</div>';
                    });
                    previewFeatures.innerHTML = featuresHtml;
                }
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateButtons();

            // Category selection styling
            document.querySelectorAll('.category-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.category-option').forEach(opt => {
                        opt.style.borderColor = 'var(--gray-200)';
                        opt.style.background = 'white';
                    });
                    this.style.borderColor = 'var(--primary-blue)';
                    this.style.background = 'var(--extra-light-blue)';
                    this.querySelector('input').checked = true;
                });
            });

            // Initialize displays
            updatePriorityDisplay('ram', document.getElementById('ram_priority').value);
            updatePriorityDisplay('storage', document.getElementById('storage_priority').value);

            document.querySelectorAll('input[name^="specifications"]').forEach(input => {
                const specId = input.name.match(/\[(\d+)\]/)[1];
                updateSpecPriorityDisplay(specId, input.value);
            });
        });
    </script>
@endsection