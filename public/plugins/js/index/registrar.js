$(function () {

});

function actualizarLongitudMaxima() {
    var select = document.getElementById("tdocumento");
    var inputDocumento = document.getElementById("documento");

    // Restablecer el valor predeterminado
    inputDocumento.maxLength = 8;

    // Actualizar el maxLength según la opción seleccionada
    switch (select.value) {
        case "D00001":
            inputDocumento.maxLength = 8;
            break;
        case "D00002":
            inputDocumento.maxLength = 11;
            break;
        case "D00003":
            inputDocumento.maxLength = 9;
            break;
        default:
            break;
    }

    // Limpiar el valor del campo de entrada si excede la nueva longitud máxima
    if (inputDocumento.value.length > inputDocumento.maxLength) {
        inputDocumento.value = inputDocumento.value.slice(0, inputDocumento.maxLength);
    }
}