   async function validarCliente(){
        var nombre= await validarNombre(); 
        var direccion= await validarDireccion();   
        var telefono= await validarTelefono();  
        var nrc= await validarNRC();
        var nit= await validarNIT();  
        if (nombre==0 && direccion && telefono==0 && nrc==0 && nit==0) {
        	$('#guardarCli').submit();
        };      
    }
   function validarNombre(){

    if ($('#nombre').val().trim()=="") {
    	notaError("El nombre es obligatorio!");
    	return false;
    }else{
        var param = {
            nombre: $('#nombre').val(),
            bandera: "nombreC"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/clienteC.php",
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

return true;
    }

     function validarDireccion(){

    if ($('#direccion').val().trim()=="") {
    	notaError("La Dirección es obligatoria!");
    	return false;
    }


return true;
    }
      function validarTelefono(){

    if ($('#telefono').val().length!=9) {
        notaError("El teléfono debe contener 8 dígitos!");
        return true;
    }
    else if ($('#telefono').val().trim()=="") {
    	notaError("El teléfono es obligatorio!");
    	return true;
    }else{
        var param = {
            telefono: $('#telefono').val(),
            bandera: "telefonoC"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/clienteC.php",
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

      function validarNRC(){

    if ($('#nrc').val().length!=8) {
        notaError("El NRC debe contener 7 dígitos!");
        return true;
    }
    else if ($('#nrc').val().trim()=="") {
    	notaError("El NRC es obligatorio!");
    	return true;
    }
    else{
        var param = {
            nrc: $('#nrc').val(),
            bandera: "nrcC"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/clienteC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El NCR ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });
    }

    }

      function validarNIT(){

    if ($('#nit').val().length!=17) {
        notaError("El NIT debe contener 14 dígitos!");
        return true;
    }
    else if ($('#nit').val().trim()=="") {
    	notaError("El NIT es obligatorio!");
    	return true;
    }else{
        var param = {
            nit: $('#nit').val(),
            bandera: "nitC"
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/clienteC.php",
            method: "post",
            success: function(data){
                if (data==0) {
                    return true;
                }else{
                   notaError("El NIT ingresado ya ha sido registrado!"); 
                   return false;
                }
            }
        });
    }
    
    }
   // *********************************************************************************************************************
      async function validareditarCliente(){
        var nombre= await validarclienteEditar(); 
        var direccion= await validarDireccionEditar();   
        var telefono= await validarTelefonoEditar();  
        var nrc= await validarNRCEditar();
        var nit= await validarNITEditar();  
        if (nombre==0 && direccion && telefono==0 && nrc==0 && nit==0) {
            $('#editarCli').submit();
        };      
    }

    function validarclienteEditar(){
    var retornar;
    nombreC = $("#nombreCliEditar").val();
    descripcionC = $("#descripcionCliEditar").val();
    anteriorC = $("#anterior").val();

    if ($('#nombreCliEditar').val().trim()=="") {
        notaError("¡El nombre del cliente es obligatorio!");
        return 1;
    }else if (nombreC == anteriorC) {
        retornar= 0;
    }else if(descripcionC.length > 14){
        retornar= 0;
    }else if(descripcionC.length !=0 && descripcionC.length <= 14){
        notaError("Descripción muy corta");
        return 1;
    }else{
        notaError("Justifique en la descripción porque modificó el nombre del cliente");
        return 1;
    }
    if(retornar==0){
        var param={
            nombre: $('#nombreCliEditar').val(),
            bandera: "cnombreEditar",
            idC: $('#idcliente').val()
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/clienteC.php",
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
    //function validarclienteEditar(){
    //nombre = $("#nombreCliEditar").val();
    //descripcionE = $("#descripcionCliEditar").val();
    //anteriorE = $("#anterior").val();

    //if ($('#nombreCliEditar').val().trim()=="") {
      //  notaError("¡El nombre del cliente es obligatorio!");
        //return 1;
    //}else if (nombre == anteriorE) {
      //  return 0;
    //}else if(descripcionE.length > 14){
      //  return 0;
    //}else if(descripcionE.length !=0 && descripcionE.length <= 14){
      //  notaError("Descripción muy corta");
        //return 1;
    //}else{
      //  notaError("Justifique en la descripción porque modificó el nombre del cliente");
        //return 1;
    //}
      //  }

    function validarDireccionEditar(){

    if ($('#direccionCliEditar').val().trim()=="") {
        notaError("La Dirección es obligatoria!");
        return false;
    }
        return true;
    }


      function validarTelefonoEditar(){

    if ($('#telefonoCliEditar').val().length!=9) {
        notaError("El teléfono debe contener 8 dígitos!");
        return true;
    }
    else if ($('#telefonoCliEditar').val().trim()=="") {
        notaError("El teléfono es obligatorio!");
        return true;
    }else{
        var param = {
            telefono: $('#telefonoCliEditar').val(),
            bandera: "telefonoCEditar",
            idC: $('#idcliente').val()
        };

        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/clienteC.php",
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

      function validarNRCEditar(){

    if ($('#nrcCliEditar').val().trim()=="") {
        notaError("El NRC es obligatorio!");
        return 1;
    }
    else{
       return 0;
    }

    }

    function validarNITEditar(){

       if ($('#nitCliEditar').val().trim()=="") {
        notaError("El NIT es obligatorio!");
        return 1;
    }else{
        return 0;     
    }
}
    