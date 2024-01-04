// Add Menu Toggle
const boton = document.querySelector("#dropA");
const menu = document.querySelector("#menuToggle");
const insideTwoContainer = document.querySelector(".insideTwoContainer");

boton.addEventListener('click', () => {
    menu.classList.toggle('show');
    insideTwoContainer.classList.toggle('hide');
});

// Add teacher toggle
const addTeacher = document.querySelector("#addTeacher");
const createTe = document.querySelector("#createTe");

addTeacher.addEventListener('click', () => {
    createTe.classList.toggle('showAddTe');
});

// Edit teacher 
const editTeacherButtons = document.querySelectorAll(".editTeacherButton");
const editTe = document.querySelector("#editTe");

editTeacherButtons.forEach(button => {
    button.addEventListener('click', () => {
        const userId = button.dataset.userid;
        const userName = button.dataset.username;
        const userSurname = button.dataset.usersurname;
        const userEmail = button.dataset.useremail;
        const userAddress = button.dataset.useraddress;
        const userDate = button.dataset.userdate;
        const userRolId = button.dataset.userrolid;
        const userMateriasId = button.dataset.usermateriasid;

        // valores al formulario
        const form = document.querySelector("#editTe form");
        form.querySelector('input[name="id"]').value = userId;
        form.querySelector('input[name="name"]').value = userName;
        form.querySelector('input[name="surname"]').value = userSurname;
        form.querySelector('input[name="email"]').value = userEmail;
        form.querySelector('input[name="address"]').value = userAddress;
        form.querySelector('input[name="date"]').value = userDate;

        form.querySelector('select[name="rolEdit"]').value = userRolId;
        form.querySelector('select[name="materiasEdit"]').value = userMateriasId;

        // Mostrar el formulario
        editTe.classList.toggle('showEditTe');
    });
});


// Paging and Search
$(document).ready(function () {
    let miTabla = $('#miTabla').DataTable({
        "paging": true,
        "pageLength": 5,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": true,
        "responsive": true
    });

    // Search
    $('.inSearch').on('input', function () {
        let searchText = $(this).val().toLowerCase();

        // Filter and Show
        miTabla.rows().eq(0).each(function (index) {
            let row = miTabla.row(index);
            let rowData = row.data();

            // Verify text
            let matchFound = false;
            row.nodes().to$().find('td').each(function () {
                if ($(this).text().toLowerCase().includes(searchText)) {
                    matchFound = true;
                    return false;
                }
            });

            if (matchFound) {
                row.nodes().to$().show();
            } else {
                row.nodes().to$().hide();
            }
        });
    });

});