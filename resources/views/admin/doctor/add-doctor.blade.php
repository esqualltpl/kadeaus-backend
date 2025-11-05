@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('./assets/img/header-bg.png') no-repeat center center;
            background-size: cover;
            height: 190px;
            border-radius: 10px;
        }

        .appointment-container {
            max-width: 1335px;
            margin: -60px auto 40px auto;
            /* Pull white card upward */
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .section-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            font-size: 14px;
        }

        input,
        select {
            border-radius: 8px !important;
            padding: 10px;
            font-size: 14px;
        }

        .divider {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
            <div class="header-banner "></div>
            <div class="appointment-container">
                <!-- Header -->
                <div class="d-flex align-items-center mb-4">
                    <button class="btn btn-link text-dark p-0 me-2"><a href="Doctors.html">
                            &larr;
                        </a></button>
                    <h4 class="fw-bold mb-0">Add Doctor</h4>
                </div>

                <!-- Basic Details -->
                <h6 class="section-title">Basic Details</h6>
                <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter Name">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter Email">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input name="phone" type="text" class="form-control" placeholder="Enter Phone">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input name="dob" type="date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hospital</label>
                        <select name="hospital_id" class="form-control">
                            <option value="">Select Hospital</option>
                            @foreach($hospitals as $hospital)
                                <option value="{{ $hospital->id }}">{{ $hospital->user?->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select name="department_id" class="form-control">
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Speciality Hours</label>
                        <input name="speciality_hours" type="text" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Working Hours (From)</label>
                        <input name="working_hours_from" type="time" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Working Hours (To)</label>
                        <input name="working_hours_to" type="time" class="form-control">
                    </div>
                </div>

                {{-- Address section --}}
                <h6 class="section-title text-dark">Address Details</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input name="address" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <input name="city" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">State</label>
                        <input name="state" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Zipcode</label>
                        <input name="zipcode" type="text" class="form-control">
                    </div>
                </div>

                {{-- Qualification --}}
                <h5 class="fw-semibold mt-4">Qualification</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Degree</label>
                        <input name="degree" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Institute</label>
                        <input name="institute" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input name="start_date" type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input name="end_date" type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Marks / CGPA</label>
                        <input name="total_marks_CGPA" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Achieved Marks / CGPA</label>
                        <input name="achieved_marks_CGPA" type="text" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Attachment</label>
                        <div class="file-upload">
                            <label class="choose-file-btn">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Choose File
                                <input name="attachment" type="file" hidden>
                            </label>
                            <div class="file-preview">
                                <i class="fa-solid fa-file-pdf"></i> Attachment.pdf
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-danger px-4 py-2">Add</button>
                </div>
                </form>
            </div>


        </div>
@endsection
@section('script')
        <script>
        if (document.getElementById('choices-doctor-edit')) {
            var element = document.getElementById('choices-doctor-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-hospital-edit')) {
            var element = document.getElementById('choices-hospital-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-department-edit')) {
            var element = document.getElementById('choices-department-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
    </script>

    <script>
        if (document.getElementById('choices-gender-edit')) {
            var element = document.getElementById('choices-gender-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
        if (document.getElementById('choices-category-edit')) {
            var element = document.getElementById('choices-category-edit');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };
    </script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endsection