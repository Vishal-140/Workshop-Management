@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="display-5 text-white mb-3">Welcome back, {{ auth()->user()->username }}! 👋</h1>
            <p class="text-white-50 lead mb-0">Access your workshop resources and manage your learning journey all in one place.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle p-3 me-3" style="background-color: rgba(255, 184, 0, 0.1);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8V16M8 12H16" stroke="#FFB800" stroke-width="2" stroke-linecap="round"/>
                                <path d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z" stroke="#FFB800" stroke-width="2"/>
                            </svg>
                        </div>
                        <h5 class="card-title text-white mb-0">Workshop Registration</h5>
                    </div>
                    <p class="card-text text-white-50 mb-4">Browse our curated collection of workshops designed to enhance your skills. Register for upcoming sessions and start your learning journey.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('workshop.list') }}" class="btn btn-primary px-4" style="background-color: #FFB800; border: none;">View Workshops</a>
                        <span class="text-white-50">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle p-3 me-3" style="background-color: rgba(255, 184, 0, 0.1);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 19.5V4.5C4 3.67157 4.67157 3 5.5 3H18.5C19.3284 3 20 3.67157 20 4.5V19.5C20 20.3284 19.3284 21 18.5 21H5.5C4.67157 21 4 20.3284 4 19.5Z" stroke="#FFB800" stroke-width="2"/>
                                <path d="M8 7H16M8 12H16M8 17H12" stroke="#FFB800" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h5 class="card-title text-white mb-0">Workshop Materials</h5>
                    </div>
                    <p class="card-text text-white-50 mb-4">Access comprehensive learning materials, presentations, and resources for your registered workshops. Download and study at your own pace.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('materials.list') }}" class="btn btn-primary px-4" style="background-color: #FFB800; border: none;">View Materials</a>
                        <span class="text-white-50">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle p-3 me-3" style="background-color: rgba(255, 184, 0, 0.1);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12L11 14L15 10M12 3L4 7V17L12 21L20 17V7L12 3Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h5 class="card-title text-white mb-0">Certificates</h5>
                    </div>
                    <p class="card-text text-white-50 mb-4">Track your progress and download certificates for completed workshops. Showcase your achievements and validate your learning journey.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('certificate.view') }}" class="btn btn-primary px-4" style="background-color: #FFB800; border: none;">View Certificates</a>
                        <span class="text-white-50">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle p-3 me-3" style="background-color: rgba(255, 184, 0, 0.1);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8V12M12 16H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h5 class="card-title text-white mb-0">Need Help?</h5>
                    </div>
                    <p class="card-text text-white-50">Having trouble with registration or accessing materials? Our support team is here to help. Contact us through the support portal or email us at support@workshops.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
