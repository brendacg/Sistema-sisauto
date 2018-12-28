function mostrarPro(nombre,correo,telefono,direccion,nombreR,telefonoR,descripcion){
	$("#nombrePro").val(nombre);
	$("#correoPro").val(correo);
	$("#telefonoPro").val(telefono);
	$("#direccionPro").val(direccion);
	$("#nombreRes").val(nombreR);
	$("#telefonoRes").val(telefonoR);
	if (descripcion!="") {
		$("#ocultar").css("display","block");
	    $("#descripcionProv").val(descripcion);
    }else{
    	$("#ocultar").css("display","none");
    }

	
}

function editarPro(nombre,correo,telefono,direccion,nombreR,telefonoR,idproveedor,descripcion){
	$("#nombreProEditar").val(nombre);
	$("#correoProEditar").val(correo);
	$("#telefonoProEditar").val(telefono);
	$("#direccionProEditar").val(direccion);
	$("#nombreResEditar").val(nombreR);
	$("#telefonoResEditar").val(telefonoR);
	$("#idproveedor").val(idproveedor);
	$("#descripcionProvEditar").val(descripcion);
	$("#anterior").val(nombre);

}