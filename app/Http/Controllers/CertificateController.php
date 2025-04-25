<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class CertificateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $completedWorkshops = $user->workshops()
            ->whereHas('attendances', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('is_present', true);
            })
            ->with(['certificates' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->get();

        return view('workshops.certificate', compact('completedWorkshops'));
    }

    public function download($id)
    {
        $user = Auth::user();
        $workshop = Workshop::findOrFail($id);

        // Check if user attended the workshop
        $attended = $workshop->attendances()
            ->where('user_id', $user->id)
            ->where('is_present', true)
            ->exists();

        if (!$attended) {
            return back()->with('error', 'You must attend the workshop to download the certificate.');
        }

        // Get or create certificate
        $certificate = Certificate::firstOrCreate(
            [
                'user_id' => $user->id,
                'workshop_id' => $workshop->id
            ],
            [
                'file_path' => 'certificates/' . $user->id . '_' . $workshop->id . '.pdf'
            ]
        );

        // Generate personalized certificate
        Artisan::call('certificate:generate', [
            'user_name' => $user->username,
            'workshop_title' => $workshop->title,
            'workshop_date' => $workshop->date->format('F j, Y'),
            'certificate_number' => $certificate->certificate_number,
            'instructor' => $workshop->instructor
        ]);

        $pdfPath = storage_path('app/public/sample_certificate.pdf');
        
        if (!file_exists($pdfPath)) {
            return back()->with('error', 'Certificate template not found. Please contact support.');
        }

        $pdf = file_get_contents($pdfPath);

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $workshop->title . '_' . $certificate->certificate_number . '.pdf"');
    }
}
