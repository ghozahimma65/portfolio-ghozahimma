@extends('admin.layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="container-fluid px-0">
    <!-- Breadcrumb Header -->
    <div class="mb-4">
        <a href="{{ route('admin.projects.index') }}" class="text-primary text-decoration-none small">&larr; Back to Projects</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Edit Project: {{ $project->title }}</h1>
        <p class="text-secondary small mb-0">Update case study parameters and status.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 small mb-4 py-2" style="background-color: rgba(239, 68, 68, 0.1); color: var(--status-danger);">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row g-4">
            <!-- Left panel (Core details) -->
            <div class="col-lg-8">
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Core Details</h3>
                    
                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title" class="form-label text-secondary small fw-bold">Project Title</label>
                            <input type="text" id="title" name="title" class="form-control form-control-admin w-100" placeholder="e.g. DEVO IoT Monitoring" value="{{ old('title', $project->title) }}" required>
                        </div>
                        
                        <!-- Slug -->
                        <div class="col-md-6">
                            <label for="slug" class="form-label text-secondary small fw-bold">Slug (URL identifier)</label>
                            <input type="text" id="slug" name="slug" class="form-control form-control-admin w-100" placeholder="e.g. devo-iot-monitoring" value="{{ old('slug', $project->slug) }}" required>
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <label for="role" class="form-label text-secondary small fw-bold">My Role</label>
                            <input type="text" id="role" name="role" class="form-control form-control-admin w-100" placeholder="e.g. Lead IoT Developer" value="{{ old('role', $project->role) }}">
                        </div>

                        <!-- Duration -->
                        <div class="col-md-6">
                            <label for="duration" class="form-label text-secondary small fw-bold">Duration</label>
                            <input type="text" id="duration" name="duration" class="form-control form-control-admin w-100" placeholder="e.g. 3 Months" value="{{ old('duration', $project->duration) }}">
                        </div>

                        <!-- Short Description -->
                        <div class="col-12">
                            <label for="short_description" class="form-label text-secondary small fw-bold">Short Description (Gird Overview)</label>
                            <input type="text" id="short_description" name="short_description" class="form-control form-control-admin w-100" placeholder="A brief 1-2 sentence overview of the project." value="{{ old('short_description', $project->short_description) }}">
                        </div>

                        <!-- Full Description -->
                        <div class="col-12">
                            <label for="description" class="form-label text-secondary small fw-bold">Full Description (Markdown or plain text)</label>
                            <textarea id="description" name="description" rows="6" class="form-control form-control-admin w-100" placeholder="Describe the project overview and background details in depth..." required>{{ old('description', $project->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Case Study Details -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;"><i class="bi bi-briefcase text-primary"></i> Case Study Metrics</h3>
                    <div class="row g-3">
                        <!-- Problem -->
                        <div class="col-12">
                            <label for="problem" class="form-label text-secondary small fw-bold"><i class="bi bi-exclamation-triangle text-danger"></i> The Problem</label>
                            <textarea id="problem" name="problem" rows="3" class="form-control form-control-admin w-100" placeholder="Define the core bottleneck or security failure that needed solving...">{{ old('problem', $project->problem) }}</textarea>
                        </div>

                        <!-- Solution -->
                        <div class="col-12">
                            <label for="solution" class="form-label text-secondary small fw-bold"><i class="bi bi-gear-wide-connected text-primary"></i> The Solution</label>
                            <textarea id="solution" name="solution" rows="3" class="form-control form-control-admin w-100" placeholder="Describe your technical architecture implementation...">{{ old('solution', $project->solution) }}</textarea>
                        </div>

                        <!-- Result -->
                        <div class="col-12">
                            <label for="result" class="form-label text-secondary small fw-bold"><i class="bi bi-graph-up-arrow text-success"></i> The Result</label>
                            <textarea id="result" name="result" rows="3" class="form-control form-control-admin w-100" placeholder="Highlight analytical metrics, speed improvements, or authentication success percentages...">{{ old('result', $project->result) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Tech Stack & Features arrays -->
                <div class="glass-panel p-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Tech Stack & Key Features</h3>
                    <div class="row g-3">
                        <!-- Tech Stack tags -->
                        <div class="col-12">
                            <label class="form-label text-secondary small fw-bold d-block">Technology Stack Badge Chips</label>
                            <div id="tech-list" class="d-flex flex-column gap-2 mb-2">
                                @forelse($project->tech_stack ?? [] as $tech)
                                    <div class="input-group tech-item">
                                        <input type="text" name="tech_stack[]" class="form-control form-control-admin" placeholder="e.g. Laravel" value="{{ $tech }}" required>
                                        <button type="button" class="btn-admin btn-admin-secondary remove-tech"><i class="bi bi-x-lg text-danger"></i></button>
                                    </div>
                                @empty
                                    <div class="input-group tech-item">
                                        <input type="text" name="tech_stack[]" class="form-control form-control-admin" placeholder="e.g. Laravel" required>
                                        <button type="button" class="btn-admin btn-admin-secondary remove-tech"><i class="bi bi-x-lg text-danger"></i></button>
                                    </div>
                                @endforelse
                            </div>
                            <button type="button" id="add-tech" class="btn-admin btn-admin-secondary btn-sm"><i class="bi bi-plus-lg"></i> Add Tech Tag</button>
                        </div>

                        <!-- Features list -->
                        <div class="col-12 mt-4">
                            <label class="form-label text-secondary small fw-bold d-block">Key Features bullet list</label>
                            <div id="features-list" class="d-flex flex-column gap-2 mb-2">
                                @forelse($project->features ?? [] as $feature)
                                    <div class="input-group feature-item">
                                        <input type="text" name="features[]" class="form-control form-control-admin" placeholder="e.g. Real-time Telemetry Processing" value="{{ $feature }}">
                                        <button type="button" class="btn-admin btn-admin-secondary remove-feature"><i class="bi bi-x-lg text-danger"></i></button>
                                    </div>
                                @empty
                                    <div class="input-group feature-item">
                                        <input type="text" name="features[]" class="form-control form-control-admin" placeholder="e.g. Real-time Telemetry Processing">
                                        <button type="button" class="btn-admin btn-admin-secondary remove-feature"><i class="bi bi-x-lg text-danger"></i></button>
                                    </div>
                                @endforelse
                            </div>
                            <button type="button" id="add-feature" class="btn-admin btn-admin-secondary btn-sm"><i class="bi bi-plus-lg"></i> Add Key Feature</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right panel (Uploads and status flags) -->
            <div class="col-lg-4">
                <!-- Status & Ordering -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Publishing Controls</h3>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label text-secondary small fw-bold">Status</label>
                        <select name="status" id="status" class="form-select form-control-admin" required>
                            <option value="published" {{ $project->status === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ $project->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label text-secondary small fw-bold">Display Order</label>
                        <input type="number" id="order" name="order" class="form-control form-control-admin w-100" value="{{ $project->order }}" min="0" required>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input bg-transparent border-secondary" type="checkbox" name="featured" id="featured" value="1" {{ $project->featured ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary small" for="featured">
                            Featured Project (Highlight accent)
                        </label>
                    </div>
                </div>

                <!-- Upload Images -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Thumbnail & Gallery</h3>
                    
                    <!-- Current Thumbnail -->
                    @if($project->image_path)
                        <div class="mb-3 text-center">
                            <span class="text-secondary small d-block text-start mb-2">Current Thumbnail</span>
                            <img src="{{ asset($project->image_path) }}" alt="" style="max-height: 120px; object-fit: contain; border: 1px solid var(--border-color); border-radius: 4px; padding: 4px; background: rgba(0,0,0,0.2);">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label text-secondary small fw-bold">Change Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="form-control form-control-admin w-100" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="gallery" class="form-label text-secondary small fw-bold">Change Gallery Images</label>
                        <input type="file" id="gallery" name="gallery[]" class="form-control form-control-admin w-100" accept="image/*" multiple>
                        <small class="text-muted" style="font-size: 0.7rem;">Uploading new files will overwrite current gallery carousels.</small>
                    </div>
                </div>

                <!-- SEO Tags -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">SEO Control</h3>
                    
                    <div class="mb-3">
                        <label for="seo_title" class="form-label text-secondary small fw-bold">SEO Title</label>
                        <input type="text" id="seo_title" name="seo_title" class="form-control form-control-admin w-100" value="{{ $project->seo_title }}" placeholder="Search page title override">
                    </div>

                    <div class="mb-3">
                        <label for="seo_description" class="form-label text-secondary small fw-bold">SEO Description</label>
                        <textarea id="seo_description" name="seo_description" rows="3" class="form-control form-control-admin w-100" placeholder="Meta description overrides">{{ $project->seo_description }}</textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">
                        <i class="bi bi-save"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Tech stack addition
        const techList = document.getElementById('tech-list');
        const addTech = document.getElementById('add-tech');
        if(addTech && techList) {
            addTech.addEventListener('click', () => {
                const item = document.createElement('div');
                item.className = 'input-group tech-item';
                item.innerHTML = `
                    <input type="text" name="tech_stack[]" class="form-control form-control-admin" placeholder="e.g. Flutter" required>
                    <button type="button" class="btn-admin btn-admin-secondary remove-tech"><i class="bi bi-x-lg text-danger"></i></button>
                `;
                techList.appendChild(item);
            });
            techList.addEventListener('click', (e) => {
                if(e.target.closest('.remove-tech')) {
                    e.target.closest('.tech-item').remove();
                }
            });
        }

        // Features list addition
        const featuresList = document.getElementById('features-list');
        const addFeature = document.getElementById('add-feature');
        if(addFeature && featuresList) {
            addFeature.addEventListener('click', () => {
                const item = document.createElement('div');
                item.className = 'input-group feature-item';
                item.innerHTML = `
                    <input type="text" name="features[]" class="form-control form-control-admin" placeholder="e.g. Real-time Telemetry Processing">
                    <button type="button" class="btn-admin btn-admin-secondary remove-feature"><i class="bi bi-x-lg text-danger"></i></button>
                `;
                featuresList.appendChild(item);
            });
            featuresList.addEventListener('click', (e) => {
                if(e.target.closest('.remove-feature')) {
                    e.target.closest('.feature-item').remove();
                }
            });
        }
    });
</script>
@endsection
