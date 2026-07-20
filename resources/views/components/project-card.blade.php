@props(['project'])

<div class="col-md-6 project-item" data-tech="{{ implode(',', $project->tech_stack ?? []) }}" data-featured="{{ $project->featured ? 'true' : 'false' }}">
    <div class="project-card h-100" data-aos="fade-up" data-aos-duration="600">
        <!-- Project Screenshot (Hero of the Card) -->
        <div class="project-card-image-wrap shadow-sm position-relative">
            @if($project->featured)
                <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark shadow-sm" style="font-size: 0.75rem; z-index: 2;">
                    <i class="bi bi-star-fill me-1" aria-hidden="true"></i> Featured
                </span>
            @endif
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
                        @if(in_array('Flutter', $project->tech_stack ?? []))
                            Mobile Application
                        @elseif(in_array('ESP32', $project->tech_stack ?? []) || in_array('IoT Sensors', $project->tech_stack ?? []))
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
                @if(!empty($project->duration))
                    <span class="text-secondary mx-1">•</span>
                    <span class="text-secondary">{{ $project->duration }}</span>
                @endif
            </div>
            
            <p class="project-card-desc mb-4">{{ $project->short_description ?: Str::limit($project->description, 115) }}</p>

            <!-- Tech Tags -->
            <div class="project-tech-tags mb-4">
                @foreach($project->tech_stack ?? [] as $tech)
                    <span class="project-tech-badge">{{ $tech }}</span>
                @endforeach
            </div>

            <!-- Actions Row -->
            <div class="project-card-footer">
                @if(!empty($project->github_url))
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="link-arrow" aria-label="View {{ $project->title }} GitHub Repository">
                        GitHub <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                    </a>
                @else
                    <span class="small text-secondary" style="font-style: italic;">Private Repository</span>
                @endif
                
                <a href="{{ route('portfolio.project', $project->slug) }}" class="link-arrow ms-2" aria-label="View page for {{ $project->title }}">
                    Detail <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                </a>

                <button class="link-arrow ms-auto border-0 bg-transparent p-0" 
                        data-bs-toggle="modal" 
                        data-bs-target="#projectModal"
                        data-title="{{ $project->title }}"
                        data-role="{{ $project->role ?? 'Software Developer' }}"
                        data-duration="{{ $project->duration ?? 'N/A' }}"
                        data-short-desc="{{ $project->short_description ?? '' }}"
                        data-desc="{{ $project->description }}"
                        data-problem="{{ $project->problem ?? '' }}"
                        data-solution="{{ $project->solution ?? '' }}"
                        data-result="{{ $project->result ?? '' }}"
                        data-img="{{ $project->image_path && str_starts_with($project->image_path, 'http') ? $project->image_path : asset($project->image_path ?? 'assets/images/project-placeholder.png') }}"
                        data-github="{{ $project->github_url ?? '#' }}"
                        data-demo="{{ $project->demo_url ?? '#' }}"
                        data-tech="{{ json_encode($project->tech_stack ?? []) }}"
                        data-features="{{ json_encode($project->features ?? []) }}"
                        data-gallery="{{ json_encode(array_map(fn($img) => str_starts_with($img, 'http') ? $img : asset($img), $project->gallery_images ?? [])) }}"
                        data-url="{{ route('portfolio.project', $project->slug) }}"
                        aria-label="View details of {{ $project->title }}">
                    Quick View <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
