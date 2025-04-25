@extends('layouts.app')

@section('title', 'Workshop Registration')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">Workshop Registration</h1>
            <p class="text-white-50 lead">Browse and register for upcoming workshops to enhance your skills.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(16, 185, 129, 0.1); border: none; color: #10B981;">
            <div class="d-flex align-items-center">
                <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1) brightness(200%);"></button>
        </div>
    @endif

    @if($workshops->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-6 text-center py-5">
                <div class="card" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div class="card-body p-4">
                        <div class="rounded-circle mx-auto mb-4" style="width: 60px; height: 60px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center;">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15H8M12 11H8M12 7H8M16 15H16.01M16 11H16.01M16 7H16.01" stroke="#6366F1" stroke-width="2" stroke-linecap="round"/>
                                <path d="M5 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3Z" stroke="#6366F1" stroke-width="2"/>
                            </svg>
                        </div>
                        <h4 class="text-white mb-3">No Workshops Available</h4>
                        <p class="text-white-50">Check back later for upcoming workshops.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($workshops as $workshop)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                        <div class="card-header border-bottom p-3" style="background: rgba(99, 102, 241, 0.1); border-color: rgba(99, 102, 241, 0.1);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge rounded-pill px-2 py-1" style="background: {{ $workshop->level === 'Beginner' ? 'rgba(16, 185, 129, 0.1)' : ($workshop->level === 'Intermediate' ? 'rgba(99, 102, 241, 0.1)' : 'rgba(236, 72, 153, 0.1)') }}; color: {{ $workshop->level === 'Beginner' ? '#10B981' : ($workshop->level === 'Intermediate' ? '#6366F1' : '#EC4899') }}; font-weight: 500;">
                                    {{ $workshop->level }}
                                </span>
                            </div>
                            <h5 class="text-white mb-0">{{ $workshop->title }}</h5>
                        </div>
                        <div class="card-body p-3 d-flex flex-column" style="height: 100%;">
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle p-1 me-2" style="background: rgba(99, 102, 241, 0.1);">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 7V3M16 7V3M7 11H17M5 21H19C20.1046 21 21 20.1046 21 19V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V19C3 20.1046 3.89543 21 5 21Z" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span class="text-white-50">{{ $workshop->date->format('F j, Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="rounded-circle p-1 me-2" style="background: rgba(99, 102, 241, 0.1);">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 8V12L15 15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span class="text-white-50">{{ $workshop->start_time }} - {{ $workshop->end_time }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle p-1 me-2" style="background: rgba(99, 102, 241, 0.1);">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span class="text-white-50">{{ $workshop->instructor }}</span>
                                </div>
                            </div>
                            <p class="text-white-50 mb-3" style="font-size: 0.9rem;">{{ $workshop->description }}</p>
                            @if($workshop->topics && is_array($workshop->topics))
                            <div class="mb-3">
                                @foreach($workshop->topics as $topic)
                                    <span class="badge me-1 mb-1" style="background: rgba(99, 102, 241, 0.1); color: #6366F1;">{{ $topic }}</span>
                                @endforeach
                            </div>
                            @endif
                            <div class="mt-auto">
                                @if($workshop->status === 'completed' || $workshop->status === 'ongoing')
                                    <button class="btn btn-sm py-1 w-100" disabled style="background: rgba(239, 68, 68, 0.1); color: #EF4444; border: none; font-size: 0.8rem;">
                                        Registration Closed
                                    </button>
                                @elseif($workshop->isRegistered)
                                    <form action="{{ route('workshop.deregister', $workshop->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm py-1 w-100" style="background: rgba(239, 68, 68, 0.1); color: #EF4444; border: none; font-size: 0.8rem;">
                                            Deregister
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('workshop.register', $workshop->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm py-1 w-100" style="background: rgba(254, 184, 0, 0.1); color: #FEB800; border: none; font-size: 0.8rem;">
                                            Register Now
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const registerButtons = document.querySelectorAll('button[type="submit"]');
    
    registerButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Registering...';
            this.closest('form').submit();
        });
    });
});
</script>
@endpush

@endsection
