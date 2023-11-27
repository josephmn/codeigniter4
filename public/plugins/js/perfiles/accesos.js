$(function () {
    creardatatable("#example1", 0); //tabla.- menu
    // creardatatable("#example2", 0); //tabla.- submenu
});

$(document).ready(function () {
    var groupColumn = 0;
    var table = $("#example2").DataTable({
        lengthChange: true,
        responsive: true,
        autoWidth: false,
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
        columnDefs: [{ visible: false, targets: groupColumn }],
        order: [[groupColumn, "asc"]],
        displayLength: [100],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            api
                .column(groupColumn, { page: "current" })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="5">' + group + "</td></tr>"
                            );

                        last = group;
                    }
                });
        },
    });

    // Order by the grouping
    $("#example2 tbody").on("click", "tr.group", function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
            table.order([groupColumn, "desc"]).draw();
        } else {
            table.order([groupColumn, "asc"]).draw();
        }
    });
});