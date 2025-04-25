<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $workshops = Workshop::all()->map(function ($workshop) use ($user) {
            $workshop->isRegistered = $user->workshops()->where('workshop_id', $workshop->id)->exists();
            return $workshop;
        });

        return view('workshops.register', compact('workshops'));
    }

    public function register($id)
    {
        $user = Auth::user();
        $workshop = Workshop::findOrFail($id);

        if ($workshop->status !== 'upcoming') {
            return back()->with('error', 'Registration is closed for this workshop.');
        }

        if ($user->workshops()->where('workshop_id', $id)->exists()) {
            return back()->with('error', 'Already registered for this workshop.');
        }

        $user->workshops()->attach($id);
        return back()->with('success', 'Successfully registered!');
    }

    public function deregister($id)
    {
        $user = Auth::user();
        $workshop = Workshop::findOrFail($id);

        if ($workshop->status !== 'upcoming') {
            return back()->with('error', 'Cannot deregister from an ongoing or completed workshop.');
        }

        if (!$user->workshops()->where('workshop_id', $id)->exists()) {
            return back()->with('error', 'You are not registered for this workshop.');
        }

        $user->workshops()->detach($id);
        return back()->with('success', 'Successfully deregistered!');
    }
}
