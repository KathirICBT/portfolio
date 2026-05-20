<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{NetworkProfile, Media};
use Illuminate\Http\Request;

class NetworkProfileController extends Controller
{
    public function index()
    {
        return view('admin.network-profiles.index', [
            'profiles' => NetworkProfile::with('media')->ordered()->get()
        ]);
    }

    public function create()
    {
        return view('admin.network-profiles.create', [
            'mediaList' => Media::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        NetworkProfile::create($this->validated($request));
        return redirect()->route('admin.network-profiles.index')->with('success', 'Profile created.');
    }

    public function edit(NetworkProfile $networkProfile)
    {
        return view('admin.network-profiles.edit', [
            'profile'   => $networkProfile,
            'mediaList' => Media::latest()->get()
        ]);
    }

    public function update(Request $request, NetworkProfile $networkProfile)
    {
        $networkProfile->update($this->validated($request));
        return redirect()->route('admin.network-profiles.index')->with('success', 'Profile updated.');
    }

    public function destroy(NetworkProfile $networkProfile)
    {
        $networkProfile->delete();
        return redirect()->route('admin.network-profiles.index')->with('success', 'Profile deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'media_id'   => ['nullable', 'exists:media,id'],
            'name'       => ['required', 'string', 'max:255'],
            'title'      => ['nullable', 'string', 'max:255'],
            'bio'        => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
