<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }
    /**
     * Display a listing of projects.
     */
    public function index(Request $request)
    {
        $query = Project::query();

        // 1. Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // 2. Status filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'deleted') {
                $query->onlyTrashed();
            } else {
                $query->where('status', $status);
            }
        }

        $projects = $query->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project.
     * Validation and slug auto-generation handled by StoreProjectRequest.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $path = $this->cloudinary->upload($request->file('thumbnail'), 'projects/thumbnails');
            $validated['image_path'] = $path;
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $this->cloudinary->upload($file, 'projects/gallery');
                $galleryPaths[] = $path;
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        $validated['featured']   = $request->boolean('featured');
        $validated['tech_stack'] = array_values(array_filter($validated['tech_stack']));
        $validated['features']   = array_values(array_filter($validated['features'] ?? []));

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     * Route Model Binding resolves via Project::resolveRouteBinding() which includes soft-deleted records.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project.
     * Validation and slug logic handled by UpdateProjectRequest.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($project->image_path) {
                $this->cloudinary->delete($project->image_path);
            }
            $path = $this->cloudinary->upload($request->file('thumbnail'), 'projects/thumbnails');
            $validated['image_path'] = $path;
        }

        if ($request->hasFile('gallery')) {
            if ($project->gallery_images) {
                foreach ($project->gallery_images as $oldImage) {
                    $this->cloudinary->delete($oldImage);
                }
            }
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $path = $this->cloudinary->upload($file, 'projects/gallery');
                $galleryPaths[] = $path;
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        $validated['featured']   = $request->boolean('featured');
        $validated['tech_stack'] = array_values(array_filter($validated['tech_stack']));
        $validated['features']   = array_values(array_filter($validated['features'] ?? []));

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Soft delete the specified project.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project soft deleted successfully.');
    }

    /**
     * Restore a soft deleted project.
     */
    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.index')->with('success', 'Project restored successfully.');
    }
}
