@extends('admin.layout.master')
@section('style')
    <style>
        .doctor-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        /* Active selected card style */
        .doctor-card.active {
            border: 2px solid #D32F2F;
            background-color: #FFEFF1;
            box-shadow: 0px 4px 12px rgba(211, 47, 47, 0.2);
        }

        /* Hover effect for better UX */
        .doctor-card:hover {
            transform: scale(1.02);
        }

        .main-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 0;
        }

        .patients-header {
            padding: 20px 25px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .patients-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            color: #343a40;
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 8px 15px 8px 40px;
            width: 100%;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #6c757d;
        }

        .entries-control {
            padding: 0 25px 15px;
            font-size: 14px;
            color: #6c757d;
        }

        .entries-control select {
            border: none;
            background: none;
            outline: none;
            font-weight: 500;
            color: #495057;
        }

        .patient-table {
            margin: 0;
        }

        .patient-table th {
            background-color: #f8f9fa;
            border: none;
            padding: 15px 25px;
            font-weight: 600;
            color: #000;
            font-size: 15px;
        }

        .patient-table td {
            padding: 12px 23px;
            /* border-top: 1px solid #f1f3f4; */
            vertical-align: middle;
            font-size: 14px;
        }

        .bg-secondary {
            background-color: #CB0C9F !important;
        }

        .patient-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .view-btn {
            background: #fff;
            color: #007bff;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .view-btn:hover {
            background: #0056b3;
        }

        .pagination-container {
            padding: 20px 25px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            font-size: 14px;
            color: #6c757d;
        }

        .pagination .page-link {
            border: none;
            color: #6c757d;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 4px;
        }

        .pagination .page-item.active .page-link {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
            color: #495057;
        }

        /* Patient Detail View */
        .patient-detail {
            display: none;
        }

        .patient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 25px;
            color: white;
        }

        .patient-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .patient-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .patient-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .patient-info h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .patient-info p {
            margin: 2px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .nav-tabs {
            border-bottom: 1px solid #e9ecef;
            padding: 0 25px;
            margin-bottom: 0;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 15px 20px;
            margin-right: 10px;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff !important;
            background-color: #dc3545;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        .nav-tabs .nav-link.active {
            color: #fff !important;

            background: #dc3545;
        }

        .tab-content {
            padding: 5px;
        }

        .detail-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .detail-section h5 {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 12px;
        }

        .details-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            /* max-width: 1100px; */
            margin: 30px auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .detail-label {
            font-weight: 500;
            color: #495057;
            width: 140px;
            font-size: 14px;
        }

        .detail-value {
            color: #6c757d;
            font-size: 14px;
        }

        .nav.nav-pills .nav-link.active a {
            color: #fff !important;
            font-weight: bold;
        }

        .accordion-button:not(.collapsed) {
            color: var(--bs-accordion-active-color);
            /* background-color: var(--bs-accordion-active-bg); */
            box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
        }

        .doctor-card.active {
            border: 2px solid #D32F2F;
            background-color: #FFEFF1;
            box-shadow: 0px 4px 12px rgba(211, 47, 47, 0.2);
        }

        @media (min-width: 992px) {
            .col-lg-3 {
                flex: 0 0 auto;
                width: 20%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div id="Divone">
            <div class="appointments-header">
                <h4>Doctor</h4>
                <div class="appointments-controls">
                    <div class="search-box">
                        <input type="text" placeholder="Type here..." class="search-input">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    <button class="btn-primary schedule-btn" onclick="window.location.href='{{ route('admin.doctor.addDoctor') }}'">
                        Add Doctor
                    </button>
                </div>
            </div>
            @if (($doctors ?? null) && $doctors->count())
            <div class="appointments">
                @foreach($doctors as $doctor)
                <div class="card doctor-card p-3">
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ asset('admin/assets/img/team-1.jpg') }}" alt="Doctor" class="rounded-md border-radius-lg me-2"
                            style="width: 100px; height: 100px;">
                        <div>
                            <h6 class="mb-0 fw-bold">
                                Dr. {{ $doctor->user?->name ?? 'N/A' }}
                            </h6>
                            <h6 class="mb-0 fw-bold text-muted">
                                {{ $doctor->department?->name ?? '—' }}
                            </h6>
                            <small class="text-muted">
                                <i class="fa-regular fa-envelope text-danger"></i>
                                {{ $doctor->user?->email ?? '—' }}<br>
                                <i class="fa-solid fa-phone text-danger"></i>
                                {{ $doctor->user?->phone ?? '—' }}
                            </small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-0">
                            {{ $doctor->hospital?->user?->name ?? 'Unknown Hospital' }}
                        </h6>
                        <p class="text-muted">
                            {{ $doctor->created_at?->diffForHumans() }}
                        </p>
                    </div>

                    <button class="btn details mt-3"
                        onclick="window.location.href='{{ route('admin.doctor.viewDoctor', $doctor->id) }}'">
                        View Details
                    </button>
                </div>
                 @endforeach
            </div>
            @else
            <div class="text-muted text-center">No record found.</div>
            @endif
        </div>

        <!-- Patient Detail View -->
        <div id="Divtwo" class="patient-detail " style="display: none;">
            <div class="col-md-5">
                <div class="nav  flex-row nav-pills   mb-3 v-links p-1  " id="v-pills-tab" role="tablist"
                    aria-orientation="horizontal" style="background-color: #fff;">
                    <button class="nav-link h-navlinks py-2 v-links my-0  active " id="v-pills-overview-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-overview" type="button" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">
                        <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#overview">
                            Overview
                        </a>
                    </button>
                    <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-doctor-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-doctor" type="button" role="tab"
                        aria-controls="v-pills-doctor" aria-selected="false">
                        <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#doctor">
                            Profile
                        </a>
                    </button>
                    <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-appointment-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-appointment" type="button" role="tab"
                        aria-controls="v-pills-appointment" aria-selected="false">
                        <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#appointment">
                            Appointments
                        </a>
                    </button>
                    <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-patients-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-patients" type="button" role="tab"
                        aria-controls="v-pills-patients" aria-selected="false">
                        <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#patients">
                            Patients
                        </a>
                    </button>
                    <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-chat-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-chat" type="button" role="tab"
                        aria-controls="v-pills-chat" aria-selected="false">
                        <a class="nav-link1  d-flex align-items-center px-0 mx-0" href="#chat">
                            Chat
                        </a>
                    </button>
                    <button class="nav-link h-navlinks py-2 v-links my-0  " id="v-pills-telemedicine-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-telemedicine" type="button" role="tab"
                        aria-controls="v-pills-profile" aria-selected="false">
                        <a class="nav-link1 d-flex align-items-center px-0 mx-0 " href="#telemedicine">
                            Telemedicine
                        </a>
                    </button>

                </div>
            </div>
            <div class=" ">
                <div class="tab-content" id="v-pills-tabContent">
                    @includeIf('admin.doctor.tabs.overview')
                    @includeIf('admin.doctor.tabs.profile')
                    @includeIf('admin.doctor.tabs.appointment')
                    @includeIf('admin.doctor.tabs.patient')
                    @includeIf('admin.doctor.tabs.chat')
                    @includeIf('admin.doctor.tabs.telemedicine')
                </div>
            </div>
        </div>
        <div class="modal fade" id="addSuggestionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Add Pregnancy Suggestion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="suggestionForm">
                            <div class="mb-3">
                                <label class="form-check-label opacity-6 font-weight-bold">Suggestion
                                    Category</label>
                                <select class="form-control" name="choices-department" id="choices-department-edit">
                                    <option value="">Select Category</option>
                                    <option value="baby-growth">Baby Growth</option>
                                    <option value="nutrition">Nutrition</option>
                                    <option value="lifestyle">Lifestyle</option>
                                    <option value="health-tips">Health Tips</option>
                                    <option value="warning-signs">Warning Signs/Alerts</option>
                                    <option value="general-advice">General Advice</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-check-label opacity-6 font-weight-bold">Suggestion</label>
                                <input type="text" class="form-control" placeholder="Enter Suggestion">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn bg-danger  text-white">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="assignDoctorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">New Chat</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="search-box mb-4">
                            <input type="text" placeholder="search here..." class="search-input "
                                style="width: 500px !important;">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <div class="d-flex p-2"
                            style="border: 1px solid #B71C1C; background-color: #FFEFF1;border-radius: 10px;">
                            <img alt="Image" src="{{ asset('admin/assets/img/team-5.jpg') }}" class="avatar shadow border-radius-md">
                            <div class="ms-3">
                                <h6 class="mb-0 text-danger">Randy Ramirez</h6>
                                <p class="text-danger text-xs mb-2">Doctor</p>

                            </div>
                        </div>
                        <div class="d-flex p-2">
                            <img alt="Image" src="{{ asset('admin/assets/img/team-5.jpg') }}" class="avatar shadow border-radius-md">
                            <div class="ms-3">
                                <h6 class="mb-0">Jessica Gibson</h6>
                                <p class="text-muted text-xs mb-2">Nurse</p>
                            </div>
                        </div>
                        <div class="d-flex p-2">
                            <img alt="Image" src="{{ asset('admin/assets/img/team-5.jpg') }}" class="avatar shadow border-radius-md">
                            <div class="ms-3">
                                <h6 class="mb-0">Jessica Gibson</h6>
                                <p class="text-muted text-xs mb-2">Nurse</p>
                            </div>
                        </div>
                        <div class="d-flex p-2">
                            <img alt="Image" src="{{ asset('admin/assets/img/team-5.jpg') }}" class="avatar shadow border-radius-md">
                            <div class="ms-3">
                                <h6 class="mb-0">Jessica Gibson</h6>
                                <p class="text-muted text-xs mb-2">Nurse</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end p-3">
                        <button type="button" id="doneBtn" class="btn bg-danger text-white">Done</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="rescheduleDoctorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Add Prescription <p class="text-info" id="addPrescriptionBtn"> <i
                                    class="fa-solid fa-circle-plus"></i>Add More</p>
                        </h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3" id="prescriptionContainer">
                            <div class="col-md-12">
                                <label class="form-label">Medication Name</label>
                                <select class="form-control" name="choices-medication" id="choices-medication-edit">
                                    <option value="">Select Medication</option>
                                    <option value="Aspirin">Aspirin</option>
                                    <option value="Ibuprofen">Ibuprofen</option>
                                    <option value="Paracetamol">Paracetamol</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"> Dosage</label>
                                <input type="text" class="form-control" placeholder="Enter Dosage">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mg</label>
                                <select class="form-control" name="choices-mg" id="choices-mg-edit">
                                    <option value="">Select Mg</option>
                                    <option value="5mg">5mg</option>
                                    <option value="10mg">10mg</option>
                                    <option value="15mg">15mg</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Form</label>
                                <select class="form-control" name="choices-form" id="choices-form-edit">
                                    <option value="">Select Form</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Syrup">Syrup</option>
                                    <option value="Injection">Injection</option>
                                </select>
                            </div>
                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Quantity Per Dose</label>
                                <input type="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Frequency</label>
                                <select class="form-control" name="choices-frequency" id="choices-frequency-edit">
                                    <option value="">Select Frequency</option>
                                    <option value="Once Daily">Once Daily</option>
                                    <option value="Twice Daily">Twice Daily</option>
                                    <option value="Three Times Daily">Three Times Daily</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <input type="text" class="form-control" placeholder="Enter Duration">
                            </div>

                            <!-- DOB -->
                            <div class="col-md-6">
                                <label class="form-label">Note</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end p-3">
                        <button type="button" class="btn  details  me-3 ">Skip</button>
                        <button type="button" class="btn bg-danger text-white" data-bs-toggle="modal"
                            data-bs-target="#labreportModal" data-bs-dismiss="rescheduleDoctorModal"
                            aria-label="Close">Next</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal " id="labreportModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Lab Report</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label"> Patient Name</label>
                                <input type="text" class="form-control" placeholder="Enter Patient Name">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"> User ID</label>
                                <input type="text" class="form-control" placeholder="Enter User ID">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Report Name</label>
                                <select class="form-control" name="choices-report" id="choices-report-edit">
                                    <option value="">Select Report</option>
                                    <option value="Blood Test">Blood Test</option>
                                    <option value="X-Ray">X-Ray</option>
                                    <option value="MRI Scan">MRI Scan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control" placeholder="Enter Date">
                            </div>

                            <!-- DOB -->
                            <div class="col-md-6">
                                <label class="form-label">Time</label>
                                <input type="text" class="form-control" placeholder="Enter Time">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end p-3">
                        <button type="button" class="btn  details  me-3 ">Skip</button>
                        <button type="button" class="btn bg-danger text-white" data-bs-toggle="modal"
                            data-bs-target="#successModal" data-bs-dismiss="labreportModal"
                            aria-label="Close">Add</button>
                    </div>


                </div>
            </div>
        </div>
        <div class="modal " id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-3">
                    <div class="modal-body p-3">
                        <div class="mb-3">
                            <img src="{{ asset('admin/assets/img/Successmark.svg') }}" alt="Success"
                                style="width: 100px; height: 100px;">
                        </div>
                        <h5 class="mb-2">Appointment Booked</h5>
                        <p>Your appointment was successfully scheduled.</p>
                        <button type="button" class="btn bg-danger text-white"
                            data-bs-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
  const prescriptionContainer = document.getElementById("prescriptionContainer");
  const addPrescriptionBtn = document.getElementById("addPrescriptionBtn");

  // Prescription fields template
  const prescriptionTemplate = () => `
    <div class="prescription-box">
    
      <div class="row g-3">
        <div class="col-md-12">
          <label class="form-label">Medication Name</label>
          <select class="form-control">
            <option value="">Select Medication</option>
            <option value="Aspirin">Aspirin</option>
            <option value="Ibuprofen">Ibuprofen</option>
            <option value="Paracetamol">Paracetamol</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Dosage</label>
          <input type="text" class="form-control" placeholder="Enter Dosage">
        </div>
        <div class="col-md-6">
          <label class="form-label">Mg</label>
          <select class="form-control">
            <option value="">Select Mg</option>
            <option value="5mg">5mg</option>
            <option value="10mg">10mg</option>
            <option value="15mg">15mg</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Form</label>
          <select class="form-control">
            <option value="">Select Form</option>
            <option value="Tablet">Tablet</option>
            <option value="Syrup">Syrup</option>
            <option value="Injection">Injection</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Quantity Per Dose</label>
          <input type="text" class="form-control" placeholder="Enter Quantity">
        </div>
        <div class="col-md-6">
          <label class="form-label">Frequency</label>
          <select class="form-control">
            <option value="">Select Frequency</option>
            <option value="Once Daily">Once Daily</option>
            <option value="Twice Daily">Twice Daily</option>
            <option value="Three Times Daily">Three Times Daily</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Duration</label>
          <input type="text" class="form-control" placeholder="Enter Duration">
        </div>
        <div class="col-md-6">
          <label class="form-label">Note</label>
          <input type="text" class="form-control" placeholder="Enter Note">
        </div>
      </div>
    </div>
  `;

  // Add prescription block on "Add More" click
  addPrescriptionBtn.addEventListener("click", () => {
    const wrapper = document.createElement("div");
    wrapper.innerHTML = prescriptionTemplate();
    prescriptionContainer.appendChild(wrapper.firstElementChild);
  });

  // Remove prescription block when clicked on "×"
  prescriptionContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("remove-prescription")) {
      e.target.closest(".prescription-box").remove();
    }
  });

  // Add one default prescription form on modal open
  document.getElementById("prescriptionModal").addEventListener("shown.bs.modal", () => {
    if (prescriptionContainer.children.length === 0) {
      const wrapper = document.createElement("div");
      wrapper.innerHTML = prescriptionTemplate();
      prescriptionContainer.appendChild(wrapper.firstElementChild);
    }
  });
