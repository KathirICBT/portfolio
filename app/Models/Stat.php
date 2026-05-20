<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model {
    public $timestamps = false;
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = null;
    protected $fillable = ['value','suffix','label','description','icon','sort_order','is_active'];
    protected $casts = ['is_active' => 'boolean'];
    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order'); }
}
