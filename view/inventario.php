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
              <a style="font-size:15px;">Inventario</a>
            </li>
          </ol>
        </div>

        <div class="col-lg-2">
        </div>
      </div>
      <?php

      $sql="SELECT * from inventario GROUP BY id_Producto";
      $inventarios = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta"); ?>
      
      <div class="row">
        <div class="col-12">
          <div class="row" style="padding:20px">
            <br>

            <a class="pull-right" href="Reportes/ReporteInventario.php">
          <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
            Reporte
            <span class="fa fa-file-pdf-o"></span>
          </button>
          &nbsp;
        </a>
            <a class="pull-right" href="">
            <a class="pull-right" href="Compras.php">
              <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
                Ver compras 
                <span class="fa fa-eye"></span>
              </button>
              <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
                Ver ventas 
                <span class="fa fa-eye"></span>
              </button>
              &nbsp;
            </a>

          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="wrapper wrapper-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                      <div class="ibox-content">
                        <form class="form-horizontal" action=" " method="POST"  autocomplete="off">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered display" id="example">
                              <thead>
                                <div class="col-sm-3 input-group">
                                <!-- <label align="right" for="categorias" class="col-sm-4 control-label" style="font-size:15px;">Categoria del Producto:</label>
                                 <div class="col-sm-3">
                                   <select name="categorias" style="width:600px;height:40px" class="form-control" id="" onchange="veruniversal();">
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
                                <br><br><br>     -->                                          
                                &nbsp;
                                <tr>
                                 <th style="width:70px" >Código Producto</th>
                                 <th style="width:125px" >Nombre</th>
                                 <th style="width:20px" >Existencias</th>
                                 <th style="width:35px" >Acción</th>
                               </tr>
                             </thead>
                             <tbody>

                              <?php While($inventario = mysqli_fetch_assoc($inventarios)){?>
                              <tr>
                                <td align="center">
                                  <?php
                                  $aux1 = $inventario['id_Producto']; 
                                  $sql1 = "SELECT codigo_Prod FROM producto where idProducto = '$aux1'";
                                  $producto = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
                                  $producto = mysqli_fetch_array($producto);
                                  echo $producto['codigo_Prod'];
                                  ?>
                                </td>
                                <td>
                                  <?php
                                  $aux = $inventario['id_Producto']; 
                                  $sql1 = "SELECT * FROM producto where idProducto = '$aux'";
                                  $producto = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
                                  $producto = mysqli_fetch_array($producto);
                                  echo $producto['nombre_Prod'].' -'.$producto['marca_Prod'].' -'.$producto['modeloVehiculo_Prod'].' -'.$producto['anioVehiculo_Prod'].' -'.$producto['descripcion_Prod'];
                                  ?>
                                </td>
                                <td align="center">
                                  <?php 
                                  $sql2 = "SELECT nuevaExistencia_Inv FROM inventario WHERE id_Producto = '$aux1' order by idInventario desc";
                                  $resultadooS = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());
                                  $resultadoo = mysqli_fetch_array($resultadooS);//CAPTURA EL ULTIMO REGISTRO
                                  $cant = $resultadoo['nuevaExistencia_Inv'];
                                  echo $cant ?>
                                </td>
                                <th align="center">
                                <button title="Ver" type="button" class="btn btn-info fa fa-eye" data-toggle="modal" data-target="" ></button>
                                               
                             <?php } ?>




                                </tbody>
                              </table>
                            </div>
                          </form>


          <?php include("generalidades/cierre.php"); ?>
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
