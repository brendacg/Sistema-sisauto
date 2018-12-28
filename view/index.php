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
                        <a style="font-size:15px;">Inicio</a>
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
                                    <div class="row" align="" >
                                        <div class="col-12">
                                            <h1 class="card-body " align="center"><b>SISTEMA INFORMÁTICO DE CONTROL DE COMPRAS-VENTAS</b><br><b> PARA EL NEGOCIO AUTOS REPUESTOS VAQUERANO</b></h1>
                                            <br><br>
                                            <p style="text-align: center; "> <img src="../assets/img/sisa.jpg" alt="aut" width="600"></p>
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
        <!-- aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->
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