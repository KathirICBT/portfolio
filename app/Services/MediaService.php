<?php
namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    public function store(UploadedFile $file, ?string $altText = ''): Media
    {
        $slug     = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $ext      = strtolower($file->getClientOriginalExtension());
        $filename = $slug . '-' . time() . '.' . $ext;
        $folder   = 'uploads/' . date('Y/m');

        // Store original
        $path = $file->storeAs($folder, $filename, 'public');

        // Try to get image dimensions if GD available
        $width = $height = null;
        try {
            [$width, $height] = getimagesize($file->getRealPath());
        } catch (\Throwable) {}

        return Media::create([
            'filename'      => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path'          => $path,
            'disk'          => 'public',
            'mime_type'     => $file->getMimeType(),
            'size'          => $file->getSize(),
            'alt_text'      => $altText ?: $slug,
            'width'         => $width,
            'height'        => $height,
        ]);
    }

    public function delete(Media $media): void
    {
        Storage::disk($media->disk)->delete($media->path);
        $media->delete();
    }
}
