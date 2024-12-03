<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/schedule.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="images/websiteicon.png">
    <title>Schedule</title>
</head>

<body>
    <nav id="sidebar">
        <ul>
            <li>
                <span class="logo"><img src="images/applicationlogo.png" alt="" width="80%"></span>
                <button onclick=toggleSidebar() id="toggle-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#e8eaed">
                        <path
                            d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z" />
                    </svg>
                </button>
            </li>
            <li class="">
                <a href="/animal">
                    <i class="fa-solid fa-paw"></i>
                    <span>&nbsp;Animal</span>
                </a>
            </li>
            <li class="">
                <a href="/doctor">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>&nbsp;Doctor</span>
                </a>
            </li>
            <li class="active">
                <a href="/schedule">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>&nbsp;Schedule</span>
                </a>
            </li>
            <li>
                <a href="/diagnosis">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span>Diagnosis</span>
                </a>
            </li>
            <li>
                <a href="/graph">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>&nbsp;Graph</span>
                </a>
            </li>
            <li>
                <a href="/logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>&nbsp;Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Page Content -->
    <div id="page-content-wrapper" class="w-100 p-3">
        <!-- Main Dashboard -->
        <div class="container-fluid row">

            <div class="text-end mb-3"><button class="btn buttoncreate" data-bs-toggle="modal"
                    data-bs-target="#createScheduleModal">Create</button></div>
            @foreach ($doctor as $doctors)
                <div class="col-4 carddoctor">
                    <div class="doctor-card" data-bs-toggle="collapse" data-bs-target="#doctor{{ $doctors->id }}">
                        <div class="row">
                            <div class="col-7">
                                <img src="{{ asset('images/' . $doctors->gender . 'doctor.png') }}"
                                    alt="{{ $doctors->gender }}" class="img-fluid" style="width: 30px;">
                                &nbsp;{{ $doctors->name }}
                            </div>
                            <div class="col-5 text-end mt-1">
                                <i class="fa-solid fa-angles-down"></i>
                            </div>
                        </div>
                    </div>
                    <div id="doctor{{ $doctors->id }}" class="collapse">
                        @foreach ($doctors->schedules as $schedule)
                            <div class="collapse-item row">
                                <div class="col-1">
                                    <div class="iconanimal">
                                        <img src="{{ asset('images/' . $schedule->animal->type . '.png') }}"
                                            class="animal-icon">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="namedateanimal">
                                        <div class="nameanimal">{{ $schedule->animal->name }}</div>
                                        <div>{{ $schedule->date }}, {{ $schedule->time }}</div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <input class="form-check-input checkbox" type="checkbox"
                                        data-id="{{ $schedule->id }}" @if ($schedule->status == '1') checked @endif>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Modal -->
        <div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createScheduleModalLabel">Create Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/schedule" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="updateDoctor" class="form-label">Doctor</label>
                                <select class="form-select" id="updateDoctor" name="doctor" required>
                                    <option value="" disabled selected>Select Doctor</option>
                                    @foreach ($doctor as $doctors)
                                        <option value="{{ $doctors->id }}">{{ $doctors->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="updateAnimalType" class="form-label">Type</label>
                                    <select class="form-select" id="updateAnimalType" name="type" required>
                                        <option value="" disabled selected>Select Type</option>
                                        @php
                                            $displayedTypesModal = []; // Array untuk menyimpan type hewan yang sudah ditampilkan
                                        @endphp
                                        @foreach ($animal as $animals)
                                            @if (!in_array($animals->type, $displayedTypesModal))
                                                <option value="{{ $animals->type }}">{{ $animals->type }}</option>
                                                @php
                                                    $displayedTypesModal[] = $animals->type; // Tambahkan type ke array yang sudah ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-8">
                                    <label for="updateAnimalName" class="form-label">Name</label>
                                    <select class="form-select" id="updateAnimalName" name="name" required>
                                        <option value="" disabled selected>Select Name</option>
                                        @foreach ($animal as $animals)
                                            <option value="{{ $animals->name }}" data-type="{{ $animals->type }}">
                                                {{ $animals->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="updateDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="updateDate" name="date" required>
                            </div>
                            <div class="mb-4">
                                <label for="updateTime" class="form-label">Time</label>
                                <input type="time" class="form-control" id="updateTime" name="time" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn buttonsave">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/main.js"></script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                });
            </script>
        @endif
</body>

</html>
