<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="es">
<script src="../assets/Validaciones/validarCliente.js"></script>
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
                        <a href="Cliente.php" style="font-size:15px;color:blue;">Clientes</a>
                    </li>
                    <li>
                        <a style="font-size:15px;">Registrar cliente</a>
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
                                    <form class="form-horizontal" action="../Controlador/clienteC.php" method="POST" id="guardarCli" align="center" autocomplete="off">
                                        <h2><b>Datos Generales</b></h2>
                                        <input type="hidden" value="GuardarCli" name="bandera">
                                        <div class="form-group">

                                        </div>
                                        <div class="form-group">
                                            <label for="empresa" class="col-sm-3 control-label">Nombre:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" placeholder="Nombre del Cliente" type="text" name="NombreC" id="nombre">
                                            </div>
                                        </div>
                                        <br>
                                            <div class="form-group">
                                            <label for="empresa" class="col-sm-3 control-label">Dirección:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" placeholder="Dirección" name="DireccionC" type="text" id="direccion">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group ">
                                            <label  for="tele1" class="col-sm-3 control-label">Teléfono:</label>
                                            <div  class="col-sm-3">
                                                <input class="form-control" name="TelefonoC" type="tel" id="telefono"placeholder="9999-9999" data-mask="9999-9999"  onkeypress="return validarTel(this,event,this.value)">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                            <label for="nrc" class="col-sm-3 control-label">NRC:</label>
                            <div class="col-sm-3">
                                <input class="form-control" name="NRC" type="text" id="nrc" placeholder="999999-9" data-mask="999999-9" >
                            </div>
                        </div>
                        <br>
                        <div class="form-group ">
                            <label class="col-sm-3 control-label">NIT:</label>
                            <div class="col-sm-3">
                                <input class="form-control" name="NIT" type="text" id="nit" placeholder="9999-999999-999-9" data-mask="9999-999999-999-9">
                            </div>
                        </div>
                                     <hr width="75%">
                                        <div class="form-group" align="center">
                                            <button title="Aceptar" type="button" class="btn" style="color:#fff; background-color:#28a745" onclick="validarCliente();">Aceptar</button>
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
                    <script src="../assets/Validaciones/validarCliente.js"></script>
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
<meta http-equiv="refresh" content="0;URL=/SISAUTO1/view/login.php">
</head>
<body>
</body>
</html>
    <?php
}
?>
