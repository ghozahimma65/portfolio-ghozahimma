<!-- Handcrafted Editorial Hero Section -->
<section id="home" class="hero-section position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Hero Left: Branding, Biography, CTA & Statistics -->
            <div class="col-lg-6 pe-lg-4" data-aos="fade-right" data-aos-duration="600">
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if(!empty($globalSettings['about_photo']))
                        <div class="position-relative hero-avatar-sm" style="width: 56px; height: 56px; border-radius: 50%; overflow: hidden; border: 2px solid var(--accent); flex-shrink: 0;">
                            <img src="{{ str_starts_with($globalSettings['about_photo'], 'http') ? $globalSettings['about_photo'] : asset($globalSettings['about_photo']) }}" alt="Ghoza Himma" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endif
                    <div>
                        <span class="hero-subtitle mb-1 d-block">{{ $globalSettings['about_headline'] ?: 'Software Developer & Backend Specialist' }}</span>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1" style="font-size: 0.7rem;">
                            <i class="bi bi-circle-fill me-1" style="font-size: 0.45rem;"></i> Available for Hiring
                        </span>
                    </div>
                </div>
                
                <h1 class="hero-title text-gradient mb-3">
                    Building robust, secure & scalable applications.
                </h1>
 
                <!-- Dynamic Typing Text -->
                <p class="hero-tagline mb-3">
                    Specialized in <span id="typing-text" data-words="{{ json_encode(array_values(array_filter([$globalSettings['about_headline'], $globalSettings['about_current_focus'], $globalSettings['about_career_goal']]))) }}" style="color: var(--accent); font-weight: 700;"></span><span class="typed-cursor" aria-hidden="true">|</span>
                </p>
                
                <p class="fs-6 mb-4" style="color: var(--text-secondary); line-height: 1.75;">
                    {{ $globalSettings['about_biography'] }}
                </p>

                <!-- Call-To-Action buttons -->
                <div class="d-flex flex-wrap gap-2 gap-sm-3 mb-4">
                    <a href="#projects" class="btn-custom btn-custom-accent" aria-label="View Projects">
                        View Projects <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
                    </a>
                    <a href="#contact" class="btn-custom btn-custom-secondary" aria-label="Contact Me">
                        Contact Me <i class="bi bi-chat-dots" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('portfolio.cv.download') }}" class="btn-custom btn-custom-secondary" aria-label="Download CV as PDF">
                        Download CV <i class="bi bi-download" aria-hidden="true"></i>
                    </a>
                </div>

                <!-- Statistics row -->
                <div class="row g-3 hero-stats-row text-start">
                    <div class="col-4">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number"><span class="counter-value" data-target="{{ $projects->count() }}">0</span></div>
                            <div class="hero-stat-label">Projects</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number"><span class="counter-value" data-target="{{ $experiences->count() }}">0</span></div>
                            <div class="hero-stat-label">Experience</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number"><span class="counter-value" data-target="{{ $skills->count() }}">0</span></div>
                            <div class="hero-stat-label">Core Techs</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Right: Code Terminal & Developer Highlights Card -->
            <div class="col-lg-6 ps-lg-4" data-aos="fade-left" data-aos-duration="600">
                <!-- Code Terminal Mockup -->
                <div class="code-terminal shadow-lg mb-4">
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

                <!-- Career Goal, Current Focus & Core Tech Stack Container -->
                <div class="card-custom p-3 p-md-4 shadow-sm">
                    @if(!empty($globalSettings['about_career_goal']) || !empty($globalSettings['about_current_focus']))
                        <div class="row g-2 mb-3">
                            @if(!empty($globalSettings['about_career_goal']))
                                <div class="col-sm-6">
                                    <div class="p-2 border rounded h-100" style="border-color: var(--border-color) !important; background: rgba(255,255,255,0.02);">
                                        <span class="d-block text-primary fw-bold" style="font-size: 0.725rem;"><i class="bi bi-bullseye me-1"></i> Career Goal</span>
                                        <span class="text-secondary" style="font-size: 0.775rem; line-height: 1.5; display: block;">{{ $globalSettings['about_career_goal'] }}</span>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($globalSettings['about_current_focus']))
                                <div class="col-sm-6">
                                    <div class="p-2 border rounded h-100" style="border-color: var(--border-color) !important; background: rgba(255,255,255,0.02);">
                                        <span class="d-block text-primary fw-bold" style="font-size: 0.725rem;"><i class="bi bi-cpu me-1"></i> Current Focus</span>
                                        <span class="text-secondary" style="font-size: 0.775rem; line-height: 1.5; display: block;">{{ $globalSettings['about_current_focus'] }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Core Technologies Pills -->
                    <div>
                        <span class="small text-secondary d-block mb-2" style="font-size: 0.7rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.08em;">Core Technical Stack:</span>
                        <div class="d-flex flex-wrap gap-2" aria-label="Core Technical Stack">
                            @forelse($skills->take(8) as $skill)
                                <span class="skill-badge">
                                    @if($skill->icon)
                                        <i class="{{ $skill->icon }} text-primary" aria-hidden="true"></i>
                                    @else
                                        <i class="bi bi-code-slash text-primary" aria-hidden="true"></i>
                                    @endif
                                    {{ $skill->name }}
                                </span>
                            @empty
                                <span class="skill-badge"><i class="bi bi-server text-primary"></i> Laravel</span>
                                <span class="skill-badge"><i class="bi bi-phone-fill text-primary"></i> Flutter</span>
                            @endforelse
                        </div>
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
