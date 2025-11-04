@extends('admin.layout.master')
@section('style')
    <style>
        .fc-event {
            border-radius: 30px !important;
            /* Rounded corners */
            padding: 5px 10px;
            /* Add some padding */
            font-size: 14px;
            /* Adjust font size */
            color: white;
            /* Text color */
            border: none;
            /* Remove borders */
        }

        .nav.nav-pills {
            background: #f4f4f5;
            border-radius: 0.75rem;
            position: relative;
            width: fit-content;
        }

        .active-circle {
            position: absolute;
            margin-left: 45px;
        }

        .nav.nav-pills .nav-link.active {
            animation: 0.2s ease;
            border: 2px solid #D32F2F;
            color: #fff;
            background: transparent linear-gradient(180deg, #D32F2F 0%, #D32F2F 100%) 0% 0% no-repeat padding-box;
        }

        .nav.nav-pills .nav-link.active .nav-link1 {
            font-weight: 500;
            color: #fff;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 1,
                'wght' 700,
                'GRAD' 0,
                'opsz' 24
        }


        /* Remove default card styles */
        .banner-container {
            position: relative;
            border-radius: 21px;
            overflow: hidden;
            height: 200px;
            /* Default height */
        }

        /* Background image */
        .banner-background {
            object-fit: cover;
            height: 100%;
        }

        /* Text and content styling */
        .banner-content {
            background: transparent;

            height: 100%;
            padding: 30px;
            z-index: 1;
        }

        .banner-content h4 {
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .banner-container {
                height: 150px;
                /* Adjust height for smaller screens */
            }

            .banner-content h4 {
                font-size: 18px;
                /* Adjust font size for smaller screens */
            }
        }

        .avatar-edit {
            position: relative;
            right: 0;
            bottom: 0;
            /* background-color: #fff; */
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            z-index: 1;
            align-items: center;
            justify-content: center;
            /* border: 2px solid #ddd; */
            cursor: pointer;
        }

        /* .avatar-profile {
                    color: #fff;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1rem;
                    border-radius: 50rem;
                    height: 90px;
                    width: 90px;
                    transition: all .2s ease-in-out;
                }

                .avatar-edit input {
                    display: none;
                }

                .avatar-edit label {
                    display: inline-block;
                    width: 150%;
                    height: 150%;
                    margin-left: 120px;
                    margin-top: -9px;
                    position: absolute;
                    z-index: 1;
                    cursor: pointer;
                    background: url(../assets/img/camera\ copy.png) center center no-repeat;
                    background-size: 150%;
                } */
        .avatar-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #ddd;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-edit input {
            display: none;
        }

        .avatar-edit label {
            cursor: pointer;
            display: inline-block;
            padding: 1px 1px;
            margin-left: 50px;
            margin-bottom: 50px;
            /* background-color: white; */
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }

        .position-relative {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-3">

        <div class="row mx-2" style="border-radius: 10%;box-shadow:none; ">
            <div class="col-md-7 ">
                <div class="nav  flex-row nav-pills mb-3 v-links p-1" id="v-pills-tab" role="tablist"
                    aria-orientation="horizontal" style="background-color: #fff;">
                    <button class="nav-link h-navlinks py-2 v-links my-0 active " id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <a class="nav-link1 d-flex align-items-center px-0 mx-0 ">
                            Update Profile
                        </a>
                    </button>
                    <button class="nav-link h-navlinks py-2 v-links my-0 px-3" id="v-pills-Vaccine-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-Vaccine" type="button" role="tab"
                        aria-controls="v-pills-Vaccine" aria-selected="false">
                        <a class="nav-link1  d-flex align-items-center px-0 mx-0">
                            Update Password
                        </a>
                    </button>
                </div>
            </div>
            <div class="col-md-12 m-auto ">
                <!-- Image container -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <div class="p-3 card col-md-10 border-radius-lg" style="border: 1px solid rgb(208, 208, 208);">
                            <div class="d-flex gap-3">
                                <div class="avatar-upload">
                                    <div class="avatar-preview">
                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('admin/assets/img/team-2.jpg') }}"
                                            id="avatarImage" class="avatar-profile" alt="Avatar Preview" />
                                    </div>

                                    {{-- avatar upload (auto-submit on change) --}}
                                    <form id="avatarForm" action="{{ route('admin.setting.avatar') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="avatar-edit">
                                            <input type="file" id="imageUpload" name="avatar"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload">
                                                <i class="fa-solid fa-camera" style="color:#cecece; font-size:30px;"></i>
                                            </label>
                                        </div>
                                    </form>
                                </div>

                                <div class="text-align-center my-5">
                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                    <p class="text-sm font-weight-bold">
                                        {{ $user->roles->pluck('name')->implode(', ') ?: '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 mt-4 card col-md-10 border-radius-lg" id="Divone"
                            style="border: 1px solid rgb(208, 208, 208);">
                            <div class="d-flex justify-content-between">
                                <h6>Basic Detail</h6>
                                <div>
                                    <i class="fa-solid fa-pen" onclick="switchDocument()"></i>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Name:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->name }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Email</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->email }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Phone Number:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->phone ?? '—' }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Date of Birth:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">
                                        {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d/m/Y') : '—' }}
                                    </p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Gender:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->gender ?? '—' }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Address</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->address ?? '—' }}</p>
                                </div>

                                <div class="col-md-12">
                                    <h6>Address </h6>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Address:</p>
                                </div>
                                <div class="col-md-9 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->address ?? '—' }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">City:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->city ?? '—' }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">State:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->state ?? '—' }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Country:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->country ?? '—' }}</p>
                                </div>

                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-bold text-dark">Zip Code:</p>
                                </div>
                                <div class="col-md-3 mb-3 gap-4">
                                    <p class="text-sm font-weight-normal">{{ $user->zipcode ?? '—' }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="p-3 mt-4 card col-md-10 border-radius-lg" id="Divtwo"
                                style="display: none;border: 1px solid rgb(208, 208, 208);">

                                <h6>Basic Detail</h6>

                                {{-- edit form (kept invisible until pen is clicked) --}}
                                <form id="settingsForm" action="{{ route('admin.setting.update') }}" method="POST">
                                    @csrf
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">First Name</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', $user->name) }}" placeholder="John Doe">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">Email</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ old('email', $user->email) }}"
                                                    placeholder="johndoe@gmail.com">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">Phone Number</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone', $user->phone) }}" placeholder="(307)197-6191">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">Gender</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="gender"
                                                    value="{{ old('gender', $user->gender) }}" placeholder="Male">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">Date of Birth</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="date" class="form-control" name="dob"
                                                    value="{{ old('dob', $user->dob) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <h6>Address Details</h6>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">Address Details</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="address"
                                                    value="{{ old('address', $user->address) }}"
                                                    placeholder="112 hawkin street">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">City</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="city"
                                                    value="{{ old('city', $user->city) }}" placeholder="California">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">State</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="state"
                                                    value="{{ old('state', $user->state) }}" placeholder="united state">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">Zip Code</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="zipcode"
                                                    value="{{ old('zipcode', $user->zipcode) }}" placeholder="0000">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label mb-0 text-xs font-weight-bold">Country</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control" name="country"
                                                    value="{{ old('country', $user->country) }}"
                                                    placeholder="United States">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="text-end p-3 col-md-10">
                                <button id="saveSettingsBtn" type="button" class="btn btn-sm btn-info btn-lg mt-4">Save
                                    Changes</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-Vaccine" role="tabpanel"
                        aria-labelledby="v-pills-Vaccine-tab">
                        <form action="{{ route('admin.setting.password') }}" method="POST"
                            class="p-3 card col-md-10 border-radius-lg" style="border: 1px solid rgb(208, 208, 208);">
                            @csrf
                            <h6>Change Password</h6>

                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3 position-relative">
                                    <input type="password" class="form-control form-control-lg password-field"
                                        id="current-password" name="current_password" placeholder="Current Password"
                                        aria-label="Password" />
                                    <span class="toggle-password" onclick="togglePassword('current-password', this)">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    @error('current_password')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 my-3">
                                <div class="mb-3 position-relative">
                                    <input type="password" class="form-control form-control-lg password-field"
                                        id="new-password" name="new_password" placeholder="New Password"
                                        aria-label="Password" />
                                    <span class="toggle-password" onclick="togglePassword('new-password', this)">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    @error('new_password')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3 position-relative">
                                    <input type="password" class="form-control form-control-lg password-field"
                                        id="confirm-password" name="new_password_confirm"
                                        placeholder="Confirm New Password" aria-label="Password" />
                                    <span class="toggle-password" onclick="togglePassword('confirm-password', this)">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    @error('new_password_confirm')
                                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-5">
                                <h6>Password requirements</h6>
                                <p class="text-sm font-weight-normal">Please follow this guide for a strong password:</p>
                                <p class="text-sm font-weight-normal">One special characters<br /> Min 6 characters<br />
                                    One number (2 are recommended)<br /> Change it often</p>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-sm btn-info btn-lg mt-4 mb-0">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function togglePassword(id, el) {
            const i = document.getElementById(id);
            if (!i) return;
            const is = i.type === 'password';
            i.type = is ? 'text' : 'password';
            const icon = el.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            }
        }
    </script>
    <script>
        document.getElementById('imageUpload')?.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('avatarImage').src = e.target.result;
                reader.readAsDataURL(this.files[0]);
                document.getElementById('avatarForm').submit();
            }
        });
        document.getElementById('saveSettingsBtn')?.addEventListener('click', function() {
            document.getElementById('settingsForm')?.submit();
        });
    </script>
    <script>
        document.getElementById("billingLink").addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default anchor behavior

            const target = document.getElementById("dashboardsExamples");

            if (target.classList.contains("show")) {
                // Already open: redirect immediately
                window.location.href = "billing.html";
            } else {
                // Collapse open first
                new bootstrap.Collapse(target, {
                    toggle: true
                });

                // Delay the redirect slightly so the collapse is seen
                setTimeout(() => {
                    window.location.href = "billing.html";
                }, 300); // adjust delay as needed
            }
        });
    </script>
    <script>

        const sidebar = document.getElementById('sidenav-main');
        const toggleButton = document.getElementById('sidebarToggle');
        const expandedLogo = document.querySelector('.expanded-logo');
        const collapsedLogo = document.querySelector('.collapsed-logo');

        let isCollapsed = false;

        toggleButton.addEventListener('click', () => {
            isCollapsed = !isCollapsed;

            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                expandedLogo.style.display = 'none';
                collapsedLogo.style.display = 'block';
            } else {
                sidebar.classList.remove('collapsed');
                expandedLogo.style.display = 'block';
                collapsedLogo.style.display = 'none';
            }
        });


    </script>
    <script>
        function togglePassword(inputId, iconElement) {
            const passwordInput = document.getElementById(inputId);
            const icon = iconElement.querySelector("i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
        if (document.getElementById('products-list')) {
            const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });
        }
        if (document.getElementById('Vaccines-list')) {
            const dataTableSearch = new simpleDatatables.DataTable("#Vaccines-list", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });
        }
        if (document.getElementById('permission-list')) {
            const dataTableSearch = new simpleDatatables.DataTable("#permission-list", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });
        }
    </script>
    <script>
        document.getElementById("imageUpload").addEventListener("change", function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("avatarImage").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
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

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: false,
            fixedHeight: false,
            perPageSelect: false
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
