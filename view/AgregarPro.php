<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
  if ($_SESSION['usuarioActivo']['tipo_Usu']=='0') {
?>
<!DOCTYPE html>
<html lang="es">
<script src="../assets/Validaciones/validarProveedor.js"></script>
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
                        <a href="Proveedor.php" style="font-size:15px;color:blue;">Proveedores</a>
                    </li>
                    <li>
                        <a style="font-size:15px;">Registrar Proveedor</a>
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
                                    <form class="form-horizontal" action="../Controlador/proveedorC.php" method="POST" id="guardarPro" align="center" autocomplete="off">
                                        <h3><b>Datos Generales</b></h3>
                                        <input type="hidden" value="guardar" name="bandera">
                                        <div class="form-group">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="empresa" class="col-sm-3 control-label">Nombre de la Empresa:</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" placeholder="Nombre Completo" type="text" id="nombreEmp" name="Nombre_Emp">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group ">
                                            <label for="empresa" class="col-sm-3 control-label">Correo:</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" placeholder="Correo empresa" type="text" id="email" name="Correo_Emp" onkeyup="validarCorreoProv(this)"><a id='correoPro'></a>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group ">
                                            <label  for="tele1" class="col-sm-3 control-label">Teléfono:</label>
                                            <div  class="col-sm-2">
                                                <input class="form-control" type="text" id="telefonoEmp" placeholder="9999-9999" data-mask="9999-9999" name="Telefono_Emp"  onkeypress="return validarTel(this,event,this.value)">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group ">
                                            <label for="direccion" class="col-sm-3 control-label">Dirección:</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" placeholder="Dirección" id="direccionEmp" name="Direccion_Emp">
                                            </div>
                                        </div><br>
                                        <hr size="50" style="background-color: #78bab9"/><br>
                                        <h3 align="center"><b>Datos del Responsable</b></h3><br>
                                        <div class="form-group ">
                                            <label for="responsable" class="col-sm-3 control-label">Nombre del Responsable:</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" type="text" placeholder="Nombre Completo" name="Nombre_Res" id="nombreResp"/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group ">
                                            <label for="tel2" class="col-sm-3 control-label">Teléfono: </label>
                                            <div class="col-sm-2">
                                                <input type="tel" class="form-control" placeholder="9999-9999" data-mask="9999-9999" id="telefonoResp" name="Telefono_Res" maxlength="9" onkeypress="return validarTel(this,event,this.value)">
                                            </div>
                                        </div>
                                        <br>
                                        <hr width="75%">
                                        <div class="form-group" align="center">
                                            <button title="Aceptar" type="button" class="btn" style="color:#fff; background-color:#28a745" onclick="validarProveedor();">Aceptar</button>
                                            <button title="Cancelar" type="reset" value="Cancelar" class="btn " style="color:#fff; background-color:#ffc107">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                    <?php include("generalidades/cierre.php"); ?>
                    <script src="../assets/Validaciones/validarCorreo.js"></script>
                    <script src="../assets/Validaciones/validarNombreCompletoUsuario.js"></script>
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
