<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Slider, Media};
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('media')->ordered()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        $mediaList = Media::latest()->get();
        return view('admin.sliders.create', compact('mediaList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'           => ['required','string','max:255'],
            'subtitle'        => ['nullable','string','max:600'],
            'eyebrow_label'   => ['nullable','string','max:100'],
            'media_id'        => ['nullable','exists:media,id'],
            'overlay_color'   => ['nullable','regex:/^#[0-9A-Fa-f]{6}$/'],
            'overlay_opacity' => ['nullable','numeric','min:0','max:1'],
            'cta1_label'      => ['nullable','string','max:100'],
            'cta1_url'        => ['nullable','string','max:255'],
            'cta2_label'      => ['nullable','string','max:100'],
            'cta2_url'        => ['nullable','string','max:255'],
            'sort_order'      => ['nullable','integer'],
            'is_active'       => ['nullable','boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        Slider::create($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slide created successfully.');
    }

    public function edit(Slider $slider)
    {
        $mediaList = Media::latest()->get();
        return view('admin.sliders.edit', compact('slider','mediaList'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'           => ['required','string','max:255'],
            'subtitle'        => ['nullable','string','max:600'],
            'eyebrow_label'   => ['nullable','string','max:100'],
            'media_id'        => ['nullable','exists:media,id'],
            'overlay_color'   => ['nullable','regex:/^#[0-9A-Fa-f]{6}$/'],
            'overlay_opacity' => ['nullable','numeric','min:0','max:1'],
            'cta1_label'      => ['nullable','string','max:100'],
            'cta1_url'        => ['nullable','string','max:255'],
            'cta2_label'      => ['nullable','string','max:100'],
            'cta2_url'        => ['nullable','string','max:255'],
            'sort_order'      => ['nullable','integer'],
            'is_active'       => ['nullable','boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slide updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slide deleted.');
    }

    public function toggle(Slider $slider)
    {
        $slider->update(['is_active' => !$slider->is_active]);
        return back()->with('success', 'Slide status updated.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['order' => ['required','array'], 'order.*' => ['integer']]);
        foreach ($request->order as $position => $id) {
            Slider::where('id', $id)->update(['sort_order' => $position + 1]);
        }
        return response()->json(['success' => true]);
    }
}
