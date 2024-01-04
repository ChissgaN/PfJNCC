// Menú desplegable
const boton = document.querySelector("#dropA");
const menu = document.querySelector("#menuToggle");
const insideTwoContainer = document.querySelector(".insideTwoContainer");

boton.addEventListener('click', () => {
    menu.classList.toggle('show');
    insideTwoContainer.classList.toggle('hide');
});

// Editar permisos
const editPermisosButtons = document.querySelectorAll(".editPermisosButton");
const editPermi = document.querySelector("#editPermi");
const editPermisosForm = document.querySelector("#editPermisosForm");
const editEmailInput = document.querySelector("#editEmail");
const editRolSelect = document.querySelector("#rolSelc");
const editUserIdInput = document.querySelector("#editUserId");
const estadoSwitchInput = document.querySelector("#estadoSwitch");

if (editPermisosButtons.length > 0 && editPermi && editPermisosForm && editEmailInput && editRolSelect && editUserIdInput && estadoSwitchInput) {
    editPermisosButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Obtener valores del botón
            const userId = button.getAttribute('data-id');
            const userEmail = button.parentElement.parentElement.querySelector('.claseP').textContent;
            const userRolId = button.getAttribute('data-userrol');
            const userEstado = button.parentElement.parentElement.getAttribute('data-estado');

            // Mapear status
            const statusId = (userEstado === 'Activo') ? 1 : 2;

            // Prede
            editPermisosForm.action = `../index.php?controller=PermisosController&action=editPermiso&id=${userId}`;
            editUserIdInput.value = userId;
            editEmailInput.value = userEmail;
            editRolSelect.value = userRolId; 

            estadoSwitchInput.checked = (userEstado === 'Activo');

            // show edit
            editPermi.classList.toggle('showEditPermi');
        });
    });

    // Change Switch
    estadoSwitchInput.addEventListener('change', () => {
        // New Value Switch
        const nuevoEstado = estadoSwitchInput.checked ? 'Activo' : 'Inactivo';
    });
}

// Paging and Search
$(document).ready(function() {
    let miTabla = $('.tableP').DataTable({
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
    $('.inSearch').on('input', function() {
        let searchText = $(this).val().toLowerCase();

        // Filter and Show 
        miTabla.rows().eq(0).each(function(index) {
            let row = miTabla.row(index);
            let rowData = row.data();

            // Verify 
            let matchFound = false;
            row.nodes().to$().find('td').each(function() {
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



