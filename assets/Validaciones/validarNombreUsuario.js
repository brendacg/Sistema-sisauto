function validarNombreUsuario(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if((val > 64 && val < 91) || (val > 96 && val < 123)){
      aux = true;
    }
  }else if(valor[0] != (val > 64 && val < 91) || (val > 96 && val < 123)){
    if((val > 47 && val < 58) || (val > 64 && val < 91) || (val > 96 && val < 123) || val == 95){//poner rangos de letras 
      if(valor.length < 8){
        aux = true;
      }   
    }
  }
  return aux;
}
