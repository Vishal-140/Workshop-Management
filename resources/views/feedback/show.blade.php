@extends('layouts.app')

@section('title', 'Submit Feedback')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">Submit Feedback</h1>
            <p class="text-white-50 lead">Share your experience about {{ $workshop->title }}</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($existingFeedback)
                <div class="card" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div class="card-body p-4">
                        <h4 class="text-white mb-4">Your Previous Feedback</h4>
                        <div class="mb-4">
                            <div class="d-flex mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="me-1" width="20" height="20" viewBox="0 0 24 24" fill="{{ $i <= $existingFeedback->rating ? '#FFB800' : 'none' }}" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-white-50 mb-0">{{ $existingFeedback->feedback_text }}</p>
                            <small class="text-white-50">Submitted on {{ $existingFeedback->submitted_at->format('F j, Y') }}</small>
                        </div>
                        <a href="{{ route('feedback.index') }}" class="btn btn-sm py-2" style="background: rgba(99, 102, 241, 0.1); color: #6366F1; border: none;">
                            Back to Feedback List
                        </a>
                    </div>
                </div>
            @else
                <div class="card" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div class="card-body p-4">
                        <form action="{{ route('feedback.store', $workshop) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rating" class="form-label text-white">Rating</label>
                                <div class="d-flex" id="ratingStars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="me-2 rating-star" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer;" data-rating="{{ $i }}">
                                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="#FFB800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating" value="{{ old('rating', 5) }}" required>
                                @error('rating')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="feedback_text" class="form-label text-white">Your Feedback</label>
                                <textarea class="form-control text-white border-0" id="feedback_text" name="feedback_text" rows="4" style="background-color: #293241;" required>{{ old('feedback_text') }}</textarea>
                                @error('feedback_text')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('feedback.index') }}" class="btn btn-sm py-2" style="background: rgba(255, 255, 255, 0.1); color: #fff; border: none;">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-sm py-2" style="background: rgba(99, 102, 241, 0.1); color: #6366F1; border: none;">
                                    Submit Feedback
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating');

    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.setAttribute('fill', '#FFB800');
            } else {
                star.setAttribute('fill', 'none');
            }
        });
        ratingInput.value = rating;
    }

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            updateStars(rating);
        });

        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            updateStars(rating);
        });
    });

    const ratingStars = document.getElementById('ratingStars');
    if (ratingStars) {
        ratingStars.addEventListener('mouseout', function() {
            updateStars(parseInt(ratingInput.value));
        });
    }

    // Initialize stars
    updateStars(parseInt(ratingInput.value));
});
</script>
@endpush
@endsection
