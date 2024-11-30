<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="images/websiteicon.png">
    <title>Doctor</title>
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
            <li class="active">
                <a href="/doctor">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>&nbsp;Doctor</span>
                </a>
            </li>
            <li>
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
        <div class="container-fluid">
            <!-- Dashboard Summary Cards -->
            <div class="row mt-3 totalicon">
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="images/iconanimal.png" alt="">
                            </div>
                            <div class="col-9">
                                <h5>{{ $totalanimal }}</h5>
                                <p>Animal</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="images/icondoctor.png" alt="">
                            </div>
                            <div class="col-9">
                                <h5>{{ $totaldoctor }}</h5>
                                <p>Doctor</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="images/iconschedule.png" alt="">
                            </div>
                            <div class="col-9">
                                <h5>{{ $totalschedule }}</h5>
                                <p>Schedule</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="images/icondiagnosis.png" alt="">
                            </div>
                            <div class="col-9">
                                <h5>{{ $totaldiagnosis }}</h5>
                                <p>Diagnosis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders and Top Selling Products -->
            <div class="mt-4">
                <div class="">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <h6 class="card-title mb-0">Doctor</h6>
                            <button class="btn buttoncreate" data-bs-toggle="modal"
                                data-bs-target="#createDoctorModal">Create</button>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Gender</th>
                                        <th>Name</th>
                                        <th>Specialization</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctor as $doctors)
                                        <tr>
                                            <td>#{{ $doctors->id }}</td>
                                            <td><img src="{{ asset('images/' . $doctors->gender . 'doctor.png') }}"
                                                    alt="{{ $doctors->gender }}" class="img-fluid" style="width: 30px;">
                                            </td>
                                            <td>{{ $doctors->name }}</td>
                                            <td>{{ $doctors->specialization }}</td>
                                            <td>{{ $doctors->contact }}</td>
                                            <td>
                                                <button onclick="confirmDelete({{ $doctors->id }})"
                                                    class="icondelete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $doctors->id }}"
                                                    action="{{ route('doctors.delete', $doctors->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                            <td>
                                                <button class="iconupdate"
                                                    onclick="showUpdateModalDoctor({{ $doctors->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#updateDoctorModal"
                                                    data-id="{{ $doctors->id }}" data-gender="{{ $doctors->gender }}"
                                                    data-name="{{ $doctors->name }}"
                                                    data-specialization="{{ $doctors->specialization }}"
                                                    data-contact="{{ $doctors->contact }}">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <!-- Tombol Previous -->
                                    <li class="page-item {{ $doctor->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $doctor->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <!-- Tombol Halaman Dinamis -->
                                    @for ($i = 1; $i <= $doctor->lastPage(); $i++)
                                        <li class="page-item {{ $i == $doctor->currentPage() ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $doctor->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ $doctor->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $doctor->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createDoctorModal" tabindex="-1" aria-labelledby="createDoctorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDoctorModalLabel">Create Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/doctor" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="doctorName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="doctorName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="doctorName" class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="Male" required>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="Female" required>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ownerName" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="ownerName" name="specialization"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="ownerContact" class="form-label">Owner Contact</label>
                            <input type="text" class="form-control" id="ownerContact" name="contact" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn buttonsave">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateDoctorModal" tabindex="-1" aria-labelledby="updateDoctorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDoctorModalLabel">Update Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateDoctorForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="doctorName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="updateDoctorName" name="name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="doctorName" class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="radio1"
                                    value="Male" required>
                                <label class="form-check-label" for="radio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="radio2"
                                    value="Female" required>
                                <label class="form-check-label" for="radio2">Female</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ownerName" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="updateDoctorSpecialization"
                                name="specialization" required>
                        </div>
                        <div class="mb-4">
                            <label for="ownerContact" class="form-label">Owner Contact</label>
                            <input type="text" class="form-control" id="updateDoctorContact" name="contact"
                                required>
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
