<?php
namespace App\Services;

use App\Models\SeoSetting;
use App\Models\SiteSetting;

class SeoService
{
    public function forPage(string $key = 'home'): SeoSetting
    {
        return SeoSetting::with('ogImage')
            ->where('entity_type', 'page')
            ->where('entity_key', $key)
            ->firstOrNew(['entity_type' => 'page', 'entity_key' => $key]);
    }

    public function buildSchemaOrg(SeoSetting $seo): string
    {
        if (!empty($seo->schema_json)) {
            return $seo->schema_json;
        }
        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'Person',
            'name'     => SiteSetting::get('site_name', 'Suresh Kumar'),
            'jobTitle' => SiteSetting::get('tagline', 'Strategic Business Advisor'),
            'url'      => config('app.url'),
            'telephone'=> SiteSetting::get('contact_phone_main', ''),
            'email'    => SiteSetting::get('contact_email', ''),
            'address'  => [
                '@type'           => 'PostalAddress',
                'addressRegion'   => 'ON',
                'addressCountry'  => 'CA',
                'addressLocality' => 'Greater Toronto Area',
            ],
        ];
        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
