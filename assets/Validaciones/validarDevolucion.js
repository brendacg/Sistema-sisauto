
async function validarDevolucion(){
    var cantidades = await validarCantidades(); 
    var justificacion = await validarjustificacion();    
    
    if (cantidades && justificacion){
        $('#guardarDev').submit();
    };   
}

function validarCantidades(){
    if ($('#numFacCom').val().trim() == "") {
        notaError("¡La cantidad a devolver es mayor que la cantidad disponible!");
        return false;
    }
    // else if ($('#numFacCom').val().trim() == 0) {
    //     notaError("¡El número de factura es inválido!");
    //     return false;
    // }
    return true;
}

function validarjustificacion(){
    if ($('#justificar').val().trim() == "") {
        notaError("¡La justificación de la devolución es obligatorio!");
        return false;
    }
    return true;
}