<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoSetting extends Model {
    public $timestamps = false;
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = null;
    protected $fillable = ['entity_type','entity_key','meta_title','meta_description','canonical_url','og_title','og_description','og_image_id','twitter_card','robots','schema_json'];
    public function ogImage(): BelongsTo { return $this->belongsTo(Media::class, 'og_image_id'); }
    public static function forPage(string $key = 'home'): self {
        return static::firstOrNew(['entity_type' => 'page', 'entity_key' => $key]);
    }
}
