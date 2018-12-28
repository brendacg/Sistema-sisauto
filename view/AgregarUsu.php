<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
  if ($_SESSION['usuarioActivo']['tipo_Usu']=='0') {
?>
<!DOCTYPE html>
<html lang="es">
<script src="../assets/Validaciones/validarUsuario.js"></script>
<?php include("generalidades/apertura.php"); ?>
<body>
    <div id="wrapper">
        <?php include("generalidades/menu.php"); ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php" style="font-size:15px;color:blue;">Inicio</a>
                    </li>
                    <li>
                        <a href="Usuarios.php" style="font-size:15px;color:blue;">Usuarios</a>
                    </li>
                    <li>
                        <a style="font-size:15px;">Registrar usuario</a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <form class="form-horizontal" action="../Controlador/usuarioC.php" method="POST" id="guardarUsu" align="center" autocomplete="off">
                                        <h3><b>Datos Generales</b></h3>
                                        <hr width="75%" style="background-color:#007bff;"/><br>
                                        <input type="hidden" value="GuardarUsu" name="bandera"></input>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-1">
                                            </div>
                                            <label for="nombre" class="col-sm-3 control-label">Nombre:</label>
                                            <div class="col-sm-12 col-md-8">
                                                <input class="form-control" placeholder="Nombre Completo" type="text" id="nombreUsu" name="Nombre_Usu" style="width:600px;height:40px" onkeypress="return validarNombreCompletoUsuario(this,event,this.value)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-1">
                                            </div>
                                            <label for="tel3" class="col-sm-3 control-label">Teléfono:</label>
                                            <div  class="col-sm-12 col-md-3">
                                                <input class="form-control" type="text" id="telefonoUsu" placeholder="9999-9999" data-mask="9999-9999" name="Telefono_Usu" style="width:150px;height:40px" onkeypress="return validarTel(this,event,this.value)"><a id='mensajitoTel'></a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-1">
                                            </div>
                                            <label for="nombre" class="col-sm-3 control-label">Correo:</label>
                                            <div class="col-sm-12 col-md-2">
                                                <input class="form-control" id="email" placeholder="Correo Electrónico" type="text" name="Correo_Usu" style="width:600px;height:40px" onkeyup="validarCorreo(this)"><a id='correoUsu'></a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-1">
                                            </div>
                                            <label for="direccion" class="col-sm-3 control-label">Dirección:</label>
                                            <div class="col-sm-12 col-md-8">
                                                <input class="form-control" type="text" placeholder="Dirección" name="Direccion_Usu" style="width:600px;height:40px" id="direccionUsu">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-1">
                                            </div>
                                            <label class="col-sm-3 control-label">DUI:</label>
                                            <div class="col-sm-12 col-md-4">
                                                <input class="form-control" type="text" placeholder="99999999-9" data-mask="99999999-9" id="duiUsu"  name="DUI_Usu" style="width:150px;height:40px" onkeypress="return validarDUI(this,event,this.value)"><a id='mensajitoDUI1'></a><a id='mensajitoDUI2'></a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-1">
                                            </div>
                                            <label for="usuario" class="col-sm-3 control-label">Usuario:</label>
                                            <div class="col-sm-12 col-md-8">
                                                <input class="form-control" type="text" placeholder="Nombre de Usuario" id="nombreusuUsu" name="NombreUsu_Usu" style="width:600px;height:40px" onkeypress="return validarNombreUsuario(this,event,this.value)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-1 col-md-1">
                                            </div>
                                            <label for="contrasena" class="col-sm-3 control-label">Contraseña:</label>
                                            <div class="col-sm-5 col-md-2">
                                                <input class="form-control" type="password" placeholder="******" id="contrasenaUsu" name="Contrasena_Usu" style="width:150px;height:40px" onkeypress="return validarContrasena(this,event,this.value)">
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <a id='mensajitoo'></a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-1">
                                            </div>
                                            <label for="contrasena" class="col-sm-3 control-label">Vuelve a escribir la contraseña:</label>
                                            <div class="col-sm-1 col-md-2">
                                                <input class="form-control" type="password" placeholder="******" id="contrasenaUsu2" name="Contrasena_Usu2" style="width:150px;height:40px" onkeyup="return validarContrasena2(this,event,this.value)"</a>
                                            </div>
                                            <div class="col-sm-12 col-md-2">
                                                <a id='mensajitooo'></a>
                                            </div>
                                        </div><br>
                                        <hr width="75%"/>
                                        <div class="form-group" align="center">
                                            <button title="Aceptar" type="button" class="btn" onclick="validarUsuario();" style="color:#fff; background-color:#28a745">Aceptar</button>
                                            <button title="Cancelar" type="reset" value="Cancelar" class="btn" style="color:#fff; background-color:#ffc107">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("generalidades/cierre.php"); ?>
            <script src="../assets/Validaciones/validarDUI.js"></script>
            <script src="../assets/Validaciones/validarTelefono.js"></script>
            <script src="../assets/Validaciones/validarContrasena.js"></script>
            <script src="../assets/Validaciones/validarNombreUsuario.js"></script>
            <script src="../assets/Validaciones/validarNombreCompletoUsuario.js"></script>
            <script src="../assets/Validaciones/validarCorreo.js"></script>
        </div>
    </div>
</body>
</html>

<?php
}else{
    ?>
    <!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="0;URL=/SISAUTO1/view/index.php">
</head>
<body>
</body>
</html>
    <?php
}
?>
<?php
}else{
    ?>
    <!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="0;URL=/SISAUTO1/view/login.php">
</head>
<body>
</body>
</html>
    <?php
}
?>
