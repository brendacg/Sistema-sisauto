<?php

session_start();
include("../confi/Conexion.php");
$conexion = conectarMysql();

if(isset($_GET["bandera"])){
	$id = $_GET["id"];
	$cadena='';
	$sql1 = "SELECT * from detallecompra where id_Compra = '$id'";
	$detalles = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$cadena="";
	$acumulado=0;
	While ($detalle = mysqli_fetch_assoc($detalles)){
		$idP=$detalle['id_Producto'];
		$sql1 = "SELECT * from producto where idProducto = '$idP'";
		$producto = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
		$producto = mysqli_fetch_array($producto);
		$cadena.='<tr  id="f'.$producto['idProducto'].'">';
		$cadena=$cadena.'<td>'.$detalle['cantidad_DCom'].'</td>';
		$cadena=$cadena.'<td>'.$producto['nombre_Prod'].' '.$producto['marca_Prod'].' '.$producto['modeloVehiculo_Prod'].' '.$producto['anioVehiculo_Prod'].' '.$producto['descripcion_Prod'].'</td>';
		$cadena=$cadena.'<td>'.$detalle['precio_DCom'].'</td>';
		$subtotal = $detalle['cantidad_DCom']*$detalle['precio_DCom'];
		$cadena=$cadena.'<td>'.number_format($subtotal,2,'.','').'</td>';
		$cadena=$cadena.'<td>';
		$cadena=$cadena.'<input type="hidden" name="cantidad_DCom[]" value="'.$detalle['cantidad_DCom'].'"/>';
	    $cadena=$cadena.'<input type="hidden" name="precio_DCom[]" value="'.$detalle['precio_DCom'].'"/>';
	    $cadena=$cadena.'<input type="hidden" name="id_Producto[]" value="'.$producto['idProducto'].'"/>';
		$cadena=$cadena.'<button title="Eliminar" type="button" class="btn btn-danger fa fa-trash" onclick="eliminar('.$producto['idProducto'].','.$subtotal.');"></button></td></tr>';
		$acumulado=$acumulado+$subtotal;
	}
	$retornar= [$cadena,$acumulado];
	
	// .= ---> $cadena=$cadena.variable
	echo json_encode($retornar);
}

if(isset($_GET["bandera1"])){
	$id = $_GET["id"];
	$cadena='';
	$sql1 = "SELECT * from detallecompra where id_Compra = '$id'";
	$detalles = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$cadena="";
	While ($detalle = mysqli_fetch_assoc($detalles)){
		$idP=$detalle['id_Producto'];
		$sql1 = "SELECT * from producto where idProducto = '$idP'";
		$producto = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
		$producto = mysqli_fetch_array($producto);
		$cadena.='<tr id="f'.$producto['idProducto'].'">';
		$cadena=$cadena.'<td>'.$detalle['cantidad_DCom'].'</td>';
		$cadena=$cadena.'<td>'.$producto['nombre_Prod'].' -'.$producto['marca_Prod'].' -'.$producto['modeloVehiculo_Prod'].' -'.$producto['anioVehiculo_Prod'].' -'.$producto['descripcion_Prod'].'</td>';
		$cadena=$cadena.'<td>'.$detalle['precio_DCom'].'</td>';
		$subtotal = $detalle['cantidad_DCom']*$detalle['precio_DCom'];
		$cadena=$cadena.'<td>'.number_format($subtotal,2,'.','').'</td>';
		// $cadena=$cadena.'<td>'.$detalle['cantidad_DCom']*$detalle['precio_DCom'].'</td>';
		$cadena.='</tr>';
	}
	
	// .= ---> $cadena=$cadena.variable
	echo $cadena;


}


?>