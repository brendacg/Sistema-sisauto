function radioSeleccionado(numero){

	if(numero == 1){
		$("#r2").css('background','');
		$("#r1").css('background','green');

		$("#clientesID").css('display','block');//mostrar

	}else{
		$("#r2").css('background','green');
		$("#r1").css('background','');

		$("#clientesID").css('display','none');//ocultar
		
	}
}

function mostrarCostoyExistencias(id){
	$('#cantidadDisponiblePV').empty();
	$('#costoPV').empty();
	$('#precioPV').empty();
    $.get('/SISAUTO1/Controlador/ventasC.php?existencias=1&id='+id,function(data){
        $('#cantidadDisponiblePV').val(data);
    });
    $.get('/SISAUTO1/Controlador/ventasC.php?costo=1&id='+id,function(data){
    	$('#costoPV').val(data); 
    });
    $.get('/SISAUTO1/Controlador/ventasC.php?precio=1&id='+id,function(data){
    	$('#precioPV').val(data); 
    });
}

function aplicarDescuento15(){
	var precio = $('#precioPV').val();
	$('#precioPV').val("");
	if(precio != ""){
		var p = parseFloat(precio)-(parseFloat(precio) * 0.15);
    	$('#precioPV').val(parseFloat(p).toFixed(2));
	}else{
		$('#precioPV').val("");
	}    
}

function agregarProductosATabla(){
	var disponible = $('#cantidadDisponiblePV').val();
	//console.log(disponible);
    var cantidad = $('#cantidadPV').val();

	//console.log(cantidad);
    var precio = $('#precioPV').val();
    //var precioventa = $('#precioventa').val();
    var obtenerP = $("#produs").find('option:selected');
    var productoId = obtenerP.val();
    var productoText = obtenerP.text();
    var subtotal = parseFloat(cantidad) * parseFloat(precio);
    var html = '<tr id="f'+productoId+'"><td>'+cantidad+'</td>';
    html = html+'<td>'+productoText+'</td>';
    html = html+'<td>'+precio+'</td>';
   // html = html+'<td>'+precioventa+'</td>';
    html = html+'<td>'+parseFloat(subtotal).toFixed(2)+'</td>';
    html = html+'<td>';
    html = html+'<input type="hidden" name="cantidad_DCom[]" value="'+cantidad+'"/>';
    html = html+'<input type="hidden" name="precio_DCom[]" value="'+precio+'"/>';
   // html = html+'<input type="hidden" name="precio_DVen[]" value="'+precioventa+'"/>';
    html = html+'<input type="hidden" name="id_Producto[]" value="'+productoId+'"/>';
    html = html+'<button title="Eliminar" type="button" class="btn btn-danger fa fa-trash" onclick="eliminarProductosDeTabla('+productoId+','+subtotal+');"></button></td></tr>';
    
     if(cantidad == "" || precio == "" || $('#produs').val() == ""){
        $('#mensajeee1').text("");
        $('#mensajeee1').text("* Debe completar todos los datos del producto");

     }else if(cantidad == 0 || precio == 0 ){
        $('#mensajeee1').text("");
        $('#mensajeee1').text("* Debe escribir datos correctos");

     }else if(parseInt(cantidad) > parseInt(disponible)){
        $('#mensajeee1').text("");
        $('#mensajeee1').text("* Cantidad solicitada NO disponible");

     }else{
        $('#mensajeee1').text("");

        $('#tablaProductosVenta').append(html);
        var acumulado = parseFloat($('#totalVenta').val());
        acumulado = acumulado + subtotal;
        $('#totalVenta').val(parseFloat(acumulado).toFixed(2));
        $('#cantidadPV').val("");
        $('#precioPV').val("");
        $('#cantidadDisponiblePV').val("");
        $('#costoPV').val("");
        $('#produs').val("");
    }
}

function eliminarProductosDeTabla(id,subtotal){
    var acumulado = parseFloat($('#totalVenta').val());
    acumulado = acumulado - subtotal;
    $('#totalVenta').val(parseFloat(acumulado).toFixed(2));
    $('#f'+id).remove();
}

async function validarVenta(){
    var detallesV = await validarDetallesV();
    var clienteV = await validarClienteV();
    if (detallesV && clienteV){
        $('#guardarVen').submit();
    };   
}

function validarDetallesV(){
    if (($('#totalVenta').val().trim() == "0")) {
        notaError("¡Los detalles de la compra son obligatorios!");
        return false;
    }else if (($('#totalVenta').val().trim() == "")) {
        notaError("¡Los detalles de la compra deben ser válidos!");
        return false;
    }
    return true;
}

function validarClienteV(){
    if ($('#clientess').val().trim() == "") {
        notaError("¡Debe seleccionar un cliente!");
        return false;
    }
    return true;
}