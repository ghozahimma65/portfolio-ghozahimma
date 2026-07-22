<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }
    /**
     * Display settings form panel.
     */
    public function index()
    {
        $settings = [
            'about_headline' => Setting::get('about_headline'),
            'about_biography' => Setting::get('about_biography'),
            'about_career_goal' => Setting::get('about_career_goal'),
            'about_current_focus' => Setting::get('about_current_focus'),
            'about_photo' => Setting::get('about_photo'),
            'about_resume' => Setting::get('about_resume'),
            
            'contact_email' => Setting::get('contact_email'),
            'contact_phone' => Setting::get('contact_phone'),
            'contact_whatsapp' => Setting::get('contact_whatsapp'),
            'contact_linkedin' => Setting::get('contact_linkedin'),
            'contact_github' => Setting::get('contact_github'),
            'contact_instagram' => Setting::get('contact_instagram'),
            'contact_location' => Setting::get('contact_location'),
            'contact_google_maps' => Setting::get('contact_google_maps'),
            
            'seo_meta_title' => Setting::get('seo_meta_title'),
            'seo_meta_description' => Setting::get('seo_meta_description'),
            'seo_keywords' => Setting::get('seo_keywords'),
            'seo_og_image' => Setting::get('seo_og_image'),
            'seo_twitter_card' => Setting::get('seo_twitter_card'),
            'seo_robots' => Setting::get('seo_robots'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings keys.
     */
    public function update(Request $request)
    {
        $request->validate([
            'about_headline' => ['required', 'string', 'max:255'],
            'about_biography' => ['required', 'string'],
            'about_career_goal' => ['nullable', 'string', 'max:255'],
            'about_current_focus' => ['nullable', 'string', 'max:255'],
            'about_photo' => ['nullable', 'image', 'max:2048'],
            'about_resume' => ['nullable', 'file', 'mimes:pdf', 'max:5120'], // Max 5MB PDF
            
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_whatsapp' => ['nullable', 'string', 'max:255'],
            'contact_linkedin' => ['nullable', 'url', 'max:255'],
            'contact_github' => ['nullable', 'url', 'max:255'],
            'contact_instagram' => ['nullable', 'url', 'max:255'],
            'contact_location' => ['nullable', 'string', 'max:255'],
            'contact_google_maps' => ['nullable', 'string'],
            
            'seo_meta_title' => ['nullable', 'string', 'max:255'],
            'seo_meta_description' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string'],
            'seo_og_image' => ['nullable', 'string'],
            'seo_twitter_card' => ['nullable', 'string'],
            'seo_robots' => ['nullable', 'string'],
        ]);

        // Handle profile photo upload
        if ($request->hasFile('about_photo')) {
            $oldPhoto = Setting::get('about_photo');
            if ($oldPhoto) {
                $this->cloudinary->delete($oldPhoto);
            }
            $path = $this->cloudinary->upload($request->file('about_photo'), 'settings');
            Setting::set('about_photo', $path);
        }

        // Handle resume PDF upload using Cloudinary
        if ($request->hasFile('about_resume')) {
            $oldResume = Setting::get('about_resume');
            if ($oldResume) {
                $this->cloudinary->delete($oldResume);
            }

            // Delete existing local file if it exists to clean up
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists('cv/resume.pdf')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('cv/resume.pdf');
            }

            // Store on Cloudinary
            $path = $this->cloudinary->upload($request->file('about_resume'), 'settings', [
                'use_filename' => true,
                'unique_filename' => false,
                'overwrite' => true,
            ]);
            Setting::set('about_resume', $path);
        }

        // Save normal keys
        $normalKeys = [
            'about_headline', 'about_biography', 'about_career_goal', 'about_current_focus',
            'contact_email', 'contact_phone', 'contact_whatsapp', 'contact_linkedin', 
            'contact_github', 'contact_instagram', 'contact_location', 'contact_google_maps',
            'seo_meta_title', 'seo_meta_description', 'seo_keywords', 'seo_og_image',
            'seo_twitter_card', 'seo_robots'
        ];

        foreach ($normalKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
