<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        return view('admin.stats.index', [
            'stats' => Stat::ordered()->get()
        ]);
    }

    public function update(Request $request, Stat $stat)
    {
        $data = $request->validate([
            'value'       => ['required', 'string', 'max:20'],
            'suffix'      => ['nullable', 'string', 'max:10'],
            'label'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon'        => ['nullable', 'string', 'max:100'],
            'sort_order'  => ['nullable', 'integer'],
            'is_active'   => ['nullable', 'boolean'],
        ]);
        $data['is_active']  = $request->boolean('is_active');
        $data['updated_at'] = now();
        $stat->update($data);
        return redirect()->route('admin.stats.index')->with('success', 'Stat updated.');
    }
}
