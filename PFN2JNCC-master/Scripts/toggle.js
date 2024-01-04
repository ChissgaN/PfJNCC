//menu desplegable 

const boton = document.querySelector("#dropA");
const menu = document.querySelector("#menuToggle");
const insideTwoContainer = document.querySelector(".insideTwoContainer");

boton.addEventListener('click', () => {
    menu.classList.toggle('show')
    insideTwoContainer.classList.toggle('hide');
})

//Add Class toggle

const botonAdd = document.querySelector("#addClassB");
const create = document.querySelector("#create");
const close = document.querySelector("#close");


botonAdd.addEventListener('click', () => {
    create.classList.toggle('showAdd')
    close.classList.toggle('showClose')
})

// Edit Class toggle
const editButtons = document.querySelectorAll(".editButton");
const edit = document.querySelector("#edit");
const editForm = edit.querySelector("form");

editButtons.forEach((button) => {
    button.addEventListener('click', () => {
        // values data
        const materiaId = button.dataset.id;
        const materiaNombre = button.dataset.materia;

        //prede
        editForm.querySelector('input[name="id"]').value = materiaId;
        editForm.querySelector('input[name="materiasEdit"]').value = materiaNombre;

        // Mostrar el formulario de edición
        edit.classList.toggle('showEdit');
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


