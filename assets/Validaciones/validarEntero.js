function validarEntero(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if(tecla >= '1'){
      aux = true;
    }
    
  }
  else if(valor[0] >= 1){
    if(val > 47 && val < 58){
      if(valor.length < 5){
        aux = true;
      }   
    }
  }
  return aux;
}

function validarAnio(obj, e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if(tecla == '1' || tecla == '2'){
      aux = true;
    }
  }else if(valor[0] == 1 || valor[0] == 2){
    if(val > 47 && val < 58){
      if(valor.length < 4){
        aux = true;
      }   
    }
  }
  return aux;
}