async function validarCompra(){
    var fechaC = await validarFechaC();    
    var numeroFacC = await validarNumeroFacC();
    var proveedorC = await validarProveedorC(); 
    var detallesC = await validarDetallesC();
    var duplicada = await validarCompraDuplicada();
    if (fechaC && numeroFacC && proveedorC && detallesC && duplicada){
        $('#guardarCom').submit();
    };   
}

function validarFechaC(){
    var f = new Date();
    //FECHA ACTUAL
    var diaActual = f.getDate();
    var mesActual = f.getMonth() + 1;
    var anioActual = f.getFullYear();
    //FECHA SELECCIONADA
    $fechaCom = $('#fecha').val();
    var fechas = $fechaCom.split('/');
    var diaSeleccionado = fechas[0];
    var mesSeleccionado = fechas[1];
    var anioSeleccionado = fechas[2];       

    if ($('#fecha').val().trim() == "") {
        notaError("¡La fecha es obligatoria!");
        return false;
    }else if (anioSeleccionado > anioActual) {
        notaError("¡La fecha debe ser válida!");
        return false;
    }else if (diaSeleccionado > diaActual && mesSeleccionado > mesActual && anioSeleccionado > anioActual) {
        notaError("¡La fecha debe ser válida!");
        return false;
    }else if (diaSeleccionado > diaActual && mesSeleccionado == mesActual && anioSeleccionado == anioActual) {
        notaError("¡La fecha debe ser válida!");
        return false;
    }else if (diaSeleccionado == diaActual && mesSeleccionado == mesActual && anioSeleccionado > anioActual) {
        notaError("¡La fecha debe ser válida!");
        return false;
    }else if (diaSeleccionado == diaActual && mesSeleccionado > mesActual && anioSeleccionado == anioActual) {
        notaError("¡La fecha debe ser válida!");
        return false;
    }else if (mesSeleccionado > mesActual && anioSeleccionado == anioActual) {
        notaError("¡La fecha debe ser válida!");
        return false;
    }
    return true;
}

function validarNumeroFacC(){
    if ($('#numFacCom').val().trim() == "") {
        notaError("¡El número de factura es obligatorio!");
        return false;
    }else if ($('#numFacCom').val().trim() == 0) {
        notaError("¡El número de factura es inválido!");
        return false;
    }
    return true;
}

function validarProveedorC(){
    if ($('#proves').val().trim() == "") {
        notaError("¡El proveedor es obligatorio!");
        return false;
    }
    return true;
}

function validarDetallesC(){
    if (($('#total').val().trim() == "0")) {
        notaError("¡Los detalles de la compra son obligatorios!");
        return false;
    }else if (($('#total').val().trim() == "")) {
        notaError("¡Los detalles de la compra deben ser válidos!");
        return false;
    }
    return true;
}

function filtrarCategoria(id){
    $('#productoFiltrado').empty();
    $('#productoFiltrado').append('<option value="">[Selecionar producto]</option>');
    $.get('/SISAUTO1/Controlador/comprasC.php?bandera=1&id='+id,function(data){
        console.log(data);
            $('#productoFiltrado').append(data);
    });
}

function mostrarAddProduc(){
    var cate = ["AMORTIGUADORES","BUJÍAS","COMBUSTIBLE","ELÉCTRICO","ENFRIAMIENTO","FILTROS","FRENOS","MOTOR","SENSORES","SUSPENSIÓN Y DIRECCIÓN","TRANSMISIÓN Y EMBRAGUE","UNIVERSALES"];
    var obtenerC = $("#categoriaPro").find('option:selected');
    var categoriaId = obtenerC.val();
    var categoriaText = obtenerC.text();
    var obtenerP = $("#productoFiltrado").find('option:selected');
    var id = obtenerP.val();
    var productoText = obtenerP.text();
    $("#cateAddP").val(cate[parseInt(categoriaId)-1]);

    $.get('/SISAUTO1/Controlador/comprasC.php?codigo=1&id='+id,function(data){
            $("#codigoAddP").val(data);    
     });

    $.get('/SISAUTO1/Controlador/comprasC.php?nombre=1&id='+id,function(data){
            $("#nombreAddP").val(data);    
     });

    $.get('/SISAUTO1/Controlador/comprasC.php?marca=1&id='+id,function(data){
            $("#marcaAddP").val(data);    
     });

    $.get('/SISAUTO1/Controlador/comprasC.php?descripcion=1&id='+id,function(data){
            $("#descripcionAddP").val(data);  
     });

    $.get('/SISAUTO1/Controlador/comprasC.php?modelo=1&id='+id,function(data){
            $("#modeloAddP").val(data);   
     });

    $.get('/SISAUTO1/Controlador/comprasC.php?anio=1&id='+id,function(data){
            if(data!='0'){
                $("#anioAddP").val(data);
            }else{
                $("#anioAddP").val("");
            }           
     });  
}

