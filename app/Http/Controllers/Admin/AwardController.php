<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::orderBy('order')->get();
        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'order' => ['required', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('awards', 'public');
            $validated['image_path'] = $path;
        }

        Award::create($validated);

        return redirect()->route('admin.awards.index')->with('success', 'Award created successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'order' => ['required', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            if ($award->image_path) {
                Storage::disk('public')->delete(str_replace('storage/', '', $award->image_path));
            }
            $path = $request->file('image')->store('awards', 'public');
            $validated['image_path'] = $path;
        }

        $award->update($validated);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        if ($award->image_path) {
            Storage::disk('public')->delete(str_replace('storage/', '', $award->image_path));
        }
        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}
