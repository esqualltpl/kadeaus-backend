{{-- <div class="tab-pane fade" id="v-pills-nurses" role="tabpanel" aria-labelledby="v-pills-nurses-tab"> --}}
    <section class="appointments-section">
        <div class="appointments-header">
            <h4>Nurse</h4>
            <div class="appointments-controls">
                <div class="search-box">
                    <input type="text" placeholder="Type here..." class="search-input">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <a href="{{ route('admin.hospital.add_nurse') }}"><button class="btn-primary schedule-btn">Add Nurse</button></a>
            </div>
        </div>
        @if(($nurses ?? null) && $nurses->count())
            <div class="appointments">
                @foreach($nurses as $nurse)
                    <div class="card doctor-card p-3 mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Nurse"
                                class="rounded-md border-radius-lg me-2"
                                style="width: 100px; height: 100px;">
                            <div>
                                <h6 class="mb-0 fw-bold">
                                    {{ $nurse->user?->name ?? 'N/A' }}
                                </h6>
                                <small class="text-muted">
                                    <i class="fa-regular fa-envelope text-danger"></i>
                                    {{ $nurse->user?->email ?? '—' }}<br>
                                    <i class="fa-solid fa-phone text-danger"></i>
                                    {{ $nurse->user?->phone ?? '—' }}
                                </small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold mb-0">
                                {{ $nurse->hospital?->user?->name ?? 'Unknown Hospital' }}
                            </h6>
                            <p class="text-muted mb-0">
                                {{ $nurse->created_at?->diffForHumans() ?? '—' }}
                            </p>
                        </div>

                        <button class="btn details mt-3"
                                onclick="window.location.href='{{ route('admin.hospital.nurse_view', $nurse->id) }}'">
                            View Details
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-muted">No record found.</div>
        @endif

    </section>
{{-- </div> --}}
