<!-- Handcrafted Contact Section -->
<section id="contact">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Get In Touch</span>
            <h2 class="section-title text-gradient">Connect With Me</h2>
        </div>

        <div class="row g-5">
            <!-- Contact Details -->
            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100">
                <div class="d-flex flex-column justify-content-between h-100 gap-4">
                    <div>
                        <h3 class="fw-bold mb-3" style="font-family: 'Sora', sans-serif;">Let's discuss a project</h3>
                        <p class="text-secondary fs-6 mb-4" style="line-height: 1.8;">
                            Saya selalu terbuka untuk membahas peluang kerja sama baru, perancangan API/backend sistem, integrasi IoT telemetry, atau posisi developer backend penuh waktu. Silakan kirim pesan atau hubungi saya langsung!
                        </p>
                    </div>

                     <!-- Direct Connect list -->
                    <div class="contact-info-list my-2">
                        <!-- Email Link -->
                        @if(!empty($globalSettings['contact_email']))
                            <div class="contact-info-item">
                                <div class="contact-info-icon" aria-hidden="true">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h4>Email Address</h4>
                                    <p><a href="mailto:{{ $globalSettings['contact_email'] }}" aria-label="Send email">{{ $globalSettings['contact_email'] }}</a></p>
                                </div>
                            </div>
                        @endif

                        <!-- LinkedIn Link -->
                        @if(!empty($globalSettings['contact_linkedin']))
                            <div class="contact-info-item">
                                <div class="contact-info-icon" aria-hidden="true">
                                    <i class="bi bi-linkedin"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h4>LinkedIn</h4>
                                    <p><a href="{{ $globalSettings['contact_linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="Visit LinkedIn">{{ str_replace(['https://', 'http://', 'www.'], '', $globalSettings['contact_linkedin']) }}</a></p>
                                </div>
                            </div>
                        @endif

                        <!-- GitHub Link -->
                        @if(!empty($globalSettings['contact_github']))
                            <div class="contact-info-item">
                                <div class="contact-info-icon" aria-hidden="true">
                                    <i class="bi bi-github"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h4>GitHub</h4>
                                    <p><a href="{{ $globalSettings['contact_github'] }}" target="_blank" rel="noopener noreferrer" aria-label="Visit GitHub">{{ str_replace(['https://', 'http://', 'www.'], '', $globalSettings['contact_github']) }}</a></p>
                                </div>
                            </div>
                        @endif

                        <!-- Instagram Link -->
                        @if(!empty($globalSettings['contact_instagram']))
                            <div class="contact-info-item">
                                <div class="contact-info-icon" aria-hidden="true">
                                    <i class="bi bi-instagram"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h4>Instagram</h4>
                                    <p><a href="{{ $globalSettings['contact_instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Visit Instagram">{{ str_replace(['https://', 'http://', 'www.'], '', $globalSettings['contact_instagram']) }}</a></p>
                                </div>
                            </div>
                        @endif

                        <!-- Location Link -->
                        @if(!empty($globalSettings['contact_location']))
                            <div class="contact-info-item">
                                <div class="contact-info-icon" aria-hidden="true">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h4>Location</h4>
                                    <p>{{ $globalSettings['contact_location'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
 
                    <!-- WhatsApp CTA Card -->
                    @if(!empty($globalSettings['contact_whatsapp']))
                        <div class="card-custom text-start" style="padding: 1.5rem;">
                            <h4 class="fw-bold text-gradient mb-2" style="font-family: 'Sora', sans-serif; font-size: 1.05rem;"><i class="bi bi-whatsapp text-success" aria-hidden="true"></i> Direct Chat</h4>
                            <p class="text-secondary small mb-3" style="font-size: 0.8rem; line-height: 1.5;">Hubungi saya langsung via WhatsApp untuk respons cepat.</p>
                            <a href="{{ str_starts_with($globalSettings['contact_whatsapp'], 'http') ? $globalSettings['contact_whatsapp'] : 'https://wa.me/' . preg_replace('/[^0-9]/', '', $globalSettings['contact_whatsapp']) . '?text=Hello,%20I%20visited%20your%20portfolio...' }}" target="_blank" rel="noopener noreferrer" class="link-arrow" aria-label="Chat directly on WhatsApp">
                                Chat on WhatsApp <i class="bi bi-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- AJAX Contact Form -->
            <div class="col-lg-7" data-aos="fade-left" data-aos-duration="600" data-aos-delay="200">
                <div class="card-custom h-100">
                    <h3 class="fw-bold mb-4" style="font-family: 'Sora', sans-serif;">Send a Message</h3>
                    
                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 form-group-custom">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-custom" placeholder="e.g. John Doe" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 form-group-custom">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control form-control-custom" placeholder="e.g. john@example.com" required>
                            </div>

                            <!-- Subject -->
                            <div class="col-12 form-group-custom">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control form-control-custom" placeholder="Project Inquiry / Job Opportunity">
                            </div>

                            <!-- Message -->
                            <div class="col-12 form-group-custom">
                                <label for="message" class="form-label">Your Message</label>
                                <textarea id="message" name="message" rows="5" class="form-control form-control-custom" placeholder="Write your message details here..." required></textarea>
                            </div>

                            <!-- Submit button -->
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn-custom btn-custom-accent w-100" style="padding: 12px 24px;">
                                    Send Message <i class="bi bi-send ms-2" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
