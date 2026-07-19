<!-- Handcrafted Certificates Section -->
<section id="certificates" class="bg-section-theme">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Academic Credentials</span>
            <h2 class="section-title text-gradient">Certifications</h2>
        </div>

        <!-- Certificates Grid -->
        <div class="row g-4">
            @forelse($certificates as $index => $certificate)
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-duration="600" data-aos-delay="{{ 50 * ($index + 1) }}">
                    <div class="cert-card-modern">
                        <!-- Thumbnail Image Frame -->
                        <div class="cert-image-wrap shadow-sm">
                            @if(!empty($certificate->image_path))
                                <img src="{{ asset($certificate->image_path) }}" alt="{{ $certificate->title }} certificate document" loading="lazy">
                            @else
                                <img src="{{ asset('assets/images/cert-placeholder.png') }}" alt="{{ $certificate->title }} placeholder preview" loading="lazy">
                            @endif
                        </div>

                        <!-- Card Body Details -->
                        <div class="d-flex flex-column flex-grow-1">
                            <h3 class="cert-title mt-2" style="font-size: 0.95rem;">{{ $certificate->title }}</h3>
                            
                            <p class="cert-issuer text-secondary mb-3 mt-auto" style="font-size: 0.75rem; line-height: 1.5;">
                                {{ $certificate->issuer }}<br>
                                <span class="fw-semibold text-primary" style="font-family: 'Sora', sans-serif;">{{ $certificate->issue_date ?? 'N/A' }}</span>
                            </p>

                            <!-- Optional Credential link -->
                            @if(!empty($certificate->credential_url))
                                <a href="{{ $certificate->credential_url }}" target="_blank" class="link-arrow mt-auto" aria-label="Verify Ghoza Himma Certificate for {{ $certificate->title }}">
                                    Verify Credential <i class="bi bi-chevron-right" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-award fs-1 text-secondary" aria-hidden="true"></i>
                    <p class="text-secondary mt-3">No certificates registered yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
