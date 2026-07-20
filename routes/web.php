<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SettingsController;

use App\Http\Controllers\SitemapController;

// Public Website Routes
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/project/{slug}', [PortfolioController::class, 'projectShow'])->name('portfolio.project');
Route::get('/cv/download', [PortfolioController::class, 'downloadCv'])->middleware('throttle:10,1')->name('portfolio.cv.download');
Route::get('/blog', [PortfolioController::class, 'blogIndex'])->name('portfolio.blog.index');
Route::get('/blog/{slug}', [PortfolioController::class, 'blogShow'])->name('portfolio.blog.show');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('admin.login.submit');

// Admin Dashboard CMS Group
Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Overview
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Projects CRUD + Soft Deletes
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::post('projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');

    // Experiences, Certificates & Skills CRUDs
    Route::resource('experiences', ExperienceController::class)->except(['show']);
    Route::resource('certificates', CertificateController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show']);

    // Educations, Organizations & Awards CRUDs
    Route::resource('education', EducationController::class)->except(['show']);
    Route::resource('organizations', OrganizationController::class)->except(['show']);
    Route::resource('awards', AwardController::class)->except(['show']);
    Route::resource('social-links', SocialLinkController::class)->except(['show']);

    // Blog Category and Posts CRUD
    Route::resource('blog-posts', BlogController::class)->except(['show']);

    // Contact Form Inbox
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/{message}', [InboxController::class, 'show'])->name('inbox.show');
    Route::post('/inbox/{message}/read', [InboxController::class, 'markRead'])->name('inbox.read');
    Route::delete('/inbox/{message}', [InboxController::class, 'destroy'])->name('inbox.destroy');
    Route::get('/inbox-export/csv', [InboxController::class, 'exportCsv'])->name('inbox.export');

    // Media Manager library
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::delete('/media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');

    // Settings Control Panel (About Details & Global SEO settings)
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