function agregar(){
    var cantidad = $('#cantidad').val();
    var precio = $('#precio').val();
    //var precioventa = $('#precioventa').val();
    var obtenerC = $("#categoriaPro").find('option:selected');
    var obtenerP = $("#productoFiltrado").find('option:selected');
    var categoriaId = obtenerC.val();
    var categoriaText = obtenerC.text();
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
    html = html+'<button title="Eliminar" type="button" class="btn btn-danger fa fa-trash" onclick="eliminar('+productoId+','+subtotal+');"></button></td></tr>';
    
     if(cantidad == "" || precio == "" || $('#categoriaPro').val() == "" || $('#productoFiltrado').val() == ""){
        $('#mensajeee1').text("");
        $('#mensajeee1').text("* Debe completar todos los datos del producto");

     }else if(cantidad == 0 || precio == 0 ){
        $('#mensajeee1').text("");
        $('#mensajeee1').text("* Debe escribir datos correctos");

     }else{
        $('#mensajeee1').text("");

        $('#tablaProductos').append(html);
        var acumulado = parseFloat($('#total').val());
        acumulado = acumulado + subtotal;
        $('#total').val(parseFloat(acumulado).toFixed(2));
        $('#cantidad').val("");
        $('#precio').val("");
        $('#categoriaPro').val("");
        $('#productoFiltrado').val("");
    }
}

function eliminar(id,subtotal){
    var acumulado = parseFloat($('#total').val());
    acumulado = acumulado - subtotal;
    $('#total').val(parseFloat(acumulado).toFixed(2));
    $('#f'+id).remove();
}

function validarCompraDuplicada(){
    if (!($('#numFacCom').val().trim() == "") && !($('#proves').val().trim() == "")) {
        
        var param = {
            numerofac: $('#numFacCom').val(),
            idproveedor: $('#proves').val(),
            bandera: "unnumerofac"
        };
        return $.ajax({
            data: param,
            url:"/SISAUTO1/Controlador/comprasC.php",
            method: "post",
            success: function(data){
                console.log(data);
                if (data == 0) {
                    return true;
                }else{
                   notaError("¡La compra ya fue registrada!"); 
                   return false;
                }
            }
        });
    }
}
//-----------------FUNCIONES DE EDITAR------------------------------------------------------

async function validarCompraE(){
    var numFac= await validarnumFacE();
    var fecha= await validarfechaE();
    var proveedor= await validarproveedorE();
    var total= await validartotalE();
    if(numFac==true && fecha==true && proveedor==true && total==true){
        $('#editarCompra').submit();
    }
}

   function validarnumFacE(){

    if ($('#numFacCom').val().trim()=="") {
        notaError("¡El numero de factura es obligatorio!");
        return false;
    }

    return true;

    }

    function validarproveedorE(){

    if ($('#proveedorComEditar').val().trim()=="") {
        notaError("¡El proveedor es obligatorio!");
        return false;
    }

    return true;

    }

    function validartotalE(){

    if ($('#total').val().trim()=="0.00") {
        notaError("¡Los detalles de la compra son obligatorios!");
        return false;
    }else if (($('#total').val().trim() == "")) {
        notaError("¡Los detalles de la compra deben ser validos!");
        return false;
    }

    return true;

    }

    function validarfechaE(){

    var f = new Date();
    //FECHA ACTUAL
    var diaActual = f.getDate();
    var mesActual = f.getMonth() + 1;
    var anioActual = f.getFullYear();
    //FECHA SELECCIONADA
    $fechaCom = $('#fecha').val();
    var fechas = $fechaCom.split('/');
    var diaSeleccionado = fechas[0];
    var mesSeleccionado = fechas[1];
    var anioSeleccionado = fechas[2];       

    if ($('#fecha').val().trim() == "") {
        notaError("¡La fecha es obligatoria!");
        return false;
    }else if (anioSeleccionado > anioActual) {
        notaError("¡La fecha debe ser valida!");
        return false;
    }else if (diaSeleccionado > diaActual && mesSeleccionado > mesActual && anioSeleccionado > anioActual) {
        notaError("¡La fecha debe ser valida!");
        return false;
    }else if (diaSeleccionado > diaActual && mesSeleccionado == mesActual && anioSeleccionado == anioActual) {
        notaError("¡La fecha debe ser valida!");
        return false;
    }else if (diaSeleccionado == diaActual && mesSeleccionado == mesActual && anioSeleccionado > anioActual) {
        notaError("¡La fecha debe ser valida!");
        return false;
    }else if (diaSeleccionado == diaActual && mesSeleccionado > mesActual && anioSeleccionado == anioActual) {
        notaError("¡La fecha debe ser valida!");
        return false;
    }else if (mesSeleccionado > mesActual && anioSeleccionado == anioActual) {
        notaError("¡La fecha debe ser valida!");
        return false;
    }
    return true;
}
