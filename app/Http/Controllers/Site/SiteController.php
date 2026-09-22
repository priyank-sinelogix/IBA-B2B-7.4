<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route as RouteFacade;

class SiteController extends Controller
{
    // Custom priorities for known public pages; anything not listed here
    // (e.g. a newly added public page) falls back to $defaultPriority below.
    private array $sitemapPriorities = [
        '/' => '1.0',
        '/about' => '0.8',
        '/services' => '0.8',
        '/how-jit-works' => '0.8',
        '/who-we-help' => '0.8',
        '/sustainability' => '0.7',
        '/contact' => '0.7',
        '/media' => '0.6',
        '/awards' => '0.6',
        '/privacy-policy' => '0.3',
    ];

    private string $defaultSitemapPriority = '0.6';

    // Actions on this controller that are public GET routes but should never
    // appear in the sitemap (the sitemap itself, and unrouted helper views).
    private array $sitemapExcludedActions = ['sitemap', 'comingSoon'];

    public function comingSoon($title = 'This Page')
    {
        return view('site.pages.coming-soon', ['title' => $title]);
    }

    public function sitemap()
    {
        $urls = [];

        foreach (RouteFacade::getRoutes() as $route) {
            $action = $route->getActionName();

            // Only auto-include public pages served directly by this
            // controller. Admin, auth, dashboard and every other
            // authenticated/system route lives on a different controller
            // and is therefore never picked up here.
            if (strpos($action, SiteController::class.'@') !== 0) {
                continue;
            }

            $method = substr($action, strrpos($action, '@') + 1);
            if (in_array($method, $this->sitemapExcludedActions, true)) {
                continue;
            }

            if (!in_array('GET', $route->methods(), true)) {
                continue;
            }

            $uri = $route->uri();
            if (strpos($uri, '{') !== false) {
                continue; // skip any route with parameters
            }

            $path = $uri === '/' ? '/' : '/'.ltrim($uri, '/');

            $urls[] = [
                'loc' => $path,
                'priority' => $this->sitemapPriorities[$path] ?? $this->defaultSitemapPriority,
            ];
        }

        usort($urls, function ($a, $b) {
            return $b['priority'] <=> $a['priority'] ?: $a['loc'] <=> $b['loc'];
        });

        return response()
            ->view('site.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'text/xml');
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

    public function privacyPolicy()
    {
        return view('site.pages.privacy-policy');
    }

    public function onDemandManufacturing()
    {
        return view('site.pages.on-demand-garment-manufacturing');
    }

    public function privateLabelManufacturing()
    {
        return view('site.pages.private-label-garment-manufacturing');
    }

    public function customGarmentManufacturerIndia()
    {
        return view('site.pages.custom-garment-manufacturer-india');
    }

    public function smallBatchManufacturing()
    {
        return view('site.pages.small-batch-garment-manufacturing');
    }

    public function womensGarmentManufacturer()
    {
        return view('site.pages.womens-garment-manufacturer');
    }

    public function plusSizeGarmentManufacturer()
    {
        return view('site.pages.plus-size-garment-manufacturer');
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
