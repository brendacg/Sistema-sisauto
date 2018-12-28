<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html>
<?php include("generalidades/apertura.php"); ?>
<body>
	<div id="wrapper">
		<?php include("generalidades/menu.php"); ?>
		<!-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-10">
				<h2></h2>
				<ol class="breadcrumb">
					<li>
						<a href="index.php" style="font-size:15px;color:blue;">Inicio</a>
					</li>
					<li>
						<a style="font-size:15px;">Clientes</a>
					</li>
				</ol>
			</div>
			<div class="col-lg-2">
			</div>
		</div>
		<?php if (!isset($_GET['tipo'])) {
			$tipo=1;
		}else{
			$tipo = $_GET['tipo'];
		}?>
		 <?php
            $sql="SELECT * from cliente where tipo_Cli='$tipo' order by nombre_Cli ASC";
            $clientes= mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta"); ?>
		<div class="row">
			<div class="col-12">
			<div class="row" style="padding:20px">
				<br>
				<a class="pull-right" target="_blank" href="Reportes/ReporteClienteUnico.php">
					<button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
						Reporte
						<span class="fa fa-file-pdf-o"></span>
					</button>
          &nbsp;
				</a>
				<a class="pull-right" href="AgregarCli.php">
					<button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
						Agregar nuevo
						<span class="fa fa-plus"></span>
					</button>
          &nbsp;
				</a>
				<?php  if ($tipo == 1) { ?>
				<a class="pull-right" href="/SISAUTO1/view/Cliente.php?tipo=0">
					<button class="btn btn-success" style="font-size:16px;">
						Ver clientes inactivos  <i class="fa fa-bars"></i>
					</button>
          &nbsp;
				</a>
				<?php  }else{ ?>
				<a class="pull-right" href="/SISAUTO1/view/Cliente.php?tipo=1">
					<button class="btn btn-success" style="font-size:16px;">
						Ver clientes activos <i class="fa fa-bars"></i>
					</button>
          &nbsp;
				</a>
        <?php } ?>
			</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="wrapper wrapper-content">
							<div class="row">
								<div class="col-lg-12">
									<div class="ibox float-e-margins">
										<div class="ibox-content">
											<form class="form-horizontal" action="../Controlador/clienteC.php" method="POST" id="guardarCli" autocomplete="off">
												<div class="table-responsive">
													<table class="table table-striped table-bordered display" id="example">
														<thead>
															 <tr>
                                   <th style="width:175px">Nombre</th>
                                   <!-- <th style="width:175px">Dirección</th> -->
                                   <th style="width:85px">Teléfono</th>
                                   <th style="width:85px">NCR</th>
                                   <th style="width:85px">NIT</th>
                                   <?php if( $_SESSION['usuarioActivo']['tipo_Usu'] == 0 ){?>
                                     <th align="center" style="width:2px">Acciones</th>
                                   <?php  }else{ ?>
                                     <th align="center" style="width:2px">Acción</th>
                                   <?php } ?>
                                </tr>
														</thead>
														<tbody>
															<?php While($cliente=mysqli_fetch_assoc($clientes)){?>
                                        <tr>
                                            <td><?php echo $cliente['nombre_Cli'] ?></td>
                                            <td><?php echo $cliente['telefono_Cli'] ?></td>
                                            <td><?php echo $cliente['nrc_Cli'] ?></td>
                                            <td><?php echo $cliente['nit_Cli'] ?></td>

                                            <th align="center">
                                                <button title="Ver" type="button" class="btn btn-info fa fa-eye" data-toggle="modal" data-target="#modalVerCliente" href="" onclick="mostrarCli('<?php echo $cliente['nombre_Cli']?>','<?php echo $cliente['direccion_Cli']?>','<?php echo $cliente['telefono_Cli']?>','<?php echo $cliente['nrc_Cli']?>','<?php echo $cliente['nit_Cli']?>','<?php echo $cliente['descripcion_Cli']?>');"></button>
                                               <?php if( $_SESSION['usuarioActivo']['tipo_Usu'] == 0 ){?>
                                               <?php  if ($tipo == 1) {
                                                ?>
                                                <button title="Editar" type="button" class="btn btn-success fa fa-pencil-square-o" data-toggle="modal" data-target="#modalEditarCliente" onclick="editarCli('<?php echo $cliente['nombre_Cli']?>','<?php echo $cliente['direccion_Cli']?>','<?php echo $cliente['telefono_Cli']?>','<?php echo $cliente['nrc_Cli']?>','<?php echo $cliente['nit_Cli']?>','<?php echo $cliente['idCliente']?>','<?php echo $cliente['descripcion_Cli']?>');"></button>
                                                 <?php  }else{ }?>
                                                <?php  if($tipo == 1) { ?>
                                                <button title="Dar de baja" type="button" class="btn btn-danger fa fa-arrow-circle-down" onclick="baja(<?php echo $cliente['idCliente'] ?>)"></button>
                                                <?php  }else{ ?>
                                                <button title="Dar de alta" type="button" class="btn fa fa-arrow-circle-up" style="color:#fff; background-color:#28a745" onclick="alta(<?php echo $cliente['idCliente'] ?>)"></button>
                                                <?php } ?>
                                                <?php  }else{ if($tipo == 0){?>
                                                  <button title="Dar de alta" type="button" class="btn fa fa-arrow-circle-up" style="color:#fff; background-color:#28a745" onclick="alta(<?php echo $cliente['idCliente'] ?>)"></button>
                                                <?php } }?>
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
						<!-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->
					</div>
					<?php include("generalidades/cierre.php"); ?>
              <script src="../assets/Validaciones/mostrarCliente.js"></script>
              <script src="../assets/Validaciones/validarCliente.js"></script>
				</div>
			</div>

		<!-- MODAL VER CLIENTE -->

         <div class="modal fade" id="modalVerCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#007bff;color:black;">

                    <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-user"></i> Cliente</h3>
                </div>
                <div class="modal-body">
                 <h2 align="center"><b>Datos Generales</b></h2>
                        <hr width="75%" style="background-color:#007bff;"/>
                        <div class="form-group ">
                            <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Nombre:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="nombre" name="NombreC" readonly="readonly" aria-required="true" value="">
                            </div>
                        </div>
                        <br><br><br><br>
                        <div class="form-group">
                            <label align="right" for="direccion" class="col-sm-4 control-label" style="font-size:15px;">Dirección:</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="direccion" name="DireccionC" readonly="readonly" aria-required="true" value="">
                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Teléfono:</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" id="telefono" name="TelefonoC" value="" disabled="true">
                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <label align="right" for="nrc" class="col-sm-4 control-label" style="font-size:15px;">NRC:</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" id="nrc" name="NRC" disabled="true">
                            </div>
                        </div>
                         <br><br><br>
                        <div class="form-group">
                            <label align="right" for="nrc" class="col-sm-4 control-label" style="font-size:15px;">NIT:</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" id="nit" name="NIT" disabled="true">
                            </div>
                        </div>

                        <div id="ocultar">
                        <br><br><br>
                        <div class="form-group">
                            <label align="right" for="usuario" class="col-sm-4 control-label" style="font-size:15px;">Descripción:</label>
                            <div class="col-sm-7">
                               <textarea class="form-control" type="text" name="descripcion"  placeholder="Escriba aqui..." id="descripcionCli" disabled="true">
                               </textarea>
                            </div>
                        </div>
                       </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#007bff;color:black;font-size:15px;">Cerrar</button>
                </div>
            </div>
        </div>
            </div>

    <!-- MODAL EDITAR CLIENTE -->

            <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color:#007bff;color:black;">

                    <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-user"></i> Editar Cliente</h3>
                  </div>
                  <div class="modal-body">
                   <form action="../Controlador/clienteC.php" method="POST" id="editarCli" align="center" autocomplete="off">
                    <h2 align="center"><b>Datos Generales</b></h2>
                    <hr width="75%" style="background-color:#007bff;"/>
                      <input type="hidden" value="EditarCli" name="bandera"/>
                      <input type="hidden" value="" name="idcliente" id="idcliente"/>
                    <div class="form-group ">
                      <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Nombre:</label>
                      <div class="col-sm-7">
                        <input class="form-control" type="text" id="nombreCliEditar" name="nombreCli" aria-required="true" value="">
                      </div>
                    </div>
                    <br><br><br><br>
                    <div class="form-group ">
                      <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Dirección:</label>
                      <div class="col-sm-7">
                        <input class="form-control" type="text" id="direccionCliEditar"  name="direccionCli" aria-required="true" value="">
                      </div>
                    </div>
                    <br><br><br>
                    <div class="form-group">
                      <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Teléfono:</label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" id="telefonoCliEditar" name="telefonoCli" data-mask="9999-9999" value="" >
                      </div>
                    </div>
                    <br><br><br>
                     <div class="form-group">
                      <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">NRC:</label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="nrcCli" id="nrcCliEditar" data-mask="9999-9999" readonly="readonly"aria-required="true"  value="" >
                      </div>
                    </div>
                        <br><br><br>
                        <div class="form-group">
                      <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">NIT:</label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="nitCli" id="nitCliEditar" data-mask="9999-9999" readonly="readonly"aria-required="true" value="" >
                      </div>
                    </div>
                      <br><br><br>
                      <div class="form-group">
                        <label align="right" for="usuario" class="col-sm-4 control-label" style="font-size:15px;">Descripción:</label>
                        <div class="col-sm-7">
                         <textarea class="form-control" type="text" name="descripcion"  placeholder="Escriba aqui porque va a modificar el nombre del cliente " id="descripcionCliEditar" >
                         </textarea>
                       </div>
                     </div>
                  </form>
                 </div>
                 <br><br>
                 <div class="modal-footer">
                  <input type="hidden" id="anterior" value=""  />
                  <button type="button" class="btn btn-default" style="background-color:#007bff;color:black;font-size:15px;" onclick="validareditarCliente()">Aceptar</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#007bff;color:black;font-size:15px;">Cerrar</button>
                </div>
              </div>
            </div>

 <!--********************************************************************************************************************** -->
             <form method="POST" id="cambioCli">
               <input type="hidden" name="id" id="idCli"  />
               <input type="hidden" name="bandera" id="banderaCli" />
               <input type="hidden" name="valor" id="valorCli" />
             </form>
          </div>
            <!-- DAR DE BAJA -->
        <script type="text/javascript">
            function baja(id){
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
                $('#idCli').val(id);
                $('#banderaCli').val('cambio');
                $('#valorCli').val('0');
                var dominio = window.location.host;
                 $('#cambioCli').attr('action','http://'+dominio+'/SISAUTO1/Controlador/clienteC.php');
                 $('#cambioCli').submit();
                 }else{

                }
            })
            }
     //DAR DE ALTA
            function alta(id){
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
                $('#idCli').val(id);
                $('#banderaCli').val('cambio');
                $('#valorCli').val('1');
                var dominio = window.location.host;
                 $('#cambioCli').attr('action','http://'+dominio+'/SISAUTO1/Controlador/clienteC.php');
                 $('#cambioCli').submit();
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
<meta http-equiv="refresh" content="0;URL=/SISAUTO1/view/login.php">
</head>
<body>
</body>
</html>
    <?php
}
?>
