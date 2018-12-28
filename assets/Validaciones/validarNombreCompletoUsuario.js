function validarNombreCompletoUsuario(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if((val > 64 && val < 91) || (val > 96 && val < 123)){
      aux = true;
    }
  }else if(valor[0] != (val > 64 && val < 91) || (val > 96 && val < 123)){
    if((val > 64 && val < 91) || (val > 96 && val < 123) || val == 32){//poner rangos de letras 
      
        aux = true;
  
    }
  }
  return aux;
}

function validarNombreCompletoProveedor(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if((val > 64 && val < 91) || (val > 96 && val < 123)){
      aux = true;
    }
  }else if(valor[0] != (val > 64 && val < 91) || (val > 96 && val < 123)){
    if((val > 64 && val < 91) || (val > 96 && val < 123) || val == 32){//poner rangos de letras 
      
        aux = true;
  
    }
  }
  return aux;
}