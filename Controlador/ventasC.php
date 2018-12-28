<?php

session_start();
include("../confi/Conexion.php");
$conexion = conectarMysql();

//-------------------------------------------------------   VER COSTO Y EXISTENCIAS DEL PRODUCTO EN LA VENTA
	if(isset($_GET["existencias"])){
		$id = $_GET["id"];
		$exis = '';
		$sql1 = "SELECT nuevaExistencia_Inv from inventario where id_Producto = '$id' order by idInventario desc";
		$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
		$producto = mysqli_fetch_array($productos);//CAPTURA EL ULTIMO REGISTRO
		$exis = $exis.''.$producto['nuevaExistencia_Inv'];
		echo $exis;
	}
	
	if(isset($_GET["costo"])){
		$id = $_GET["id"];
		$costo = '';
		$sql1 = "SELECT nuevoPrecio_Inv from inventario where id_Producto = '$id' order by idInventario desc";
		$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
		$producto = mysqli_fetch_array($productos);//CAPTURA EL ULTIMO REGISTRO
		$costo = $costo.''.$producto['nuevoPrecio_Inv'];
		echo $costo;
	}

	if(isset($_GET["precio"])){
		$id = $_GET["id"];
		$pre = '';
		$sql1 = "SELECT * from producto where idProducto = '$id' ";
		$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
		$producto = mysqli_fetch_array($productos);//CAPTURA EL ULTIMO REGISTRO
		$pre = $pre.''.$producto['precio_Prod'];
		echo $pre;
	}
//-------------------------------------------------------------
//
//
if(isset($_POST["bandera"])){
	$bandera = $_POST["bandera"];
	if($bandera == "GuardarVen"){

		$fechaCom = $_POST["fecha_Com"];
		$fechaCom = explode("/",$fechaCom);
		$fechaCom = $fechaCom[2].'-'.$fechaCom[1].'-'.$fechaCom[0];

		$numFacCom = $_POST["numFac_Com"];
		$totalCom = $_POST["total"];
		$idProvCom = $_POST["id_Proveedor"];
		$cantidadProdCom = $_POST["cantidad_DCom"];
		$precioProdCom = $_POST["precio_DCom"];
		$precioProdVen = $_POST["precio_DVen"];
		$idProdCom = $_POST["id_Producto"];
		print_r($idProdCom);
		echo("---------------------------");
		$sql = "INSERT INTO compra (numFac_Com,fecha_Com,total_Com,id_Proveedor) VALUES ('$numFacCom','$fechaCom','$totalCom','$idProvCom')";
		mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());
		$sql1 = "SELECT * FROM compra order by idCompra desc";
		$resultado = mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());
		$resultado =  mysqli_fetch_array($resultado);
		$id = $resultado['idCompra'];
		foreach ($cantidadProdCom as $key => $producto) {
			
			$sql1 = "INSERT INTO detallecompra (cantidad_DCom,precio_DCom,id_Compra,id_Producto) VALUES ('$cantidadProdCom[$key]','$precioProdCom[$key]','$id','$idProdCom[$key]')";
			mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());

		
			$sql2 = "SELECT * FROM inventario WHERE id_Producto = '$idProdCom[$key]' order by idInventario desc";
			$resultadooS = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());
			$resultadoo = mysqli_fetch_array($resultadooS);//CAPTURA EL ULTIMO REGISTRO
			$idD = $resultadoo['idInventario'];


			if($idD == ""){
				$sql3 = "INSERT INTO inventario (tipoMovimiento_Inv,existencias_Inv,precioActual_Inv,cantidad_Inv,precio_Inv,fechaMovimiento_Inv,nuevaExistencia_Inv,nuevoPrecio_Inv,id_Producto) VALUES (0,0,0.0,'$cantidadProdCom[$key]','$precioProdCom[$key]','$fechaCom','$cantidadProdCom[$key]','$precioProdCom[$key]','$idProdCom[$key]')";
				mysqli_query($conexion,$sql3) or die ("Error a Conectar en la BD".mysqli_connect_error());

				
				
			}else{

				$existencias = $resultadoo['nuevaExistencia_Inv'];
				$precioActual = $resultadoo['nuevoPrecio_Inv'];
				$nuevaExistencia = $resultadoo['nuevaExistencia_Inv'] + $cantidadProdCom[$key];
				$nuevoPrecio = (($existencias*$precioActual) + ($cantidadProdCom[$key]*$precioProdCom[$key]))/$nuevaExistencia;
				$nuevoPrecio = $nuevoPrecio.toFixed(2);

				$sql3 = "INSERT INTO inventario (tipoMovimiento_Inv,existencias_Inv,precioActual_Inv,cantidad_Inv,precio_Inv,fechaMovimiento_Inv,nuevaExistencia_Inv,nuevoPrecio_Inv,id_Producto) VALUES (0,'$existencias','$precioActual','$cantidadProdCom[$key]','$precioProdCom[$key]','$fechaCom','$nuevaExistencia','$nuevoPrecio','$idProdCom[$key]')";
				mysqli_query($conexion,$sql3) or die ("Error a Conectar en la BD".mysqli_connect_error());

				
			}


		
		}
		//////////CAPTURA DATOS PARA BITACORA
		$usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
		$sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Guardo una compra')";
		mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
		///////////////////////////////////////////////

		$_SESSION['mensaje'] = "Registro guardado exitosamente";
		header("location: /SISAUTO1/view/Compras.php?");
	}
	


}
?>