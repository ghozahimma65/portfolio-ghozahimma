<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AnalyticsLog;
use Symfony\Component\HttpFoundation\Response;

class TrackAnalytics
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log GET requests that are successful HTML views, excluding admin/debug/ajax routes
        if ($request->isMethod('GET') 
            && $response->getStatusCode() === 200 
            && !$request->is('admin*') 
            && !$request->is('api*') 
            && !$request->ajax() 
            && !$request->prefetch()
        ) {
            try {
                AnalyticsLog::create([
                    'event_type' => 'visitor_hit',
                    'event_payload' => $request->path() === '/' ? 'home' : $request->path(),
                    'ip_address' => $request->ip(),
                    'user_agent' => substr($request->userAgent(), 0, 500),
                ]);
            } catch (\Exception $e) {
                // Silently catch exceptions to not disrupt page load
                logger('TrackAnalytics middleware error: ' . $e->getMessage());
            }
        }

        return $response;
    }
}
