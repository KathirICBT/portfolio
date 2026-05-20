<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{SiteSetting, Media};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function edit()
    {
        $settings  = SiteSetting::all()->keyBy('key')->map(fn($s) => $s->value);
        $mediaList = Media::latest()->get();
        return view('admin.settings.edit', compact('settings', 'mediaList'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name'             => ['required', 'string', 'max:255'],
            'tagline'               => ['nullable', 'string', 'max:255'],
            'footer_copyright'      => ['nullable', 'string', 'max:255'],
            'contact_email'         => ['nullable', 'email', 'max:255'],
            'contact_phone_main'    => ['nullable', 'string', 'max:30'],
            'contact_phone_cgta'    => ['nullable', 'string', 'max:30'],
            'contact_phone_kashden' => ['nullable', 'string', 'max:30'],
            'form_recipient_email'  => ['nullable', 'email', 'max:255'],
            'social_linkedin'       => ['nullable', 'url', 'max:500'],
            'social_twitter'        => ['nullable', 'url', 'max:500'],
            'social_facebook'       => ['nullable', 'url', 'max:500'],
            'ga_id'                 => ['nullable', 'string', 'max:50'],
            'cta_button_label'      => ['nullable', 'string', 'max:100'],
            'cta_button_url'        => ['nullable', 'string', 'max:255'],
            'about_video_url'       => ['nullable', 'url', 'max:500'],
            'about_photo_id'        => ['nullable', 'exists:media,id'],
        ]);

        SiteSetting::setMany($data);
        Cache::forget('global_settings');

        return redirect()->route('admin.settings.edit')->with('success', 'Settings saved successfully.');
    }
}
