<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
  if ($_SESSION['usuarioActivo']['tipo_Usu']=='0') {
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
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
                        <a style="font-size:15px;">Usuarios</a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <?php if (!isset($_GET['tipo'])) {
            $tipo = 1;
        }else{
            $tipo = $_GET['tipo'];
        }?>
        <?php
        $sql = "SELECT * from usuario where estado_Usu = '$tipo' order by nombre_Usu ASC";
        $usuarios= mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
        ?>
    <div class="row">
        <div class="col-12">
            <div class="row" style="padding:20px">
                <br>
                <a class="pull-right" href="Reportes/ReporteUsuario.php">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
                        Reporte
                        <span class="fa fa-file-pdf-o"></span>
                    </button>
                    &nbsp;
                </a>
                <a class="pull-right" href="AgregarUsu.php">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
                        Agregar nuevo
                        <span class="fa fa-plus"></span>
                    </button>
                    &nbsp;
                </a>
                <?php  if ($tipo == 1) { ?>
                    <a class="pull-right" href="/SISAUTO1/view/Usuarios.php?tipo=0">
                        <button class="btn btn-success" style="font-size:16px;">
                            Ver usuarios inactivos  <i class="fa fa-bars"></i>
                        </button>
                        &nbsp;
                    </a>
                <?php  }else{ ?>
                    <a class="pull-right" href="/SISAUTO1/view/Usuarios.php?tipo=1">
                        <button class="btn btn-success" style="font-size:16px;">
                            Ver usuarios activos  <i class="fa fa-bars"></i>
                        </button>
                        &nbsp;
                    </a>
                <?php } ?>
                <br><br>
                <!-- TABLA USUARIOS-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wrapper wrapper-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                                            <form class="form-horizontal" action="../Controlador/usuarioC.php" method="POST" id="guardarUsu" autocomplete="off">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered display" id="example">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:175px">Nombre</th>
                                                                <th style="width:85px">Correo</th>
                                                                <th style="width:85px">Teléfono</th>
                                                                <th align="center" style="width:2px">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php While($usuario = mysqli_fetch_assoc($usuarios)){?>
                                                                <tr>
                                                                    <td><?php echo $usuario['nombre_Usu'] ?></td>
                                                                    <td><?php echo $usuario['correo_Usu'] ?></td>
                                                                    <td><?php echo $usuario['telefono_Usu'] ?></td>
                                                                    <th align="center">
                                                                        <button title="Ver" type="button" class="btn btn-info fa fa-eye" data-toggle="modal" data-target="#modalVerUsuario" href="" onclick="mostrarUsu('<?php echo $usuario['nombre_Usu']?>','<?php echo $usuario['telefono_Usu']?>','<?php echo $usuario['correo_Usu']?>','<?php echo $usuario['direccion_Usu']?>','<?php echo $usuario['dui_Usu']?>','<?php echo $usuario['usuario_Usu']?>','<?php echo $usuario['tipo_Usu']?>');">
                                                                        </button>
                                                                        <?php  if ($tipo == 1) { ?>
                                                                            <button title="Editar" type="button" class="btn btn-success fa fa-pencil-square-o" data-toggle="modal" data-target="#modalEditarUsuario" onclick="editarUsu('<?php echo $usuario['nombre_Usu']?>','<?php echo $usuario['telefono_Usu']?>','<?php echo $usuario['correo_Usu']?>','<?php echo $usuario['direccion_Usu']?>','<?php echo $usuario['dui_Usu']?>','<?php echo $usuario['usuario_Usu']?>','<?php echo $usuario['tipo_Usu']?>','<?php echo $usuario['idUsuario']?>');"></button>
                                                                            <?php if($usuario['tipo_Usu'] == 0){ ?>
                                                                            <?php }else{ ?>
                                                                                <button title="Dar de baja" type="button" class="btn btn-danger fa fa-arrow-circle-down" onclick="bajaUsu(<?php echo $usuario['idUsuario'] ?>)"></button>
                                                                            <?php }?>
                                                                        <?php  }else{ ?>
                                                                            <button title="Dar de alta" type="button" class="btn fa fa-arrow-circle-up" style="color:#fff; background-color:#28a745" onclick="altaUsu(<?php echo $usuario['idUsuario'] ?>)"></button>
                                                                        <?php } ?>
                                                                    </th>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("generalidades/cierre.php"); ?>
    </div>

    <!-- MODAL EDITAR USUARIOS ADMINISTRADOR -->
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff;color:black;">
                <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-user"></i> Editar usuario</h3>
            </div>
            <div class="modal-body">
                <form action="../Controlador/usuarioC.php" method="POST" id="editarUsu" align="center" autocomplete="off">
                    <h3 align="center"><b>Datos Generales</b></h3>
                    <hr width="75%" style="background-color:#007bff;"/>
                    <input type="hidden" value="EditarUsu" name="bandera"></input>
                    <input type="hidden" value="" name="idusuario" id="idusuario"></input>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="nombre" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Nombre:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" id="nombreUsuEditar" name="Nombre_Usu" style="width:400px;height:40px" aria-required="true" value=""  onkeypress="return validarNombreCompletoUsuario(this,event,this.value)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="tel3" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Teléfono:</label>
                        <div  class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" id="telefonoUsuEditar" data-mask="9999-9999" name="Telefono_Usu" style="width:150px;height:40px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="nombre" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Correo:</label>
                        <div class="col-sm-12 col-md-3">
                            <input class="form-control" type="email" id="correoUsuEditar" name="Correo_Usu" style="width:400px;height:40px" value="" onkeyup="validarCorreoEditar(this)"><a id='mensajitoCorreo'></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="direccion" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Dirección:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" name="Direccion_Usu" style="width:400px;height:40px" id="direccionUsuEditar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">DUI:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" data-mask="99999999-9" id="duiUsuEditar" name="DUI_Usu" style="width:150px;height:40px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="usuario" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Usuario:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" id="nombreusuUsuEditar" name="NombreUsu_Usu" style="width:400px;height:40px" readonly="readonly"aria-required="true" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="usuario" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Tipo de Usuario:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" id="tipoUsuEditar" name="Tipo_Usu" style="width:400px;height:40px" readonly="readonly" aria-required="true" value="">
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" style="background-color:#007bff;color:black;font-size:15px;" onclick="validareditarUsuario();">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#007bff;color:black;font-size:15px;">Cerrar</button>
            </div>
        </div>
    </div>

        <form method="POST" id="cambioUsu">
          <input type="hidden" name="id" id="idUsu"  />
          <input type="hidden" name="bandera" id="banderaUsu" />
          <input type="hidden" name="valor" id="valorUsu" />
        </form>
    </div>

    <script src="../assets/Validaciones/validarUsuario.js"></script>
    <script src="../assets/Validaciones/validarDUI.js"></script>
    <script src="../assets/Validaciones/validarTelefono.js"></script>
    <script src="../assets/Validaciones/validarContrasena.js"></script>
    <script src="../assets/Validaciones/validarNombreUsuario.js"></script>
    <script src="../assets/Validaciones/validarNombreCompletoUsuario.js"></script>
    <script src="../assets/Validaciones/validarCorreo.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

    <!-- Dar de Baja Dar de Alta -->
    <script type="text/javascript">
        function bajaUsu(id){
            swal({
                title: '¿Está seguro en dar de baja?',
              // text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
            }).then((result) => {
                if(result.value){
                    $('#idUsu').val(id);
                    $('#banderaUsu').val('cambio');
                    $('#valorUsu').val('0');
                    var dominio = window.location.host;
                    $('#cambioUsu').attr('action','http://'+dominio+'/SISAUTO1/Controlador/usuarioC.php');
                    $('#cambioUsu').submit();
                }else{

                }

            })
        }

        function altaUsu(id){
            swal({
                title: '¿Está seguro en dar de alta?',
              // text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No',

          }).then((result) => {
            if(result.value){
            $('#idUsu').val(id);
            $('#banderaUsu').val('cambio');
            $('#valorUsu').val('1');
            var dominio = window.location.host;
             $('#cambioUsu').attr('action','http://'+dominio+'/SISAUTO1/Controlador/usuarioC.php');
             $('#cambioUsu').submit();
             }else{

                }
        })
        }
    </script>
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
