<!-- Handcrafted Editorial Hero Section -->
<section id="home" class="hero-section position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Hero Left: Typography Focus -->
            <div class="col-lg-7 pe-lg-4" data-aos="fade-right" data-aos-duration="600">
                <span class="hero-subtitle">{{ $globalSettings['about_headline'] }}</span>
                
                <h1 class="hero-title text-gradient mb-3">
                    Building robust, secure & scalable applications.
                </h1>
 
                <!-- Custom Typing Text -->
                <p class="hero-tagline mb-3">
                    Specialized in <span id="typing-text" style="color: var(--accent); font-weight: 700;"></span><span class="typed-cursor" aria-hidden="true">|</span>
                </p>
                
                <p class="fs-6 mb-4" style="color: var(--text-secondary); max-width: 580px; line-height: 1.8;">
                    {{ $globalSettings['about_biography'] }}
                </p>

                <!-- Core Technologies pills -->
                <div class="d-flex flex-wrap gap-2 mb-4" aria-label="Core Technical Stack">
                    <span class="skill-badge"><i class="bi bi-server text-primary" aria-hidden="true"></i> Laravel</span>
                    <span class="skill-badge"><i class="bi bi-phone-fill text-primary" aria-hidden="true"></i> Flutter</span>
                    <span class="skill-badge"><i class="bi bi-code-slash text-primary" aria-hidden="true"></i> PHP</span>
                    <span class="skill-badge"><i class="bi bi-database-fill text-primary" aria-hidden="true"></i> MySQL</span>
                    <span class="skill-badge"><i class="bi bi-braces text-primary" aria-hidden="true"></i> REST API</span>
                    <span class="skill-badge"><i class="bi bi-cpu text-primary" aria-hidden="true"></i> ESP32</span>
                </div>

                <!-- Call-To-Action Apple/Vercel rectangular buttons -->
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="#projects" class="btn-custom btn-custom-accent" aria-label="View Ghoza Himma Projects">
                        View Projects <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
                    </a>
                    <a href="#contact" class="btn-custom btn-custom-secondary" aria-label="Contact Ghoza Himma">
                        Contact Me <i class="bi bi-chat-dots" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('portfolio.cv.download') }}" class="btn-custom btn-custom-secondary" aria-label="Download CV as PDF">
                        Download CV <i class="bi bi-download" aria-hidden="true"></i>
                    </a>
                </div>

                <!-- Statistics row -->
                <div class="row g-4 hero-stats-row text-start">
                    <div class="col-4">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number"><span class="counter-value" data-target="{{ $projects->count() ?: 3 }}">0</span>+</div>
                            <div class="hero-stat-label">Projects</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number"><span class="counter-value" data-target="{{ $experiences->count() ?: 1 }}">0</span></div>
                            <div class="hero-stat-label">Internship</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number">{{ $skills->count() ?: 6 }}</div>
                            <div class="hero-stat-label">Core Techs</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Right: Code Terminal Mockup (Visual Backend Representation) -->
            <div class="col-lg-5 ps-lg-4" data-aos="fade-left" data-aos-duration="600">
                <div class="code-terminal shadow-lg">
                    <div class="terminal-header">
                        <span class="terminal-dot red" aria-hidden="true"></span>
                        <span class="terminal-dot yellow" aria-hidden="true"></span>
                        <span class="terminal-dot green" aria-hidden="true"></span>
                        <span class="terminal-title" aria-label="Terminal File: routes/api.php">routes/api.php</span>
                    </div>
                    <div class="terminal-body" style="font-size: 0.75rem;">
                        <p class="mb-1"><span class="t-keyword">use</span> <span class="t-class">Illuminate\Support\Facades\Route</span>;</p>
                        <p class="mb-1"><span class="t-keyword">use</span> <span class="t-class">App\Http\Controllers\TelemetryController</span>;</p>
                        <p class="mb-3"><span class="t-keyword">use</span> <span class="t-class">App\Http\Controllers\PickupController</span>;</p>
                        
                        <p class="mb-1"><span class="t-keyword">Route</span>::<span class="t-func">middleware</span>(<span class="t-string">'auth:sanctum'</span>)-><span class="t-func">group</span>(<span class="t-keyword">function</span> () {</p>
                        <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;<span class="t-comment">// 1. Telemetry IoT Stream Intake API</span></p>
                        <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;<span class="t-keyword">Route</span>::<span class="t-func">post</span>(<span class="t-string">'/telemetry/stream'</span>, [</p>
                        <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="t-class">TelemetryController</span>::<span class="t-keyword">class</span>, <span class="t-string">'store'</span></p>
                        <p class="mb-2">&nbsp;&nbsp;&nbsp;&nbsp;]);</p>
                        
                        <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;<span class="t-comment">// 2. PAUD Guardian Verification System</span></p>
                        <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;<span class="t-keyword">Route</span>::<span class="t-func">get</span>(<span class="t-string">'/pickup/verify/{qr_code}'</span>, [</p>
                        <p class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="t-class">PickupController</span>::<span class="t-keyword">class</span>, <span class="t-string">'verify'</span></p>
                        <p class="mb-2">&nbsp;&nbsp;&nbsp;&nbsp;]);</p>
                        <p class="mb-0">});</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll down indicator -->
    <div id="scroll-down-indicator" class="scroll-indicator" aria-hidden="true">
        <div class="scroll-indicator-mouse">
            <div class="scroll-indicator-wheel"></div>
        </div>
    </div>
</section>
