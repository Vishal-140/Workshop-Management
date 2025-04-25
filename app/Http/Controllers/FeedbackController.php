<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workshops = Workshop::whereHas('attendances', function($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('is_present', true);
        })
        ->with(['feedback' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
        ->get();

        // Transform feedback collection to single feedback
        $workshops->each(function($workshop) {
            $workshop->userFeedback = $workshop->feedback->first();
        });

        return view('feedback.index', compact('workshops'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $workshop = Workshop::findOrFail($id);
        
        // Check if user attended the workshop
        $attended = $workshop->attendances()
            ->where('user_id', $user->id)
            ->where('is_present', true)
            ->exists();

        if (!$attended) {
            return redirect()->route('workshops.index')
                ->with('error', 'You must attend the workshop to provide feedback.');
        }

        $existingFeedback = $workshop->feedback()
            ->where('user_id', $user->id)
            ->first();

        return view('feedback.show', compact('workshop', 'existingFeedback'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback_text' => 'required|string|min:10|max:500'
        ]);

        $user = Auth::user();
        $workshop = Workshop::findOrFail($id);

        // Check if user attended the workshop
        $attended = $workshop->attendances()
            ->where('user_id', $user->id)
            ->where('is_present', true)
            ->exists();

        if (!$attended) {
            return back()->with('error', 'You must attend the workshop to provide feedback.');
        }

        $feedback = Feedback::updateOrCreate(
            [
                'user_id' => $user->id,
                'workshop_id' => $workshop->id
            ],
            [
                'rating' => $request->rating,
                'feedback_text' => $request->feedback_text,
                'submitted_at' => now()
            ]
        );

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback submitted successfully!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $workshop = Workshop::findOrFail($id);
        
        $feedback = $workshop->feedback()
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('feedback.edit', compact('workshop', 'feedback'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback_text' => 'required|string|min:10|max:500'
        ]);

        $user = Auth::user();
        $workshop = Workshop::findOrFail($id);
        
        $feedback = $workshop->feedback()
            ->where('user_id', $user->id)
            ->firstOrFail();

        $feedback->update([
            'rating' => $request->rating,
            'feedback_text' => $request->feedback_text,
            'submitted_at' => now()
        ]);

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback updated successfully!');
    }
}
