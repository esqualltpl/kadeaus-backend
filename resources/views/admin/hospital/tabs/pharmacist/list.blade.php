<section class="appointments-section">
    <div class="appointments-header">
        <h4>Pharmacists</h4>
        <div class="appointments-controls">
            <div class="search-box">
                <input type="text" placeholder="Type here..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <button class="btn-primary schedule-btn" onclick="window.location.href='{{ route('admin.hospital.create_pharmacist') }}'">
                Add Pharmacists
            </button>
        </div>
    </div>
    <div class="appointments">
        @forelse ($pharmacists as $pharmacist)
        <div class="card doctor-card p-3">
            <div class="d-flex align-items-center mb-2">
                <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                    class="rounded-md border-radius-lg me-2" style="width: 100px; height: 100px;">
                <div>
                    <h6 class="mb-0 fw-bold">{{ $pharmacist->user?->name ?? 'N/A' }}</h6>
                    <small class="text-muted">
                        <i class="fa-regular fa-envelope text-danger"></i>
                        {{ $pharmacist->user?->email ?? '-' }}<br>
                        <i class="fa-solid fa-phone text-danger"></i> {{ $pharmacist->user?->phone ?? '-'}}
                    </small>
                    <div class="d-flex justify-content-between">
                        {{-- <h6 class="fw-bold mb-0">
                            {{ $pharmacist->hospital?->user?->name ?? 'Unknown Hospital' }}
                        </h6> --}}
                        <p class="fw-semibold text-muted mb-0">
                            {{ $pharmacist->created_at?->diffForHumans() ?? '—' }}
                        </p>
                    </div>
                </div>
            </div>
            <button class="btn details mt-3" onclick="window.location.href='{{ route('admin.hospital.view_pharmacist', $pharmacist->id) }}'">View
                Details</button>
        </div>
        @empty
            <div class="text-muted text-center">No record found.</div>
        @endforelse
    </div>
</section>
