<!-- Handcrafted Editorial Skills Section -->
<section id="skills">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Technical Competencies</span>
            <h2 class="section-title text-gradient">Core Skills</h2>
        </div>

        <!-- 7-Category Grid Layout -->
        <div class="row g-4 justify-content-center">
            <!-- Row 1: Backend, Database, API -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                <div class="skills-column">
                    <h3 class="skills-title text-gradient-accent"><i class="bi bi-server text-primary" aria-hidden="true"></i> Backend Development</h3>
                    <p class="small text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5;">Arsitektur server-side, routing, business logic, MVC patterns, dan middleware controller.</p>
                    <div class="skills-badge-list">
                        @forelse($skills->where('category', 'Backend') as $skill)
                            <span class="skill-badge">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} text-primary" aria-hidden="true"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @empty
                            <span class="skill-badge"><i class="bi bi-code-slash text-primary" aria-hidden="true"></i> PHP</span>
                            <span class="skill-badge"><i class="bi bi-server text-primary" aria-hidden="true"></i> Laravel</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="150">
                <div class="skills-column">
                    <h3 class="skills-title text-gradient-accent"><i class="bi bi-database text-primary" aria-hidden="true"></i> Database Architecture</h3>
                    <p class="small text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5;">Desain skema basis data relasional, normalisasi data, query builder, dan migrasi terstruktur.</p>
                    <div class="skills-badge-list">
                        @forelse($skills->where('category', 'Database') as $skill)
                            <span class="skill-badge">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} text-primary" aria-hidden="true"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @empty
                            <span class="skill-badge"><i class="bi bi-database-fill text-primary" aria-hidden="true"></i> MySQL</span>
                            <span class="skill-badge"><i class="bi bi-filetype-sql text-primary" aria-hidden="true"></i> SQLite</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                <div class="skills-column">
                    <h3 class="skills-title text-gradient-accent"><i class="bi bi-braces text-primary" aria-hidden="true"></i> API Development</h3>
                    <p class="small text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5;">Perancangan endpoints RESTful, validasi request, respons JSON, dan otentikasi data (Sanctum/QR).</p>
                    <div class="skills-badge-list">
                        @forelse($skills->where('category', 'API') as $skill)
                            <span class="skill-badge">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} text-primary" aria-hidden="true"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @empty
                            <span class="skill-badge"><i class="bi bi-braces text-primary" aria-hidden="true"></i> REST API</span>
                            <span class="skill-badge"><i class="bi bi-filetype-json text-primary" aria-hidden="true"></i> JSON Payload</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Row 2: Mobile, IoT, Frontend -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="250">
                <div class="skills-column">
                    <h3 class="skills-title text-gradient-accent"><i class="bi bi-phone-fill text-primary" aria-hidden="true"></i> Mobile Development</h3>
                    <p class="small text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5;">Pengembangan aplikasi lintas platform (Android/iOS) dengan performa UI & state management clean.</p>
                    <div class="skills-badge-list">
                        @forelse($skills->where('category', 'Mobile') as $skill)
                            <span class="skill-badge">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} text-primary" aria-hidden="true"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @empty
                            <span class="skill-badge"><i class="bi bi-code text-primary" aria-hidden="true"></i> Dart</span>
                            <span class="skill-badge"><i class="bi bi-phone text-primary" aria-hidden="true"></i> Flutter</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                <div class="skills-column">
                    <h3 class="skills-title text-gradient-accent"><i class="bi bi-cpu-fill text-primary" aria-hidden="true"></i> Internet of Things (IoT)</h3>
                    <p class="small text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5;">Pengukuran sensor telemetry, transmisi data ESP32 mikrokontroler, dan visualisasi volume waktu nyata.</p>
                    <div class="skills-badge-list">
                        @forelse($skills->where('category', 'IoT') as $skill)
                            <span class="skill-badge">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} text-primary" aria-hidden="true"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @empty
                            <span class="skill-badge"><i class="bi bi-cpu text-primary" aria-hidden="true"></i> ESP32</span>
                            <span class="skill-badge"><i class="bi bi-broadcast text-primary" aria-hidden="true"></i> Telemetry Sensors</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="350">
                <div class="skills-column">
                    <h3 class="skills-title text-gradient-accent"><i class="bi bi-layout-wtf text-primary" aria-hidden="true"></i> Frontend Essentials</h3>
                    <p class="small text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5;">Struktur semantik HTML, flex/grid layouts, penataan vanilla CSS, dan kerangka responsif.</p>
                    <div class="skills-badge-list">
                        @forelse($skills->where('category', 'Frontend') as $skill)
                            <span class="skill-badge">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} text-primary" aria-hidden="true"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @empty
                            <span class="skill-badge"><i class="bi bi-filetype-html text-primary" aria-hidden="true"></i> HTML5</span>
                            <span class="skill-badge"><i class="bi bi-filetype-css text-primary" aria-hidden="true"></i> CSS3</span>
                            <span class="skill-badge"><i class="bi bi-filetype-js text-primary" aria-hidden="true"></i> JavaScript</span>
                            <span class="skill-badge"><i class="bi bi-bootstrap text-primary" aria-hidden="true"></i> Bootstrap</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Row 3: Tools (Full Width) -->
            <div class="col-lg-12" data-aos="fade-up" data-aos-duration="600" data-aos-delay="400">
                <div class="skills-column">
                    <h3 class="skills-title text-gradient-accent"><i class="bi bi-tools text-primary" aria-hidden="true"></i> Development Tools & Environments</h3>
                    <p class="small text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5;">Alat penunjang versioning kode, kolaborasi tim dev, pengujian fungsionalitas REST endpoints, dan perancangan prototype UI/UX.</p>
                    <div class="skills-badge-list">
                        @forelse($skills->where('category', 'Tools') as $skill)
                            <span class="skill-badge">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }}" aria-hidden="true"></i>
                                @endif
                                {{ $skill->name }}
                            </span>
                        @empty
                            <span class="skill-badge"><i class="bi bi-git text-danger" aria-hidden="true"></i> Git</span>
                            <span class="skill-badge"><i class="bi bi-github" aria-hidden="true"></i> GitHub</span>
                            <span class="skill-badge"><i class="bi bi-terminal-fill text-primary" aria-hidden="true"></i> VS Code</span>
                            <span class="skill-badge"><i class="bi bi-android2 text-success" aria-hidden="true"></i> Android Studio</span>
                            <span class="skill-badge"><i class="bi bi-send-fill text-warning" aria-hidden="true"></i> Postman</span>
                            <span class="skill-badge"><i class="bi bi-figma text-purple" aria-hidden="true"></i> Figma</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
