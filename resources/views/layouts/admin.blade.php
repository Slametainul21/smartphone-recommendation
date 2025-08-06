<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Smartphone Recommendation')</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @yield('extra-css')
</head>

<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                Admin Panel
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.smartphones.index') }}"
                    class="sidebar-nav-item {{ request()->routeIs('admin.smartphones.*') ? 'active' : '' }}">
                    Smartphones
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="sidebar-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    Kategori
                </a>
                <a href="{{ route('admin.specifications.index') }}"
                    class="sidebar-nav-item {{ request()->routeIs('admin.specifications.*') ? 'active' : '' }}">
                    Spesifikasi
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Header -->
            <header class="admin-header">
                <div>
                    <h1 style="font-size: 24px; font-weight: 600; color: var(--gray-900);">
                        @yield('page-title', 'Dashboard')
                    </h1>
                </div>

                <div style="display: flex; align-items: center; gap: 16px;">
                    <span style="color: var(--gray-600);">
                        Selamat datang, <strong>{{ session('admin_name', 'Admin') }}</strong>
                    </span>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-secondary">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Alert Messages -->
            @if (session('success'))
                <div class="admin-content" style="padding-top: 16px; padding-bottom: 0;">
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="admin-content" style="padding-top: 16px; padding-bottom: 0;">
                    <div class="alert alert-error">
                        ❌ {{ session('error') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="admin-content" style="padding-top: 16px; padding-bottom: 0;">
                    <div class="alert alert-error">
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin: 8px 0 0 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    @yield('extra-js')
</body>

</html>
