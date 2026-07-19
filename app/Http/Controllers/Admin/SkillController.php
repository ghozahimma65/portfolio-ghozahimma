<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(['Backend', 'Frontend', 'Mobile', 'Database', 'API', 'IoT', 'Tools'])],
            'icon' => ['nullable', 'string', 'max:255'], // bootstrap icon class name
            'level' => ['required', Rule::in(['Beginner', 'Intermediate', 'Advanced', 'Expert'])],
            'order' => ['required', 'integer'],
        ]);

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(['Backend', 'Frontend', 'Mobile', 'Database', 'API', 'IoT', 'Tools'])],
            'icon' => ['nullable', 'string', 'max:255'],
            'level' => ['required', Rule::in(['Beginner', 'Intermediate', 'Advanced', 'Expert'])],
            'order' => ['required', 'integer'],
        ]);

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
