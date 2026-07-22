<!-- Handcrafted Editorial Skills Section -->
<section id="skills">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header text-center" data-aos="fade-up" data-aos-duration="600">
            <span class="section-subtitle">Technical Competencies</span>
            <h2 class="section-title text-gradient">Core Skills</h2>
        </div>

        @php
            // Predefine the logical grouping rules (order of keys is preserved)
            $groupMappings = [
                'Backend' => [
                    'Laravel', 'PHP'
                ],
                'Frontend' => [
                    'HTML5', 'HTML', 'CSS3', 'CSS', 'JavaScript', 'Blade', 'Tailwind CSS', 'Alpine.js', 'Bootstrap', 'Vite'
                ],
                'Database' => [
                    'MySQL', 'SQLite', 'PostgreSQL'
                ],
                'API' => [
                    'REST API', 'Laravel Sanctum', 'JSON', 'JSON Payload', 'Postman'
                ],
                'Mobile' => [
                    'Flutter', 'Dart'
                ],
                'IoT' => [
                    'ESP32', 'HC-SR04'
                ],
                'Development Ecosystem' => [
                    'Git', 'GitHub', 'VS Code', 'Android Studio', 'Figma'
                ]
            ];

            // Map each group name to its icon and description
            $groupMetadata = [
                'Backend' => [
                    'icon' => 'bi-server',
                    'desc' => 'Building secure and scalable web applications.'
                ],
                'Frontend' => [
                    'icon' => 'bi-window-sidebar',
                    'desc' => 'Crafting beautiful, responsive, and interactive user interfaces.'
                ],
                'Database' => [
                    'icon' => 'bi-database',
                    'desc' => 'Relational database management and optimization.'
                ],
                'API' => [
                    'icon' => 'bi-braces-asterisk',
                    'desc' => 'Designing and integrating secure, structured web services.'
                ],
                'Mobile' => [
                    'icon' => 'bi-phone',
                    'desc' => 'Developing fluid cross-platform native applications.'
                ],
                'IoT' => [
                    'icon' => 'bi-cpu',
                    'desc' => 'Integrating firmware architectures with hardware circuits.'
                ],
                'Development Ecosystem' => [
                    'icon' => 'bi-tools',
                    'desc' => 'Modern versioning, workflows, environments, and prototyping.'
                ],
            ];

            // Reorganize skills dynamically based on the logical groupings
            $reorganizedGroups = [];
            foreach ($groupMappings as $groupName => $names) {
                $matchedSkills = $skills->filter(function($skill) use ($names) {
                    return in_array($skill->name, $names);
                });

                if ($matchedSkills->isNotEmpty()) {
                    $reorganizedGroups[$groupName] = $matchedSkills;
                }
            }

            // Capture any leftover skills that didn't match the predefined mappings to ensure no data loss
            $matchedSkillsIds = collect($reorganizedGroups)->flatten()->pluck('id');
            $leftoverSkills = $skills->reject(function($skill) use ($matchedSkillsIds) {
                return $matchedSkillsIds->contains($skill->id);
            });

            if ($leftoverSkills->isNotEmpty()) {
                $reorganizedGroups['General Skills'] = $leftoverSkills;
                $groupMetadata['General Skills'] = [
                    'icon' => 'bi-cpu-fill',
                    'desc' => 'Additional technical tools and competencies.'
                ];
            }
        @endphp

        <!-- Dynamic Category Grid Layout -->
        <div class="row g-4 justify-content-center">
            @forelse($reorganizedGroups as $categoryName => $categorySkills)
                <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="600">
                    <div class="skills-column d-flex flex-column h-100">
                        <div class="mb-4">
                            <h3 class="skills-title text-gradient-accent mb-2">
                                <i class="bi {{ $groupMetadata[$categoryName]['icon'] ?? 'bi-cpu' }} text-primary me-2" aria-hidden="true"></i> {{ $categoryName }}
                            </h3>
                            <p class="text-secondary small mb-0" style="font-size: 0.8rem; line-height: 1.5; color: var(--text-secondary) !important;">
                                {{ $groupMetadata[$categoryName]['desc'] ?? 'Technical tools and competencies.' }}
                            </p>
                        </div>
                        <div class="skills-badge-list flex-grow-1 d-flex flex-wrap align-content-start gap-2">
                            @foreach($categorySkills as $skill)
                                <span class="skill-badge">
                                    @if($skill->icon)
                                        <i class="{{ $skill->icon }} text-primary me-1" aria-hidden="true"></i>
                                    @else
                                        <i class="bi bi-check-circle-fill text-primary me-1" aria-hidden="true"></i>
                                    @endif
                                    {{ $skill->name }}
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
