<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }
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
            $path = $this->cloudinary->upload($request->file('image'), 'awards');
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
                $this->cloudinary->delete($award->image_path);
            }
            $path = $this->cloudinary->upload($request->file('image'), 'awards');
            $validated['image_path'] = $path;
        }

        $award->update($validated);

        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        if ($award->image_path) {
            $this->cloudinary->delete($award->image_path);
        }
        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}
