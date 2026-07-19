<!-- Handcrafted Minimal Footer -->
<footer class="footer-minimal" aria-label="Footer Navigation">
    <div class="container text-center">
        <!-- Links Row -->
        <nav class="footer-link-group mb-4" aria-label="Footer Sitemap Links">
            <a href="#home" class="footer-link">Home</a>
            <a href="#about" class="footer-link">About</a>
            <a href="#skills" class="footer-link">Skills</a>
            <a href="#projects" class="footer-link">Projects</a>
            <a href="#experience" class="footer-link">Experience</a>
            <a href="#certificates" class="footer-link">Certifications</a>
            <a href="#contact" class="footer-link">Contact</a>
        </nav>

        <!-- Social Icons shortcuts -->
        <div class="footer-social-links mb-4 d-flex justify-content-center gap-3" aria-label="Social Profiles">
            @forelse($social_links as $link)
                <a href="{{ $link->url }}" target="_blank" class="footer-social-icon" aria-label="Visit Ghoza Himma {{ $link->platform }}">
                    <i class="{{ $link->icon ?: 'bi bi-link-45deg' }}" aria-hidden="true"></i>
                </a>
            @empty
                <a href="{{ $globalSettings['contact_github'] }}" target="_blank" class="footer-social-icon" aria-label="Visit Ghoza Himma GitHub">
                    <i class="bi bi-github" aria-hidden="true"></i>
                </a>
                <a href="{{ $globalSettings['contact_linkedin'] }}" target="_blank" class="footer-social-icon" aria-label="Visit Ghoza Himma LinkedIn">
                    <i class="bi bi-linkedin" aria-hidden="true"></i>
                </a>
                <a href="mailto:{{ $globalSettings['contact_email'] }}" class="footer-social-icon" aria-label="Email Ghoza Himma">
                    <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                </a>
            @endforelse
        </div>

        <!-- Copyright texts -->
        <p class="mb-0" style="font-size: 0.8rem; font-family: 'Sora', sans-serif; color: var(--text-secondary); letter-spacing: -0.01em;">
            &copy; {{ date('Y') }} Ghoza Himma Al Farizqi. All rights reserved.
        </p>
        <p class="mt-2 mb-0" style="font-size: 0.7rem; color: var(--text-secondary); opacity: 0.4;">
            Handcrafted with Laravel & Custom Styling.
        </p>
    </div>
</footer>
