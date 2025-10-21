<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .admin-wrapper {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .admin-navbar {
            background-color: #343a40;
        }
        .admin-content {
            padding: 20px;
        }
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
    </style>
    @stack('styles')
</head>
<body>
    @php
        $isLoginPage = false;
        if(isset($_SERVER['REQUEST_URI']) && str_contains($_SERVER['REQUEST_URI'], 'admin/login')) {
            $isLoginPage = true;
        }
    @endphp
    <div class="d-flex">
        @if(!$isLoginPage)
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white p-3" style="min-width:220px; min-height:100vh;">
            <div class="sidebar-header mb-4 d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:40px; width:auto; margin-right:10px;">
                <span class="fs-5 fw-bold">OPSTA Admin</span>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-tags me-2"></i>Categories
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.courses.index') }}">
                        <i class="fas fa-book me-2"></i>Courses
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.galleries.index') }}">
                        <i class="fas fa-images me-2"></i>Gallery
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.faqs.index') }}">
                        <i class="fas fa-question-circle me-2"></i>FAQs
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.user-registrations.index') }}">
                        <i class="fas fa-users me-2"></i>User Registrations
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.testimonials.index') }}">
                        <i class="fas fa-comment-alt me-2"></i>Testimonials
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.offers.index') }}">
                        <i class="fas fa-gift me-2"></i>Offers
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.demo-bookings.index') }}">
                        <i class="fas fa-calendar-check me-2"></i>Demo Bookings
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('admin.course-enrollments.index') }}">
                        <i class="fas fa-user-graduate me-2"></i>Course Enrollments
                    </a>
                </li>
            </ul>
        </nav>
        @endif
        <!-- Main Content -->
        <div class="flex-grow-1">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
