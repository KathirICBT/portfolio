<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\{Slider, PageSection, Service, NetworkProfile, Client, Testimonial, Stat, SiteSetting, SeoSetting, GalleryItem};
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(SeoService $seoService)
    {
        $seo             = $seoService->forPage('home');
        $schemaJson      = $seoService->buildSchemaOrg($seo);
        $sliders         = Slider::active()->ordered()->with('media')->get();
        $sections        = PageSection::visible()->ordered()->get()->keyBy('key');
        $services        = Service::active()->ordered()->get();
        $networkProfiles = NetworkProfile::active()->ordered()->with('media')->get();
        $clients         = Client::active()->ordered()->with('media')->get();
        $testimonials    = Testimonial::active()->ordered()->with('media')->get();
        $stats           = Stat::active()->ordered()->get();
        $galleryItems    = GalleryItem::active()->ordered()->with('media')->get();

        return view('front.home', compact(
            'seo','schemaJson','sliders','sections','services',
            'networkProfiles','clients','testimonials','stats','galleryItems'
        ));
    }

    public function contact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $recipient = SiteSetting::get('form_recipient_email', 'info@sureshkumar.ca');

        try {
            Mail::send('emails.contact', $validated, function ($m) use ($recipient, $validated) {
                $m->to($recipient)
                  ->replyTo($validated['email'], $validated['name'])
                  ->subject('New Contact Form Submission – ' . config('app.name'));
            });
        } catch (\Throwable $e) {
            \Log::error('Contact mail failed: ' . $e->getMessage());
        }

        return back()->with('contact_success', 'Thank you, ' . $validated['name'] . '! We will be in touch shortly.');
    }

    public function sitemap()
    {
        $content = view('front.sitemap')->render();
        return response($content, 200)->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $seo     = SeoSetting::forPage('home');
        $noindex = str_contains($seo->robots ?? '', 'noindex');
        $content = view('front.robots', ['noindex' => $noindex])->render();
        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
