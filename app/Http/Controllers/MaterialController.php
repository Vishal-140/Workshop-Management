<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $registeredWorkshops = $user->workshops()
            ->with(['materials' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();

        // Format material links to ensure they have http/https
        $registeredWorkshops->each(function($workshop) {
            $workshop->materials->each(function($material) {
                // Get the URL from either file_path or material_link
                $url = !empty($material->file_path) ? $material->file_path : $material->material_link;
                
                // Ensure URL has http/https prefix
                if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
                    $url = "https://" . $url;
                }
                
                // Store the formatted URL back to the material
                $material->formatted_url = $url;
            });
        });

        return view('workshops.materials', compact('registeredWorkshops'));
    }
}
