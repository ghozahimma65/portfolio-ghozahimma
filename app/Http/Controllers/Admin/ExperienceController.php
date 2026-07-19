<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExperienceRequest;
use App\Http\Requests\Admin\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $query = Experience::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('role', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $experiences = $query->orderBy('order', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(StoreExperienceRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('experiences', 'public');
            $validated['logo'] = $path;
        }

        $validated['current_position'] = $request->boolean('current_position');
        $validated['responsibilities'] = array_values(array_filter($validated['responsibilities']));
        $validated['achievements']     = array_values(array_filter($validated['achievements'] ?? []));
        $validated['tech_stack']       = array_values(array_filter($validated['tech_stack'] ?? []));

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience created successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($experience->logo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $experience->logo));
            }
            $path = $request->file('logo')->store('experiences', 'public');
            $validated['logo'] = $path;
        }

        $validated['current_position'] = $request->boolean('current_position');
        $validated['responsibilities'] = array_values(array_filter($validated['responsibilities']));
        $validated['achievements']     = array_values(array_filter($validated['achievements'] ?? []));
        $validated['tech_stack']       = array_values(array_filter($validated['tech_stack'] ?? []));

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        if ($experience->logo) {
            Storage::disk('public')->delete(str_replace('storage/', '', $experience->logo));
        }
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted successfully.');
    }
}
