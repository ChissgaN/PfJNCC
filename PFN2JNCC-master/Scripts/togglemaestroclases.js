//menu desplegable 

const boton = document.querySelector("#dropA");
const menu = document.querySelector("#menuToggle");
const insideTwoContainer = document.querySelector(".insideTwoContainer");

boton.addEventListener('click', () => {
    menu.classList.toggle('show')
    insideTwoContainer.classList.toggle('hide');
})

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