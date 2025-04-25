@extends('layouts.app')

@section('title', 'My Workshop Attendance')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">My Workshop Attendance</h1>
            <p class="text-white-50 lead">View your workshop attendance status.</p>
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

    @if($workshops->isEmpty())
        <div class="card" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="card-body p-5 text-center">
                <h4 class="text-white mb-3">No Registered Workshops</h4>
                <p class="text-white-50 mb-4">You haven't registered for any workshops yet.</p>
                <a href="{{ route('workshop.list') }}" class="btn btn-warning">Browse Workshops</a>
            </div>
        </div>
    @else
        @foreach($workshops as $category => $categoryWorkshops)
            <div class="card mb-4" style="background-color: #1B2231; border: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="card-header border-bottom" style="background-color: rgba(255, 184, 0, 0.1); border-color: rgba(255, 255, 255, 0.1);">
                    <h5 class="text-white mb-0">{{ $category }}</h5>
                </div>
                <div class="card-body p-0">
                    @foreach($categoryWorkshops as $workshop)
                        <div class="border-bottom" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="text-white mb-1">{{ $workshop->title }}</h5>
                                        <small class="text-white-50">
                                            <span>{{ $workshop->date->format('F j, Y') }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $workshop->instructor }}</span>
                                        </small>
                                    </div>
                                    <div>
                                        <span class="badge {{ $workshop->attendances->where('user_id', $user->id)->where('is_present', true)->count() ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                            {{ $workshop->attendances->where('user_id', $user->id)->where('is_present', true)->count() ? 'Present' : 'Absent' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
