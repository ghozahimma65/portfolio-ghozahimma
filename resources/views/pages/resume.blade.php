@extends('layouts.app')

@section('title', 'Resume | ' . ($globalSettings['seo_meta_title'] ?? 'Backend Developer Resume'))
@section('meta_description', 'Resume of Ghoza Himma Al Farizqi - Backend Developer. View my background, qualifications, and core technical skills.')

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <!-- Back Button -->
        <div class="mb-4" data-aos="fade-right">
            <a href="{{ url('/') }}" class="btn-custom btn-custom-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to Portfolio
            </a>
        </div>

        <!-- Resume Page Header -->
        <div class="row align-items-center g-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <span class="section-subtitle mb-2">My Profile</span>
                <h1 class="fw-bold display-5 text-gradient mb-1">Resume</h1>
                <p class="fs-5 text-primary fw-medium mb-0">Backend Developer Resume</p>
            </div>
        </div>

        <!-- PDF Viewer Card -->
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12">
                <div class="card-custom p-2 p-md-3 shadow-lg" style="background-color: rgba(13, 17, 23, 0.45); backdrop-filter: blur(16px); border-radius: var(--radius-xl); border: 1px solid var(--border-color);">
                    @if(file_exists(public_path('assets/resume/resume.pdf')))
                        <iframe 
                            src="{{ asset('assets/resume/resume.pdf') }}#toolbar=0&navpanes=0&scrollbar=1" 
                            width="100%" 
                            style="height: 80vh; min-height: 600px; max-height: 950px; border: none; border-radius: var(--radius-lg); background-color: var(--bg-color);" 
                            title="Backend Developer Resume PDF"
                        >
                            <p>Your browser does not support embedded PDFs. <a href="{{ asset('assets/resume/resume.pdf') }}" target="_blank" rel="noopener noreferrer">Click here to view the PDF directly.</a></p>
                        </iframe>
                    @else
                        <div class="text-center py-5 text-secondary">
                            <i class="bi bi-file-earmark-pdf fs-1 text-danger d-block mb-3"></i>
                            <p class="mb-0">The Resume PDF is currently unavailable.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Back Button Below Viewer -->
        <div class="d-flex justify-content-start mt-4" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ url('/') }}" class="btn-custom btn-custom-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Portfolio
            </a>
        </div>
    </div>
</section>
@endsection
