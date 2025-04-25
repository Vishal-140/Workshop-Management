@extends('layouts.app')

@section('title', 'Edit Feedback')

@section('content')
<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="display-6 text-white mb-3">Edit Feedback</h1>
            <p class="text-white-50 lead">Update your feedback for {{ $workshop->title }}</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background: linear-gradient(145deg, #1a1f2e, #1d2433); border: 1px solid rgba(99, 102, 241, 0.1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div class="card-body p-4">
                    <form action="{{ route('feedback.update', $workshop->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label text-white">Rating</label>
                            <div class="d-flex gap-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" {{ $feedback->rating == $i ? 'checked' : '' }}>
                                        <label class="form-check-label text-white-50" for="rating{{ $i }}">
                                            {{ $i }}
                                        </label>
                                    </div>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="feedback_text" class="form-label text-white">Feedback</label>
                            <textarea class="form-control" id="feedback_text" name="feedback_text" rows="4" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); color: #fff;">{{ old('feedback_text', $feedback->feedback_text) }}</textarea>
                            @error('feedback_text')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('feedback.index') }}" class="btn btn-sm py-2" style="background: rgba(255, 255, 255, 0.1); color: #fff; border: none;">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-sm py-2" style="background: rgba(99, 102, 241, 0.1); color: #6366F1; border: none;">
                                Update Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
