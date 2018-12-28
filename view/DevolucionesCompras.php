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
                            <a href="Compras.php" style="font-size:15px;color:blue;">Compras</a>
                        </li>
                        <li>
                            <a style="font-size:15px;">Devolución de compra</a>
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
                                        <form class="form-horizontal" action="../Controlador/comprasC.php" method="POST" id="guardarDev" align="center" autocomplete="off">
                                            <input type="hidden" name="bandera" value="devolucion" />
                                            <h2><b>Devoluciones <?php $var=$_GET['idcompra'] ?></b></h2>
                                            <div class="form-group">
                                            </div>
                                            <?php 
                                            $sql = "SELECT  detallecompra.*,producto.nombre_Prod FROM detallecompra left OUTER JOIN producto on detallecompra.id_Producto=producto.idProducto where detallecompra.id_Compra='$var'";
                                            $compras = mysqli_query($conexion, $sql) or die("No se pudo ejecutar la consulta");
                                            ?>
                                            <div class="form-group">
                                                <label for="empresa" class="col-sm-3 control-label">Justificar:</label>
                                                <div class="col-sm-6">
                                                   <textarea class="form-control" type="text" name="justificacion"  placeholder="" id="justificar" ></textarea>
                                               </div>
                                           </div>
                                           <div class="card mb-3">
                                            <br>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:300px">Nombre producto</th>
                                                                <th style="width:10px">Cantidad disponible</th>
                                                                <th style="width:10px">Cantidad a devolver</th> 
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                             <?php While($compra = mysqli_fetch_assoc($compras)){?>
                                                             <tr>
                                                                <td>
                                                                    <?php echo $compra['nombre_Prod'];?>
                                                                </td>   
                                                                <td>
                                                                    <?php 
                                                                    $idProducto= $compra['id_Producto'];
                                                                    $sql1 = "SELECT * FROM inventario WHERE id_Producto = '$idProducto' order by idInventario desc";
                                                                    $inventario = mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());
                                                                $inventario = mysqli_fetch_array($inventario);//CAPTURA EL ULTIMO REGISTRO
                                                                $resta = $inventario['nuevaExistencia_Inv'];

                                                                $sql2 = " SELECT * from detallecompra where id_Producto = '$idProducto' order by idDetalleCompra desc";
                                                                $resultados = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());
                                                                
                                                                foreach ($resultados as $resultado) {
                                                                    if($resta > $resultado["cantidad_DCom"]){
                                                                        $resta = $resta - $resultado["cantidad_DCom"];
                                                                    }else{

                                                                        $stop = $resultado["idDetalleCompra"];
                                                                        $devolver = $compra["idDetalleCompra"];                        

                                                                        if($devolver < $stop){
                                                                            $disponible = 0;
                                                                        }else if($devolver == $stop){
                                                                            $disponible = $resta;
                                                                        }else{
                                                                            $disponible = $compra["cantidad_DCom"];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <?php echo $disponible;?>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="id_detallecompra[]" value="<?php echo $compra['idDetalleCompra'] ?>">
                                                                <input class="form-control" type="number" id="devolucion<?php echo $devolver?>" name="devolucion[]"  aria-required="true" value="">
                                                            </td>

                                                        </tr>
                                                        <?php } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer small text-muted"></div>
                                </div>
                                <hr width="75%">
                                <div class="form-group" align="center">
                                    <button title="Aceptar" type="button" class="btn" style="color:#fff; background-color:#28a745" onclick="validarDevolucion();">Aceptar</button>
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
    <script src="../assets/Validaciones/validarDevolucion.js"></script>
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
