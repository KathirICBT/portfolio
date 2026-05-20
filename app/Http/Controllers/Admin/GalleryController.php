<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{GalleryItem, Media};
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index', [
            'items' => GalleryItem::with('media')->ordered()->get()
        ]);
    }

    public function create()
    {
        return view('admin.gallery.create', [
            'mediaList' => Media::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        GalleryItem::create($this->validated($request));
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.gallery.edit', [
            'item'      => $gallery,
            'mediaList' => Media::latest()->get()
        ]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $gallery->update($this->validated($request));
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(GalleryItem $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'media_id'   => ['nullable', 'exists:media,id'],
            'title'      => ['nullable', 'string', 'max:255'],
            'caption'    => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
