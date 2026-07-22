@extends('layouts.app')

@section('title', $project->seo_title ?: $project->title . ' | Case Study')

@section('meta_description', $project->seo_description ?: ($project->short_description ?: Str::limit($project->description, 160)))

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <!-- Back Button & Breadcrumb -->
        <div class="mb-4" data-aos="fade-right">
            <a href="{{ url('/#projects') }}" class="btn-custom btn-custom-secondary btn-sm me-2">
                <i class="bi bi-arrow-left me-1"></i> Back to Portfolio
            </a>
            @if($project->featured)
                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i> Featured Project</span>
            @endif
        </div>

        <!-- Project Header -->
        <div class="row align-items-center g-4 mb-5" data-aos="fade-up">
            <div class="col-lg-8">
                <span class="project-category-badge mb-2 d-inline-block">
                    @if(in_array('Flutter', $project->tech_stack ?? []))
                        Mobile Application
                    @elseif(in_array('ESP32', $project->tech_stack ?? []) || in_array('IoT Sensors', $project->tech_stack ?? []))
                        IoT Telemetry System
                    @else
                        Web Application
                    @endif
                </span>
                <h1 class="fw-bold display-5 text-gradient mb-3">{{ $project->title }}</h1>
                @if($project->short_description)
                    <p class="fs-5 text-primary fw-medium mb-3">{{ $project->short_description }}</p>
                @endif
                <div class="d-flex flex-wrap gap-4 text-secondary small">
                    <div><strong class="text-light">Role:</strong> {{ $project->role ?? 'Software Developer' }}</div>
                    @if($project->duration)
                        <div><strong class="text-light">Duration:</strong> {{ $project->duration }}</div>
                    @endif
                    <div><strong class="text-light">Status:</strong> <span class="badge bg-success">{{ ucfirst($project->status) }}</span></div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                    @if(!empty($project->github_url) && filter_var($project->github_url, FILTER_VALIDATE_URL))
                        <a href="{{ $project->github_url }}" target="_blank" class="btn-custom btn-custom-secondary">
                            <i class="bi bi-github me-1"></i> GitHub Repository
                        </a>
                    @endif
                    @if(!empty($project->demo_url) && filter_var($project->demo_url, FILTER_VALIDATE_URL))
                        <a href="{{ $project->demo_url }}" target="_blank" class="btn-custom btn-custom-accent">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Live Demo
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Banner Screenshot -->
        <div class="mb-5 shadow-lg rounded" style="overflow: hidden; border: 1px solid var(--border-color); background-color: rgba(0, 0, 0, 0.25);" data-aos="fade-up">
            <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="img-fluid w-100" style="max-height: 520px; object-fit: contain;" onerror="this.onerror=null; this.src='{{ asset('assets/images/project-placeholder.png') }}';">
        </div>

        <!-- Case Study Sections (Problem, Solution, Result) -->
        <div class="row g-4 mb-5" data-aos="fade-up">
            @if(!empty($project->problem))
                <div class="col-md-4">
                    <div class="modal-section-box h-100 p-4">
                        <div class="modal-section-title red mb-3">
                            <i class="bi bi-exclamation-triangle fs-5"></i> The Problem
                        </div>
                        <p class="text-secondary small mb-0" style="line-height: 1.7; white-space: pre-wrap;">{{ $project->problem }}</p>
                    </div>
                </div>
            @endif

            @if(!empty($project->solution))
                <div class="col-md-4">
                    <div class="modal-section-box h-100 p-4">
                        <div class="modal-section-title blue mb-3">
                            <i class="bi bi-gear-wide-connected fs-5"></i> The Solution
                        </div>
                        <p class="text-secondary small mb-0" style="line-height: 1.7; white-space: pre-wrap;">{{ $project->solution }}</p>
                    </div>
                </div>
            @endif

            @if(!empty($project->result))
                <div class="col-md-4">
                    <div class="modal-section-box h-100 p-4">
                        <div class="modal-section-title green mb-3">
                            <i class="bi bi-graph-up-arrow fs-5"></i> The Result
                        </div>
                        <p class="text-secondary small mb-0" style="line-height: 1.7; white-space: pre-wrap;">{{ $project->result }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="row g-5">
            <!-- Left Column: Full Description & Gallery -->
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card-custom mb-5">
                    <h3 class="fw-bold mb-3 text-gradient">Full Project Breakdown</h3>
                    <div class="text-secondary" style="line-height: 1.8; white-space: pre-wrap; font-size: 0.95rem;">{{ $project->description }}</div>
                </div>

                <!-- Gallery Images -->
                @if(!empty($project->gallery_urls))
                    <div class="card-custom mb-5">
                        <h3 class="fw-bold mb-4 text-gradient"><i class="bi bi-images text-primary me-2"></i> Project Gallery</h3>
                        <div class="row g-3">
                            @foreach($project->gallery_urls as $galleryImgUrl)
                                <div class="col-md-6">
                                    <div class="rounded shadow-sm overflow-hidden border" style="border-color: var(--border-color) !important; aspect-ratio: 16/10; background-color: rgba(0, 0, 0, 0.25);">
                                        <img src="{{ $galleryImgUrl }}" alt="Gallery Image" class="w-100 h-100" style="object-fit: contain;" onerror="this.onerror=null; this.src='{{ asset('assets/images/project-placeholder.png') }}';">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column: Tech Stack & Key Features -->
            <div class="col-lg-4" data-aos="fade-left">
                <!-- Tech Stack -->
                <div class="card-custom mb-4">
                    <h4 class="fw-bold mb-3 text-gradient"><i class="bi bi-code-slash text-primary me-2"></i> Technologies Used</h4>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($project->tech_stack ?? [] as $tech)
                            <span class="skill-badge"><i class="bi bi-check2-circle text-primary me-1"></i> {{ $tech }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Key Features -->
                @if(!empty($project->features) && is_array($project->features))
                    <div class="card-custom mb-4">
                        <h4 class="fw-bold mb-3 text-gradient"><i class="bi bi-check-all text-primary me-2"></i> Key Features</h4>
                        <ul class="resp-list-custom mb-0">
                            @foreach($project->features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Projects Section -->
        @if(!empty($relatedProjects) && $relatedProjects->count() > 0)
            <div class="my-5" data-aos="fade-up">
                <hr class="mb-5" style="border-color: var(--border-color);">
                <h3 class="fw-bold mb-4 text-gradient"><i class="bi bi-grid-fill text-primary me-2"></i> Related Projects</h3>
                <div class="row g-4">
                    @foreach($relatedProjects as $relProj)
                        <div class="col-md-6">
                            <div class="card-custom h-100 p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <span class="project-category-badge mb-2 d-inline-block">
                                        @if(in_array('Flutter', $relProj->tech_stack ?? []))
                                            Mobile Application
                                        @elseif(in_array('ESP32', $relProj->tech_stack ?? []) || in_array('IoT Sensors', $relProj->tech_stack ?? []))
                                            IoT Telemetry System
                                        @else
                                            Web Application
                                        @endif
                                    </span>
                                    <h4 class="fw-bold mb-2" style="font-size: 1.2rem;">{{ $relProj->title }}</h4>
                                    <p class="text-secondary small mb-3">{{ Str::limit($relProj->short_description ?: $relProj->description, 120) }}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="{{ route('portfolio.project', $relProj->slug) }}" class="link-arrow">
                                        View Case Study <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Prev / Next Navigation -->
        <hr class="my-5" style="border-color: var(--border-color);">
        <div class="row g-4 mb-5" data-aos="fade-up">
            <div class="col-6">
                @if($prevProject)
                    <a href="{{ route('portfolio.project', $prevProject->slug) }}" class="text-decoration-none group">
                        <span class="text-secondary small d-block mb-1"><i class="bi bi-chevron-left"></i> Previous Project</span>
                        <strong class="text-primary hover-accent text-gradient" style="font-size: 1.1rem;">{{ $prevProject->title }}</strong>
                    </a>
                @endif
            </div>
            <div class="col-6 text-end">
                @if($nextProject)
                    <a href="{{ route('portfolio.project', $nextProject->slug) }}" class="text-decoration-none group">
                        <span class="text-secondary small d-block mb-1">Next Project <i class="bi bi-chevron-right"></i></span>
                        <strong class="text-primary hover-accent text-gradient" style="font-size: 1.1rem;">{{ $nextProject->title }}</strong>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@include('sections.footer')
@endsection