</script>

    <script>
        document.querySelectorAll('.btn details').forEach(btn => {
            btn.addEventListener('click', function () {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';

                setTimeout(() => {
                    this.innerHTML = originalText;
                    alert('Prescription downloaded successfully!');
                }, 1500);
            });
        });
        if (document.getElementById('choices-mg-edit')) {
            var element = document.getElementById('choices-mg-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-medicine-edit')) {
            var element = document.getElementById('choices-medicine-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-report-edit')) {
            var element = document.getElementById('choices-report-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-form-edit')) {
            var element = document.getElementById('choices-form-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-frequency-edit')) {
            var element = document.getElementById('choices-frequency-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample patient data
        const patients = [
            {
                id: 'PID-01',
                firstName: 'Jessica',
                lastName: 'Hudson',
                name: 'Jessica Hudson',
                email: 'jessicahudson@gmail.com',
                contact: '(809)666-4172',
                appointments: 123,
                dateOfBirth: '15/08/1985',
                gender: 'Female',
                sex: 'Female',
                maritalStatus: 'Single',
                address: '123 Main St, New York, NY, 10001, United States',
                city: 'New York',
                state: 'New York',
                country: 'United States',
                zipCode: '10001',
                height: '168 cm',
                bloodType: 'O+',
                maritalStatus: 'Single',
                weight: '132 Pounds',
                photo: 'https://images.unsplash.com/photo-1494790108755-2616b612b27c?w=100&h=100&fit=crop&crop=face'
            },
        ];

        let currentPage = 1;
        let entriesPerPage = 12;
        let filteredPatients = [...patients];

        function renderPatients() {
            const tbody = document.getElementById('patientTableBody');
            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;
            const patientsToShow = filteredPatients.slice(start, end);

            tbody.innerHTML = '';

            patientsToShow.forEach(patient => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${patient.id}</td>
                    <td>${patient.name}</td>
                    <td>${patient.email}</td>
                    <td>${patient.contact}</td>
                    <td>${patient.appointments}</td>
                    <td>
                        <div class="d-flex align-items-center g-3">
                        <button class="view-btn text-danger" >
                           <i class="fa-solid fa-trash-can"></i>
                        </button>
                         <button class="view-btn text-success" >
                          <i class="fa-solid fa-pencil"></i>
                        </button>
                         <button class="view-btn" onclick="window.location.href='doctor-detail.html'">
                            <i class="fas fa-eye"></i>
                        </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            updatePaginationInfo();
            renderPagination();
        }

        function updatePaginationInfo() {
            const start = (currentPage - 1) * entriesPerPage + 1;
            const end = Math.min(currentPage * entriesPerPage, filteredPatients.length);
            const total = filteredPatients.length;

            document.getElementById('showingStart').textContent = start;
            document.getElementById('showingEnd').textContent = end;
            document.getElementById('totalEntries').textContent = total;
        }

        function renderPagination() {
            const totalPages = Math.ceil(filteredPatients.length / entriesPerPage);
            const paginationNav = document.getElementById('paginationNav');

            paginationNav.innerHTML = '';

            // Previous button
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage - 1})">‹</a>`;
            paginationNav.appendChild(prevLi);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                paginationNav.appendChild(li);
            }

            // Next button
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
            nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${currentPage + 1})">›</a>`;
            paginationNav.appendChild(nextLi);
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredPatients.length / entriesPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderPatients();
            }
        }

        function showPatientDetail(patientId) {
            const patient = patients.find(p => p.id === patientId);
            if (!patient) return;



            // Hide patients view and show detail view
            document.getElementById('patientsView').style.display = 'none';
            document.getElementById('patientDetail').style.display = 'block';
        }

        function showPatientsView() {
            document.getElementById('patientDetail').style.display = 'none';
            document.getElementById('patientsView').style.display = 'block';
        }

        function filterPatients() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            filteredPatients = patients.filter(patient =>
                patient.name.toLowerCase().includes(searchTerm) ||
                patient.email.toLowerCase().includes(searchTerm) ||
                patient.id.toLowerCase().includes(searchTerm) ||
                patient.contact.includes(searchTerm)
            );
            currentPage = 1;
            renderPatients();
        }

        function changeEntriesPerPage() {
            entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
            currentPage = 1;
            renderPatients();
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', filterPatients);
        document.getElementById('entriesPerPage').addEventListener('change', changeEntriesPerPage);

        // Initialize the page
        renderPatients();

        // Prevent default behavior for pagination links
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('page-link')) {
                e.preventDefault();
            }
        });
    </script>
    <script>
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            contentHeight: 'auto',
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                center: '',
                end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
            },
            selectable: true,
            editable: true,
            initialDate: '2020-12-01',
            events: [{
                title: 'Call with Dave',
                start: '2020-11-18',
                end: '2020-11-18',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Lunch meeting',
                start: '2020-11-21',
                end: '2020-11-22',
                className: 'bg-gradient-warning'
            },

            {
                title: 'All day conference',
                start: '2020-11-29',
                end: '2020-11-29',
                className: 'bg-gradient-success'
            },

            {
                title: 'Meeting with Mary',
                start: '2020-12-01',
                end: '2020-12-01',
                className: 'bg-gradient-info'
            },

            {
                title: 'Winter Hackaton',
                start: '2020-12-03',
                end: '2020-12-03',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Digital event',
                start: '2020-12-07',
                end: '2020-12-09',
                className: 'bg-gradient-warning'
            },

            {
                title: 'Marketing event',
                start: '2020-12-10',
                end: '2020-12-10',
                className: 'bg-primary'
            },

            {
                title: 'Dinner with Family',
                start: '2020-12-19',
                end: '2020-12-19',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Black Friday',
                start: '2020-12-23',
                end: '2020-12-23',
                className: 'bg-gradient-info'
            },

            {
                title: 'Cyber Week',
                start: '2020-12-02',
                end: '2020-12-02',
                className: 'bg-gradient-warning'
            },

            ],
            views: {
                month: {
                    titleFormat: {
                        month: "long",
                        year: "numeric"
                    }
                },
                agendaWeek: {
                    titleFormat: {
                        month: "long",
                        year: "numeric",
                        day: "numeric"
                    }
                },
                agendaDay: {
                    titleFormat: {
                        month: "short",
                        year: "numeric",
                        day: "numeric"
                    }
                }
            },
        });

        calendar.render();

        var ctx1 = document.getElementById("chart-line-1").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(255,255,255,0.3)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Visitors",
                    tension: 0.5,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fff",
                    borderWidth: 2,
                    backgroundColor: gradientStroke1,
                    data: [50, 45, 60, 60, 80, 65, 90, 80, 100],
                    maxBarThickness: 6,
                    fill: true
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                },
            },
        });
    </script>

    <script>
        document.getElementById("doneBtn").addEventListener("click", function () {
            let doctor = document.getElementById("doctorSelect").value;
            let errorMsg = document.getElementById("errorMsg");

            if (doctor === "") {
                errorMsg.classList.remove("d-none"); // show error
            } else {
                errorMsg.classList.add("d-none"); // hide error
                // Close current modal
                let assignModal = bootstrap.Modal.getInstance(document.getElementById("assignDoctorModal"));
                assignModal.hide();

                // Open success modal
                let successModal = new bootstrap.Modal(document.getElementById("successModal"));
                successModal.show();
            }
        });
        if (document.querySelector('.datetimepicker')) {
            flatpickr('.datetimepicker', {
                allowInput: true
            }); // flatpickr
        }
    </script>

    <script>
        if (document.getElementById('choices-category-edit')) {
            var element = document.getElementById('choices-category-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        function switchDocument() {
            if (document.getElementById('Divone')) {

                if (document.getElementById('Divone').style.display == 'none') {
                    document.getElementById('Divone').style.display = 'block';
                    document.getElementById('Divtwo').style.display = 'none';
                }
                else {
                    document.getElementById('Divone').style.display = 'none';
                    document.getElementById('Divtwo').style.display = 'block';
                }
            }
        }

    </script>

    <script>
        // Notification system for standalone appointments page
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                z-index: 9999;
                animation: slideInRight 0.3s ease-out;
            `;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease-in';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Create mock dashboard object for compatibility
        const mockDashboard = {
            showNotification: showNotification
        };

        // Initialize appointments when page loads
        document.addEventListener('DOMContentLoaded', () => {
            const appointmentsManager = new AppointmentsManager(mockDashboard);
            appointmentsManager.render();

            // Update statistics
            const updateStats = () => {
                document.getElementById('pendingRequests').textContent = appointmentsManager.appointments.length;
                document.getElementById('totalAppointments').textContent = appointmentsManager.appointments.length + 6; // Including completed ones
            };

            updateStats();

            // Update stats when appointments change
            const originalAccept = appointmentsManager.acceptAppointment.bind(appointmentsManager);
            const originalReject = appointmentsManager.rejectAppointment.bind(appointmentsManager);

            appointmentsManager.acceptAppointment = function (id) {
                originalAccept(id);
                updateStats();
            };

            appointmentsManager.rejectAppointment = function (id) {
                originalReject(id);
                updateStats();
            };
        });
    </script>
    <script>
        const cards = document.querySelectorAll(".doctor-card");

        cards.forEach(card => {
            card.addEventListener("click", () => {
                // Remove active class from all cards
                cards.forEach(c => c.classList.remove("active"));
                // Add active class to the clicked card
                card.classList.add("active");
            });
        });
    </script>
@endsection
