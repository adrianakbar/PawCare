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
    <title>Animal</title>
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
            <li class="active">
                <a href="">
                    <i class="fa-solid fa-paw"></i>
                    <span>&nbsp;Animal</span>
                </a>
            </li>
            <li>
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
                            <h6 class="card-title mb-0">Animal</h6>
                            <button class="btn buttoncreate" data-bs-toggle="modal"
                                data-bs-target="#createAnimalModal">Create</button>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Breed</th>
                                        <th>Owner</th>
                                        <th>Owner Contact</th>
                                        <th>Age</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($animals as $animal)
                                        <tr>
                                            <td>#{{ $animal->id }}</td>
                                            <td><img src="{{ asset('images/' . $animal->type . '.png') }}"
                                                    alt="{{ $animal->type }}" class="img-fluid" style="width: 30px;">
                                            </td>
                                            <td>{{ $animal->name }}</td>
                                            <td>{{ $animal->breed }}</td>
                                            <td>{{ $animal->owner_name }}</td>
                                            <td class="contact-box">{{ $animal->owner_contact }}</td>
                                            <td class="age-box">{{ $animal->age }} Year</td>
                                            <td>
                                                <button onclick="confirmDelete({{ $animal->id }})"
                                                    class="icondelete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $animal->id }}"
                                                    action="{{ route('animals.delete', $animal->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                            <td>
                                                <button class="iconupdate"
                                                    onclick="showUpdateModalAnimal({{ $animal->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#updateAnimalModal"
                                                    data-id="{{ $animal->id }}" 
                                                    data-type="{{ $animal->type }}"
                                                    data-name="{{ $animal->name }}"
                                                    data-breed="{{ $animal->breed }}"
                                                    data-owner="{{ $animal->owner_name }}"
                                                    data-contact="{{ $animal->owner_contact }}"
                                                    data-age="{{ $animal->age }}">
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
                                    <li class="page-item {{ $animals->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $animals->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                            
                                    <!-- Tombol Halaman Dinamis -->
                                    @for ($i = 1; $i <= $animals->lastPage(); $i++)
                                        <li class="page-item {{ $i == $animals->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $animals->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                            
                                    <!-- Tombol Next -->
                                    <li class="page-item {{ $animals->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $animals->nextPageUrl() }}" aria-label="Next">
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
    <div class="modal fade" id="createAnimalModal" tabindex="-1" aria-labelledby="createAnimalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAnimalModalLabel">Create Animal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/animal" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="animalType" class="form-label">Type</label>
                                <select class="form-select" aria-label="Default select example" name="type"
                                    required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Dog">Dog</option>
                                    <option value="Bear">Bear</option>
                                    <option value="Cow">Cow</option>
                                    <option value="Monkey">Monkey</option>
                                    <option value="Owl">Owl</option>
                                    <option value="Panda">Panda</option>
                                    <option value="Pig">Pig</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Sheep">Sheep</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <label for="animalBreed" class="form-label">Breed</label>
                                <input type="text" class="form-control" id="animalBreed" name="breed" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="animalName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="animalName" name="name" required>
                            </div>
                            <div class="col">
                                <label for="animalAge" class="form-label">Age</label>
                                <input type="number" class="form-control" id="animalAge" name="age" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ownerName" class="form-label">Owner</label>
                            <input type="text" class="form-control" id="ownerName" name="owner_name" required>
                        </div>
                        <div class="mb-4">
                            <label for="ownerContact" class="form-label">Owner Contact</label>
                            <input type="text" class="form-control" id="ownerContact" name="owner_contact"
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

    <div class="modal fade" id="updateAnimalModal" tabindex="-1" aria-labelledby="updateAnimalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAnimalModalLabel">Update Animal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateAnimalForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="updateAnimalType" class="form-label">Type</label>
                                <select class="form-select" id="updateAnimalType" name="type" required>
                                    <option value="Cat">Cat</option>
                                    <option value="Dog">Dog</option>
                                    <option value="Bear">Bear</option>
                                    <option value="Cow">Cow</option>
                                    <option value="Monkey">Monkey</option>
                                    <option value="Owl">Owl</option>
                                    <option value="Panda">Panda</option>
                                    <option value="Pig">Pig</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Sheep">Sheep</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <label for="updateAnimalBreed" class="form-label">Breed</label>
                                <input type="text" class="form-control" id="updateAnimalBreed" name="breed"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="updateAnimalName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="updateAnimalName" name="name"
                                    required>
                            </div>
                            <div class="col">
                                <label for="updateAnimalAge" class="form-label">Age</label>
                                <input type="number" class="form-control" id="updateAnimalAge" name="age"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="updateOwnerName" class="form-label">Owner</label>
                            <input type="text" class="form-control" id="updateOwnerName" name="owner_name"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="updateOwnerContact" class="form-label">Owner Contact</label>
                            <input type="text" class="form-control" id="updateOwnerContact" name="owner_contact"
                                required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn buttonsave">Update</button>
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
