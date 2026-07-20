<!-- Handcrafted Editorial Skills Section -->
<section id="skills">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Technical Competencies</span>
            <h2 class="section-title text-gradient">Core Skills</h2>
        </div>

        <!-- Dynamic Category Grid Layout -->
        <div class="row g-4 justify-content-center">
            @php
                $groupedSkills = $skills->groupBy(function($item) {
                    return $item->category ?: 'General Skills';
                });
            @endphp

            @forelse($groupedSkills as $categoryName => $categorySkills)
                <div class="col-md-6 {{ count($categorySkills) > 6 ? 'col-lg-6' : 'col-lg-4' }}" data-aos="fade-up" data-aos-duration="600">
                    <div class="skills-column h-100">
                        <h3 class="skills-title text-gradient-accent">
                            @php
                                $catLower = strtolower($categoryName);
                                $catIcon = 'bi-cpu';
                                if (str_contains($catLower, 'backend')) $catIcon = 'bi-server';
                                elseif (str_contains($catLower, 'database')) $catIcon = 'bi-database';
                                elseif (str_contains($catLower, 'api')) $catIcon = 'bi-braces';
                                elseif (str_contains($catLower, 'mobile')) $catIcon = 'bi-phone-fill';
                                elseif (str_contains($catLower, 'iot')) $catIcon = 'bi-cpu-fill';
                                elseif (str_contains($catLower, 'frontend')) $catIcon = 'bi-layout-wtf';
                                elseif (str_contains($catLower, 'tool')) $catIcon = 'bi-tools';
                            @endphp
                            <i class="bi {{ $catIcon }} text-primary me-2" aria-hidden="true"></i> {{ $categoryName }}
                        </h3>
                        <div class="skills-badge-list mt-3">
                            @foreach($categorySkills as $skill)
                                <span class="skill-badge">
                                    @if($skill->icon)
                                        <i class="{{ $skill->icon }} text-primary me-1" aria-hidden="true"></i>
                                    @else
                                        <i class="bi bi-check-circle-fill text-primary me-1" aria-hidden="true"></i>
                                    @endif
                                    {{ $skill->name }}
                                    @if(!empty($skill->level) && strtolower($skill->level) !== 'intermediate')
                                        <small class="text-secondary opacity-75 ms-1" style="font-size: 0.7rem;">({{ $skill->level }})</small>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-tools fs-1 text-secondary"></i>
                    <p class="text-secondary mt-3">No skills data available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
