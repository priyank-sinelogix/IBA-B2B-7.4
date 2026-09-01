<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        try {
            Mail::to('info@ibacrafts.com')->send(new ContactFormSubmitted($data));
        } catch (\Throwable $e) {
            Log::error('Contact form email failed to send: ' . $e->getMessage());
        }

        return redirect('/contact')->with('success', "Thanks! We've received your message and will get back to you within 24 hours.");
    }
}
