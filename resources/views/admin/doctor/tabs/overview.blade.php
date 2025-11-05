<div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel" aria-labelledby="v-pills-overview-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="row g-2 mb-2">
                <!-- Doctors -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card">
                        <div>
                            <p class="stats-title">Total Doctors</p>
                            <div class="stats-value text-dark">21 <span class="stats-change text-success">+20%</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-primary">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card">
                        <div>
                            <p class="stats-title">Total Patients</p>
                            <div class="stats-value text-dark">21 <span class="stats-change text-success">+20%</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-secondary">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                    </div>
                </div>
                <!-- Nurses -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title">Upcoming Appoinments</p>
                            <div class="stats-value  text-dark">24 <span class="stats-change text-success">+20%</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-info">
                            <i class="fa-solid fa-user-nurse"></i>
                        </div>
                    </div>
                </div>
                <!-- Pharmacists -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title">Completed Appoinments</p>
                            <div class="stats-value text-dark">13 <span class="stats-change text-danger">-2%</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-success">
                            <i class="fa-solid fa-pills"></i>
                        </div>
                    </div>
                </div>
                <!-- Admins -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stats-card mb-1">
                        <div>
                            <p class="stats-title">Cancelled Appoinments</p>
                            <div class="stats-value text-dark">20 <span class="stats-change text-danger">-2%</span>
                            </div>
                        </div>
                        <div class="stats-icon bg-danger">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                    </div>
                </div>
                <!-- Admins -->

            </div>
            <div class="row g-3">
                <!-- Doctors -->
                <div class="col-lg-9 col-md-4 col-sm-6">
                    <div class="card ">
                        <h5 class="mb-0 font-weight-bolder">Calendar</h5>

                        <div class="calendar " id="calendar">

                        </div>
                        <script src="../../assets/js/plugins/fullcalendar.min.js"></script>
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

                            document.getElementById("calendar-loader").style.display = "none";
                        </script>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6" style="width: 25%;">
                    <div class="card">
                        <div class=" p-3 pb-0">
                            <h5 class="mb-0">Upcoming events</h5>
                        </div>
                        <div class="card-body border-radius-lg p-3">
                            <div class="d-flex my-4">
                                <div>
                                    <div
                                        class="icon icon-shape bg-info-soft shadow text-center border-radius-md shadow-none">
                                        <i class="ni ni-money-coins text-lg text-info text-gradient opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="numbers">
                                        <h6 class="mb-1 text-dark text-sm">Dr.Vincent Pearson
                                        </h6>
                                        <div class="d-flex justify-content-between gap-5"><span
                                                class="text-sm">Patient:Justin Richards</span>
                                            <span class="text-sm">10:00
                                                PM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex my-4">
                                <div>
                                    <div
                                        class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                        <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="numbers">
                                        <div class="numbers">
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5">
                                                <span class="text-sm">Patient:Justin
                                                    Richards</span> <span class="text-sm">10:00
                                                    PM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex my-4">
                                <div>
                                    <div
                                        class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                        <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="numbers">
                                        <div class="numbers">
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5">
                                                <span class="text-sm">Patient:Justin
                                                    Richards</span> <span class="text-sm">10:00
                                                    PM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex my-4">
                                <div>
                                    <div
                                        class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                        <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="numbers">
                                        <div class="numbers">
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5">
                                                <span class="text-sm">Patient:Justin
                                                    Richards</span> <span class="text-sm">10:00
                                                    PM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex my-4">
                                <div>
                                    <div
                                        class="icon icon-shape bg-primary-soft shadow text-center border-radius-md shadow-none">
                                        <i class="ni ni-bell-55 text-lg text-primary text-gradient opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="numbers">
                                        <div class="numbers">
                                            <h6 class="mb-1 text-dark text-sm">Dr.Vincent
                                                Pearson</h6>
                                            <div class="d-flex justify-content-between gap-5">
                                                <span class="text-sm">Patient:Justin
                                                    Richards</span> <span class="text-sm">10:00
                                                    PM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
