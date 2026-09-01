<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    public function comingSoon($title = 'This Page')
    {
        return view('site.pages.coming-soon', ['title' => $title]);
    }

    public function home()
    {
        return view('site.pages.home');
    }

    public function about()
    {
        return view('site.pages.about');
    }

    public function services()
    {
        return view('site.pages.services');
    }

    public function howJitWorks()
    {
        return view('site.pages.how-jit-works');
    }

    public function whoWeHelp()
    {
        return view('site.pages.who-we-help');
    }

    public function sustainability()
    {
        return view('site.pages.sustainability');
    }

    public function media()
    {
        return view('site.pages.media');
    }

    public function awards()
    {
        return view('site.pages.awards');
    }

    public function contact()
    {
        return view('site.pages.contact');
    }

    public function submitContact(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'work_email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'ext' => 'nullable|string|max:10',
            'company' => 'required|string|max:150',
            'website' => 'nullable|url|max:200',
            'company_size' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:2000',
            'learned_from' => 'nullable|string|max:100',
        ]);

        $description = trim($data['message'] ?? '');
        $extra = [];
        if (!empty($data['company_size'])) {
            $extra[] = "Company Size: {$data['company_size']}";
        }
        if (!empty($data['learned_from'])) {
            $extra[] = "Heard about us via: {$data['learned_from']}";
        }
        if ($extra) {
            // $description .= ($description ? "\n\n" : '') . implode("\n", $extra);
            $description .= ($description ? "\n\n" : '');
        }

        try {
            $response = Http::timeout(10)->withOptions(['verify' => false])->post('https://s4sassy.com/API_NewDevelopment/sewgo.php?typ=save_addr', [
                'Fname' => $data['first_name'],
                'Lname' => $data['last_name'],
                'Email' => $data['work_email'],
                'phone' => $data['phone'] ?? '',
                'Compnay' => $data['company'],
                'Website' => $data['website'] ?? '',
                'description' => $description,
                'company_size' => $data['company_size'] ?? '',
                'learned_from' => $data['learned_from'] ?? '',
                'social_media' => '',
            ]);

            if (!$response->successful()) {
                Log::error('Contact form API call returned an error: ' . $response->body());
            }
        } catch (\Throwable $e) {
            Log::error('Contact form API call failed: ' . $e->getMessage());
        }

        return redirect('/contact')->with('success', "Thanks! We've received your message and will get back to you within 24 hours.");
    }
}
