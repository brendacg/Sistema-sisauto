<?php
    session_start();
include("../confi/Conexion.php");
$conexion = conectarMysql();

$bandera = $_POST["bandera"];

if ($bandera == "guardar") {
    $codigo = $_POST["codigoPro"];
    $nombrePro = $_POST["nombrePro"];
    $categoria = $_POST["categorias"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $anio = $_POST["anio"];
    $descripcion = $_POST["descripcion"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $sql = "INSERT INTO producto (nombre_Prod,categoria_Prod,marca_Prod,descripcion_Prod,modeloVehiculo_Prod,anioVehiculo_Prod,codigo_Prod,tipo_Prod,stock_Prod,precio_Prod) VALUES ('$nombrePro','$categoria','$marca','$descripcion','$modelo','$anio','$codigo',1,'$stock','$precio')";

    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());
    $_SESSION['mensaje'] = "Registro guardado exitosamente";
    header("location: /SISAUTO1/view/Producto.php?");
}

if ($bandera == "EditarProd") {
    $nombrePro = $_POST["nombrePro"];
    $categoria = $_POST["categorias"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $anio = $_POST["anio"];
    $descripcion = $_POST["descripcion"];
    $idProducto = $_POST["idProducto"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $sql = "UPDATE producto set nombre_Prod='$nombrePro', categoria_Prod='$categoria',marca_Prod='$marca',modeloVehiculo_Prod='$modelo',anioVehiculo_Prod='$anio',descripcion_Prod='$descripcion',stock_Prod='$stock',precio_Prod='$precio' where idProducto = '$idProducto'";

    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());
    $_SESSION['mensaje'] ="Registro editado exitosamente";
    header("location: /SISAUTO1/view/Producto.php");
}

if ($bandera=="cambio") {

    $sql = "UPDATE producto set tipo_Prod='".$_POST["valor"]."' where idProducto = '".$_POST["id"]."'";
    $producto = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    if ($_POST["valor"]==1) {
        $aux = 0;
        $_SESSION['mensaje'] ="Producto dado de alta exitosamente";
        // $mensaje = "Proveedor dado de alta exitosamente";
    }else{
        $aux = 1;
        $_SESSION['mensaje'] ="Producto dado de baja exitosamente";
    }
    header("location: /SISAUTO1/view/Producto.php?tipo=".$aux."");
}

if ($bandera=="existe") {
    $sql="SELECT * from producto where nombre_Prod like '".$_POST["nombre"]."' AND categoria_Prod like '".$_POST["categoria"]."' AND marca_Prod like '".$_POST["marca"]."' AND modeloVehiculo_Prod like '".$_POST["modelo"]."' AND anioVehiculo_Prod like '".$_POST["anio"]."'";
    $proveedor = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    echo mysqli_num_rows($proveedor);
}

//----------------------------  AGREGAR AL COMBOBOX DE LOS MODELOS
if(isset($_GET["bandera"])){
    $id = $_GET["id"];
    $cadena='';
    $sql1 = "SELECT * from producto where categoria_Prod = '$id' and tipo_Prod = 1 order by nombre_Prod ASC";
    $productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
    While ($producto = mysqli_fetch_assoc($productos)){
        if($producto['anioVehiculo_Prod'] != 0){
            $cadena = $cadena.'<option value="'.$producto['idProducto'].'">'.$producto['modeloVehiculo_Prod'].', año: '.$producto['anioVehiculo_Prod'].'</option>';
        }
    }
    echo $cadena;
}

?>
