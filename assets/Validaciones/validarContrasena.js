function validarContrasena(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;//valor en ascii
  tecla = String.fromCharCode(tecla);
  aux = false;//bandera

    if(valor == ''){
    if((val > 47 && val < 58) || (val > 64 && val < 91) || (val > 96 && val < 123)){
      aux = true;
    }
  }else if(valor[0] >= 0 || valor[0] >= '0'){
    if((val > 47 && val < 58) || (val > 64 && val < 91) || (val > 96 && val < 123)){//poner rangos de letras 
      if(valor.length < 8){
        aux = true;
      }   
    }
  }
  
  var tamanio = $('#contrasenaUsu').val().length + 1;
  if( tamanio < 6){
    $('#mensajitoo').text("Debe contener al menos 6 caracteres");
  }else{
    $('#mensajitoo').text("");
  }
  return aux;
}

function validarContrasena2(obj,e,valor){
 
  var confirmar = $('#contrasenaUsu').val();
  var contrasena = $('#contrasenaUsu2').val();

  console.log(confirmar);
  console.log(contrasena);
  if( confirmar == contrasena){
    $('#mensajitooo').text("La contraseña coincide");
  }else{
    $('#mensajitooo').text("La contraseña no coincide");
  }
}

function validareditarContrasena(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;//valor en ascii
  tecla = String.fromCharCode(tecla);
  aux = false;//bandera

    if(valor == ''){
    if((val > 47 && val < 58) || (val > 64 && val < 91) || (val > 96 && val < 123)){
      aux = true;
    }
  }else if(valor[0] >= 0 || valor[0] >= '0'){
    if((val > 47 && val < 58) || (val > 64 && val < 91) || (val > 96 && val < 123)){//poner rangos de letras 
      if(valor.length < 8){
        aux = true;
      }   
    }
  }
  
  var tamanio = $('#contrasenaUsuEditar').val().length+1;
  if( tamanio < 6){
    $('#mensajito1').text("Debe contener al menos 6 caracteres");
  }else{
    $('#mensajito1').text("");
  }
  return aux;
}

function validareditarContrasena2(obj,e,valor){
  var confirmar = $('#contrasenaUsuEditar').val();
  var contrasena = $('#contrasenaUsu2Editar').val();
  if( confirmar == contrasena){
    $('#mensajito').text("La contraseña coincide");
  }else{
    $('#mensajito').text("La contraseña no coincide");
  }
}

function validarContrasenaActual(obj,e,valor){
  tecla = (document.all) ? e.keyCode : e.which;
  val = tecla;//valor en ascii
  tecla = String.fromCharCode(tecla);
  aux = false;//bandera

    if(valor == ''){
    if((val > 47 && val < 58) || (val > 64 && val < 91) || (val > 96 && val < 123)){
      aux = true;
    }
  }else if(valor[0] >= 0 || valor[0] >= '0'){
    if((val > 47 && val < 58) || (val > 64 && val < 91) || (val > 96 && val < 123)){//poner rangos de letras 
      if(valor.length < 8){
        aux = true;
      }   
    }
  }
  
  var tamanio = $('#contrasenaActualUsuEditar').val().length+1;
  if( tamanio < 6){
    $('#mensajito2').text("Debe contener al menos 6 caracteres");
  }else{
    $('#mensajito2').text("");
  }
  return aux;
}