<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model {
    protected $fillable = ['media_id','name','url','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean'];
    public function media(): BelongsTo { return $this->belongsTo(Media::class); }
    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order')->orderBy('id'); }
}
