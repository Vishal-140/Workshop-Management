<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop Management - @yield('title')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #141B2A;
        }
        .content-wrapper {
            flex: 1 0 auto;
            width: 100%;
            min-height: calc(100vh - 80px - 450px); /* viewport height - (navbar height + footer height) */
        }
        .navbar {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            height: 80px;
            background: linear-gradient(145deg, #1a1f2e, #1d2433);
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        }
        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 600;
            letter-spacing: -0.5px;
            color: #fff !important;
        }
        .nav-link {
            font-size: 0.95rem;
            padding: 0.5rem 1.2rem !important;
            transition: all 0.2s ease;
            border-radius: 6px;
            color: rgba(255, 255, 255, 0.7) !important;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #6366F1 !important;
        }
        .navbar-nav {
            gap: 0.3rem;
        }
        .footer {
            flex-shrink: 0;
            background-color: #1B2231;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 3rem 0;
        }
        .footer-heading {
            color: #FFB800;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }
        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.95rem;
            display: block;
            margin-bottom: 0.7rem;
            transition: all 0.2s ease;
        }
        .footer-link:hover {
            color: #FFB800;
        }
        .footer-social {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 184, 0, 0.1);
            color: #FFB800;
            margin-right: 0.8rem;
            transition: all 0.2s ease;
        }
        .footer-social:hover {
            background: #FFB800;
            color: #1B2231;
        }
        .footer-bottom {
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #1B2231;">
        <div class="container">
            <a class="navbar-brand text-white d-flex align-items-center" href="{{ route('home') }}">
                <svg width="24" height="24" class="me-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17L12 22L22 17" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 12L12 17L22 12" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Workshop Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    style="border-color: rgba(255, 255, 255, 0.1);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item {{ request()->routeIs('workshop.list') ? 'active' : '' }}">
                            <a class="nav-link text-white" href="{{ route('workshop.list') }}">Workshop Registration</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('materials.list') ? 'active' : '' }}">
                            <a class="nav-link text-white" href="{{ route('materials.list') }}">Workshop Materials</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('attendance.view') ? 'active' : '' }}">
                            <a class="nav-link text-white" href="{{ route('attendance.view') }}">Attendance View</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('certificate.view') ? 'active' : '' }}">
                            <a class="nav-link text-white" href="{{ route('certificate.view') }}">Download Certificate</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('feedback.*') ? 'active' : '' }}">
                            <a class="nav-link text-white" href="{{ route('feedback.index') }}">Feedback</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link text-white d-flex align-items-center" href="{{ route('logout') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Logout
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-4">
                        <svg width="32" height="32" class="me-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 17L12 22L22 17" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 12L12 17L22 12" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <h5 class="text-white mb-0">Workshop Management</h5>
                    </div>
                    <p class="text-white-50 mb-4">Empowering learners through comprehensive workshop management and certification tracking.</p>
                    <div class="d-flex">
                        <a href="#" class="footer-social"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="footer-social"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2 mb-4 mb-lg-0">
                    <h6 class="footer-heading">Quick Links</h6>
                    <a href="{{ route('workshop.list') }}" class="footer-link">Workshops</a>
                    <a href="{{ route('materials.list') }}" class="footer-link">Materials</a>
                    <a href="{{ route('attendance.view') }}" class="footer-link">Attendance</a>
                    <a href="{{ route('certificate.view') }}" class="footer-link">Certificates</a>
                    <a href="{{ route('feedback.index') }}" class="footer-link">Feedback</a>
                </div>
                <div class="col-6 col-lg-3 mb-4 mb-lg-0">
                    <h6 class="footer-heading">Resources</h6>
                    <a href="#" class="footer-link">Documentation</a>
                    <a href="#" class="footer-link">FAQs</a>
                    <a href="#" class="footer-link">Support Center</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                </div>
                <div class="col-lg-3">
                    <h6 class="footer-heading">Contact Us</h6>
                    <p class="text-white-50 mb-2">Have questions? We're here to help!</p>
                    <p class="text-white-50 mb-0">
                        <i class="fas fa-envelope me-2 text-warning"></i>
                        support@workshops.com
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-phone me-2 text-warning"></i>
                        9452xxxxxxx
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="text-white-50 mb-0">&copy; {{ date('Y') }} Workshop Management. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <a href="#" class="footer-link d-inline-block me-3 mb-0">Privacy Policy</a>
                        <a href="#" class="footer-link d-inline-block mb-0">Terms of Use</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
