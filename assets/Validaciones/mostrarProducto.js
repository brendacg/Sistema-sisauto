function mostrarProduc(codigoP,nombreP,cateP,marcaP,modeloP,anioP,descripcionP,stockP,precioP){
    var cate =["AMORTIGUADORES","BUJÍAS","COMBUSTIBLE","ELÉCTRICO","ENFRIAMIENTO","FILTROS","FRENOS","MOTOR","SENSORES","SUSPENSIÓN Y DIRECCIÓN","TRANSMISIÓN Y EMBRAGUE","UNIVERSALES"];

    $("#codigoP").val(codigoP);
    $("#nombreP").val(nombreP);
    $("#cateP").val(cate[parseInt(cateP)-1]);
    $("#marcaP").val(marcaP);
    $("#modeloP").val(modeloP);
    if(anioP!='0'){
       $("#anioP").val(anioP);
    }else{
       $("#anioP").val("");
    }
    $("#descripcionP").val(descripcionP);
    $("#stockP").val(stockP);
    $("#precioP").val(precioP);
}

function editarProduc(codigoP,nombreP,cateP,marcaP,modeloP,anioP,descripcionP,idProducto,stockP,precioP){
    $("#codigoPE").val(codigoP);
    $("#nombrePE").val(nombreP);
    $("#catePE").val(cateP);
    $("#marcaPE").val(marcaP);
    $("#modeloPE").val(modeloP);
        if(anioP!='0'){
       $("#anioPE").val(anioP);
    }else{
       $("#anioPE").val("");
    }
    $("#descripcionPE").val(descripcionP);
    $("#idProducto").val(idProducto);
    if(cateP=="12"){
        $("#modeloPE").attr("disabled", "disabled");
        $("#anioPE").attr("disabled", "disabled");
        $('#universal').val(1);
    }else{
        $('#universal').val(0);
        $("#modeloPE").removeAttr("disabled");
        $("#anioPE").removeAttr("disabled");
    }
    $("#stockPE").val(stockP);
    $("#precioPE").val(precioP);

}
