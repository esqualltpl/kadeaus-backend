@extends('admin.layout.master')
@section('style')
    <style>
        .header-banner {
            background: url('{{ asset('admin/assets/img/header-bg.png') }}') no-repeat center center;
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
                    <button class="btn btn-link text-dark p-0 me-2"><a href="{{ route('admin.hospital') }}">&larr;</a></button>
                    <h4 class="fw-bold mb-0">Add Hospital</h4>
                </div>
                <h6 class="section-title">Basic Details </h6>
                <form action="{{ route('admin.hospital.hospitalUpdate', $hospital->id) }}" method="POST"> 
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" 
                                value="{{ old('name', $hospital->user->name ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" placeholder="Enter Email"
                                value="{{ old('email', $hospital->user->email ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input name="phone" type="text" class="form-control" placeholder="Enter Phone Number"
                                value="{{ old('phone', $hospital->user->phone ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Specialities</label>
                            <input name="specialities" type="text" class="form-control" placeholder="Enter Specialities"
                                value="{{ old('specialities', $hospital->specialities ?? '') }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Departments
                                <span id="addDepartmentBtn" style="cursor: pointer;">
                                    <i class="fa-solid fa-circle-plus ms-3 text-info"></i> Add more
                                </span>
                            </label>
                            <div id="departmentsContainer">
                                @foreach(old('departments', ['']) as $dept)
                                    <input name="departments[]" type="text" class="form-control mb-2" placeholder="Enter Department" value="{{ $dept }}">
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <h6 class="section-title text-dark mt-3">Address Details</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Address 1</label>
                            <input name="address" type="text" class="form-control" placeholder="Enter Address"
                                value="{{ old('address', $hospital->user->address ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">City</label>
                            <input name="city" type="text" class="form-control" placeholder="Enter City"
                                value="{{ old('city', $hospital->user->city ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <input name="state" type="text" class="form-control" placeholder="Enter State"
                                value="{{ old('state', $hospital->user->state ?? '') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Zipcode</label>
                            <input name="zipcode" type="text" class="form-control" placeholder="Enter Zipcode"
                                value="{{ old('zipcode', $hospital->user->zipcode ?? '') }}">
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary px-4 py-2">Update</button>
                    </div>
                </form>
            </div>


        </div>   
@endsection
@section('script')
     <script>
        const addBtn = document.getElementById("addDepartmentBtn");
        const container = document.getElementById("departmentsContainer");

        addBtn.addEventListener("click", function () {
            // Create a wrapper div for input + remove button
            const wrapper = document.createElement("div");
            wrapper.classList.add("d-flex", "align-items-center", "mb-2");

            // Create input field
            const input = document.createElement("input");
            input.type = "text";
            input.classList.add("form-control", "me-2");
            input.placeholder = "Enter Department";

            // Create remove button
            const removeBtn = document.createElement("button");
            removeBtn.classList.add("btn", "btn-danger", "btn-sm");
            removeBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';

            // Remove the field on click
            removeBtn.addEventListener("click", () => wrapper.remove());

            // Append input + remove button to wrapper
            wrapper.appendChild(input);
            wrapper.appendChild(removeBtn);

            // Add wrapper into the container
            container.appendChild(wrapper);
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