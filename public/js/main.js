function confirmDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form delete jika dikonfirmasi
            document.getElementById("delete-form-" + id).submit();
        }
    });
}

function showUpdateModalAnimal(id) {
    // Ambil elemen tombol yang ditekan
    const button = document.querySelector(`button[data-id='${id}']`);

    // Ambil data dari atribut tombol
    const type = button.getAttribute("data-type");
    const name = button.getAttribute("data-name");
    const breed = button.getAttribute("data-breed");
    const owner = button.getAttribute("data-owner");
    const contact = button.getAttribute("data-contact");
    const age = button.getAttribute("data-age");

    // Isi nilai data di dalam modal
    document.getElementById("updateAnimalType").value = type;
    document.getElementById("updateAnimalName").value = name;
    document.getElementById("updateAnimalBreed").value = breed;
    document.getElementById("updateOwnerName").value = owner;
    document.getElementById("updateOwnerContact").value = contact;
    document.getElementById("updateAnimalAge").value = age;

    // Atur action form update sesuai dengan ID animal
    document.getElementById("updateAnimalForm").action = `/animal/${id}`;
}

function showUpdateModalDoctor(id) {
    // Ambil elemen tombol yang ditekan
    const button = document.querySelector(`button[data-id='${id}']`);

    // Ambil data dari atribut tombol
    const gender = button.getAttribute("data-gender");
    const name = button.getAttribute("data-name");
    const specialization = button.getAttribute("data-specialization");
    const contact = button.getAttribute("data-contact");

    // Isi nilai data di dalam modal
    if (gender === "Male") {
        document.getElementById("radio1").checked = true;
    } else if (gender === "Female") {
        document.getElementById("radio2").checked = true;
    }

    document.getElementById("updateDoctorName").value = name;
    document.getElementById("updateDoctorSpecialization").value =
        specialization;
    document.getElementById("updateDoctorContact").value = contact;

    // Atur action form update sesuai dengan ID dokter
    document.getElementById("updateDoctorForm").action = `/doctor/${id}`;
}
