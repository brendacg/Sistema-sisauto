function validarNumFac(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if((val > 47 && val < 58)){
      aux = true;
    }
  }else if(valor[0] == (val > 47 && val < 58)){
    if(val > 47 && val < 58){
        if(valor.length < 10){
        aux = true;
      }
    }else{
      aux = false;
    }
  }else{
    if(val > 47 && val < 58){
        if(valor.length < 10){
        aux = true;
      }
    }else{
      aux = false;
    }

  }
  var tamanio = $('#numFacCom').val().length+1;
  if(tamanio >= 10){
    $('#mensajeNumFac').text("Número máximo");
  }else{
    $('#mensajeNumFac').text("");
  }
  return aux;
}


function validarCantidad(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if((val > 47 && val < 58)){
      aux = true;
    }
  }else if(valor[0] == (val > 47 && val < 58)){
    if(val > 47 && val < 58){
        if(valor.length < 10){
        aux = true;
      }
    }else{
      aux = false;
    }
  }else{
    if(val > 47 && val < 58){
        if(valor.length < 10){
        aux = true;
      }
    }else{
      aux = false;
    }

  }
  return aux;
}


function validarPrecioUnitario(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if((val > 47 && val < 58)){
      aux = true;
    }
  }else if(valor[0] == (val > 47 && val < 58)){
    if(val > 47 && val < 58 || val == 46){
        if(valor.length < 10){
        aux = true;
      }
    }else{
      aux = false;
    }
  }else{
    if(val > 47 && val < 58 || val == 46){
        if(valor.length < 10){
        aux = true;
      }
    }else{
      aux = false;
    }

  }
  return aux;
}