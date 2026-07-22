@extends('admin.layouts.admin')

@section('title', 'Add Project')

@section('content')
<div class="container-fluid px-0">
    <!-- Breadcrumb Header -->
    <div class="mb-4">
        <a href="{{ route('admin.projects.index') }}" class="text-primary text-decoration-none small">&larr; Back to Projects</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Add New Project</h1>
        <p class="text-secondary small mb-0">Create a showroom case study.</p>
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

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- Left inputs panel (Core details) -->
            <div class="col-lg-8">
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Core Details</h3>
                    
                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title" class="form-label text-secondary small fw-bold">Project Title</label>
                            <input type="text" id="title" name="title" class="form-control form-control-admin w-100 @error('title') is-invalid @enderror" placeholder="e.g. DEVO IoT Monitoring" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Slug -->
                        <div class="col-md-6">
                            <label for="slug" class="form-label text-secondary small fw-bold">Slug (URL identifier)</label>
                            <input type="text" id="slug" name="slug" class="form-control form-control-admin w-100 @error('slug') is-invalid @enderror" placeholder="e.g. devo-iot-monitoring" value="{{ old('slug') }}">
                            <small class="text-muted" style="font-size: 0.7rem;">Leave blank to auto-generate from Title</small>
                            @error('slug')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <label for="role" class="form-label text-secondary small fw-bold">My Role</label>
                            <input type="text" id="role" name="role" class="form-control form-control-admin w-100 @error('role') is-invalid @enderror" placeholder="e.g. Lead IoT Developer" value="{{ old('role') }}">
                            @error('role')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div class="col-md-6">
                            <label for="duration" class="form-label text-secondary small fw-bold">Duration</label>
                            <input type="text" id="duration" name="duration" class="form-control form-control-admin w-100 @error('duration') is-invalid @enderror" placeholder="e.g. 3 Months" value="{{ old('duration') }}">
                            @error('duration')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- GitHub URL -->
                        <div class="col-md-6">
                            <label for="github_url" class="form-label text-secondary small fw-bold">GitHub Repository URL</label>
                            <input type="url" id="github_url" name="github_url" class="form-control form-control-admin w-100 @error('github_url') is-invalid @enderror" placeholder="e.g. https://github.com/ghozahimma65/project" value="{{ old('github_url') }}">
                            @error('github_url')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Demo URL -->
                        <div class="col-md-6">
                            <label for="demo_url" class="form-label text-secondary small fw-bold">Live Demo URL</label>
                            <input type="url" id="demo_url" name="demo_url" class="form-control form-control-admin w-100 @error('demo_url') is-invalid @enderror" placeholder="e.g. https://project.com" value="{{ old('demo_url') }}">
                            @error('demo_url')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Short Description -->
                        <div class="col-12">
                            <label for="short_description" class="form-label text-secondary small fw-bold">Short Description (Grid Overview)</label>
                            <input type="text" id="short_description" name="short_description" class="form-control form-control-admin w-100 @error('short_description') is-invalid @enderror" placeholder="A brief 1-2 sentence overview of the project." value="{{ old('short_description') }}">
                            @error('short_description')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Full Description -->
                        <div class="col-12">
                            <label for="description" class="form-label text-secondary small fw-bold">Full Description (Markdown or plain text)</label>
                            <textarea id="description" name="description" rows="6" class="form-control form-control-admin w-100 @error('description') is-invalid @enderror" placeholder="Describe the project overview and background details in depth..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
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
                            <textarea id="problem" name="problem" rows="3" class="form-control form-control-admin w-100 @error('problem') is-invalid @enderror" placeholder="Define the core bottleneck or security failure that needed solving...">{{ old('problem') }}</textarea>
                            @error('problem')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Solution -->
                        <div class="col-12">
                            <label for="solution" class="form-label text-secondary small fw-bold"><i class="bi bi-gear-wide-connected text-primary"></i> The Solution</label>
                            <textarea id="solution" name="solution" rows="3" class="form-control form-control-admin w-100 @error('solution') is-invalid @enderror" placeholder="Describe your technical architecture implementation...">{{ old('solution') }}</textarea>
                            @error('solution')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Result -->
                        <div class="col-12">
                            <label for="result" class="form-label text-secondary small fw-bold"><i class="bi bi-graph-up-arrow text-success"></i> The Result</label>
                            <textarea id="result" name="result" rows="3" class="form-control form-control-admin w-100 @error('result') is-invalid @enderror" placeholder="Highlight analytical metrics, speed improvements, or authentication success percentages...">{{ old('result') }}</textarea>
                            @error('result')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
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
                            <div class="modern-tag-input-container w-100" id="tech-tag-input-container">
                                <div class="tag-chips-wrapper d-flex flex-wrap gap-2 p-2 border rounded">
                                    <input type="text" id="tech-input-field" class="border-0 bg-transparent flex-grow-1 text-light focus-none px-2 py-1" style="outline: none; min-width: 150px;" placeholder="Type technology (e.g. Laravel) & press Enter...">
                                </div>
                                <div class="suggestions-dropdown d-none" id="tech-suggestions-dropdown"></div>
                                <div id="tech-hidden-inputs"></div>
                            </div>
                            @error('tech_stack')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Features list -->
                        <div class="col-12 mt-4">
                            <label class="form-label text-secondary small fw-bold d-block">Key Features bullet list</label>
                            <div class="modern-tag-input-container w-100" id="feature-tag-input-container">
                                <div class="tag-chips-wrapper d-flex flex-wrap gap-2 p-2 border rounded">
                                    <input type="text" id="feature-input-field" class="border-0 bg-transparent flex-grow-1 text-light focus-none px-2 py-1" style="outline: none; min-width: 150px;" placeholder="Type key feature (e.g. Dashboard) & press Enter...">
                                </div>
                                <div class="suggestions-dropdown d-none" id="feature-suggestions-dropdown"></div>
                                <div id="feature-hidden-inputs"></div>
                            </div>
                            @error('features')
                                <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right settings panel (Uploads and status flags) -->
            <div class="col-lg-4">
                <!-- Status & Ordering -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Publishing Controls</h3>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label text-secondary small fw-bold">Status</label>
                        <select name="status" id="status" class="form-select form-control-admin @error('status') is-invalid @enderror" required>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label text-secondary small fw-bold">Display Order</label>
                        <input type="number" id="order" name="order" class="form-control form-control-admin w-100 @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0" required>
                        <small class="text-muted" style="font-size: 0.7rem;">Lower numbers are displayed first on landing showroom</small>
                        @error('order')
                            <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input bg-transparent border-secondary" type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary small" for="featured">
                            Featured Project (Highlight accent)
                        </label>
                    </div>
                </div>

                <!-- Upload Images Dropzones -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Thumbnail & Gallery</h3>
                    
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold">Primary Thumbnail</label>
                        <div class="upload-dropzone p-4 text-center border border-dashed rounded cursor-pointer" id="thumbnail-dropzone">
                            <i class="bi bi-image fs-3 text-secondary d-block mb-2"></i>
                            <span class="small text-secondary d-block">Drag & drop thumbnail or <span class="text-primary fw-bold">browse</span></span>
                            <input type="file" id="thumbnail" name="thumbnail" class="d-none" accept="image/*">
                        </div>
                        @error('thumbnail')
                            <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                        @enderror
                        <div id="thumbnail-preview-container" class="mt-3 d-none">
                            <div id="thumbnail-preview-grid"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold">Gallery Images</label>
                        <div class="upload-dropzone p-4 text-center border border-dashed rounded cursor-pointer" id="gallery-dropzone">
                            <i class="bi bi-images fs-3 text-secondary d-block mb-2"></i>
                            <span class="small text-secondary d-block">Drag & drop gallery images or <span class="text-primary fw-bold">browse</span></span>
                            <input type="file" id="gallery" name="gallery[]" class="d-none" accept="image/*" multiple>
                        </div>
                        @error('gallery')
                            <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                        @enderror
                        <div id="gallery-preview-container" class="mt-3 d-none">
                            <span class="text-secondary small d-block mb-2">Gallery Upload Preview</span>
                            <div id="gallery-preview-grid" class="row g-3"></div>
                        </div>
                    </div>
                </div>

                <!-- SEO Tags -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">SEO Control</h3>
                    
                    <div class="mb-3">
                        <label for="seo_title" class="form-label text-secondary small fw-bold">SEO Title</label>
                        <input type="text" id="seo_title" name="seo_title" class="form-control form-control-admin w-100 @error('seo_title') is-invalid @enderror" placeholder="Search page title override" value="{{ old('seo_title') }}">
                        @error('seo_title')
                            <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="seo_description" class="form-label text-secondary small fw-bold">SEO Description</label>
                        <textarea id="seo_description" name="seo_description" rows="3" class="form-control form-control-admin w-100 @error('seo_description') is-invalid @enderror" placeholder="Meta description overrides">{{ old('seo_description') }}</textarea>
                        @error('seo_description')
                            <div class="invalid-feedback d-block small mt-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center" id="submit-project-btn">
                        <i class="bi bi-check-lg"></i> Create Project
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
    // Suggestions Data
    const techSuggestions = [
        "Laravel", "PHP", "Flutter", "Dart", "MySQL", "PostgreSQL", "SQLite", "REST API",
        "GraphQL", "JavaScript", "TypeScript", "HTML", "CSS", "Bootstrap", "Tailwind CSS",
        "Alpine.js", "Vue.js", "React", "Next.js", "Node.js", "Express", "ESP32",
        "Arduino IDE", "IoT", "HC-SR04", "Firebase", "Cloudinary", "Railway",
        "Cloudflare", "Git", "GitHub", "Docker", "Linux"
    ];

    const featureSuggestions = [
        "Authentication", "Authorization", "CRUD", "Dashboard", "REST API", "QR Code",
        "Reporting", "Notifications", "Export PDF", "Import Excel", "Responsive Design",
        "Dark Mode", "Search", "Pagination", "Role Management", "Multi Role", "CMS",
        "Monitoring", "Real Time", "Charts", "Analytics", "File Upload", "Image Gallery"
    ];

    document.addEventListener('DOMContentLoaded', () => {
        // Init Autocomplete Tech Stack Input
        initializeTagInput({
            containerId: 'tech-tag-input-container',
            inputFieldId: 'tech-input-field',
            dropdownId: 'tech-suggestions-dropdown',
            hiddenContainerId: 'tech-hidden-inputs',
            inputName: 'tech_stack[]',
            suggestions: techSuggestions,
            initialValues: {!! json_encode(old('tech_stack', [])) !!}
        });

        // Init Autocomplete Key Features Input
        initializeTagInput({
            containerId: 'feature-tag-input-container',
            inputFieldId: 'feature-input-field',
            dropdownId: 'feature-suggestions-dropdown',
            hiddenContainerId: 'feature-hidden-inputs',
            inputName: 'features[]',
            suggestions: featureSuggestions,
            initialValues: {!! json_encode(old('features', [])) !!}
        });

        // Init Drag & Drop Uploads
        initImageUpload({
            dropzoneId: 'thumbnail-dropzone',
            fileInputId: 'thumbnail',
            previewContainerId: 'thumbnail-preview-container',
            previewGridId: 'thumbnail-preview-grid',
            isMultiple: false
        });

        initImageUpload({
            dropzoneId: 'gallery-dropzone',
            fileInputId: 'gallery',
            previewContainerId: 'gallery-preview-container',
            previewGridId: 'gallery-preview-grid',
            isMultiple: true
        });
    });

    // Modern Autocomplete Tag Input Component
    function initializeTagInput({
        containerId,
        inputFieldId,
        dropdownId,
        hiddenContainerId,
        inputName,
        suggestions,
        initialValues = []
    }) {
        const container = document.getElementById(containerId);
        const wrapper = container.querySelector('.tag-chips-wrapper');
        const input = document.getElementById(inputFieldId);
        const dropdown = document.getElementById(dropdownId);
        const hiddenContainer = document.getElementById(hiddenContainerId);
        
        if (!container || !input || !dropdown || !hiddenContainer) return;

        let selectedTags = new Set(initialValues);
        let activeSuggestionIndex = -1;
        let filteredSuggestions = [];

        // Focus wrapper click to focus input
        wrapper.addEventListener('click', (e) => {
            if (e.target === wrapper) {
                input.focus();
            }
        });

        // Render initial tags
        renderTags();

        // Toggle dropdown on input
        input.addEventListener('input', () => {
            const query = input.value.trim().toLowerCase();
            if (query.length === 0) {
                hideDropdown();
                return;
            }

            filteredSuggestions = suggestions.filter(s => 
                s.toLowerCase().includes(query) && !selectedTags.has(s)
            );

            if (filteredSuggestions.length > 0) {
                showDropdown(filteredSuggestions);
            } else {
                hideDropdown();
            }
        });

        // Close dropdown on focusout
        input.addEventListener('blur', () => {
            // Wait briefly to allow click events to register on suggestions
            setTimeout(hideDropdown, 200);
        });

        // Keydown keyboard controls
        input.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (filteredSuggestions.length === 0) return;
                activeSuggestionIndex = (activeSuggestionIndex + 1) % filteredSuggestions.length;
                highlightSuggestion();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (filteredSuggestions.length === 0) return;
                activeSuggestionIndex = (activeSuggestionIndex - 1 + filteredSuggestions.length) % filteredSuggestions.length;
                highlightSuggestion();
            } else if (e.key === 'Enter' || e.key === 'Tab') {
                if (activeSuggestionIndex > -1 && filteredSuggestions[activeSuggestionIndex]) {
                    e.preventDefault();
                    addTag(filteredSuggestions[activeSuggestionIndex]);
                } else {
                    const val = input.value.trim();
                    if (val) {
                        e.preventDefault();
                        addTag(val);
                    }
                }
            } else if (e.key === 'Escape') {
                e.preventDefault();
                hideDropdown();
            } else if (e.key === 'Backspace' && input.value.length === 0) {
                const tagArray = Array.from(selectedTags);
                if (tagArray.length > 0) {
                    const lastTag = tagArray[tagArray.length - 1];
                    removeTag(lastTag);
                }
            }
        });

        function showDropdown(items) {
            dropdown.innerHTML = '';
            activeSuggestionIndex = -1;
            
            items.forEach((item, index) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'suggestions-item';
                btn.textContent = item;
                btn.addEventListener('click', () => {
                    addTag(item);
                });
                dropdown.appendChild(btn);
            });

            dropdown.classList.remove('d-none');
        }

        function hideDropdown() {
            dropdown.classList.add('d-none');
            activeSuggestionIndex = -1;
            filteredSuggestions = [];
        }

        function highlightSuggestion() {
            const items = dropdown.querySelectorAll('.suggestions-item');
            items.forEach((item, idx) => {
                if (idx === activeSuggestionIndex) {
                    item.classList.add('active');
                    item.scrollIntoView({ block: 'nearest' });
                } else {
                    item.classList.remove('active');
                }
            });
        }

        function addTag(tag) {
            tag = tag.trim();
            if (!tag || selectedTags.has(tag)) {
                input.value = '';
                hideDropdown();
                return;
            }

            selectedTags.add(tag);
            renderTags();
            input.value = '';
            hideDropdown();
            input.focus();
        }

        function removeTag(tag) {
            selectedTags.delete(tag);
            renderTags();
            input.focus();
        }

        function renderTags() {
            // Remove existing chips
            const chips = wrapper.querySelectorAll('.tag-chip');
            chips.forEach(c => c.remove());

            // Clear hidden inputs
            hiddenContainer.innerHTML = '';

            // Add chips before input field
            selectedTags.forEach(tag => {
                const chip = document.createElement('div');
                chip.className = 'tag-chip';
                chip.innerHTML = `
                    <span>${tag}</span>
                    <button type="button" class="remove-chip-btn" aria-label="Remove tag">
                        <i class="bi bi-x-lg"></i>
                    </button>
                `;
                chip.querySelector('.remove-chip-btn').addEventListener('click', () => {
                    removeTag(tag);
                });
                wrapper.insertBefore(chip, input);

                // Append hidden input for form submission compatibility
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = inputName;
                hidden.value = tag;
                hiddenContainer.appendChild(hidden);
            });
        }
    }

    // Drag and Drop & Image Upload Component
    function initImageUpload({
        dropzoneId,
        fileInputId,
        previewContainerId,
        previewGridId,
        isMultiple = false
    }) {
        const dropzone = document.getElementById(dropzoneId);
        const input = document.getElementById(fileInputId);
        const previewContainer = document.getElementById(previewContainerId);
        const previewGrid = document.getElementById(previewGridId);

        if (!dropzone || !input || !previewContainer || !previewGrid) return;

        let selectedFiles = [];

        // Trigger input on dropzone click
        dropzone.addEventListener('click', (e) => {
            if (e.target !== input) {
                input.click();
            }
        });

        // Drag highlights
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropzone.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropzone.classList.remove('dragover');
            }, false);
        });

        // Drop handler
        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = Array.from(dt.files).filter(f => f.type.startsWith('image/'));
            
            if (files.length > 0) {
                if (!isMultiple) {
                    input.files = dt.files;
                    handleSingleFile(files[0]);
                } else {
                    appendMultipleFiles(files);
                }
            }
        });

        // Input change handler
        input.addEventListener('change', () => {
            const files = Array.from(input.files);
            if (files.length > 0) {
                if (!isMultiple) {
                    handleSingleFile(files[0]);
                } else {
                    appendMultipleFiles(files);
                }
            }
        });

        function handleSingleFile(file) {
            previewGrid.innerHTML = '';
            selectedFiles = [file];

            const imgUrl = URL.createObjectURL(file);
            const fileSizeStr = formatBytes(file.size);

            previewGrid.innerHTML = `
                <div class="glass-panel p-2 d-flex align-items-center gap-3 w-100" style="border-radius: var(--radius-md);">
                    <div class="preview-img-wrapper" style="width: 80px; height: 80px; border-radius: var(--radius-sm); overflow: hidden; background: rgba(0,0,0,0.2); flex-shrink: 0;">
                        <img src="${imgUrl}" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <span class="fw-bold d-block text-truncate small">${file.name}</span>
                        <span class="text-secondary d-block small">${fileSizeStr}</span>
                    </div>
                    <button type="button" class="btn-admin btn-admin-secondary btn-sm" id="remove-thumbnail-btn"><i class="bi bi-trash text-danger"></i></button>
                </div>
            `;

            previewContainer.classList.remove('d-none');

            document.getElementById('remove-thumbnail-btn').addEventListener('click', (e) => {
                e.stopPropagation();
                input.value = '';
                selectedFiles = [];
                previewGrid.innerHTML = '';
                previewContainer.classList.add('d-none');
            });
        }

        function appendMultipleFiles(files) {
            selectedFiles = [...selectedFiles, ...files];
            syncInputFiles();
            renderMultiplePreviews();
        }

        function removeMultipleFile(index) {
            selectedFiles.splice(index, 1);
            syncInputFiles();
            renderMultiplePreviews();
        }

        function syncInputFiles() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => {
                dt.items.add(file);
            });
            input.files = dt.files;
        }

        function renderMultiplePreviews() {
            previewGrid.innerHTML = '';
            
            if (selectedFiles.length === 0) {
                previewContainer.classList.add('d-none');
                return;
            }

            selectedFiles.forEach((file, index) => {
                const imgUrl = URL.createObjectURL(file);
                const fileSizeStr = formatBytes(file.size);
                
                const col = document.createElement('div');
                col.className = 'col-md-6 gallery-preview-item';
                col.innerHTML = `
                    <div class="glass-panel p-2 d-flex align-items-center gap-3 h-100" style="border-radius: var(--radius-md); position: relative;">
                        <div class="position-absolute bg-primary text-light rounded-circle text-center d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; font-size: 0.75rem; font-weight: 700; top: -5px; left: -5px; z-index: 10;">
                            ${index + 1}
                        </div>
                        <div class="preview-img-wrapper" style="width: 60px; height: 60px; border-radius: var(--radius-sm); overflow: hidden; background: rgba(0,0,0,0.2); flex-shrink: 0;">
                            <img src="${imgUrl}" style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <span class="fw-bold d-block text-truncate small">${file.name}</span>
                            <span class="text-secondary d-block small">${fileSizeStr}</span>
                        </div>
                        <button type="button" class="btn-admin btn-admin-secondary btn-sm remove-gallery-preview" data-index="${index}"><i class="bi bi-trash text-danger"></i></button>
                    </div>
                `;

                col.querySelector('.remove-gallery-preview').addEventListener('click', (e) => {
                    e.stopPropagation();
                    removeMultipleFile(index);
                });

                previewGrid.appendChild(col);
            });

            previewContainer.classList.remove('d-none');
        }

        function formatBytes(bytes, decimals = 2) {
            if (!+bytes) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
        }
    }
</script>
@endsection
