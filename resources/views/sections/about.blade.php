<!-- Handcrafted About Section (Why should you trust me?) -->
<section id="about" class="bg-section-theme">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Profile & Story</span>
            <h2 class="section-title text-gradient">My Journey & Background</h2>
        </div>

        <div class="row g-5 align-items-stretch">
            <!-- Left Column: Portrait & Biography -->
            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100">
                <div class="d-flex flex-column h-100 justify-content-between">
                    <!-- Photo Frame -->
                    <div class="profile-img-container shadow-sm mb-4">
                        <div class="profile-img-frame">
                            <img src="{{ $globalSettings['about_photo'] && str_starts_with($globalSettings['about_photo'], 'http') ? $globalSettings['about_photo'] : asset($globalSettings['about_photo']) }}" alt="Ghoza Himma Portrait" loading="lazy">
                        </div>
                    </div>

                    <!-- Storyteller Narrative -->
                    <div class="mb-2">
                        <h3 class="fw-bold mb-1" style="font-size: 1.25rem;">Ghoza Himma Al Farizqi</h3>
                        <p class="text-primary fw-semibold mb-3" style="font-size: 0.9rem;">{{ $globalSettings['about_headline'] }}</p>
                        
                        <p class="fs-6 mb-3" style="color: var(--text-secondary); line-height: 1.8; white-space: pre-wrap;">{{ $globalSettings['about_biography'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Strengths & Timeline -->
            <div class="col-lg-7 ps-lg-5 border-start-lg" data-aos="fade-left" data-aos-duration="600" data-aos-delay="200">
                <!-- Strengths Grid -->
                <div class="mb-5">
                    <h3 class="fw-bold mb-4 text-gradient" style="font-size: 1.25rem;"><i class="bi bi-shield-check text-primary" aria-hidden="true"></i> Core Focus Areas</h3>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="card-custom h-100" style="padding: 1.25rem;">
                                <h4 class="fw-bold fs-6 mb-2"><i class="bi bi-braces text-primary" aria-hidden="true"></i> Career Goal</h4>
                                <p class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.6;">{{ $globalSettings['about_career_goal'] }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-custom h-100" style="padding: 1.25rem;">
                                <h4 class="fw-bold fs-6 mb-2"><i class="bi bi-cpu text-primary" aria-hidden="true"></i> Current Focus</h4>
                                <p class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.6;">{{ $globalSettings['about_current_focus'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic Timeline -->
                <div class="mb-5">
                    <h3 class="fw-bold mb-4 text-gradient" style="font-size: 1.25rem;"><i class="bi bi-mortarboard text-primary" aria-hidden="true"></i> Education Journey</h3>
                    
                    <div class="timeline">
                        @forelse($educations as $edu)
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <span class="timeline-year">{{ $edu->start_date }} — {{ $edu->end_date }}</span>
                                <h4 class="timeline-title">{{ $edu->degree }} {{ $edu->major ? 'in ' . $edu->major : '' }}</h4>
                                <p class="timeline-subtitle mb-2">{{ $edu->school }}</p>
                                @if($edu->description)
                                    <p class="timeline-desc mb-0" style="white-space: pre-wrap;">{{ $edu->description }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <p class="text-secondary small mb-0">No education entries added yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Organizations & Leadership -->
                @if($organizations->isNotEmpty())
                    <div class="mb-5">
                        <h3 class="fw-bold mb-4 text-gradient" style="font-size: 1.25rem;"><i class="bi bi-people text-primary" aria-hidden="true"></i> Organizations & Leadership</h3>
                        <div class="timeline">
                            @foreach($organizations as $org)
                                <div class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <span class="timeline-year">{{ $org->start_date }} — {{ $org->end_date }}</span>
                                    <h4 class="timeline-title">{{ $org->position }}</h4>
                                    <p class="timeline-subtitle mb-2 text-primary">{{ $org->organization }}</p>
                                    @if($org->description)
                                        <p class="timeline-desc mb-0" style="white-space: pre-wrap;">{{ $org->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Awards & Honors -->
                @if($awards->isNotEmpty())
                    <div>
                        <h3 class="fw-bold mb-4 text-gradient" style="font-size: 1.25rem;"><i class="bi bi-trophy text-primary" aria-hidden="true"></i> Awards & Honors</h3>
                        <div class="row g-3">
                            @foreach($awards as $award)
                                <div class="col-sm-6">
                                    <div class="card-custom h-100" style="padding: 1.25rem;">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h4 class="fw-bold fs-6 mb-0 text-gradient">{{ $award->title }}</h4>
                                            <span class="badge bg-dark border text-light px-2 py-1" style="font-size: 0.7rem;">{{ $award->year }}</span>
                                        </div>
                                        @if($award->issuer)
                                            <p class="text-primary fw-semibold small mb-2" style="font-size: 0.8rem;">{{ $award->issuer }}</p>
                                        @endif
                                        @if($award->description)
                                            <p class="small text-secondary mb-0" style="font-size: 0.8rem; line-height: 1.5;">{{ $award->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
