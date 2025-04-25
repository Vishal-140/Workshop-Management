@extends('layouts.app')

@section('title', 'Workshop Certificates')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">Workshop Certificates</h1>
            <p class="text-white-50 lead">Download certificates for completed workshops.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($completedWorkshops->isEmpty())
        <div class="card" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="card-body p-5 text-center">
                <h4 class="text-white mb-3">No Certificates Available</h4>
                <p class="text-white-50 mb-4">You haven't completed any workshops yet. Certificates will be available after workshop completion.</p>
                <a href="{{ route('workshop.list') }}" class="btn btn-warning">Browse Workshops</a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($completedWorkshops as $workshop)
                <div class="col-md-6">
                    <div class="card h-100" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                        <div class="card-header border-bottom" style="background-color: rgba(255, 184, 0, 0.1); border-color: rgba(255, 255, 255, 0.1);">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle p-2 me-3" style="background: rgba(255, 184, 0, 0.2);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 15L8.5 9H15.5L12 15ZM3 21V3H21V21H3Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-white mb-0">{{ $workshop->title }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="text-white-50">
                                    <small>
                                        <span>{{ $workshop->date->format('F j, Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $workshop->instructor }}</span>
                                    </small>
                                </div>
                            </div>
                            <div class="mt-4">
                                @if($workshop->certificates->count() > 0)
                                    <a href="{{ route('certificate.download', $workshop->id) }}" class="btn btn-warning d-flex align-items-center justify-content-center">
                                        <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 16L4 17C4 18.6569 5.34315 20 7 20L17 20C18.6569 20 20 18.6569 20 17L20 16M16 12L12 16M12 16L8 12M12 16L12 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Download Certificate
                                    </a>
                                @else
                                    <a href="{{ route('certificate.download', $workshop->id) }}" class="btn btn-warning d-flex align-items-center justify-content-center">
                                        <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Generate Certificate
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
