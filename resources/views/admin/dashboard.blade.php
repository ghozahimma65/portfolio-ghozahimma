@extends('admin.layouts.admin')

@section('title', 'Overview')

@section('content')
<div class="container-fluid px-0">
    <!-- Header banner -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-family: var(--font-heading); font-size: 1.75rem; letter-spacing: -0.03em;">CMS Overview</h1>
            <p class="text-secondary small mb-0">Monitor site statistics, read messages, and track analytics.</p>
        </div>
    </div>

    <!-- 1. Stats Counter Row -->
    <div class="row g-4 mb-4">
        <!-- Projects -->
        <div class="col-6 col-lg-3">
            <div class="glass-panel metric-card">
                <span class="metric-label">Projects</span>
                <div class="metric-value">{{ $totalProjects }}</div>
                <div class="small text-secondary"><a href="{{ route('admin.projects.index') }}" class="text-primary text-decoration-none">Manage Projects &rarr;</a></div>
            </div>
        </div>
        <!-- Experiences -->
        <div class="col-6 col-lg-3">
            <div class="glass-panel metric-card">
                <span class="metric-label">Experiences</span>
                <div class="metric-value">{{ $totalExperiences }}</div>
                <div class="small text-secondary"><a href="{{ route('admin.experiences.index') }}" class="text-primary text-decoration-none">Manage Timeline &rarr;</a></div>
            </div>
        </div>
        <!-- Certificates -->
        <div class="col-6 col-lg-3">
            <div class="glass-panel metric-card">
                <span class="metric-label">Certificates</span>
                <div class="metric-value">{{ $totalCertificates }}</div>
                <div class="small text-secondary"><a href="{{ route('admin.certificates.index') }}" class="text-primary text-decoration-none">Manage Credentials &rarr;</a></div>
            </div>
        </div>
        <!-- Skills -->
        <div class="col-6 col-lg-3">
            <div class="glass-panel metric-card">
                <span class="metric-label">Tech Skills</span>
                <div class="metric-value">{{ $totalSkills }}</div>
                <div class="small text-secondary"><a href="{{ route('admin.skills.index') }}" class="text-primary text-decoration-none">Manage Stack &rarr;</a></div>
            </div>
        </div>
    </div>

    <!-- 2. Dashboard Quick Actions Row -->
    <h2 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.15rem; letter-spacing: -0.01em;">Quick Actions</h2>
    <div class="row g-3 mb-4">
        <!-- New Project -->
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.projects.create') }}" class="glass-panel p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100 hover-quick-action" style="transition: transform 0.2s, background-color 0.2s;">
                <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3 d-flex align-items-center justify-content-center" style="font-size: 1.25rem; width: 42px; height: 42px;">
                    <i class="bi bi-folder-plus"></i>
                </div>
                <div>
                    <span class="d-block fw-bold small">New Project</span>
                    <span class="text-secondary small" style="font-size: 0.75rem;">Showroom item</span>
                </div>
            </a>
        </div>
        <!-- New Experience -->
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.experiences.create') }}" class="glass-panel p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100 hover-quick-action" style="transition: transform 0.2s, background-color 0.2s;">
                <div class="bg-success bg-opacity-10 text-success p-2.5 rounded-3 d-flex align-items-center justify-content-center" style="font-size: 1.25rem; width: 42px; height: 42px;">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div>
                    <span class="d-block fw-bold small">New Experience</span>
                    <span class="text-secondary small" style="font-size: 0.75rem;">Timeline entry</span>
                </div>
            </a>
        </div>
        <!-- New Certificate -->
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.certificates.create') }}" class="glass-panel p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100 hover-quick-action" style="transition: transform 0.2s, background-color 0.2s;">
                <div class="bg-warning bg-opacity-10 text-warning p-2.5 rounded-3 d-flex align-items-center justify-content-center" style="font-size: 1.25rem; width: 42px; height: 42px;">
                    <i class="bi bi-award"></i>
                </div>
                <div>
                    <span class="d-block fw-bold small">New Certificate</span>
                    <span class="text-secondary small" style="font-size: 0.75rem;">Accreditation</span>
                </div>
            </a>
        </div>
        <!-- New Blog Post -->
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.blog-posts.create') }}" class="glass-panel p-3 d-flex align-items-center gap-3 text-decoration-none text-white h-100 hover-quick-action" style="transition: transform 0.2s, background-color 0.2s;">
                <div class="bg-info bg-opacity-10 text-info p-2.5 rounded-3 d-flex align-items-center justify-content-center" style="font-size: 1.25rem; width: 42px; height: 42px;">
                    <i class="bi bi-journal-plus"></i>
                </div>
                <div>
                    <span class="d-block fw-bold small">New Blog Post</span>
                    <span class="text-secondary small" style="font-size: 0.75rem;">Technical article</span>
                </div>
            </a>
        </div>
    </div>

    <!-- 3. Analytics Row -->
    <h2 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.15rem; letter-spacing: -0.01em;">Traffic & Downloads Analytics</h2>
    <div class="row g-4 mb-4">
        <!-- Visitor hits -->
        <div class="col-sm-6 col-lg-3">
            <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase fw-bold d-block mb-1">Page Hits</span>
                    <h3 class="fw-bold m-0 text-primary" style="font-size: 1.5rem;">{{ $visitorCount }}</h3>
                </div>
                <div class="small text-muted mt-3"><i class="bi bi-graph-up text-success"></i> Realtime visitor requests</div>
            </div>
        </div>
        <!-- CV Downloads -->
        <div class="col-sm-6 col-lg-3">
            <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase fw-bold d-block mb-1">CV Downloads</span>
                    <h3 class="fw-bold m-0 text-primary" style="font-size: 1.5rem;">{{ $cvDownloads }}</h3>
                </div>
                <div class="small text-muted mt-3"><i class="bi bi-download text-primary"></i> CV download events logged</div>
            </div>
        </div>
        <!-- Project Views -->
        <div class="col-sm-6 col-lg-3">
            <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase fw-bold d-block mb-1">Project Views</span>
                    <h3 class="fw-bold m-0 text-primary" style="font-size: 1.5rem;">{{ $projectViewCount }}</h3>
                </div>
                <div class="small text-muted mt-3"><i class="bi bi-eye-fill text-warning"></i> Total case study views</div>
            </div>
        </div>
        <!-- Most Popular Project -->
        <div class="col-sm-6 col-lg-3">
            <div class="glass-panel p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase fw-bold d-block mb-1">Top Project</span>
                    <h4 class="fw-bold text-gradient m-0 text-truncate" style="font-size: 1.05rem;" title="{{ $mostViewedProject ? $mostViewedProject->title : 'None' }}">
                        {{ $mostViewedProject ? $mostViewedProject->title : 'No views logged' }}
                    </h4>
                </div>
                <div class="small text-muted mt-3">
                    @if($mostViewedProject)
                        <i class="bi bi-star-fill text-warning"></i> {{ $mostViewedProject->views }} unique views
                    @else
                        No project viewed yet
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Dynamic content row: Messages, Activity, Actions -->
    <div class="row g-4">
        <!-- Messages column -->
        <div class="col-lg-6">
            <div class="glass-panel p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="fw-bold m-0" style="font-family: var(--font-heading); font-size: 1.1rem;">Recent Contact Inquiries</h3>
                    <a href="{{ route('admin.inbox.index') }}" class="small text-primary text-decoration-none">Inbox ({{ $unreadMessages }} unread) &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $msg)
                                <tr style="{{ !$msg->is_read ? 'font-weight: 700;' : '' }}">
                                    <td>
                                        <a href="{{ route('admin.inbox.show', $msg->id) }}" class="text-white text-decoration-none d-block">
                                            {{ $msg->name }}
                                        </a>
                                    </td>
                                    <td><span class="text-secondary d-block text-truncate" style="max-width: 150px;">{{ $msg->subject ?: '(No Subject)' }}</span></td>
                                    <td class="small text-muted">{{ $msg->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-secondary small">No contact messages received.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activity & Quick Actions column -->
        <div class="col-lg-6">
            <div class="d-flex flex-column gap-4 h-100">
                <!-- Recent activity -->
                <div class="glass-panel p-4 flex-grow-1">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Recent Analytics Log</h3>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2" style="font-size: 0.85rem;">
                        @forelse($recentActivities as $act)
                            <li class="d-flex align-items-start gap-2 py-1">
                                @if($act->type === 'visitor_hit')
                                    <i class="bi bi-circle-fill text-success mt-1" style="font-size: 0.5rem;"></i>
                                @elseif($act->type === 'cv_download')
                                    <i class="bi bi-circle-fill text-primary mt-1" style="font-size: 0.5rem;"></i>
                                @else
                                    <i class="bi bi-circle-fill text-warning mt-1" style="font-size: 0.5rem;"></i>
                                @endif
                                <div class="flex-grow-1">
                                    <span class="d-block text-secondary">{{ $act->description }}</span>
                                    <span class="small text-muted" style="font-size: 0.75rem;">{{ $act->time }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="text-center text-secondary py-3 small">No logs tracked.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Quick actions -->
                <div class="glass-panel p-4">
                    <h3 class="fw-bold mb-3" style="font-family: var(--font-heading); font-size: 1.1rem;">Quick Operations</h3>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-admin-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Add Project
                        </a>
                        <a href="{{ route('admin.media.index') }}" class="btn-admin btn-admin-secondary btn-sm">
                            <i class="bi bi-cloud-upload"></i> Upload Media
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="btn-admin btn-admin-secondary btn-sm">
                            <i class="bi bi-gear"></i> System Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
