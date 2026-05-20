<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model {
    public $timestamps = false;
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = null;
    protected $fillable = ['key','value'];

    public static function get(string $key, mixed $default = null): mixed {
        return Cache::remember("setting.{$key}", 3600, fn() =>
            static::where('key', $key)->value('value') ?? $default
        );
    }

    public static function set(string $key, mixed $value): void {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'updated_at' => now()]);
        Cache::forget("setting.{$key}");
    }

    public static function setMany(array $data): void {
        foreach ($data as $k => $v) { static::set($k, $v); }
        Cache::forget('global_settings');
    }

    public static function all($columns = ['*']) {
        return parent::all($columns);
    }
}
