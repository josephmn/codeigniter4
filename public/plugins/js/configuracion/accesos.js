$(function () {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
    });

    //Initialize Select2 Elements
    // $('.select2').select2();

    // $('select').select2({
    //     theme: 'bootstrap4',
    // });

    var filtro = Array([-1], ["Todos"]);
    creardatatable("#example1", 0, filtro); //tabla.- menu

    $('.select2').select2({
        dropdownParent: $('#modal-agregar .modal-body'),
        theme: 'bootstrap4',
    });

    $("#btnacceso").on("click", function () {
        let perfil = $("#perfil").val();
        combomenu(perfil);
    });

    //#region "Registrar Accesos"
    $("#btnguardar").on("click", function () {
        let post = 1; //insertar
        let perfil = $("#perfil").val(); //perfil
        let menu = ($("#menu").val() == null) ? 0 : $("#menu").val(); //menu
        let submenu = ($("#submenu").val() == null) ? 0 : $("#submenu").val(); //submenu

        if (validarInput(perfil)) {
            Toast.fire({
                icon: 'error',
                title: 'Ocurrio un error interno, vuelva a intentarlo mas tarde!!',
                timer: 4000
            });
            return;
        }

        if (validarSelect(menu)) {
            Toast.fire({
                icon: 'warning',
                title: 'No ha seleccionado un menú válido!!',
                timer: 4000
            });
            return;
        }
        console.log(menu);
        console.log(submenu);
        Swal.fire({
            title: "Estas seguro de registrar los siguientes accesos?",
            text: "Favor de confirmar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#61C250",
            cancelButtonColor: "#ea5455",
            confirmButtonText: "Si, guardar!", //<i class="fa fa-smile-wink"></i>
            cancelButtonText: "No, cancelar!", //<i class="fa fa-frown"></i>
        }).then((result) => {
            if (result.value) {

                // Crea un objeto con los datos
                let datos = {
                    post: post,
                    perfil: perfil,
                    menu: menu,
                    submenu: submenu,
                };

                $.ajax({
                    url: baseurl + "configuracion/mantaccesos",
                    type: "POST",
                    data: JSON.stringify(datos),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    beforeSend: function () {
                        overlayadd("overlay");
                    },
                    success: function (res) {
                        switch (res.i_code) {
                            case 200: //EXITO
                                Swal.fire({
                                    icon: res.v_class,
                                    title: res.v_title,
                                    text: res.v_body,
                                    timer: res.i_timer,
                                    timerProgressBar: (res.i_progressbar == 1) ? true : false,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                                var id = setInterval(function () {
                                    location.reload();
                                    clearInterval(id);
                                }, res.i_timer);
                                overlayclose("overlay");
                                $("#modal-agregar").modal("hide");
                                break;
                            default:
                                Swal.fire({
                                    icon: res.v_class,
                                    title: res.v_title,
                                    text: res.v_body,
                                    timer: res.i_timer,
                                    timerProgressBar: (res.i_progressbar == 1) ? true : false,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                                overlayclose("overlay");
                                break;
                        }
                    },
                });
            }
        });
    });
    //#endregion

    //#region "Eliminar Menu"
    $("#example1 tbody").on("click", "a.delmenu", function () {
        let id = $(this).attr("id");
        let partes = id.split('_');

        let post = 3; //eliminar submenu
        let perfil = $("#perfil").val(); //perfil
        let menu = partes[0];
        let submenu = "";

        let datos = {
            post: post,
            perfil: perfil,
            menu: menu,
            submenu: submenu,
        };

        Swal.fire({
            title: "Estas seguro de eliminar el menu y sus submenus -> " + partes[1] + " ?",
            text: "Favor de confirmar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#61C250",
            cancelButtonColor: "#ea5455",
            confirmButtonText: "Si, eliminar!", //<i class="fa fa-smile-wink"></i>
            cancelButtonText: "No, cancelar!", //<i class="fa fa-frown"></i>
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseurl + "configuracion/mantaccesos",
                    type: "POST",
                    data: JSON.stringify(datos),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    beforeSend: function () {
                        overlayadd("overlay");
                    },
                    success: function (res) {
                        switch (res.i_code) {
                            case 200: //EXITO
                                Swal.fire({
                                    icon: res.v_class,
                                    title: res.v_title,
                                    text: res.v_body,
                                    timer: res.i_timer,
                                    timerProgressBar: (res.i_progressbar == 1) ? true : false,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                                var id = setInterval(function () {
                                    location.reload();
                                    clearInterval(id);
                                }, res.i_timer);
                                overlayclose("overlay");
                                break;
                            default:
                                Swal.fire({
                                    icon: res.v_class,
                                    title: res.v_title,
                                    text: res.v_body,
                                    timer: res.i_timer,
                                    timerProgressBar: (res.i_progressbar == 1) ? true : false,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                                overlayclose("overlay");
                                break;
                        }
                    },
                });
            }
        });

    });
    //#endregion

    //#region "Eliminar Submenu"
    $("#example2 tbody").on("click", "a.delsubmenu", function () {
        let id = $(this).attr("id");
        let partes = id.split('_');

        let post = 4; //eliminar submenu
        let perfil = $("#perfil").val(); //perfil
        let menu = "";
        let submenu = partes[0];

        let datos = {
            post: post,
            perfil: perfil,
            menu: menu,
            submenu: submenu,
        };

        Swal.fire({
            title: "Estas seguro de eliminar el submenu -> " + partes[1] + " ?",
            text: "Favor de confirmar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#61C250",
            cancelButtonColor: "#ea5455",
            confirmButtonText: "Si, eliminar!", //<i class="fa fa-smile-wink"></i>
            cancelButtonText: "No, cancelar!", //<i class="fa fa-frown"></i>
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseurl + "configuracion/mantaccesos",
                    type: "POST",
                    data: JSON.stringify(datos),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    beforeSend: function () {
                        overlayadd("overlay");
                    },
                    success: function (res) {
                        switch (res.i_code) {
                            case 200: //EXITO
                                Swal.fire({
                                    icon: res.v_class,
                                    title: res.v_title,
                                    text: res.v_body,
                                    timer: res.i_timer,
                                    timerProgressBar: (res.i_progressbar == 1) ? true : false,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                                var id = setInterval(function () {
                                    location.reload();
                                    clearInterval(id);
                                }, res.i_timer);
                                overlayclose("overlay");
                                break;
                            default:
                                Swal.fire({
                                    icon: res.v_class,
                                    title: res.v_title,
                                    text: res.v_body,
                                    timer: res.i_timer,
                                    timerProgressBar: (res.i_progressbar == 1) ? true : false,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                                overlayclose("overlay");
                                break;
                        }
                    },
                });
            }
        });

    });
    //#endregion
});

// PARA LISTAR MENÚ
$("#menu").change(function () {
    let idperfil = $("#perfil").val();
    let menu = $("#menu").val();
    let datos = {
        menu: menu,
        perfil: idperfil,
    };
    let query = $.param(datos);
    $.ajax({
        url: baseurl + "configuracion/getsubmenu?" + query,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            overlayadd("overlay");
        },
        success: function (res) {
            $("#submenu").html("");
            $("#submenu").append(res.data);
            overlayclose("overlay");
        },
    });
});

// crear combo menu
function combomenu(idperfil) {
    $("#submenu").html("");
    $("#submenu").append("<option selected='selected' disabled='disabled' value='0'>-- SELECCIONAR --</option>");
    let datos = {
        perfil: idperfil,
    };
    let query = $.param(datos);
    $.ajax({
        url: baseurl + "configuracion/getmenu?" + query,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            overlayadd("overlay");
        },
        success: function (res) {
            $("#menu").html("");
            $("#menu").append(res.data);
            overlayclose("overlay");
        },
    });
    $("#modal-agregar").modal("show");
}

// // crear combo submenu
// function combosubmenu(codperfil, menu) {
//     let datos = {
//         perfil: idperfil,
//     };
//     let query = $.param(datos);
//     $.ajax({
//         url: baseurl + "configuracion/getsubmenu?" + query,
//         type: "GET",
//         dataType: "json",
//         beforeSend: function () {
//             overlayadd("overlay");
//         },
//         success: function (res) {
//             $("#menu").html("");
//             $("#menu").append(res.data);
//             overlayclose("overlay");
//         },
//     });
// }

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
        lengthMenu: [[-1], ['Todos']],
        // displayLength: [100],
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