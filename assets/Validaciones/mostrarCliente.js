function mostrarCli(nombre,direccion,telefono,nrc,nit,descripcion){
	$("#nombre").val(nombre);
	$("#direccion").val(direccion);
	$("#telefono").val(telefono);
	$("#nrc").val(nrc);
	$("#nit").val(nit);
	if (descripcion!="") {
		$("#ocultar").css("display","block");
	    $("#descripcionCli").val(descripcion);
    }else{
    	$("#ocultar").css("display","none");
    }
	
}

function editarCli(nombre,direccion,telefono,nrc,nit,idcliente,descripcion){
	$("#nombreCliEditar").val(nombre);
	$("#direccionCliEditar").val(direccion);
	$("#telefonoCliEditar").val(telefono);
	$("#nrcCliEditar").val(nrc);
	$("#nitCliEditar").val(nit);
	$("#idcliente").val(idcliente);
	$("#descripcionCliEditar").val(descripcion);
	$("#anterior").val(nombre);

}