@extends('layouts.app')

@section('title', 'Workshop Materials')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">Workshop Materials</h1>
            <p class="text-white-50 lead">Access your learning resources and study materials for registered workshops.</p>
        </div>
    </div>

    @if($registeredWorkshops->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-8 text-center py-5">
                <div class="card" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                    <div class="card-body p-5">
                        <div class="rounded-circle mx-auto mb-4" style="width: 80px; height: 80px; background: rgba(255, 184, 0, 0.1); display: flex; align-items: center; justify-content: center;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8V16M8 12H16" stroke="#FFB800" stroke-width="2" stroke-linecap="round"/>
                                <path d="M3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z" stroke="#FFB800" stroke-width="2"/>
                            </svg>
                        </div>
                        <h4 class="text-white mb-3">No Workshops Registered</h4>
                        <p class="text-white-50 mb-4">You haven't registered for any workshops yet. Start your learning journey by registering for a workshop.</p>
                        <a href="{{ route('workshop.list') }}" class="btn btn-warning px-4" style="background-color: #FFB800; border: none;">Browse Workshops</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            @foreach($registeredWorkshops as $workshop)
                <div class="col-md-12 mb-4">
                    <div class="card" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                        <div class="card-header border-bottom" style="background-color: rgba(255, 184, 0, 0.1); border-color: rgba(255, 255, 255, 0.1);">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle p-2 me-3" style="background: rgba(255, 184, 0, 0.2);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 19.5V4.5C4 3.67157 4.67157 3 5.5 3H18.5C19.3284 3 20 3.67157 20 4.5V19.5C20 20.3284 19.3284 21 18.5 21H5.5C4.67157 21 4 20.3284 4 19.5Z" stroke="#FFB800" stroke-width="2"/>
                                        <path d="M8 7H16M8 12H16M8 17H12" stroke="#FFB800" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-white mb-0">{{ $workshop->title }}</h5>
                                    <small class="text-white-50">
                                        <span class="me-2">{{ $workshop->date->format('F j, Y') }}</span>
                                        <span class="text-white-50">•</span>
                                        <span class="ms-2">{{ $workshop->instructor }}</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                @forelse($workshop->materials as $material)
                                    <div class="col-md-6">
                                        <div class="p-3 rounded" style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle p-2 me-3" style="background: rgba(255, 184, 0, 0.1);">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 6H6C4.89543 6 4 6.89543 4 8V18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V14M14 4H20M20 4V10M20 4L10 14" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="text-white mb-1">{{ $material->title }}</h6>
                                                    <small class="text-white-50 d-block">External Resource</small>
                                                </div>
                                                <a href="{{ $material->formatted_url }}" 
                                                   target="_blank" 
                                                   rel="noopener noreferrer" 
                                                   class="btn btn-sm px-3" 
                                                   style="background-color: rgba(255, 184, 0, 0.1); color: #FFB800; border: none;">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 6H6C4.89543 6 4 6.89543 4 8V18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V14M14 4H20M20 4V10M20 4L10 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="text-center py-4">
                                            <p class="text-white-50 mb-0">No materials available for this workshop yet.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
