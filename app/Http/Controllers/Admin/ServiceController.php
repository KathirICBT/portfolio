<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()   { return view('admin.services.index', ['services' => Service::ordered()->get()]); }

    public function create()  { return view('admin.services.create'); }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service) { return view('admin.services.edit', compact('service')); }

    public function update(Request $request, Service $service)
    {
        $service->update($this->validated($request));
        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'icon'       => ['nullable','string','max:100'],
            'title'      => ['required','string','max:255'],
            'body'       => ['required','string','max:2000'],
            'link_label' => ['nullable','string','max:100'],
            'link_url'   => ['nullable','string','max:255'],
            'sort_order' => ['nullable','integer'],
            'is_active'  => ['nullable','boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
