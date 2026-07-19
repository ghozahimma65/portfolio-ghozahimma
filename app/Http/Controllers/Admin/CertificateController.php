<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }
    public function index(Request $request)
    {
        $query = Certificate::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('issuer', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $certificates = $query->orderBy('order', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'issue_date' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'credential_url' => ['nullable', 'url'],
            'category' => ['nullable', 'string', 'max:255'],
            'featured' => ['boolean'],
            'order' => ['required', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $path = $this->cloudinary->upload($request->file('image'), 'certificates');
            $validated['image_path'] = $path;
        }

        $validated['featured'] = $request->boolean('featured');

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'issue_date' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'credential_url' => ['nullable', 'url'],
            'category' => ['nullable', 'string', 'max:255'],
            'featured' => ['boolean'],
            'order' => ['required', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            if ($certificate->image_path) {
                $this->cloudinary->delete($certificate->image_path);
            }
            $path = $this->cloudinary->upload($request->file('image'), 'certificates');
            $validated['image_path'] = $path;
        }

        $validated['featured'] = $request->boolean('featured');

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image_path) {
            $this->cloudinary->delete($certificate->image_path);
        }
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
