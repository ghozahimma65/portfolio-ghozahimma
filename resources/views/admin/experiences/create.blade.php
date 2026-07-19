@extends('admin.layouts.admin')

@section('title', 'Add Experience')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <a href="{{ route('admin.experiences.index') }}" class="text-primary text-decoration-none small">&larr; Back to Experiences</a>
        <h1 class="fw-bold mb-1 mt-2" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">Add Experience</h1>
        <p class="text-secondary small mb-0">Insert work history details.</p>
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

    <form action="{{ route('admin.experiences.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- Left Panel (Forms details) -->
            <div class="col-lg-8">
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Details</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="role" class="form-label text-secondary small fw-bold">Role Title</label>
                            <input type="text" id="role" name="role" class="form-control form-control-admin w-100" placeholder="e.g. Backend Intern" value="{{ old('role') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="company" class="form-label text-secondary small fw-bold">Company Name</label>
                            <input type="text" id="company" name="company" class="form-control form-control-admin w-100" placeholder="e.g. PT Sarana Insan" value="{{ old('company') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-label text-secondary small fw-bold">Location</label>
                            <input type="text" id="location" name="location" class="form-control form-control-admin w-100" placeholder="e.g. Yogyakarta, ID" value="{{ old('location') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="start_date" class="form-label text-secondary small fw-bold">Start Date</label>
                            <input type="text" id="start_date" name="start_date" class="form-control form-control-admin w-100" placeholder="e.g. August 2025" value="{{ old('start_date') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label text-secondary small fw-bold">End Date</label>
                            <input type="text" id="end_date" name="end_date" class="form-control form-control-admin w-100" placeholder="e.g. Present" value="{{ old('end_date') }}" required>
                        </div>
                    </div>
                </div>

                <!-- Responsibilities & Achievements arrays -->
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Responsibilities & Achievements</h3>
                    
                    <!-- Responsibilities list -->
                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold d-block">Responsibilities</label>
                        <div id="resp-list" class="d-flex flex-column gap-2 mb-2">
                            <div class="input-group resp-item">
                                <input type="text" name="responsibilities[]" class="form-control form-control-admin" placeholder="e.g. Designed Restful endpoints" required>
                                <button type="button" class="btn-admin btn-admin-secondary remove-resp"><i class="bi bi-x-lg text-danger"></i></button>
                            </div>
                        </div>
                        <button type="button" id="add-resp" class="btn-admin btn-admin-secondary btn-sm"><i class="bi bi-plus-lg"></i> Add Point</button>
                    </div>

                    <!-- Achievements list -->
                    <div>
                        <label class="form-label text-secondary small fw-bold d-block">Achievements (Optional)</label>
                        <div id="ach-list" class="d-flex flex-column gap-2 mb-2">
                            <div class="input-group ach-item">
                                <input type="text" name="achievements[]" class="form-control form-control-admin" placeholder="e.g. Speed up queries execution by 40%">
                                <button type="button" class="btn-admin btn-admin-secondary remove-ach"><i class="bi bi-x-lg text-danger"></i></button>
                            </div>
                        </div>
                        <button type="button" id="add-ach" class="btn-admin btn-admin-secondary btn-sm"><i class="bi bi-plus-lg"></i> Add Achievement</button>
                    </div>
                </div>

                <!-- Applied Technologies chips -->
                <div class="glass-panel p-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Technologies Applied</h3>
                    <div id="tech-list" class="d-flex flex-column gap-2 mb-2">
                        <div class="input-group tech-item">
                            <input type="text" name="tech_stack[]" class="form-control form-control-admin" placeholder="e.g. Laravel">
                            <button type="button" class="btn-admin btn-admin-secondary remove-tech"><i class="bi bi-x-lg text-danger"></i></button>
                        </div>
                    </div>
                    <button type="button" id="add-tech" class="btn-admin btn-admin-secondary btn-sm"><i class="bi bi-plus-lg"></i> Add Technology</button>
                </div>
            </div>

            <!-- Right Panel (Logo and actions) -->
            <div class="col-lg-4">
                <div class="glass-panel p-4 mb-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Settings</h3>
                    
                    <div class="mb-3">
                        <label for="logo" class="form-label text-secondary small fw-bold">Company Logo</label>
                        <input type="file" id="logo" name="logo" class="form-control form-control-admin w-100" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label text-secondary small fw-bold">Order Position</label>
                        <input type="number" id="order" name="order" class="form-control form-control-admin w-100" value="0" required>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input bg-transparent border-secondary" type="checkbox" name="current_position" id="current_position" value="1">
                        <label class="form-check-label text-secondary small" for="current_position">
                            I currently work here
                        </label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary flex-grow-1 justify-content-center">Create Record</button>
                    <a href="{{ route('admin.experiences.index') }}" class="btn-admin btn-admin-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Responsibilities addition
        const respList = document.getElementById('resp-list');
        const addResp = document.getElementById('add-resp');
        if(addResp && respList) {
            addResp.addEventListener('click', () => {
                const item = document.createElement('div');
                item.className = 'input-group resp-item';
                item.innerHTML = `
                    <input type="text" name="responsibilities[]" class="form-control form-control-admin" placeholder="e.g. Designed Restful endpoints" required>
                    <button type="button" class="btn-admin btn-admin-secondary remove-resp"><i class="bi bi-x-lg text-danger"></i></button>
                `;
                respList.appendChild(item);
            });
            respList.addEventListener('click', (e) => {
                if(e.target.closest('.remove-resp')) {
                    e.target.closest('.resp-item').remove();
                }
            });
        }

        // Achievements addition
        const achList = document.getElementById('ach-list');
        const addAch = document.getElementById('add-ach');
        if(addAch && achList) {
            addAch.addEventListener('click', () => {
                const item = document.createElement('div');
                item.className = 'input-group ach-item';
                item.innerHTML = `
                    <input type="text" name="achievements[]" class="form-control form-control-admin" placeholder="e.g. Speed up queries execution by 40%">
                    <button type="button" class="btn-admin btn-admin-secondary remove-ach"><i class="bi bi-x-lg text-danger"></i></button>
                `;
                achList.appendChild(item);
            });
            achList.addEventListener('click', (e) => {
                if(e.target.closest('.remove-ach')) {
                    e.target.closest('.ach-item').remove();
                }
            });
        }

        // Tech stack addition
        const techList = document.getElementById('tech-list');
        const addTech = document.getElementById('add-tech');
        if(addTech && techList) {
            addTech.addEventListener('click', () => {
                const item = document.createElement('div');
                item.className = 'input-group tech-item';
                item.innerHTML = `
                    <input type="text" name="tech_stack[]" class="form-control form-control-admin" placeholder="e.g. Laravel">
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
    });
</script>
@endsection
