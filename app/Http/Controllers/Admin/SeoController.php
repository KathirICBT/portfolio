<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{SeoSetting, Media};
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function edit()
    {
        $seo = SeoSetting::with('ogImage')
            ->where('entity_type', 'page')
            ->where('entity_key', 'home')
            ->first() ?? new SeoSetting(['entity_type' => 'page', 'entity_key' => 'home']);

        $mediaList = Media::latest()->get();
        return view('admin.seo.edit', compact('seo', 'mediaList'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'meta_title'       => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'canonical_url'    => ['nullable', 'url', 'max:500'],
            'og_title'         => ['nullable', 'string', 'max:255'],
            'og_description'   => ['nullable', 'string', 'max:600'],
            'og_image_id'      => ['nullable', 'exists:media,id'],
            'twitter_card'     => ['nullable', 'in:summary,summary_large_image'],
            'robots'           => ['nullable', 'string', 'max:100'],
            'schema_json'      => ['nullable', 'string'],
        ]);
        $data['updated_at'] = now();

        SeoSetting::updateOrCreate(
            ['entity_type' => 'page', 'entity_key' => 'home'],
            $data
        );

        return redirect()->route('admin.seo.edit')->with('success', 'SEO settings saved.');
    }
}
