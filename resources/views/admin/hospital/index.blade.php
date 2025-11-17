@extends('admin.layout.master')
@section('style')

@endsection
@section('content')
    <div class="container-fluid py-4">
        <div id="patientsView" class="main-container">
            <div class="patients-header">
                <h2>Hospitals</h2>
                <div class="d-flex align-items-center g-3">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Type here..." id="searchInput">
                    </div>
                    <div>
                        <button class="btn-primary schedule-btn ms-2"
                            onclick="window.location.href='{{ route('admin.hospital.addHospital') }}'">
                            Add Hospital
                        </button>
                    </div>
                </div>
            </div>
            <div class="entries-control">
                <select id="entriesPerPage">
                    <option value="12" selected>5</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                Entries Per Page
            </div>
            <table class="table patient-table align-items-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>Name</th> 
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Total Appointments</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="patientTableBody">
                    @forelse($hospitals as $hospital)
                        <tr>
                            <td class="text-nowrap">{{ $loop->iteration  }}</td>
                            <td>{{ $hospital->user?->name ?? '—' }}</td>
                            <td>{{ $hospital->user?->email ?? '—' }}</td>
                            <td>{{ $hospital->user?->phone ?? '—' }}</td>
                            <td>{{ $h->appointments_count ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing <span id="showingStart">1</span> to <span id="showingEnd">12</span> of <span
                        id="totalEntries">57</span> entries
                </div>
                <nav>
                    <ul class="pagination" id="paginationNav">
                        <!-- Pagination will be populated here -->
                    </ul>
                </nav>
            </div>
        </div>
        <div class="toast position-fixed bottom-0 end-0 p-3" id="deleteToast" role="alert">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hospital deleted successfully.
        </div>
        </div>
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel"><i class="fa-solid fa-triangle-exclamation me-2"></i> Confirm Delete</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">Are you sure you want to delete this hospital record? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // ---- Configuration ----
        const BASE_DETAIL_URL = "{{ route('admin.hospital.hospitalDetail', ['id' => ':id']) }}";
        const BASE_EDIT_URL = "{{ route('admin.hospital.hospitalEdit', ['id' => ':id']) }}";
        const BASE_DELETE_URL = "{{ route('admin.hospital.destroy', ['id' => ':id']) }}";

        // ---- Utilities ----
        function escapeHtml(str) {
            return str ? str
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;") : "";
        }

        // ---- Read DOM ----
        function readHospitalsFromDom() {
            return Array.from(document.querySelectorAll("#patientTableBody tr")).map(r => {
                const tds = r.querySelectorAll("td");
                if (tds.length < 4) return null;
                return {
                    id: tds[0].textContent.trim(),
                    name: tds[1].textContent.trim(),
                    email: tds[2].textContent.trim(),
                    phone: tds[3].textContent.trim(),
                    appointments_count:tds[4].textContent.trim()
                };
            }).filter(Boolean);
        }

        // ---- Render Table ----
        function renderTable() {
            const tbody = document.getElementById("patientTableBody");
            if (!tbody) return;

            if (filteredHospitals.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center">No records found.</td></tr>`;
                return;
            }

            tbody.innerHTML = filteredHospitals.map(h => `
                <tr>
                    <td>${escapeHtml(h.id)}</td>
                    <td>${escapeHtml(h.name)}</td>
                    <td>${escapeHtml(h.email)}</td>
                    <td>${escapeHtml(h.phone)}</td>
                    <td>${escapeHtml(h.appointments_count ?? 'N/A')}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <button class="action-btn" data-id="${h.id}" data-action="view" title="View">
                                <i class="fas fa-eye text-info"></i>
                            </button>
                            <button class="action-btn" data-id="${h.id}" data-action="edit" title="Edit">
                                <i class="fa-solid fa-pencil text-success"></i>
                            </button>
                            <button class="action-btn" data-id="${h.id}" data-action="delete" title="Delete">
                                <i class="fa-solid fa-trash-can text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join("");
        }

        // ---- Search ----
        function filterTable() {
            const query = (document.getElementById("searchInput")?.value || "").toLowerCase();
            filteredHospitals = !query
                ? [...hospitals]
                : hospitals.filter(h =>
                    h.id.toLowerCase().includes(query) ||
                    h.name.toLowerCase().includes(query) ||
                    h.email.toLowerCase().includes(query) ||
                    h.phone.toLowerCase().includes(query)
                );
            renderTable();
        }

        // ---- Actions ----
        function handleAction(id, action) {
            if (action === "view") {
                const url = BASE_DETAIL_URL.replace(':id', id);
                window.location.href = url;
            }else if (action === "edit") {
                const url = BASE_EDIT_URL.replace(":id", id);
                window.location.href = url;
            } else if (action === "delete") {
                deleteHospitalId = id;
                const modal = new bootstrap.Modal(document.getElementById("deleteConfirmModal"));
                modal.show();
            }
        }

        // ---- Event Listeners ----
        document.addEventListener("click", e => {
            const btn = e.target.closest(".action-btn");
            if (btn) handleAction(btn.dataset.id, btn.dataset.action);
        });

        document.getElementById("searchInput")?.addEventListener("input", filterTable);

        // ---- Delete Confirmation ----
        let deleteHospitalId = null;
        document.getElementById("confirmDeleteBtn")?.addEventListener("click", async function () {
            if (!deleteHospitalId) return;
            const url = BASE_DELETE_URL.replace(":id", deleteHospitalId);

            try {
                const response = await fetch(url, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                });

                const result = await response.json();
                if (result.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById("deleteConfirmModal"));
                    modal.hide();

                    const row = document.querySelector(`button[data-id="${deleteHospitalId}"]`)?.closest("tr");
                    if (row) row.remove();

                    const toast = new bootstrap.Toast(document.getElementById('deleteToast'));
                    toast.show();

                } else {
                    alert("❌ Delete failed: " + (result.message || "Unknown error"));
                }
            } catch (err) {
                alert("❌ Error: " + err.message);
            }
        });

        // ---- Initialize ----
        let hospitals = readHospitalsFromDom();
        let filteredHospitals = [...hospitals];
        renderTable();
    </script>
@endsection
