<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html>
<?php include("generalidades/apertura.php"); ?>
<?php $cate = array(1 => "AMORTIGUADORES", 2 => "BUJÍAS", 3 => "COMBUSTIBLE",
4 => "ELÉCTRICO", 5 => "ENFRIAMIENTO", 6 => "FILTROS", 7 => "FRENOS", 8 => "MOTOR", 9 => "SENSORES", 10 => "SUSPENSIÓN Y DIRECCIÓN", 11 => "TRANSMISIÓN Y EMBRAGUE", 12 => "UNIVERSALES"); ?>
<!--  -->
<body>
<div id="wrapper">
    <?php include("generalidades/menu.php"); ?>
    <?php include("funciones.php"); ?>

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
      <li>
        <a href="index.php" style="font-size:15px;color:blue;">Inicio</a>
      </li>
      <li>
        <a style="font-size:15px;">Productos</a>
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
$sql = "SELECT * from producto where tipo_Prod='$tipo' order by idProducto ASC";
$productos= mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
?>
<div class="row">
  <div class="col-12">
  <div class="row" style="padding:20px">
    <br>
    <a class="pull-right" >
      <button class="btn btn-success" data-toggle="modal" data-target="#modalReporteProducto" style="font-size:16px;">
        Reporte
        <span class="fa fa-file-pdf-o"></span>
      </button>
      &nbsp;
    </a>
    <a class="pull-right" href="AgregarProd.php">
      <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
        Agregar nuevo
        <span class="fa fa-plus"></span>
      </button>
      &nbsp;
    </a>
    <?php  if ($tipo == 1) { ?>
    <a class="pull-right" href="/SISAUTO1/view/Producto.php?tipo=0">
      <button class="btn btn-success" style="font-size:16px;">
        Ver productos inactivos  <i class="fa fa-bars"></i>
      </button>
      &nbsp;
    </a>
    <?php  }else{ ?>
    <a class="pull-right" href="/SISAUTO1/view/Producto.php?tipo=1">
      <button class="btn btn-success" style="font-size:16px;">
        Ver productos activos <i class="fa fa-bars"></i>
      </button>
      &nbsp;
    </a>
  </div>
    <?php } ?>
