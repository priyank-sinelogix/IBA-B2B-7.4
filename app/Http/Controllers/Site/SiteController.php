<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

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

    // No reference design was provided for the Contact page yet — placeholder for now.
    public function contact()
    {
        return $this->comingSoon('Contact');
    }
}
