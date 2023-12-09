$(function () {
    var filtro = Array([5, 10, 50, 100, -1], ["5 filas", "10 filas", "50 filas", "100 filas", "Todos"]);

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
    });

    $("#btnperfil").on("click", function () {
        $("#modal-agregar").modal("show");
    });

    creardatatable("#example1", 0, filtro); //tabla.- index

    //#region "Registrar Perfil"
    $("#btnguardar").on("click", function () {
        let post = 1; //insert
        let codigo = ""; //codigo del perfil
        let nombre = $("#nombre").val(); //nombre del perfil
        let estado = 0; //activo
        let defaultx = 0; //

        if (validarInput(nombre)) {
            Toast.fire({
                icon: 'error',
                title: 'No ha ingresado un nombre!!',
                timer: 3000
            });
            return;
        }

        // Crea un objeto con los datos
        let datos = {
            post: post,
            codigo: codigo,
            nombre: nombre,
            estado: estado,
            defaultx: defaultx,
        };

        Swal.fire({
            title: "Estas seguro de crear el siguiente perfil?",
            text: "Favor de confirmar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#61C250",
            cancelButtonColor: "#ea5455",
            confirmButtonText: "Si, guardar!", //<i class="fa fa-smile-wink"></i>
            cancelButtonText: "No, cancelar!", //<i class="fa fa-frown"></i>
        }).then((result) => {
            if (result.value) {
                // Envía la solicitud POST mediante Ajax
                // fetch(baseurl + 'configuracion/mantperfil', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json'
                //     },
                //     body: JSON.stringify(datos)
                // })
                //     .then(response => response.json())
                //     .then(data => {
                //         console.log(data); // Maneja la respuesta del servidor
                //     })
                //     .catch(error => {
                //         console.error('Error:', error);
                //     });
                $.ajax({
                    url: baseurl + "configuracion/mantperfil",
                    type: "POST",
                    data: JSON.stringify(datos),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
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
                    // error : function(jqXHR, status, error) {
                    //     alert('Disculpe, existió un problema');
                    // },
                    // complete : function(jqXHR, status) {
                    //     alert('Petición realizada');
                    // }
                });
            }
        });

    });
    //#endregion

    //#region "Actualizar Perfil"
    $("#example1 tbody").on("click", "a.editar", function () {
        let id = $(this).attr("id");
        $("#codigox").val("");
        $("#nombrex").val("");
        let datos = {
            post: 1,
            codigo: id,
        };
        let query = $.param(datos);
        $.ajax({
            url: baseurl + "configuracion/getperfil?" + query,
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                overlayadd("overlay");
            },
            success: function (res) {
                $("#codigox").val(res.i_id);
                $("#nombrex").val(res.v_perfil);
                $("#estadox").val(res.i_estado);
                $("#defaultx").val(res.i_default);
                overlayclose("overlay");
            },
        });
        $("#modal-editar").modal("show");
    });

    $("#btnguardarx").on("click", function () {
        let post = 2; //actualizar
        let codigo = $("#codigox").val(); //codigo del perfil
        let nombre = $("#nombrex").val(); //nombre del perfil
        let estado = $("#estadox").val(); //activo
        let defaultx = $("#defaultx").val(); //activo

        if (validarInput(nombre)) {
            Toast.fire({
                icon: 'error',
                title: 'No ha ingresado un nombre!!',
                timer: 3000
            });
            return;
        }

        Swal.fire({
            title: "Estas seguro de actualizar el siguiente perfil?",
            text: "Favor de confirmar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#61C250",
            cancelButtonColor: "#ea5455",
            confirmButtonText: "Si, actualizar!", //<i class="fa fa-smile-wink"></i>
            cancelButtonText: "No, cancelar!", //<i class="fa fa-frown"></i>
        }).then((result) => {
            if (result.value) {

                // Crea un objeto con los datos
                let datos = {
                    post: post,
                    codigo: codigo,
                    nombre: nombre,
                    estado: estado,
                    defaultx: defaultx,
                };

                $.ajax({
                    url: baseurl + "configuracion/mantperfil",
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
                                $("#modal-editar").modal("hide");
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

    //#region "Eliminar Perfil"
    $("#example1 tbody").on("click", "a.eliminar", function () {
        let id = $(this).attr("id");
        let partes = id.split('_');

        let post = 3; //eliminar
        let codigo = partes[0];
        let nombre = "";
        let estado = 0;
        let defaultx = 0;

        let datos = {
            post: post,
            codigo: codigo,
            nombre: nombre,
            estado: estado,
            defaultx: defaultx,
        };

        Swal.fire({
            title: "Estas seguro de eliminar el siguiente perfil -> " + partes[1] + " ?",
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
                    url: baseurl + "configuracion/mantperfil",
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

// $(document).Toasts('create', {
//     class: 'bg-success',
//     title: 'PORTAL NETPRODEX v1.0',
//     subtitle: '24/11/2023 18:28',
//     position: "bottomRight",
//     body: 'Nueva actualización en portal trabajador. Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
//     autohide: true,
//     delay: 10000,
// });

// toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
// toastr.error('No ha ingresado un nombre para guardar!!')

// Swal.fire({
//     icon: "warning",
//     title: "No ha ingresado un nombre de perfil",
//     text: "Favor de ingresar un nombre para registrar...!!",

//     timer: 3000,
//     timerProgressBar: true,
//     showCancelButton: false,
//     showConfirmButton: false,
// });