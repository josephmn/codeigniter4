// validación para Input
function validarInput(inputValue) {
    if (inputValue === null || inputValue.trim() === '') {
        return false;
    } else {
        return true;
    }
}

function overlayadd(valor){
    let overlay = "\
    <div id='overlay' class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i>\
        <div class='text-bold pt-2'>Cargando...</div>\
    </div>";
    $input = "#"+valor;
    $($input).html("");
    $($input).html(overlay);
}

function overlayclose(valor){
    $input = "#"+valor;
    $($input).html("");
    $($input).html(overlay);
}

// creacion de datatble
function creardatatable(nombretabla, orden) {
    var tabla = $(nombretabla).dataTable({
        lengthChange: true,
        responsive: true,
        autoWidth: false,
        // dom: 'Bfrtip',
        // buttons: [
        //     'colvis',
        //     'excel',
        //     'print'
        // ],
        language: {
            decimal: "",
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        order: [[orden, "asc"]],
        lengthMenu: [[5, 10, 50, 100, -1], ["5 filas", "10 filas", "50 filas", "100 filas", "Todos"]],
    });
    return tabla;
}
