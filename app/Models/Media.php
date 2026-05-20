<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model {
    protected $fillable = ['filename','original_name','path','disk','mime_type','size','alt_text','width','height'];

    public function getUrlAttribute(): string {
        if ($this->disk === 'url') {
            return $this->path;
        }
        if ($this->disk === 'public') {
            return '/storage/' . $this->path;
        }
        return Storage::disk($this->disk)->url($this->path);
    }
    public function getHumanSizeAttribute(): string {
        $bytes = $this->size ?? 0;
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 1) . ' MB';
    }
}
