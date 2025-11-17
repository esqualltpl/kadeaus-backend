<section class="appointments-section">
    <div class="appointments-header">
        <h4>Receptionists</h4>
        <div class="appointments-controls">
            <div class="search-box">
                <input type="text" placeholder="Type here..." class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <button class="btn-primary schedule-btn" onclick="window.location.href='{{ route('admin.hospital.create_receptionist') }}'">
                Add Receptionists
            </button>
        </div>
    </div>
    <div class="appointments">
  @forelse ($receptionists as $receptionist)
    <div class="card doctor-card p-3">
      <div class="d-flex align-items-center mb-2">
        <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Receptionist"
             class="rounded-md border-radius-lg me-2" style="width: 100px; height: 100px;">
        <div>
          <h6 class="mb-0 fw-bold">{{ $receptionist->user?->name ?? 'N/A' }}</h6>
          <small class="text-muted">
            <i class="fa-regular fa-envelope text-danger"></i>
            {{ $receptionist->user?->email ?? '-' }}<br>
            <i class="fa-solid fa-phone text-danger"></i>
            {{ $receptionist->user?->phone ?? '-' }}
          </small>
          <div class="d-flex justify-content-start">
            <p class="fw-semibold text-muted mb-0">
                {{ $receptionist->created_at?->diffForHumans() ?? '—' }}
            </p>
        </div>
        </div>
      </div>
      <button class="btn details mt-3"
              onclick="window.location.href='{{ route('admin.hospital.view_receptionist', $receptionist->id) }}'">
        View Details
      </button>
    </div>
  @empty
    <div class="text_muted text-center">No record found.</div>
  @endforelse
</div>

</section>
