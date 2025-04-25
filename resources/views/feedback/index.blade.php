@extends('layouts.app')

@section('title', 'Workshop Feedback')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">Workshop Feedback</h1>
            <p class="text-white-50 lead">View and manage your workshop feedback</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($workshops->isEmpty())
                <div class="card" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1);">
                    <div class="card-body p-4 text-center">
                        <p class="text-white-50 mb-0">You haven't attended any workshops yet.</p>
                    </div>
                </div>
            @else
                @foreach($workshops as $workshop)
                    <div class="card mb-4" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-white mb-0">{{ $workshop->title }}</h4>
                                <span class="text-white-50">{{ $workshop->date->format('F j, Y') }}</span>
                            </div>
                            
                            @if($workshop->userFeedback)
                                <div class="mb-3">
                                    <div class="d-flex mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="me-1" width="20" height="20" viewBox="0 0 24 24" fill="{{ $i <= $workshop->userFeedback->rating ? '#FFB800' : 'none' }}" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-white-50 mb-2">{{ $workshop->userFeedback->feedback_text }}</p>
                                    <small class="text-white-50">Submitted on {{ $workshop->userFeedback->submitted_at->format('F j, Y') }}</small>
                                </div>
                                <a href="{{ route('feedback.edit', $workshop->id) }}" class="btn btn-sm py-2" style="background: rgba(99, 102, 241, 0.1); color: #6366F1; border: none;">
                                    Edit Feedback
                                </a>
                            @else
                                <p class="text-white-50 mb-3">You haven't provided feedback for this workshop yet.</p>
                                <a href="{{ route('feedback.show', $workshop->id) }}" class="btn btn-sm py-2" style="background: rgba(99, 102, 241, 0.1); color: #6366F1; border: none;">
                                    Submit Feedback
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
