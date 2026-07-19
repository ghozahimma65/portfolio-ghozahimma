<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Organization;
use App\Models\Award;
use App\Models\SocialLink;
use App\Models\Setting;
use App\Models\BlogPost;
use App\Models\AnalyticsLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class PortfolioController extends Controller
{
    /**
     * Display the portfolio index page.
     */
    public function index()
    {
        $projects = Project::where('status', 'published')->orderBy('order', 'asc')->get();
        $experiences = Experience::orderBy('order', 'asc')->get();
        $certificates = Certificate::orderBy('order', 'asc')->get();
        
        $skills = \Illuminate\Support\Facades\Cache::remember('skills_all', 86400, function () {
            return Skill::orderBy('order', 'asc')->get();
        });
        
        $educations = \Illuminate\Support\Facades\Cache::remember('educations_all', 86400, function () {
            return Education::orderBy('order', 'asc')->get();
        });
        
        $organizations = Organization::orderBy('order', 'asc')->get();
        $awards = Award::orderBy('order', 'asc')->get();
        
        $social_links = \Illuminate\Support\Facades\Cache::remember('social_links_all', 86400, function () {
            return SocialLink::orderBy('order', 'asc')->get();
        });

        return view('pages.portfolio', compact(
            'projects', 'experiences', 'certificates', 'skills', 
            'educations', 'organizations', 'awards', 'social_links'
        ));
    }

    /**
     * Display the details page for a specific project and log a project_view hit.
     */
    public function projectShow($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Track Project View Event
        try {
            AnalyticsLog::create([
                'event_type' => 'project_view',
                'event_payload' => (string) $project->id,
                'ip_address' => request()->ip(),
                'user_agent' => substr(request()->userAgent(), 0, 500),
            ]);
        } catch (\Exception $e) {
            Log::warning('Analytics log project view failed: ' . $e->getMessage());
        }

        return view('pages.project-detail', compact('project'));
    }

    /**
     * Download the CV/Resume and log a cv_download hit.
     */
    public function downloadCv()
    {
        $resumePath = Setting::get('about_resume');
        
        // Track CV Download Event
        try {
            AnalyticsLog::create([
                'event_type' => 'cv_download',
                'event_payload' => $resumePath ?: 'default_cv',
                'ip_address' => request()->ip(),
                'user_agent' => substr(request()->userAgent(), 0, 500),
            ]);
        } catch (\Exception $e) {
            Log::warning('Analytics log CV download failed: ' . $e->getMessage());
        }

        if ($resumePath && (str_starts_with($resumePath, 'http://') || str_starts_with($resumePath, 'https://'))) {
            return redirect()->away($resumePath);
        }

        $cleanPath = $resumePath ? str_replace('storage/', '', $resumePath) : null;

        if ($cleanPath && Storage::disk('public')->exists($cleanPath)) {
            return Storage::disk('public')->download($cleanPath, 'Resume-Ghoza-Himma.pdf');
        }

        // Fallback to local public file if exists
        if (file_exists(public_path('assets/files/resume.pdf'))) {
            return response()->download(public_path('assets/files/resume.pdf'), 'Resume-Ghoza-Himma.pdf');
        }

        return back()->with('error', 'Resume file not uploaded yet.');
    }

    /**
     * Display list of blog posts.
     */
    public function blogIndex()
    {
        $posts = BlogPost::where('status', 'published')
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('pages.blog', compact('posts'));
    }

    /**
     * Display a specific blog post.
     */
    public function blogShow($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'tags'])
            ->firstOrFail();

        return view('pages.blog-detail', compact('post'));
    }
}
