<!-- Handcrafted Experience Section (Why am I qualified?) -->
<section id="experience">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Career Roadmap</span>
            <h2 class="section-title text-gradient">Work Experience</h2>
        </div>

        <!-- Experience Timeline Grid -->
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                <div class="timeline">
                    @forelse($experiences as $experience)
                        <!-- Timeline Card Item -->
                        <div class="timeline-item">
                            <!-- Marker -->
                            <div class="timeline-marker"></div>
                            
                            <div class="card-custom">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                    <div>
                                        <h3 class="fw-bold mb-1" style="font-size: 1.25rem;">{{ $experience->role }}</h3>
                                        <p class="mb-0 fw-semibold text-primary" style="font-size: 0.95rem;">
                                            {{ $experience->company }}
                                            @if(!empty($experience->location))
                                                <span class="text-secondary fw-normal fs-6">| <i class="bi bi-geo-alt" aria-hidden="true"></i> {{ $experience->location }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <span class="badge bg-dark border text-light mt-2 mt-md-0 px-3 py-2" style="font-size: 0.75rem; font-family: 'Sora', sans-serif; border-color: var(--border-color) !important;">
                                        {{ $experience->start_date }} — {{ $experience->end_date }}
                                    </span>
                                </div>
                                
                                @if(!empty($experience->responsibilities) && is_array($experience->responsibilities))
                                    <p class="small text-secondary mb-2 fw-semibold">Main Responsibilities:</p>
                                    <ul class="resp-list-custom mb-3">
                                        @foreach($experience->responsibilities as $responsibility)
                                            <li>{{ $responsibility }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if(!empty($experience->achievements) && is_array($experience->achievements))
                                    <div class="p-3 mb-4 rounded border" style="background-color: rgba(234, 179, 8, 0.05); border-color: rgba(234, 179, 8, 0.2) !important;">
                                        <p class="small text-warning mb-2 fw-bold d-flex align-items-center gap-1"><i class="bi bi-trophy-fill me-1"></i> Key Achievements:</p>
                                        <ul class="resp-list-custom mb-0">
                                            @foreach($experience->achievements as $achievement)
                                                <li style="color: var(--text-primary);">{{ $achievement }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Technologies used during this role -->
                                @if(!empty($experience->tech_stack) && is_array($experience->tech_stack))
                                    <div class="border-top pt-3" style="border-color: var(--border-color) !important;">
                                        <span class="small text-secondary d-block mb-2" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Technologies Applied:</span>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($experience->tech_stack as $tech)
                                                <span class="project-tech-badge">{{ $tech }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-briefcase-fill fs-1 text-secondary"></i>
                            <p class="text-secondary mt-3">No work experience data available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
