
    <section class="appointments-section">
        <div class="appointments-header">
            <h4>Doctor</h4>
            <div class="appointments-controls">
                <div class="search-box">
                    <input type="text" placeholder="Type here..." class="search-input">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <!-- <button class="btn-primary schedule-btn" onclick="window.location.href='Add-Doctors.html')">Add Nurse</button> -->
            </div>
        </div>
        
            @if(($doctors ?? null) && $doctors->count())
                <div class="appointments">
                    @foreach($doctors as $doctor)
                        <div class="card doctor-card p-3 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor"
                                    class="rounded-md border-radius-lg me-2" style="width: 100px; height: 100px;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Dr. {{ $doctor->user?->name ?? 'N/A' }}</h6>
                                    <h6 class="mb-0 fw-bold text-muted">{{ $doctor->department?->name ?? '—' }}</h6>
                                    <small class="text-muted">
                                        <i class="fa-regular fa-envelope text-danger"></i>
                                        {{ $doctor->user?->email ?? '—' }}<br>
                                        <i class="fa-solid fa-phone text-danger"></i>
                                        {{ $doctor->user?->phone ?? '—' }}
                                    </small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold mb-0">{{ $doctor->hospital?->user?->name ?? 'Unknown Hospital' }}</h6>
                                <p class="text-muted mb-0">{{ $doctor->created_at?->diffForHumans() }}</p>
                            </div>

                            <button class="btn details mt-3"
                                    onclick="window.location.href='{{ route('admin.hospital.view', $doctor->id) }}'">
                                View Details
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-muted">No record found.</div>
            @endif
    </section>

