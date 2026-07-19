@extends('admin.layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">System Settings</h1>
        <p class="text-secondary small mb-0">Configure your biography profile, contact anchors, and search engines metadata globally.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 small mb-4 py-2" style="background-color: rgba(239, 68, 68, 0.1); color: var(--status-danger);">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel p-4">
        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs border-secondary mb-4 gap-2" id="settingsTabs" role="tablist" style="border-bottom-width: 1px !important;">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-secondary active border-0 bg-transparent px-3 py-2" id="about-tab" data-bs-toggle="tab" data-bs-target="#about-pane" type="button" role="tab" aria-controls="about-pane" aria-selected="true" style="font-weight: 600; font-size: 0.9rem;">
                    <i class="bi bi-person-fill"></i> About Profile
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-secondary border-0 bg-transparent px-3 py-2" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-pane" type="button" role="tab" aria-controls="contact-pane" aria-selected="false" style="font-weight: 600; font-size: 0.9rem;">
                    <i class="bi bi-telephone-fill"></i> Contact Info
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-secondary border-0 bg-transparent px-3 py-2" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-pane" type="button" role="tab" aria-controls="seo-pane" aria-selected="false" style="font-weight: 600; font-size: 0.9rem;">
                    <i class="bi bi-search"></i> Global SEO
                </button>
            </li>
        </ul>

        <!-- Form wrapper -->
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="tab-content" id="settingsTabsContent">
                <!-- 1. ABOUT PROFILE TAB -->
                <div class="tab-pane fade show active" id="about-pane" role="tabpanel" aria-labelledby="about-tab" tabindex="0">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="about_headline" class="form-label text-secondary small fw-bold">Headline Title</label>
                            <input type="text" id="about_headline" name="about_headline" class="form-control form-control-admin w-100" value="{{ old('about_headline', $settings['about_headline']) }}" required>
                        </div>
                        <div class="col-12">
                            <label for="about_biography" class="form-label text-secondary small fw-bold">Biography Storyteller</label>
                            <textarea id="about_biography" name="about_biography" rows="5" class="form-control form-control-admin w-100" required>{{ old('about_biography', $settings['about_biography']) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="about_career_goal" class="form-label text-secondary small fw-bold">Career Goal</label>
                            <input type="text" id="about_career_goal" name="about_career_goal" class="form-control form-control-admin w-100" value="{{ old('about_career_goal', $settings['about_career_goal']) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="about_current_focus" class="form-label text-secondary small fw-bold">Current Focus</label>
                            <input type="text" id="about_current_focus" name="about_current_focus" class="form-control form-control-admin w-100" value="{{ old('about_current_focus', $settings['about_current_focus']) }}">
                        </div>
                        
                        <!-- Uploads -->
                        <div class="col-md-6">
                            <label for="about_photo" class="form-label text-secondary small fw-bold">Profile Photo</label>
                            @if($settings['about_photo'])
                                <div class="mb-2">
                                    <img src="{{ $settings['about_photo'] && str_starts_with($settings['about_photo'], 'http') ? $settings['about_photo'] : asset($settings['about_photo']) }}" alt="" style="max-height: 80px; object-fit: contain; border: 1px solid var(--border-color); border-radius: 50%;">
                                </div>
                            @endif
                            <input type="file" id="about_photo" name="about_photo" class="form-control form-control-admin w-100" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <label for="about_resume" class="form-label text-secondary small fw-bold">Resume PDF File</label>
                            @if($settings['about_resume'])
                                <div class="mb-2">
                                    <a href="{{ $settings['about_resume'] && str_starts_with($settings['about_resume'], 'http') ? $settings['about_resume'] : asset($settings['about_resume']) }}" target="_blank" class="small text-primary"><i class="bi bi-file-pdf"></i> View Current Resume Document &rarr;</a>
                                </div>
                            @endif
                            <input type="file" id="about_resume" name="about_resume" class="form-control form-control-admin w-100" accept="application/pdf">
                        </div>
                    </div>
                </div>

                <!-- 2. CONTACT INFO TAB -->
                <div class="tab-pane fade" id="contact-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="contact_email" class="form-label text-secondary small fw-bold">Primary Email</label>
                            <input type="email" id="contact_email" name="contact_email" class="form-control form-control-admin w-100" value="{{ old('contact_email', $settings['contact_email']) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_phone" class="form-label text-secondary small fw-bold">Phone Number</label>
                            <input type="text" id="contact_phone" name="contact_phone" class="form-control form-control-admin w-100" value="{{ old('contact_phone', $settings['contact_phone']) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="contact_whatsapp" class="form-label text-secondary small fw-bold">WhatsApp Number (For dynamic chat link)</label>
                            <input type="text" id="contact_whatsapp" name="contact_whatsapp" class="form-control form-control-admin w-100" placeholder="e.g. 62851563..." value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="contact_location" class="form-label text-secondary small fw-bold">Location</label>
                            <input type="text" id="contact_location" name="contact_location" class="form-control form-control-admin w-100" placeholder="e.g. Malang, East Java" value="{{ old('contact_location', $settings['contact_location']) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="contact_linkedin" class="form-label text-secondary small fw-bold">LinkedIn URL</label>
                            <input type="url" id="contact_linkedin" name="contact_linkedin" class="form-control form-control-admin w-100" value="{{ old('contact_linkedin', $settings['contact_linkedin']) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="contact_github" class="form-label text-secondary small fw-bold">GitHub URL</label>
                            <input type="url" id="contact_github" name="contact_github" class="form-control form-control-admin w-100" value="{{ old('contact_github', $settings['contact_github']) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="contact_instagram" class="form-label text-secondary small fw-bold">Instagram URL</label>
                            <input type="url" id="contact_instagram" name="contact_instagram" class="form-control form-control-admin w-100" value="{{ old('contact_instagram', $settings['contact_instagram']) }}">
                        </div>
                        <div class="col-12">
                            <label for="contact_google_maps" class="form-label text-secondary small fw-bold">Google Maps Embed Frame Source</label>
                            <textarea id="contact_google_maps" name="contact_google_maps" rows="3" class="form-control form-control-admin w-100" placeholder="Paste embed maps iframe src link...">{{ old('contact_google_maps', $settings['contact_google_maps']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 3. GLOBAL SEO TAB -->
                <div class="tab-pane fade" id="seo-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="seo_meta_title" class="form-label text-secondary small fw-bold">Global SEO Title Prefix</label>
                            <input type="text" id="seo_meta_title" name="seo_meta_title" class="form-control form-control-admin w-100" value="{{ old('seo_meta_title', $settings['seo_meta_title']) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="seo_keywords" class="form-label text-secondary small fw-bold">SEO Keywords (Comma-separated)</label>
                            <input type="text" id="seo_keywords" name="seo_keywords" class="form-control form-control-admin w-100" placeholder="Laravel, developer, portfolio, Ghoza" value="{{ old('seo_keywords', $settings['seo_keywords']) }}">
                        </div>
                        <div class="col-12">
                            <label for="seo_meta_description" class="form-label text-secondary small fw-bold">Global SEO Description</label>
                            <textarea id="seo_meta_description" name="seo_meta_description" rows="3" class="form-control form-control-admin w-100">{{ old('seo_meta_description', $settings['seo_meta_description']) }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="seo_og_image" class="form-label text-secondary small fw-bold">OpenGraph Share Image Path</label>
                            <input type="text" id="seo_og_image" name="seo_og_image" class="form-control form-control-admin w-100" placeholder="/storage/uploads/..." value="{{ old('seo_og_image', $settings['seo_og_image']) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="seo_twitter_card" class="form-label text-secondary small fw-bold">Twitter Card Format</label>
                            <select name="seo_twitter_card" id="seo_twitter_card" class="form-select form-control-admin">
                                <option value="summary_large_image" {{ $settings['seo_twitter_card'] === 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                                <option value="summary" {{ $settings['seo_twitter_card'] === 'summary' ? 'selected' : '' }}>Summary</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="seo_robots" class="form-label text-secondary small fw-bold">Robots Policy Directive</label>
                            <input type="text" id="seo_robots" name="seo_robots" class="form-control form-control-admin w-100" placeholder="index, follow" value="{{ old('seo_robots', $settings['seo_robots']) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Panel Actions -->
            <div class="mt-4 pt-3 border-top" style="border-color: var(--border-color) !important;">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="bi bi-save"></i> Save All Configurations
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Styling active tab outline rules matching premium look */
    .nav-tabs .nav-link:hover {
        border: none !important;
        color: var(--text-primary) !important;
        background-color: rgba(255,255,255,0.02) !important;
    }
    .nav-tabs .nav-link.active {
        color: var(--primary-blue) !important;
        border-bottom: 2px solid var(--primary-blue) !important;
        border-radius: 0 !important;
    }
</style>
@endsection
