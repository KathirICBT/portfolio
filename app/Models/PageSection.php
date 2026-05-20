<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model {
    public $timestamps = false;
    protected $fillable = ['key','nav_label','anchor','title','subtitle','body','extra_json','is_visible','sort_order'];
    protected $casts = ['is_visible' => 'boolean', 'extra_json' => 'array', 'updated_at' => 'datetime'];
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = null;
    public function scopeVisible($q) { return $q->where('is_visible', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order'); }
}
