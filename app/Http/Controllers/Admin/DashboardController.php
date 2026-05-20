<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Slider, Service, Testimonial, NetworkProfile, Client, Media};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'sliders'      => Slider::count(),
            'services'     => Service::count(),
            'testimonials' => Testimonial::count(),
            'networks'     => NetworkProfile::count(),
            'clients'      => Client::count(),
            'media'        => Media::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
