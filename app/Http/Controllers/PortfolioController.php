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
        $techFilter = request('tech', 'all');
        
        // Retrieve all unique published project technologies for the filter menu
        $allPublishedProjects = Project::where('status', 'published')->get();
        $techFilters = $allPublishedProjects->pluck('tech_stack')->flatten()->filter()->unique()->values();
        $hasFeatured = $allPublishedProjects->where('featured', true)->count() > 0;
        
        // Build paginated query
        $query = Project::where('status', 'published')->orderBy('order', 'asc');
        
        if ($techFilter && $techFilter !== 'all') {
            if ($techFilter === 'featured') {
                $query->where('featured', true);
            } else {
                $query->whereJsonContains('tech_stack', $techFilter);
            }
        }
        
        // Detect mobile users to adjust pagination slice dynamically
        $userAgent = request()->header('User-Agent');
        $isMobile = preg_match('/Mobile|Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile|WPDesktop/i', $userAgent);
        $perPage = $isMobile ? 2 : 4;
        
        $projects = $query->paginate($perPage)->withQueryString();
        
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
            'educations', 'organizations', 'awards', 'social_links',
            'techFilters', 'techFilter', 'hasFeatured'
        ));
    }

    /**
     * Display the details page for a specific project and log a project_view hit.
     */
    public function projectShow($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (!$project) {
            return response()->view('errors.404', [], 404);
        }

        // Get Previous and Next Projects
        $prevProject = Project::where('status', 'published')
            ->where('order', '<', $project->order)
            ->orderBy('order', 'desc')
            ->first();

        if (!$prevProject) {
            $prevProject = Project::where('status', 'published')
                ->where('id', '<', $project->id)
                ->orderBy('id', 'desc')
                ->first();
        }

        $nextProject = Project::where('status', 'published')
            ->where('order', '>', $project->order)
            ->orderBy('order', 'asc')
            ->first();

        if (!$nextProject) {
            $nextProject = Project::where('status', 'published')
                ->where('id', '>', $project->id)
                ->orderBy('id', 'asc')
                ->first();
        }

        // Get 2 random related projects (excluding current project)
        $relatedProjects = Project::where('status', 'published')
            ->where('id', '!=', $project->id)
            ->inRandomOrder()
            ->take(2)
            ->get();

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

        return view('pages.project-detail', compact('project', 'prevProject', 'nextProject', 'relatedProjects'));
    }

    /**
     * Download the CV/Resume and log a cv_download hit.
     */
    public function downloadCv()
    {
        // Track CV Download Event
        try {
            AnalyticsLog::create([
                'event_type' => 'cv_download',
                'event_payload' => 'cv/resume.pdf',
                'ip_address' => request()->ip(),
                'user_agent' => substr(request()->userAgent(), 0, 500),
            ]);
        } catch (\Exception $e) {
            Log::warning('Analytics log CV download failed: ' . $e->getMessage());
        }

        $resumeUrl = Setting::get('about_resume');

        if ($resumeUrl) {
            if (str_starts_with($resumeUrl, 'http')) {
                return redirect()->away($resumeUrl);
            }
            return redirect()->away(asset($resumeUrl));
        }

        // Fallback to local public file if exists
        if (file_exists(public_path('assets/files/resume.pdf'))) {
            return redirect()->away(asset('assets/files/resume.pdf'));
        }

        return redirect()->back()->with('error', 'Resume is currently unavailable.');
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
