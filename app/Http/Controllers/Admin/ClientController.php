<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Client, Media};
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.clients.index', [
            'clients' => Client::with('media')->ordered()->get()
        ]);
    }

    public function create()
    {
        return view('admin.clients.create', [
            'mediaList' => Media::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        Client::create($this->validated($request));
        return redirect()->route('admin.clients.index')->with('success', 'Client created.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', [
            'client'    => $client,
            'mediaList' => Media::latest()->get()
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $client->update($this->validated($request));
        return redirect()->route('admin.clients.index')->with('success', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'media_id'   => ['nullable', 'exists:media,id'],
            'name'       => ['required', 'string', 'max:255'],
            'url'        => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
