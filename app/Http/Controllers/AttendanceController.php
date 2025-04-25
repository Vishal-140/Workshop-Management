<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get only the workshops that the user is registered for
        $workshops = Workshop::whereHas('users', function($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->with(['attendances' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
        ->orderBy('date', 'desc')
        ->get()
        ->groupBy('category');

        return view('workshops.attendance', compact('workshops', 'user'));
    }

    public function markAttendance(Request $request, Workshop $workshop)
    {
        $user = Auth::user();
        
        // Check if the user is registered for this workshop
        if (!$workshop->users()->where('users.id', $user->id)->exists()) {
            return back()->with('error', 'You are not registered for this workshop.');
        }

        // Update attendance for the logged-in user only
        Attendance::updateOrCreate(
            [
                'workshop_id' => $workshop->id,
                'user_id' => $user->id,
            ],
            [
                'is_present' => $request->has('is_present')
            ]
        );

        return back()->with('success', 'Your attendance has been updated.');
    }
}
