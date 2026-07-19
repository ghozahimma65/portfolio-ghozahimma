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
            <div class="filter-btn-group" role="tablist" aria-label="Project Tech Filter">
                <button class="filter-btn active" data-filter="all" role="tab" aria-selected="true">All</button>
                <button class="filter-btn" data-filter="Laravel" role="tab" aria-selected="false">Laravel</button>
                <button class="filter-btn" data-filter="Flutter" role="tab" aria-selected="false">Flutter</button>
                <button class="filter-btn" data-filter="MySQL" role="tab" aria-selected="false">MySQL</button>
                <button class="filter-btn" data-filter="ESP32" role="tab" aria-selected="false">IoT / ESP32</button>
            </div>
        </div>

        <!-- Project Cards Grid -->
        <div class="row g-4">
            @forelse($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-folder-x fs-1 text-secondary" aria-hidden="true"></i>
                    <p class="text-secondary mt-3 fs-5">No projects found. Please run seeders.</p>
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
                        <!-- Project Image View -->
                        <div class="col-12">
                            <div class="project-card-image-wrap shadow-sm mb-3" style="aspect-ratio: 16/9; max-height: 380px; border-radius: var(--radius-lg); border: 1px solid var(--border-color); overflow: hidden;">
                                <img id="modal-project-img" src="" alt="Detailed project preview image">
                            </div>
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

                            <!-- Overview Description -->
                            <div class="mb-4">
                                <h4 class="fw-bold mb-2" style="font-size: 1.1rem; font-family: 'Sora', sans-serif;">Overview</h4>
                                <p id="modal-project-desc" class="text-secondary mb-0" style="line-height: 1.7; font-size: 0.9rem;"></p>
                            </div>

                            <!-- Case Study Breakdown (Problem, Solution, Result) -->
                            <div class="row g-3 mb-4">
                                <!-- Problem Box -->
                                <div class="col-12 col-md-4">
                                    <div class="modal-section-box h-100">
                                        <div class="modal-section-title red">
                                            <i class="bi bi-exclamation-triangle" aria-hidden="true"></i> The Problem
                                        </div>
                                        <p id="modal-project-problem" class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.5;"></p>
                                    </div>
                                </div>

                                <!-- Solution Box -->
                                <div class="col-12 col-md-4">
                                    <div class="modal-section-box h-100">
                                        <div class="modal-section-title blue">
                                            <i class="bi bi-gear-wide-connected" aria-hidden="true"></i> The Solution
                                        </div>
                                        <p id="modal-project-solution" class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.5;"></p>
                                    </div>
                                </div>

                                <!-- Result Box -->
                                <div class="col-12 col-md-4">
                                    <div class="modal-section-box h-100">
                                        <div class="modal-section-title green">
                                            <i class="bi bi-graph-up-arrow" aria-hidden="true"></i> The Result
                                        </div>
                                        <p id="modal-project-result" class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.5;"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tech tags -->
                            <div class="mb-4">
                                <h4 class="fw-bold mb-2" style="font-size: 1.1rem; font-family: 'Sora', sans-serif;">Technologies Used</h4>
                                <div id="modal-project-tech" class="project-tech-tags mb-0"></div>
                            </div>

                            <!-- Features List -->
                            <div>
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
                </div>
            </div>
        </div>
    </div>
</section>
