@props(['project'])

<div class="col-md-6 project-item" data-tech="{{ implode(',', $project->tech_stack) }}">
    <div class="project-card h-100" data-aos="fade-up" data-aos-duration="600">
        <!-- Project Screenshot (Hero of the Card) -->
        <div class="project-card-image-wrap shadow-sm">
            @if(!empty($project->image_path))
                <img src="{{ str_starts_with($project->image_path, 'http') ? $project->image_path : asset($project->image_path) }}" alt="{{ $project->title }} preview image" loading="lazy">
            @else
                <img src="{{ asset('assets/images/project-placeholder.png') }}" alt="{{ $project->title }} placeholder preview" loading="lazy">
            @endif
        </div>

        <!-- Project Editorial Metadata -->
        <div class="project-card-content">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <span class="project-category-badge">
                        @if(in_array('Flutter', $project->tech_stack))
                            Mobile Application
                        @elseif(in_array('ESP32', $project->tech_stack) || in_array('IoT Sensors', $project->tech_stack))
                            IoT Telemetry System
                        @else
                            Web Application
                        @endif
                    </span>
                    <h3 class="project-card-title mb-1" style="font-size: 1.15rem;">{{ $project->title }}</h3>
                </div>
            </div>

            <!-- Role Badge -->
            <div class="mb-3" style="font-size: 0.8rem; opacity: 0.8;">
                <span class="text-primary font-medium"><i class="bi bi-person-workspace" aria-hidden="true"></i> {{ $project->role ?? 'Software Developer' }}</span>
                <span class="text-secondary mx-1">•</span>
                <span class="text-secondary">{{ $project->duration ?? '2 Months' }}</span>
            </div>
            
            <p class="project-card-desc mb-4">{{ Str::limit($project->description, 115) }}</p>

            <!-- Subtle Tech Tags -->
            <div class="project-tech-tags mb-4">
                @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                    <span class="project-tech-badge">{{ $tech }}</span>
                @endforeach
                @if(count($project->tech_stack) > 4)
                    <span class="project-tech-badge">+{{ count($project->tech_stack) - 4 }}</span>
                @endif
            </div>

            <!-- Actions Row -->
            <div class="project-card-footer">
                @if(!empty($project->github_url))
                    <a href="{{ $project->github_url }}" target="_blank" class="link-arrow" aria-label="View {{ $project->title }} GitHub Repository">
                        GitHub <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                    </a>
                @else
                    <span class="small text-secondary" style="font-style: italic;">Private Repository</span>
                @endif
                
                <button class="link-arrow ms-auto border-0 bg-transparent p-0" 
                        data-bs-toggle="modal" 
                        data-bs-target="#projectModal"
                        data-title="{{ $project->title }}"
                        data-role="{{ $project->role ?? 'Software Developer' }}"
                        data-duration="{{ $project->duration ?? '2 Months' }}"
                        data-desc="{{ $project->description }}"
                        data-problem="{{ $project->problem ?? '' }}"
                        data-solution="{{ $project->solution ?? '' }}"
                        data-result="{{ $project->result ?? '' }}"
                        data-img="{{ $project->image_path && str_starts_with($project->image_path, 'http') ? $project->image_path : asset($project->image_path ?? 'assets/images/project-placeholder.png') }}"
                        data-github="{{ $project->github_url ?? '#' }}"
                        data-demo="{{ $project->demo_url ?? '#' }}"
                        data-tech="{{ json_encode($project->tech_stack) }}"
                        data-features="{{ json_encode($project->features ?? []) }}"
                        aria-label="View details of {{ $project->title }}">
                    Case Study <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
