    async function validarProveedor(){
        var nombreE= await validarNombreE(); 
        var correoE= await validarCorreoE();
        var telefonoE= await validarTelefonoE(); 
        var direccionE= await validarDireccionE();    
        var nombreR= await validarNombreR();
        var telefonoR= await validarTelefonoR(); 

        if (nombreE==0 && correoE==0 && telefonoE==0 && direccionE && nombreR && telefonoR==0) {
        	$('#guardarPro').submit();
        }   
    }
   function validarNombreE(){

    if ($('#nombreEmp').val().trim()=="") {
    	notaError("El nombre de la empresa es obligatorio!");
    	return false;
    }
    else{
        var param = {
            nombre: $('#nombreEmp').val(),
            bandera: "cnombre"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/proveedorC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El nombre ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });
    }
    }

    function validarCorreoE(){
    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if(!regex.test($('#email').val())){
        notaError("¡El correo es incorrecto!");
        return true;
    }else if ($('#email').val().trim()=="") {
        notaError("¡El correo es obligatorio!");
        return true;
    }else{
        var param = {
            correo: $('#email').val(),
            bandera: "ccorreo"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/proveedorC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El correo ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });
    }

    }

    function validarTelefonoE(){

     if ($('#telefonoEmp').val().length!=9) {
        notaError("El teléfono debe contener 8 dígitos!");
        return true;
    }   

    else if ($('#telefonoEmp').val().trim()=="") {
        notaError("El teléfono de la empresa es obligatorio!");
        return true;
    }
    else{
        var param = {
            telefono: $('#telefonoEmp').val(),
            bandera: "ctelEmp"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/proveedorC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El teléfono ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });
    }

    
// return true;
    }

     function validarDireccionE(){

    if ($('#direccionEmp').val().trim()=="") {
    	notaError("La Dirección es obligatoria!");
    	return false;
    }


return true;
    }

      function validarNombreR(){

    if ($('#nombreResp').val().trim()=="") {
    	notaError("El nombre del responsable es obligatorio!");
    	return false;
    }
    

return true;
    }

      function validarTelefonoR(){

    if ($('#telefonoResp').val().length!=9) {
        notaError("El teléfono del proveedor debe contener 8 dígitos!");
        return true;
    }

    else if ($('#telefonoResp').val().trim()=="") {
    	notaError("El teléfono del responsable es obligatorio!");
    	return true;
    }
    else{
        var param = {
            telefonoR: $('#telefonoResp').val(),
            bandera: "ctelResp"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/proveedorC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El teléfono del responsable ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });
    }
    }

// *******************************************************************************

    async function validareditarProveedor(){
        var nombreE= await validarproveedorEditar(); 
        var correoE= await validareditarCorreoE();
        var telefonoE= await validareditarTelefonoE(); 
        var direccionE= await validareditarDireccionE();    
        var nombreR= await validareditarNombreR();
        var telefonoR= await validareditarTelefonoR(); 

        if (nombreE==0 && correoE==0 && telefonoE==0 && direccionE && nombreR && telefonoR==0) {
            $('#editarPro').submit();
        }   
    }

function validarproveedorEditar(){
    var retornar;
    nombreE = $("#nombreProEditar").val();
    descripcionE = $("#descripcionProvEditar").val();
    anteriorE = $("#anterior").val();

    if ($('#nombreProEditar').val().trim()=="") {
        notaError("¡El nombre de la empresa es obligatorio!");
        return 1;
    }else if (nombreE == anteriorE) {
        retornar= 0;
    }else if(descripcionE.length > 14){
        retornar= 0;
    }else if(descripcionE.length !=0 && descripcionE.length <= 14){
        notaError("Descripción muy corta");
        return 1;
    }else{
        notaError("Justifique en la descripción porque modificó el nombre de la empresa");
        return 1;
    }
    if(retornar==0){
        var param={
            nombre: $('#nombreProEditar').val(),
            bandera: "cnombreEditar",
            idP: $('#idproveedor').val()
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/proveedorC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El nombre ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });

    }
}

    function validareditarCorreoE(){
    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if ($('#correoProEditar').val().trim()=="") {
        notaError("¡El correo es obligatorio!");
        return true;
    }else if(!regex.test($('#correoProEditar').val())){
        notaError("¡El correo es incorrecto!");
        return true;
    }else{
        var param = {
            correo: $('#correoProEditar').val(),
            bandera: "ccorreoEditar",
            idP: $('#idproveedor').val()
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/proveedorC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El correo ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });
    }

    }

    function validareditarTelefonoE(){

       if ($('#telefonoProEditar').val().length!=9) {
        notaError("El teléfono debe contener 8 dígitos!");
        return true;
    }   

    else if ($('#telefonoProEditar').val().trim()=="") {
        notaError("El teléfono de la empresa es obligatorio!");
        return true;
    }
    else{
        var param = {
            telefono: $('#telefonoProEditar').val(),
            bandera: "ctelEmpEditar",
            idP: $('#idproveedor').val()
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/proveedorC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                 notaError("El teléfono ingresado ya ha sido registrado!"); 
                 return false;
             }
         }
     });
    }

}

    function validareditarDireccionE(){

        if ($('#direccionProEditar').val().trim()=="") {
            notaError("La Dirección es obligatoria!");
            return false;
        }


        return true;
    }

    function validareditarNombreR(){

        if ($('#nombreResEditar').val().trim()=="") {
            notaError("El nombre del responsable es obligatorio!");
            return false;
        }


        return true;
    }

    function validareditarTelefonoR(){

        if ($('#telefonoResEditar').val().length!=9) {
            notaError("El teléfono del proveedor debe contener 8 dígitos!");
            return true;
        }

        else if ($('#telefonoResEditar').val().trim()=="") {
            notaError("El teléfono del responsable es obligatorio!");
            return true;
        }
        else{
            var param = {
                telefonoR: $('#telefonoResEditar').val(),
                bandera: "ctelRespEditar",
                idP:$('#idproveedor').val()
            };

            return $.ajax({
                data: param,
                url:"/SISAUTO1/Controlador/proveedorC.php",
                method: "post",
                success: function(data){
                    if (data==0) {
                        return true;
                    }else{
                     notaError("El teléfono del responsable ingresado ya ha sido registrado!"); 
                     return false;
                 }
             }
         });
        }
    }