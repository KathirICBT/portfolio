<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slider extends Model {
    protected $fillable = ['title','subtitle','eyebrow_label','media_id','overlay_color','overlay_opacity','cta1_label','cta1_url','cta2_label','cta2_url','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean', 'overlay_opacity' => 'float'];
    public function media(): BelongsTo { return $this->belongsTo(Media::class); }
    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order')->orderBy('id'); }
}
