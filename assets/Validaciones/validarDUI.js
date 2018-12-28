function validarDUI(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;
  tecla = String.fromCharCode(tecla);
  aux = false;
  if(valor == ''){
    if((val > 47 && val < 58)){
      aux = true;
    }
  }else if(valor[0]>=0){
    if(val > 47 && val < 58){
      if(valor.length<8){
        aux = true;
      }   
    }
  }
  if(valor.length == 8 && tecla == '-'){
    aux = true;
  }else{
    if(val > 47 && val < 58){
      if(valor.length > 8 && valor.length <= 9){
        aux = true;
      }
    }
  }
  var tamanio = $('#duiUsu').val().length+1;
  if(tamanio < 10 && tamanio != 8){
    $('#mensajitoDUI1').text("Debe contener al menos 10 caracteres");
  }else{
    $('#mensajitoDUI1').text("");
  }
  if(tamanio == 8){
    $('#mensajitoDUI2').text("Debe escribir el guión");
  }else{
    $('#mensajitoDUI2').text("");
  }
  return aux;
}
