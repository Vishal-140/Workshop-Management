@extends('layouts.app')

@section('title', 'Workshop Certificates')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">Workshop Certificates</h1>
            <p class="text-white-50 lead">Download your achievement certificates for completed workshops.</p>
        </div>
    </div>

    @php
        $userName = auth()->user()->name ?? 'John Doe';
        $dummyCertificates = [
            [
                'id' => 1,
                'workshop_title' => 'Web Development Fundamentals',
                'instructor' => 'Rajesh Kumar',
                'completion_date' => now()->subDays(5),
                'status' => 'completed',
                'certificate_id' => 'WD'.now()->format('Ym').'001',
                'skills' => ['HTML5', 'CSS3', 'JavaScript', 'Responsive Design']
            ],
            [
                'id' => 2,
                'workshop_title' => 'Data Science with Python',
                'instructor' => 'Priya Sharma',
                'completion_date' => now()->subDays(10),
                'status' => 'completed',
                'certificate_id' => 'DS'.now()->format('Ym').'002',
                'skills' => ['Python', 'Data Analysis', 'Machine Learning', 'Visualization']
            ],
            [
                'id' => 3,
                'workshop_title' => 'Cloud Architecture',
                'instructor' => 'Amit Patel',
                'completion_date' => null,
                'status' => 'in_progress',
                'certificate_id' => null,
                'progress' => 75,
                'skills' => ['AWS', 'Cloud Infrastructure', 'DevOps']
            ]
        ];
    @endphp

    <div class="row g-4">
        @foreach($dummyCertificates as $cert)
            <div class="col-md-6">
                <div class="card h-100" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1);">
                    <div class="card-header border-bottom p-4" style="background: rgba(99, 102, 241, 0.1); border-color: rgba(99, 102, 241, 0.1);">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle p-2 me-3" style="background: rgba(99, 102, 241, 0.2);">
                                @if($cert['status'] === 'completed')
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 12L11 14L15 10M12 3L4 7V17L12 21L20 17V7L12 3Z" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 8V12M12 16H12.01M12 3L4 7V17L12 21L20 17V7L12 3Z" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <h5 class="text-white mb-1">{{ $cert['workshop_title'] }}</h5>
                                <p class="text-white-50 mb-0">
                                    <span>{{ $cert['instructor'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($cert['status'] === 'completed')
                            <div class="certificate-preview mb-4 p-4 rounded" style="background: rgba(99, 102, 241, 0.05); border: 1px dashed rgba(99, 102, 241, 0.2);">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.5 15.5L6.5 21.5L12 18.5L17.5 21.5V15.5M12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3Z" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <h6 class="text-white mb-1">Certificate of Completion</h6>
                                    <p class="text-white-50 mb-3">This is to certify that</p>
                                    <h5 class="text-white mb-3" style="font-family: 'Playfair Display', serif;">{{ $userName }}</h5>
                                    <p class="text-white-50 mb-3">has successfully completed the workshop on</p>
                                    <h6 class="text-white mb-3">{{ $cert['workshop_title'] }}</h6>
                                    <p class="text-white-50 mb-0">
                                        <small>Certificate ID: {{ $cert['certificate_id'] }}</small>
                                    </p>
                                    <p class="text-white-50">
                                        <small>Issued on {{ $cert['completion_date']->format('F j, Y') }}</small>
                                    </p>
                                </div>
                            </div>
                            <div class="skills mb-4">
                                <h6 class="text-white-50 mb-3 small">Skills Acquired</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($cert['skills'] as $skill)
                                        <span class="badge rounded-pill px-2 py-1" style="background: rgba(99, 102, 241, 0.1); color: #6366F1;">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary" style="background: linear-gradient(145deg, #6366F1, #4F46E5); border: none;">
                                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline;">
                                        <path d="M12 4V16M12 16L7 11M12 16L17 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4 20H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    Download Certificate
                                </button>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <div class="mb-4">
                                    <div class="progress" style="height: 6px; background: rgba(99, 102, 241, 0.1);">
                                        <div class="progress-bar" role="progressbar" 
                                            style="width: {{ $cert['progress'] }}%; background: #6366F1;" 
                                            aria-valuenow="{{ $cert['progress'] }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <p class="text-white-50 mt-2 mb-0">{{ $cert['progress'] }}% Completed</p>
                                </div>
                                <h6 class="text-white mb-3">Workshop in Progress</h6>
                                <p class="text-white-50 mb-4">Complete all sessions to receive your certificate</p>
                                <div class="skills">
                                    <h6 class="text-white-50 mb-3 small">Skills You'll Learn</h6>
                                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                                        @foreach($cert['skills'] as $skill)
                                            <span class="badge rounded-pill px-2 py-1" style="background: rgba(99, 102, 241, 0.1); color: #6366F1;">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
@endpush

@endsection
