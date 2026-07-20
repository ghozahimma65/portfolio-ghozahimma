<!-- Handcrafted Projects Section -->
<section id="projects" class="bg-section-theme">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Portfolio Showroom</span>
            <h2 class="section-title text-gradient">Featured Projects</h2>
        </div>

        <!-- Project Filtering Menu -->
        <div class="d-flex justify-content-center mb-5" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
            <div class="filter-btn-group flex-wrap justify-content-center gap-1" role="tablist" aria-label="Project Tech Filter">
                <button class="filter-btn active" data-filter="all" role="tab" aria-selected="true">All</button>
                @if($projects->where('featured', true)->count() > 0)
                    <button class="filter-btn text-warning" data-filter="featured" role="tab" aria-selected="false"><i class="bi bi-star-fill me-1"></i> Featured</button>
                @endif
                @php
                    $techFilters = $projects->pluck('tech_stack')->flatten()->filter()->unique()->values();
                @endphp
                @foreach($techFilters as $tech)
                    <button class="filter-btn" data-filter="{{ $tech }}" role="tab" aria-selected="false">{{ $tech }}</button>
                @endforeach
            </div>
        </div>

        <!-- Project Cards Grid -->
        <div class="row g-4">
            @forelse($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-folder-x fs-1 text-secondary" aria-hidden="true"></i>
                    <p class="text-secondary mt-3 fs-5">No projects published yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- -------------------------------------------------------------
     * SINGLE DETAILED PROJECT MODAL (Problem - Solution - Result Case Study)
     * ------------------------------------------------------------- -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-custom">
                <!-- Modal Header -->
                <div class="modal-header modal-header-custom align-items-center">
                    <h5 class="modal-title" id="projectModalLabel" style="font-family: 'Sora', sans-serif; font-weight: 700;">Project Details</h5>
                    <button type="button" class="close-btn-custom ms-auto" data-bs-dismiss="modal" aria-label="Close details dialog">
                        <i class="bi bi-x-lg" aria-hidden="true"></i>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body modal-body-custom">
                    <div class="row g-4">
                        <!-- Project Main Image View -->
                        <div class="col-12">
                            <div class="project-card-image-wrap shadow-sm mb-3" style="aspect-ratio: 16/9; max-height: 380px; border-radius: var(--radius-lg); border: 1px solid var(--border-color); overflow: hidden;">
                                <img id="modal-project-img" src="" alt="Detailed project preview image" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                        </div>

                        <!-- Gallery Images Container -->
                        <div class="col-12" id="modal-project-gallery-wrap" style="display: none;">
                            <h4 class="fw-bold mb-2" style="font-size: 1rem; font-family: 'Sora', sans-serif;">Project Gallery</h4>
                            <div id="modal-project-gallery" class="d-flex flex-wrap gap-2 mb-3"></div>
                        </div>

                        <!-- Description & Tech Meta -->
                        <div class="col-12">
                            <!-- Role & Duration Info Row -->
                            <div class="row g-3 mb-4 p-3 border" style="border-radius: var(--radius-md); border-color: var(--border-color) !important; background-color: rgba(255,255,255,0.015);">
                                <div class="col-sm-6">
                                    <span class="text-secondary d-block" style="font-size: 0.7rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">My Role</span>
                                    <span id="modal-project-role" class="text-primary fw-bold fs-6">Developer</span>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <span class="text-secondary d-block" style="font-size: 0.7rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Duration</span>
                                    <span id="modal-project-duration" class="fw-bold fs-6">3 Months</span>
                                </div>
                            </div>

                            <!-- Short Description -->
                            <div id="modal-project-short-desc-wrap" class="mb-3" style="display: none;">
                                <p id="modal-project-short-desc" class="fw-semibold text-primary mb-0" style="font-size: 0.95rem; line-height: 1.6;"></p>
                            </div>

                            <!-- Overview Full Description -->
                            <div class="mb-4">
                                <h4 class="fw-bold mb-2" style="font-size: 1.1rem; font-family: 'Sora', sans-serif;">Full Description</h4>
                                <p id="modal-project-desc" class="text-secondary mb-0" style="line-height: 1.7; font-size: 0.9rem; white-space: pre-wrap;"></p>
                            </div>

                            <!-- Case Study Breakdown (Problem, Solution, Result) -->
                            <div class="row g-3 mb-4">
                                <!-- Problem Box -->
                                <div class="col-12 col-md-4">
                                    <div class="modal-section-box h-100">
                                        <div class="modal-section-title red">
                                            <i class="bi bi-exclamation-triangle" aria-hidden="true"></i> The Problem
                                        </div>
                                        <p id="modal-project-problem" class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.5; white-space: pre-wrap;"></p>
                                    </div>
                                </div>

                                <!-- Solution Box -->
                                <div class="col-12 col-md-4">
                                    <div class="modal-section-box h-100">
                                        <div class="modal-section-title blue">
                                            <i class="bi bi-gear-wide-connected" aria-hidden="true"></i> The Solution
                                        </div>
                                        <p id="modal-project-solution" class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.5; white-space: pre-wrap;"></p>
                                    </div>
                                </div>

                                <!-- Result Box -->
                                <div class="col-12 col-md-4">
                                    <div class="modal-section-box h-100">
                                        <div class="modal-section-title green">
                                            <i class="bi bi-graph-up-arrow" aria-hidden="true"></i> The Result
                                        </div>
                                        <p id="modal-project-result" class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.5; white-space: pre-wrap;"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tech tags -->
                            <div class="mb-4">
                                <h4 class="fw-bold mb-2" style="font-size: 1.1rem; font-family: 'Sora', sans-serif;">Technologies Used</h4>
                                <div id="modal-project-tech" class="project-tech-tags mb-0"></div>
                            </div>

                            <!-- Features List -->
                            <div id="modal-project-features-wrap">
                                <h4 class="fw-bold mb-2" style="font-size: 1.1rem; font-family: 'Sora', sans-serif;">Key Features</h4>
                                <ul id="modal-project-features" class="resp-list-custom mb-0"></ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer modal-footer-custom">
                    <a id="modal-github-link" href="#" target="_blank" class="btn-custom btn-custom-secondary btn-sm" aria-label="View Project on GitHub">
                        <i class="bi bi-github" aria-hidden="true"></i> View GitHub
                    </a>
                    <a id="modal-demo-link" href="#" target="_blank" class="btn-custom btn-custom-accent btn-sm ms-2" aria-label="View Project Live Demo">
                        <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Live Demo
                    </a>
                    <a id="modal-detail-link" href="#" class="btn-custom btn-custom-secondary btn-sm ms-auto" aria-label="Open Project Detail Page">
                        Full Case Study Page <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
