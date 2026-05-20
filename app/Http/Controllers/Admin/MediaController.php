<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(24);
        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request, MediaService $mediaService)
    {
        $request->validate([
            'file'     => ['required','file','mimes:jpeg,jpg,png,gif,webp,svg','max:10240'],
            'alt_text' => ['nullable','string','max:255'],
        ]);

        $media = $mediaService->store($request->file('file'), $request->input('alt_text', ''));

        if ($request->wantsJson()) {
            return response()->json(['id' => $media->id, 'url' => $media->url, 'alt_text' => $media->alt_text]);
        }
        return redirect()->route('admin.media.index')->with('success', 'File uploaded successfully.');
    }

    public function update(Request $request, Media $medium)
    {
        $request->validate(['alt_text' => ['nullable','string','max:255']]);
        $medium->update(['alt_text' => $request->alt_text]);
        return back()->with('success', 'Alt text updated.');
    }

    public function destroy(Media $medium, MediaService $mediaService)
    {
        $mediaService->delete($medium);
        return back()->with('success', 'File deleted.');
    }
}
