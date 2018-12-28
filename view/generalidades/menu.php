<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <img alt="logo" src="../assets/img/aut5.png" width="100%" height="100%" />
            <li>
                <a href="/SISAUTO1/view/NuevaVenta.php" style="font-size:15px;"><i class="fa fa-dollar"></i> <span class="nav-label">Vender</span>  </a>
            </li>
            <li>
                <a href="" style="font-size:15px;"><i class="fa fa-cart-plus"></i> <span class="nav-label">Compras/Ventas</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="Compras.php" style="font-size:15px;">Compras</a></li>
                    <li><a href="Ventas.php" style="font-size:15px;">Ventas</a></li>
                </ul>
            </li>
            <li>
                <a href="" style="font-size:15px;"><i class="fa fa-folder"></i> <span class="nav-label">Catalogo</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="Cliente.php" style="font-size:15px;"><span class="fa fa-user"> Cliente</span></a></li>
                    <li><a href="Proveedor.php" style="font-size:15px;"><span class="fa fa-group"> Proveedor</span></a></li>
                    <li><a href="Producto.php"><span class="fa fa-tags" style="font-size:15px;"> Producto</span></a></li>
                </ul>
            </li>
            <li>
                <a href="" style="font-size:15px;"><i class="fa fa-area-chart"></i> <span class="nav-label">Inventario</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="inventario.php" style="font-size:15px;"><span class="fa fa-book"> Inventario Principal</span></a></li>
                    <li><a href="" style="font-size:15px;"><span class="fa fa-book"> Kardex</span></a></li>
                
                </ul>
            </li>
            <?php if( $_SESSION['usuarioActivo']['tipo_Usu'] == 0 ){?>
            <li>
                <a href="" style="font-size:15px;"><i class="fa fa-unlock-alt"></i> <span class="nav-label">Seguridad</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="Usuarios.php" style="font-size:15px;"><span class="fa fa-group">  Control Usuarios</span></a></li>
                    <li><a href="Bitacora.php" style="font-size:15px;"><span class="fa fa-history"> Bitácora</span></a></li>
                    <li><a href="" style="font-size:15px;"><span class="fa fa-database"> Administrar Backup</span></a></li>
                    <li><a data-toggle="modal" data-target="#modalConfigFactura" style="font-size:15px;"><span class="fa fa-database"> Configuracion</span></a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>

    </div>
</nav>
<!-- Logout Modal-->
<div class="modal inmodal" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Listo para salir?</h5>
            </div>
            <div class="modal-body">
                <p>Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</p>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-success" href="../Controlador/cerrar.php">Cerrar sesión</a>
            </div>
        </div>
    </div>
</div>

<!-- el </div> esta en cierre -->
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #343A40;">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-success" href="#"><i class="fa fa-bars"></i> </a>
                <a class="navbar-brand" href="index.php" style="color: white">SISAUTO</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-success">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

                <?php include("../confi/Conexion.php");
                $conexion = conectarMysql();
                ?>

                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION['usuarioActivo']['nombre_Usu']?>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a class="dropdown-item" data-toggle="modal" data-target="#modalVerUsuario" onclick="mostrarUsu('<?php echo $_SESSION['usuarioActivo']['nombre_Usu']?>','<?php echo $_SESSION['usuarioActivo']['telefono_Usu']?>','<?php echo $_SESSION['usuarioActivo']['correo_Usu']?>','<?php echo $_SESSION['usuarioActivo']['direccion_Usu']?>','<?php echo $_SESSION['usuarioActivo']['dui_Usu']?>','<?php echo $_SESSION['usuarioActivo']['usuario_Usu']?>','<?php echo $_SESSION['usuarioActivo']['tipo_Usu']?>');">
                                <span class="text-success">
                                    <strong><h4>Perfil</h4></strong>
                                </span>
                                <div class="dropdown-message small"><h4><i class="fa fa-at"></i> <?php echo $_SESSION['usuarioActivo']['usuario_Usu'] ?></h4></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="dropdown-item" data-toggle="modal" data-target="#modalEditarUsuarioContrasena" onclick="editarUsuContrasena('<?php echo $_SESSION['usuarioActivo']['usuario_Usu']?>','<?php echo $_SESSION['usuarioActivo']['tipo_Usu']?>','<?php echo $_SESSION['usuarioActivo']['idUsuario']?>');" >
                                <span class="text-success">
                                    <strong><h4>Cambiar contraseña</h4></strong>
                                </span>
                                <div class="dropdown-message small"></div>
                            </a>
                        </li>
                    </ul>
                </li>

                &nbsp;&nbsp;
                <li>
                    <a  data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-sign-out"></i> Cerrar sesión
                    </a>
                </li>
            </ul>
        </nav>
    </div>


<!-- MODAL VER USUARIOS -->
<div class="modal fade" id="modalVerUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff;color:black;">
                <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-user"></i> Usuario</h3>
            </div>
            <div class="modal-body">
                <form action="../Controlador/usuarioC.php" method="POST" id="guardarUsu" align="center" autocomplete="off">
                    <h3 align="center"><b>Datos Generales</b></h3>
                    <hr width="100%" style="background-color:#007bff;"/>
                    <input type="hidden" value="GuardarUsu" name="bandera"></input>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="nombre" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Nombre:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" placeholder="Nombre Completo" type="text" id="nombreUsu" name="Nombre_Usu" style="width:400px;height:40px" readonly="readonly" aria-required="true" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="tel3" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Teléfono:</label>
                        <div  class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" id="telefonoUsu" placeholder="9999-9999" data-inputmask="'mask' : '9999-9999'" name="Telefono_Usu" style="width:150px;height:40px" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="nombre" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Correo:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" placeholder="Correo" type="email" id="correoUsu" name="Correo_Usu" style="width:400px;height:40px" value="" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="direccion" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Dirección:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" placeholder="Dirección" name="Direccion_Usu" style="width:400px;height:40px" id="direccionUsu" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">DUI:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" placeholder="99999999-9" id="duiUsu" name="DUI_Usu" style="width:150px;height:40px" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="usuario" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Usuario:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" placeholder="Nombre de Usuario" id="nombreusuUsu" name="NombreUsu_Usu" style="width:400px;height:40px" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="usuario" class="col-sm-12 col-md-3 col-form-label" style="font-size:15px;">Tipo de Usuario:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" placeholder="Tipo de Usuario" id="tipoUsu" name="Tipo_Usu" style="width:400px;height:40px" aria-required="true" value="" readonly="readonly">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#007bff;color:black;font-size:15px;">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR USUARIO -->

<div class="modal fade" id="modalEditarUsuarioContrasena" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#007bff;color:black;">
                <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-user"></i> Editar contraseña usuario</h3>
            </div>
            <div class="modal-body">
                <form action="../Controlador/usuarioC.php" method="POST" id="editarUsuContrasena" align="center" autocomplete="off">
                    <h3 align="center">Datos del usuario</h3>
                    <hr width="75%" style="background-color:#007bff;"/>
                    <input type="hidden" value="EditarUsuContrasena" name="bandera"/>
                    <input type="hidden" value="" name="idusuarioContrasena" id="idusuarioContrasena"/>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="usuario" class="col-sm-12 col-md-3 col-form-label">Usuario:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" id="nombreusuUsuContrasenaEditar" name="NombreUsu_Usu" style="width:200px;height:40px" readonly="readonly"aria-required="true" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="usuario" class="col-sm-12 col-md-3 col-form-label">Tipo de Usuario:</label>
                        <div class="col-sm-12 col-md-8">
                            <input class="form-control" type="text" id="tipoUsuContrasenaEditar" name="Tipo_Usu" style="width:200px;height:40px" readonly="readonly" aria-required="true" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="contrasena" class="col-sm-12 col-md-3 col-form-label">Contraseña actual:</label>
                        <div class="col-sm-12 col-md-3">
                            <input class="form-control" type="password" placeholder="******" id="contrasenaActualUsuEditar" name="Contrasena_UsuA" style="width:150px;height:40px" onkeypress="return validarContrasenaActual(this,event,this.value)">
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <a id='mensajito2'></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="contrasena" class="col-sm-12 col-md-3 col-form-label">Nueva contraseña:</label>
                        <div class="col-sm-12 col-md-3">
                            <input class="form-control" type="password" placeholder="******" id="contrasenaUsuEditar" name="Contrasena_Usu" style="width:150px;height:40px" onkeypress="return validareditarContrasena(this,event,this.value)">
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <a id='mensajito1'></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-1">
                        </div>
                        <label align="right" for="contrasena" class="col-sm-12 col-md-3 col-form-label">Vuelve a escribir la nueva contraseña:</label>
                        <div class="col-sm-12 col-md-3">
                            <input class="form-control" type="password" placeholder="******" id="contrasenaUsu2Editar" name="Contrasena_Usu2" style="width:150px;height:40px" onkeyup="return validareditarContrasena2(this,event,this.value)"</a>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <a id='mensajito'></a>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" style="background-color:#007bff;color:black;font-size:15px;" onclick="validareditarUsuarioContrasena();">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#007bff;color:black;font-size:15px;">Cerrar</button>
            </div>
        </div>
    </div>
    <form method="POST" id="cambio">
        <input type="hidden" name="id" id="id"  />
        <input type="hidden" name="bandera" id="bandera" />
        <input type="hidden" name="valor" id="valor" />
    </form>
</div>

<!-- MODAL -->
  <div class="modal inmodal" id="modalConfigFactura" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-check-square-o modal-icon"></i>
                <h4 class="modal-title"></h4>
                <small>...</small>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="../Controlador/facturaC.php" method="POST" id="guardarProd" autocomplete="off">
                    <div class="form-group">
                     <label align="right" class="col-sm-4 control-label" style="font-size:15px;">Generar numero de facturas desde:</label>
                     <div class="col-sm-3">
                         <input class="form-control" type="text" id="numF" name="numF">
                         <input type="hidden" value="factura" name="bandera">
                     </div>
                 </div> 
              <br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
              &nbsp;&nbsp;
              <a class="pull-right">
                <button type="submit" class="btn btn-success" style="font-size:14px;">
                  Aceptar
                </button>
                &nbsp;
              </a>
              </form>
            </div>
        </div>
    </div>
  </div>
<!---------------------------------------------------------------------------------------->

<script src="../assets/Validaciones/mostrarUsuario.js"></script>
<script src="../assets/Validaciones/validarContrasena.js"></script>
<script src="../assets/Validaciones/validarUsuario.js"></script>
