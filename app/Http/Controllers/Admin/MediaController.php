<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
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

    /**
     * Upload a new media asset.
     */
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

        // Clean filename using original name (without extension)
        $cleanName = pathinfo($originalName, PATHINFO_FILENAME);

        // Use server-side extension detection — never trust client-provided extension
        $extension = $file->guessExtension() ?? $file->getClientOriginalExtension();
        $filename  = Str::slug($cleanName) . '_' . time() . '.' . $extension;

        // Store file in the public disk uploads directory
        $path = $file->storeAs('uploads', $filename, 'public');

        // Register file metadata in the media library database
        Media::create([
            'filename'  => $originalName,
            'filepath'  => $path,
            'file_type' => $file->getMimeType(), // Use server-detected MIME, not client-provided
            'file_size' => $file->getSize(),
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media asset uploaded successfully.');
    }

    /**
     * Delete a media asset from storage and database.
     */
    public function destroy(Media $medium)
    {
        // Delete physical file
        $diskPath = str_replace('storage/', '', $medium->filepath);
        if (Storage::disk('public')->exists($diskPath)) {
            Storage::disk('public')->delete($diskPath);
        }

        // Delete database record
        $medium->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media asset deleted successfully.');
    }
}
