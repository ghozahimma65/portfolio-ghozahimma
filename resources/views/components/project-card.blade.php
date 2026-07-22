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
            <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }} preview image" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('assets/images/project-placeholder.png') }}';">
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
            <div class="project-tech-tags mb-4 toggle-tech-stack" style="cursor: pointer;">
                @php
                    $techs = $project->tech_stack ?? [];
                    $totalTechs = count($techs);
                    $limit = 4;
                @endphp
                @foreach($techs as $index => $tech)
                    <span class="project-tech-badge {{ $index >= $limit ? 'hidden-tech d-none' : '' }}">{{ $tech }}</span>
                @endforeach
                @if($totalTechs > $limit)
                    <span class="project-tech-badge tech-more-badge">+{{ $totalTechs - $limit }}</span>
                @endif
            </div>

            <!-- Actions Row -->
            <div class="project-card-footer">
                @if(!empty($project->github_url) && filter_var($project->github_url, FILTER_VALIDATE_URL))
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="link-arrow" aria-label="View {{ $project->title }} GitHub Repository">
                        GitHub <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                    </a>
                @endif
                
                <a href="{{ route('portfolio.project', $project->slug) }}" class="link-arrow {{ (!empty($project->github_url) && filter_var($project->github_url, FILTER_VALIDATE_URL)) ? 'ms-2' : '' }}" aria-label="View page for {{ $project->title }}">
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
                        data-img="{{ $project->thumbnail_url }}"
                        data-github="{{ (!empty($project->github_url) && filter_var($project->github_url, FILTER_VALIDATE_URL)) ? $project->github_url : '#' }}"
                        data-demo="{{ (!empty($project->demo_url) && filter_var($project->demo_url, FILTER_VALIDATE_URL)) ? $project->demo_url : '#' }}"
                        data-tech="{{ json_encode($project->tech_stack ?? []) }}"
                        data-features="{{ json_encode($project->features ?? []) }}"
                        data-gallery="{{ json_encode($project->gallery_urls) }}"
                        data-url="{{ route('portfolio.project', $project->slug) }}"
                        aria-label="View details of {{ $project->title }}">
                    Quick View <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
