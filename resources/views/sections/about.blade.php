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
                            <img src="{{ asset($globalSettings['about_photo']) }}" alt="Ghoza Himma Portrait" loading="lazy">
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
                <div>
                    <h3 class="fw-bold mb-4 text-gradient" style="font-size: 1.25rem;"><i class="bi bi-mortarboard text-primary" aria-hidden="true"></i> Education Journey</h3>
                    
                    <div class="timeline">
                        @forelse($educations as $edu)
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <span class="timeline-year">{{ $edu->start_date }} — {{ $edu->end_date }}</span>
                                <h4 class="timeline-title">{{ $edu->degree }} {{ $edu->major ? 'in ' . $edu->major : '' }}</h4>
                                <p class="timeline-subtitle mb-2">{{ $edu->school }}</p>
                                @if($edu->description)
                                    <p class="timeline-desc" style="white-space: pre-wrap;">{{ $edu->description }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="timeline-item">
                                <div class="timeline-marker"></div>
                                <span class="timeline-year">2021 — 2024</span>
                                <h4 class="timeline-title">D3 Manajemen Informatika</h4>
                                <p class="timeline-subtitle mb-2">Politeknik Negeri Jember</p>
                                <p class="timeline-desc">
                                    Mempelajari rekayasa perangkat lunak dasar, struktur data, basis data relasional, pemrograman berorientasi objek (OOP), perancangan sistem informasi, dan UI/UX design. Fokus tugas akhir dan proyek praktis mencakup implementasi full-stack web, mobile integration, dan Internet of Things (IoT).
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
