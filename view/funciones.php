<?php

function contarProducto($id){
	$conexion = conectarMysql();
	$sql="SELECT * from compra where id_Proveedor = '$id' ";
	$var= mysqli_query($conexion,$sql);
	$total = mysqli_num_rows($var);
	return $total; 
}

function contarProductoInventario($id){
	$conexion = conectarMysql();
	$sql = "SELECT * from inventario where id_Producto = '$id' ";
	$var = mysqli_query($conexion,$sql);
	$total = mysqli_num_rows($var);

	if(!($total == 0)){
		$sql2 = "SELECT nuevaExistencia_Inv FROM inventario WHERE id_Producto = '$id' order by idInventario desc";
		$resultadooS = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());
		$resultadoo = mysqli_fetch_array($resultadooS);//CAPTURA EL ULTIMO REGISTRO
		$cant = $resultadoo['nuevaExistencia_Inv'];
		if($cant == 0){
			$total = 0;
		}else{
			$total = 1;
		}
	}
	return $total; 
}

function correlativoFactura(){
	$conexion = conectarMysql();
	$sql = "SELECT * from factura ";
	$var = mysqli_query($conexion,$sql);
	$total = mysqli_num_rows($var);
	if($total == 0){

		$sql2 = "SELECT numeroInicial_numF FROM numerofactura";
		$resultadooS = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());
		$total2 = mysqli_num_rows($resultadooS);
		if($total2 == 0){
			return 0;
		}else{
			$resultadoo = mysqli_fetch_array($resultadooS);//CAPTURA EL ULTIMO REGISTRO
			return $resultadoo['numeroInicial_numF'];
		}
		
	}else{
		$result = mysqli_fetch_array($var);//CAPTURA EL ULTIMO REGISTRO
		return $result['numero_Fac'];

	}
	
}

?>