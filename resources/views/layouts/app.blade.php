<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Rekomendasi Smartphone dengan Content-Based Filtering">
    <meta name="author" content="Smart Recommendation System">
    <title>@yield('title', 'Smartphone Recommendation - Temukan HP Ideal Anda')</title>
    
    <!-- CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @yield('extra-css')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="{{ route('home') }}" class="navbar-brand">
                    Rekomendasi Smartphone
                </a>
                
                <ul class="navbar-nav">
                    <li>
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('recommendation.form') }}" class="nav-link {{ request()->routeIs('recommendation.*') ? 'active' : '' }}">
                            Rekomendasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.login') }}" class="nav-link">
                            Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mt-3">
            <div class="alert alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">📱 SmartPhone Rec</div>
                <div class="footer-description">
                    Sistem rekomendasi smartphone cerdas menggunakan algoritma Content-Based Filtering 
                    untuk membantu Anda menemukan perangkat yang tepat sesuai kebutuhan dan preferensi.
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Smartphone Recommendation System. Dibuat dengan menggunakan Laravel & Content-Based Filtering.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('extra-js')
</body>
</html>