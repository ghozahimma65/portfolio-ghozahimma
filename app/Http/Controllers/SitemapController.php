<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML Sitemap for search engine indexing.
     */
    public function index(): Response
    {
        $projects = Project::where('status', 'published')->orderBy('updated_at', 'desc')->get();
        $posts = BlogPost::where('status', 'published')->orderBy('published_at', 'desc')->get();
        $baseUrl = url('/');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$baseUrl}</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>1.0</priority>\n";
        $xml .= "  </url>\n";

        // Blog Index
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . route('portfolio.blog.index') . "</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "    <changefreq>daily</changefreq>\n";
        $xml .= "    <priority>0.8</priority>\n";
        $xml .= "  </url>\n";

        // Published Projects
        foreach ($projects as $project) {
            $projectUrl = route('portfolio.project', $project->slug);
            $lastMod = $project->updated_at ? $project->updated_at->format('Y-m-d') : date('Y-m-d');
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$projectUrl}</loc>\n";
            $xml .= "    <lastmod>{$lastMod}</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </url>\n";
        }

        // Published Blog Posts
        foreach ($posts as $post) {
            $postUrl = route('portfolio.blog.show', $post->slug);
            $lastMod = $post->published_at ? $post->published_at->format('Y-m-d') : date('Y-m-d');
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$postUrl}</loc>\n";
            $xml .= "    <lastmod>{$lastMod}</lastmod>\n";
            $xml .= "    <changefreq>monthly</changefreq>\n";
            $xml .= "    <priority>0.7</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    /**
     * Generate dynamic robots.txt output.
     */
    public function robots(): Response
    {
        $sitemapUrl = url('/sitemap.xml');
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /admin/*\n\n";
        $content .= "Sitemap: {$sitemapUrl}\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