<div class="row">
  <div class="col-lg-12">
    <div class="wrapper wrapper-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
            <div class="ibox-content">
              <form class="form-horizontal" action="../Controlador/productoC.php" method="POST" id="guardarProd" autocomplete="off">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered display" id="example">
                    <thead>
                      <tr>
                        <th style="width:30px">Código</th>
                        <th style="width:120px">Nombre</th>
                        <th style="width:130px">Categoría</th>
                        <th style="width:100px">Marca</th>
                        <?php if( $_SESSION['usuarioActivo']['tipo_Usu'] == 0 ){?>
                        <th align="center" style="width:2px">Acciones</th>
                      <?php  }else{ ?>
                        <th align="center" style="width:2px">Acción</th>
                      <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php While ($producto = mysqli_fetch_assoc($productos)) { ?>
                      <tr>
                        <td><?php echo $producto['codigo_Prod'] ?></td>
                        <td><?php echo $producto['nombre_Prod'] ?></td>
                        <td><?php echo $cate[$producto['categoria_Prod']] ?></td>
                        <td><?php echo $producto['marca_Prod'] ?></td>

                        <th align="center">
                          <!-- ____________________________________________________ -->
                            <?php
                              $cuenta = contarProductoInventario($producto['idProducto'] );
                            ?>
                          <!-- ____________________________________________________ -->
                          <button title="Ver"type="button" class="btn btn-info fa fa-eye" data-toggle="modal" data-target="#modalVerProducto" href="" onclick="mostrarProduc('<?php echo $producto['codigo_Prod'] ?>', '<?php echo $producto['nombre_Prod'] ?>', '<?php echo $producto['categoria_Prod'] ?>',
                            '<?php echo $producto['marca_Prod'] ?>', '<?php echo $producto['modeloVehiculo_Prod'] ?>', '<?php echo $producto['anioVehiculo_Prod'] ?>', '<?php echo $producto['descripcion_Prod'] ?>', '<?php echo $producto['stock_Prod'] ?>', '<?php echo $producto['precio_Prod'] ?>');"></button>
                            <?php if( $_SESSION['usuarioActivo']['tipo_Usu'] == 0 ){?>
                          <?php  if ($tipo == 1) {
                            ?>
                            <button title="Editar" type="button" class="btn btn-success fa fa-pencil-square-o" data-toggle="modal" data-target="#modalEditarProducto" onclick="editarProduc('<?php echo $producto['codigo_Prod'] ?>', '<?php echo $producto['nombre_Prod'] ?>',
                               '<?php echo $producto['categoria_Prod'] ?>', '<?php echo $producto['marca_Prod'] ?>', '<?php echo $producto['modeloVehiculo_Prod'] ?>', '<?php echo $producto['anioVehiculo_Prod'] ?>', '<?php echo $producto['descripcion_Prod'] ?>', '<?php echo $producto['idProducto'] ?>', '<?php echo $producto['stock_Prod'] ?>', '<?php echo $producto['precio_Prod'] ?>');"></button>
                            <?php  }else{ }?>
                            <?php  if ($tipo == 1) {
                              if($cuenta == 0){
                              ?>
                              <button title="Dar de baja" type="button" class="btn btn-danger fa fa-arrow-circle-down" onclick="baja(<?php echo $producto['idProducto'] ?>)"></button>
                              <?php  
                              }else{}
                              }else{ ?>
                              <button title="Dar de alta" type="button" class="btn fa fa-arrow-circle-up" style="color:#fff; background-color:#28a745" onclick="alta(<?php echo $producto['idProducto'] ?>)" ></button>
                              <?php } ?>
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
    <!-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->
  </div>
</div>
<!--  -->
     <?php include("generalidades/cierre.php"); ?>
     </div>

     <!-- MODAL VER PRODUCTO -->

          <div class="modal fade" id="modalVerProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header" style="background-color:#007bff;color:black;">

                     <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-tag"></i> Producto</h3>
                 </div>
                 <div class="modal-body">
                         <hr width="75%" style="background-color:#007bff;"/>
                         <div class="form-group ">
                             <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Código: </label>
                             <div class="col-sm-7">
                                 <input class="form-control" type="text" id="codigoP" name="codigoP" readonly="readonly" aria-required="true" value="">
                             </div>
                         </div>
                         <br><br><br>
                         <div class="form-group">
                             <label align="right" for="tel3" class="col-sm-4 control-label" style="font-size:15px;">Nombre producto:</label>
                             <div  class="col-sm-7">
                                 <input class="form-control" type="text" id="nombreP" name="nombreP" readonly="readonly">
                             </div>
                         </div>
                         <br><br>
                         <div class="form-group">
                             <label align="right" for="cateP" class="col-sm-4 control-label" style="font-size:15px;">Categoria:</label>
                             <div class="col-sm-5">
                                 <input class="form-control" type="text" id="cateP" name="cateP" value="" readonly="readonly">
                             </div>
                         </div>
                         <br><br>
                         <div class="form-group">
                             <label align="right" for="direccion" class="col-sm-4 control-label" style="font-size:15px;">Marca de producto:</label>
                             <div class="col-sm-7">
                                 <input class="form-control" type="text" type="text" name="marcaP"  id="marcaP" readonly="readonly">
                             </div>
                         </div>
                         <br><br>
                         <div class="form-group">
                             <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Modelo de vehículo:</label>
                             <div class="col-sm-7">
                                 <input class="form-control" type="text" id="modeloP" name="modeloP" readonly="readonly">
                             </div>
                         </div>
                         <br><br>
                         <div class="form-group">
                             <label align="right" for="usuario" class="col-sm-4 control-label" style="font-size:15px;">Año del vehículo:</label>
                             <div class="col-sm-3">
                                 <input class="form-control" type="text" id="anioP" name="anioP" readonly="readonly">
                             </div>
                         </div>
                         <div id="ocultar">
                           <br><br>
                           <div class="form-group">
                               <label align="right" for="usuario" class="col-sm-4 control-label" style="font-size:15px;">Descripción:</label>
                               <div class="col-sm-7">
                                  <textarea class="form-control" type="text" name="descripcion" id="descripcionP"  placeholder="Escriba aqui..." readonly="readonly">
                                  </textarea>
                               </div>
                           </div>
                        </div>
                        <br><br><br>

                        <div class="form-group">
                          <label align="right"  class="col-sm-4 control-label" style="font-size:15px;">Stock mínimo:</label>
                          <div class="col-sm-3">
                            <input class="form-control" type="text" id="stockP" name="stock" readonly="readonly">
                          </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                          <label align="right" class="col-sm-4 control-label" style="font-size:15px;">Precio: </label>
                          <div class="col-sm-3 input-group date">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                            <input class="form-control" type="text" id="precioP" name="precio" style="width:150px;height:40px" readonly="readonly">
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

             <!-- MODAL EDITAR PROVEEDOR -->

             <div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
               <div class="modal-dialog modal-lg" role="document">
                 <div class="modal-content">
                   <div class="modal-header" style="background-color:#007bff;color:black;">

                     <h3 class="modal-title" id="myModalLabel"> <i class="fa fa-tag"></i> Producto</h3>
                   </div>
                   <div class="modal-body">
                    <form action="../Controlador/productoC.php" method="POST" id="editarProd" align="center" autocomplete="off">
                       <input type="hidden" value="EditarProd" name="bandera"/>
                       <input type="hidden" value="" id="idProducto" name="idProducto"/>
                     <div class="form-group ">
                       <label align="right" for="nombre" class="col-sm-4 control-label" style="font-size:15px;">Código:</label>
                       <div class="col-sm-7">
                         <input class="form-control" type="text" id="codigoPE" name="codigoP"  aria-required="true" value="" readonly="readonly">
                       </div>
                     </div>
                     <br><br><br>
                     <div class="form-group">
                       <label align="right" for="nombrePro" class="col-sm-4 control-label" style="font-size:15px;">Nombre producto:</label>
                       <div  class="col-sm-7">
                         <input class="form-control" type="text" id="nombrePE" name="nombrePro">
                       </div>
                     </div>
                     <br><br>
                     <div class="form-group">
                       <label align="right" for="categorias" class="col-sm-4 control-label" style="font-size:15px;">Categoria del producto:</label>
                       <div class="col-sm-5">
                         <select name="categorias" class="form-control" id="catePE" onchange="veruniversal();">
                            <option value="">[Selecionar Categoria]</option>
                            <option value="1">AMORTIGUADORES</option>
                            <option value="2">BUJÍAS</option>
                            <option value="3">COMBUSTIBLE</option>
                            <option value="4">ELÉCTRICO</option>
                            <option value="5">ENFRIAMIENTO</option>
                            <option value="6">FILTROS</option>
                            <option value="7">FRENOS</option>
                            <option value="8">MOTOR</option>
                            <option value="8">SENSORES</option>
                            <option value="10">SUSPENSIÓN Y DIRECCIÓN</option>
                            <option value="11">TRANSMISIÓN Y EMBRAGUE</option>
                            <option value="12">UNIVERSALES</option>
                        </select>
                       </div>
                     </div>
                     <br><br>
                     <div class="form-group">
                       <label align="right" for="marca" class="col-sm-4 control-label" style="font-size:15px;">Marca de producto:</label>
                       <div class="col-sm-7">
                         <input class="form-control" type="text" name="marca" id="marcaPE" >
                       </div>
                     </div>
                     <br><br>
                     <div class="form-group">
                       <label align="right" for="modelo" class="col-sm-4 control-label" style="font-size:15px;">Modelo de vehículo:</label>
                       <div class="col-sm-7">
                         <input class="form-control" type="text" id="modeloPE" name="modelo" >
                       </div>
                     </div>
                     <br><br>
                     <div class="form-group">
                       <label align="right" for="anio" class="col-sm-4 control-label" style="font-size:15px;">Año del vehículo:</label>
                       <div class="col-sm-3">
                         <input class="form-control" type="text" id="anioPE" name="anio" onkeypress="return validarAnio(this,event,this.value)">
                       </div>
                     </div>
                       <br><br>
                       <div class="form-group">
                         <label align="right" for="descripcion" class="col-sm-4 control-label" style="font-size:15px;">Descripción:</label>
                         <div class="col-sm-7">
                          <textarea class="form-control" type="text" name="descripcion" id="descripcionPE"  placeholder="Escriba aqui porque va a modificar el nombre de la empresa " >
                          </textarea>
                        </div>
                      </div>
                      <br><br><br>
                      <div class="form-group">
                       <label align="right" class="col-sm-4 control-label" style="font-size:15px;">Stock mínimo:</label>
                       <div class="col-sm-3">
                         <input class="form-control" type="text" id="stockPE" name="stock" onkeypress="return validarEntero(this,event,this.value)">
                       </div>
                     </div>
                     <br><br>
                      <div class="form-group ">
                        <label align="right" class="col-sm-4 control-label">Precio: </label>
                        <div class="col-sm-3 input-group date">&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                            <input class="form-control" type="text" id="precioPE" name="precio" style="width:150px;height:40px">
                        </div>
                      </div>
                   </form>
                  </div>
                  <br><br>
                  <div class="modal-footer">
                   <input type="hidden" id="anterior" value=""  />
                   <button type="button" class="btn btn-default" style="background-color:#007bff;color:black;font-size:15px;"  onclick="validarProductoEditar()">Aceptar</button>
                   <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color:#007bff;color:black;font-size:15px;">Cerrar</button>
                   <input type="hidden" id="universal"value="0">
                 </div>
               </div>
             </div>
             <form method="POST" id="cambioProd">
                        <input type="hidden" name="id" id="idProd"  />
                        <input type="hidden" name="bandera" id="banderaProd" />
                        <input type="hidden" name="valor" id="valorProd" />
                    </form>
           </div>


  <!-- MODAL -->
  <div class="modal inmodal" id="modalReporteProducto" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <i class="fa fa-check-square-o modal-icon"></i>
                <h4 class="modal-title">Seleccione</h4>
                <small>...</small>
            </div>
            <div class="modal-body">

              <div class="i-checks">
                <label><input type="radio" checked="" value="option1" name="a"> <i></i> Ambos</label>
              </div>
              <br>
              <div class="i-checks">
                <label><input type="radio" value="option1" name="a"> <i></i> Categoria </label>
              </div>
              <div class="form-group row">
                <div class="col-sm-2">
                  <select id="categoriaPro" name="categorias" style="width:400px;height:40px" class="form-control" onchange="filtrarModelos(this.value);">
                    <option value="">[Selecionar categoría]</option>
                    <option value="1">AMORTIGUADORES</option>
                    <option value="2">BUJÍAS</option>
                    <option value="3">COMBUSTIBLE</option>
                    <option value="4">ELÉCTRICO</option>
                    <option value="5">ENFRIAMIENTO</option>
                    <option value="6">FILTROS</option>
                    <option value="7">FRENOS</option>
                    <option value="8">MOTOR</option>
                    <option value="8">SENSORES</option>
                    <option value="10">SUSPENSIÓN Y DIRECCIÓN</option>
                    <option value="11">TRANSMISIÓN Y EMBRAGUE</option>
                    <option value="12">UNIVERSALES</option>
                </select>
                </div>
              </div>
              <br>
              <div class="i-checks">
                <label><input type="radio" value="option2" name="a"> <i></i> Modelo de vehiculo </label>
              </div>
              <div class="col-sm-2 input-group">
                <select id="modeloFiltrado" name="modelos" style="width:500px;height:40px" class="form-control"> 
                  <option value="">[Selecionar modelo y año]</option>
                  <option value=""></option>
                </select>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
              &nbsp;&nbsp;
              <a class="pull-right" href="Reportes/ReporteProductosCat.php">
                <button type="button" class="btn btn-success" style="font-size:14px;">
                  Generar reporte
                  <span class="fa fa-file-pdf-o"></span>
                </button>
                &nbsp;
              </a>
            </div>
        </div>
    </div>
  </div>
<!---------------------------------------------------------------------------------------->


     <!-- _______________________________________________________________ -->
    <script src="../assets/Validaciones/validarEntero.js"></script>
    <script src="../assets/Validaciones/mostrarProducto.js"></script>
    <script src="../assets/Validaciones/validarProducto.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <script type="text/javascript">
         function baja(id) {
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
                 if (result.value) {
                     $('#idProd').val(id);
                     $('#banderaProd').val('cambio');
                     $('#valorProd').val('0');
                     var dominio = window.location.host;
                     $('#cambioProd').attr('action', 'http://' + dominio + '/SISAUTO1/Controlador/productoC.php');
                     $('#cambioProd').submit();
                 } else {

                 }
             })
         }

         function alta(id) {
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
                 if (result.value) {
                     $('#idProd').val(id);
                     $('#banderaProd').val('cambio');
                     $('#valorProd').val('1');
                     var dominio = window.location.host;
                     $('#cambioProd').attr('action', 'http://' + dominio + '/SISAUTO1/Controlador/productoC.php');
                     $('#cambioProd').submit();
                 } else {

                 }
             })
         }
     </script>

            <script type="text/javascript">
                function veruniversal() {
                    if ($('#catePE').find('option:selected').text() == "UNIVERSALES") {
                        $('#universal').val(1);
    //                                        $("#marcaPr").attr("disabled", "disabled");
                        $("#modeloPE").val("");
                        $("#anioPE").val("");
                        $("#modeloPE").attr("disabled", "disabled");
                        $("#anioPE").attr("disabled", "disabled");
                    } else {
                        $('#universal').val(0);
    //                                        $("#marcaPr").removeAttr("disabled");
                        $("#modeloPE").removeAttr("disabled");
                        $("#anioPE").removeAttr("disabled");
                    }
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
