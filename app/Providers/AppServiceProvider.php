<?php
namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\{View, Cache};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = Cache::remember('global_settings', 3600, function () {
                return SiteSetting::all()->keyBy('key')->map(fn($s) => $s->value)->toArray();
            });
            $view->with('gs', $settings);
        });
    }
}
