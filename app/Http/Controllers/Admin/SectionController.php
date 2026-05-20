<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        return view('admin.sections.index', [
            'sections' => PageSection::orderBy('sort_order')->get()
        ]);
    }

    public function edit(PageSection $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, PageSection $section)
    {
        $data = $request->validate([
            'nav_label'  => ['nullable', 'string', 'max:100'],
            'title'      => ['nullable', 'string', 'max:255'],
            'subtitle'   => ['nullable', 'string', 'max:255'],
            'body'       => ['nullable', 'string'],
            'is_visible' => ['nullable', 'boolean'],
        ]);
        $data['is_visible'] = $request->boolean('is_visible');
        $data['updated_at'] = now();
        $section->update($data);
        return redirect()->route('admin.sections.index')->with('success', 'Section updated.');
    }
}
