
<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
  if ($_SESSION['usuarioActivo']['tipo_Usu']=='0') {
?>
  <!DOCTYPE html>
  <html>
  <?php include("generalidades/apertura.php"); ?>
  <body>
  <div id="wrapper">
      <?php include("generalidades/menu.php"); ?>
  <!--  -->
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
      <h2></h2>
      <ol class="breadcrumb">
        <li>
          <a href="index.php" style="font-size:15px;color:blue;">Inicio</a>
        </li>
        <li>
          <a style="font-size:15px;">Bitácora</a>
        </li>
      </ol>
    </div>
    <div class="col-lg-2">

    </div>
  </div>

 <!--  <?php if (!isset($_GET['tipo'])) {
    $tipo = 0;
  }else{
    $tipo = $_GET['tipo'];
  }?> -->

  <?php
    $sql = "SELECT * from bitacora order by idBitacora DESC";
    $bitacoras = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
  ?>
  <div class="row">
    <div class="col-12">
    <div class="row" style="padding:20px">
      <br>
      <a class="pull-right">
        <button type="button" title="Editar" class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
          Reporte
          <span class="fa fa-file-pdf-o"></span>
        </button>
        &nbsp;
      </a>

      <!-- <a class="pull-right" href="Reportes/bitacora.php">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo" style="font-size:16px;">
          Reporte
          <span class="fa fa-file-pdf-o"></span>
        </button>
        &nbsp;
      </a> -->

      <!-- <?php  if ($tipo == 0) { ?>
       <?php  }else{ ?>
       -->
    </div>
      <!-- <?php } ?> -->
  <div class="row">
    <div class="col-lg-12">
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-content">
                <form class="form-horizontal" action="../Controlador/logear.php" method="POST" id="var" autocomplete="off">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered display" id="example">
                      <thead>
                        <tr>
                          <th style="width:30px">Fecha</th>
                          <th style="width:30px">Hora</th>
                          <th style="width:40px">Usuario</th>
                          <th style="width:150px">Actividad</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php While ($bitacora = mysqli_fetch_assoc($bitacoras)) {
                       date_default_timezone_set('America/El_Salvador');
                        ?>

                        <tr>
                          <td><?php echo date('d/m/Y',strtotime($bitacora['sesionInicio'])) ?></td>
                          <td><?php echo date('H:i:s A',strtotime($bitacora['sesionInicio'])) ?></td>
                          <td><?php echo $bitacora['usuario_Usu'] ?></td>
                          <td><?php echo $bitacora['actividad'] ?></td>
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
  <!--  -->
  </div>
  <?php include("generalidades/cierre.php"); ?>

      
  <!-- MODAL -->
  <div class="modal inmodal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Seleccione</h4>
            </div>
            <div class="modal-body">
                <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div><!---------------------------------------------------------------------------------------->

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
