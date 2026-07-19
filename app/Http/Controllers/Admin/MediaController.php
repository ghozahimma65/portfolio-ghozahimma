<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }
    /**
     * Display media library files grid.
     */
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('search')) {
            $query->where('filename', 'like', '%' . $request->search . '%');
        }

        $mediaFiles = $query->orderBy('created_at', 'desc')->paginate(24);

        return view('admin.media.index', compact('mediaFiles'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            // Explicit MIME allowlist — prevents uploading executable files (.php, .phar, .html, etc.)
            'file' => [
                'required',
                'file',
                'max:5120', // 5MB limit
                'mimes:jpg,jpeg,png,gif,webp,svg,pdf,mp4,mp3,zip,xlsx,csv,docx',
            ],
        ]);

        $file        = $request->file('file');
        $originalName = $file->getClientOriginalName();

        // Upload to Cloudinary
        $path = $this->cloudinary->upload($file, 'uploads');

        // Register file metadata in the media library database
        Media::create([
            'filename'  => $originalName,
            'filepath'  => $path,
            'file_type' => $file->getMimeType(), // Use server-detected MIME
            'file_size' => $file->getSize(),
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media asset uploaded successfully.');
    }

    /**
     * Delete a media asset from storage and database.
     */
    public function destroy(Media $medium)
    {
        // Delete from Cloudinary
        $this->cloudinary->delete($medium->filepath);

        // Delete database record
        $medium->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media asset deleted successfully.');
    }
}
