<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\ContactMessage;
use App\Models\AnalyticsLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the CMS Overview Dashboard.
     */
    public function index()
    {
        // Core counts
        $totalProjects = Project::count();
        $totalCertificates = Certificate::count();
        $totalSkills = Skill::count();
        $totalExperiences = Experience::count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        // Analytics counters
        $visitorCount = AnalyticsLog::where('event_type', 'visitor_hit')->count();
        $cvDownloads = AnalyticsLog::where('event_type', 'cv_download')->count();
        $projectViewCount = AnalyticsLog::where('event_type', 'project_view')->count();

        // Most viewed project calculation
        $mostViewedProjectData = AnalyticsLog::where('event_type', 'project_view')
            ->select('event_payload', DB::raw('count(*) as total_views'))
            ->groupBy('event_payload')
            ->orderBy('total_views', 'desc')
            ->first();

        $mostViewedProject = null;
        if ($mostViewedProjectData) {
            $mostViewedProject = Project::find($mostViewedProjectData->event_payload);
            if ($mostViewedProject) {
                $mostViewedProject->views = $mostViewedProjectData->total_views;
            }
        }

        // Recent Activity Feeds
        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();

        // Fetch recent analytics logs
        $recentLogs = AnalyticsLog::orderBy('created_at', 'desc')->take(5)->get();

        // Pre-load all project IDs referenced in project_view logs — avoids N+1 query
        $projectViewIds = $recentLogs
            ->where('event_type', 'project_view')
            ->pluck('event_payload')
            ->unique()
            ->filter()
            ->values();

        $projectsById = $projectViewIds->isNotEmpty()
            ? Project::whereIn('id', $projectViewIds)->get()->keyBy('id')
            : collect();

        $recentActivities = $recentLogs->map(function ($log) use ($projectsById) {
            $time = $log->created_at->diffForHumans();

            if ($log->event_type === 'visitor_hit') {
                $description = "IP {$log->ip_address} visited page: '{$log->event_payload}'";
            } elseif ($log->event_type === 'cv_download') {
                $description = "IP {$log->ip_address} downloaded CV/Resume";
            } elseif ($log->event_type === 'project_view') {
                $proj = $projectsById->get($log->event_payload);
                $projName = $proj ? $proj->title : "Project #{$log->event_payload}";
                $description = "IP {$log->ip_address} viewed project: '{$projName}'";
            } else {
                $description = "IP {$log->ip_address} triggered: {$log->event_type}";
            }

            return (object) [
                'description' => $description,
                'time'        => $time,
                'type'        => $log->event_type,
            ];
        });

        return view('admin.dashboard', compact(
            'totalProjects', 'totalCertificates', 'totalSkills', 'totalExperiences',
            'totalMessages', 'unreadMessages', 'visitorCount', 'cvDownloads',
            'projectViewCount', 'mostViewedProject', 'recentMessages', 'recentActivities'
        ));
    }
}
