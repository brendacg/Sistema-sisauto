<?php

session_start();
include("../confi/Conexion.php");
$conexion = conectarMysql();


if(isset($_POST["bandera"])){
	$bandera = $_POST["bandera"];
	if($bandera == "GuardarCom"){

		$fechaCom = $_POST["fecha_Com"];
		$fechaCom = explode("/",$fechaCom);
		$fechaCom = $fechaCom[2].'-'.$fechaCom[1].'-'.$fechaCom[0];

		$numFacCom = $_POST["numFac_Com"];
		$totalCom = $_POST["total"];
		$idProvCom = $_POST["id_Proveedor"];
		$cantidadProdCom = $_POST["cantidad_DCom"];
		$precioProdCom = $_POST["precio_DCom"];
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
				$nuevoPrecio = $nuevoPrecio;

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

	if($bandera == "EditarCom"){

		$fechaCom = $_POST["fecha_Com"];
		$fechaCom = explode("/",$fechaCom);
		$fechaCom = $fechaCom[2].'-'.$fechaCom[1].'-'.$fechaCom[0];
		$totalCom = $_POST["total"];
		$cantidadProdCom = $_POST["cantidad_DCom"];
		$precioProdCom = $_POST["precio_DCom"];
		$idProdCom = $_POST["id_Producto"];
		$idcompra = $_POST["idcompra"];

		$sql = "UPDATE compra set total_Com='$totalCom' where idCompra = '$idcompra'";
		mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());


		$sql1 = "SELECT * from detallecompra  where id_Compra = '$idcompra'";
		$detalles=mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());

		foreach ($detalles as $detalle) {

			$idProd = $detalle['id_Producto'];
			$cantidad = $detalle['cantidad_DCom'];
			$precio = $detalle['precio_DCom'];

			$sql2 = " SELECT * from inventario where id_Producto = '$idProd' order by idInventario desc";
			$resultado = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());

			$resultado = mysqli_fetch_array($resultado);

			$existencia = $resultado['nuevaExistencia_Inv'];
			$nuevaExistencia = $existencia-$cantidad;
			$precioActual = $resultado['nuevoPrecio_Inv'];
			$nuevoPrecio = (($existencia*$precioActual) - ($cantidad*$precio))/$nuevaExistencia;

			//Tipo de movimiento = 2 -> para modificar compra
			$sql3 = "INSERT INTO inventario (tipoMovimiento_Inv,existencias_Inv,precioActual_Inv,cantidad_Inv,precio_Inv,fechaMovimiento_Inv,nuevaExistencia_Inv,nuevoPrecio_Inv,id_Producto) VALUES (2,'$existencia','$precioActual','$cantidad','$precio','$fechaCom','$nuevaExistencia','$nuevoPrecio','$idProd')";
			mysqli_query($conexion,$sql3) or die ("Error a Conectar en la BD".mysqli_connect_error());

		}

		$sql4 = "DELETE from detallecompra where id_Compra = '$idcompra'";
		mysqli_query($conexion,$sql4) or die ("Error a Conectar en la BD".mysqli_connect_error());

		foreach ($cantidadProdCom as $key => $producto) {
			$sql5 = "INSERT INTO detallecompra (cantidad_DCom,precio_DCom,id_Compra,id_Producto) VALUES ('$cantidadProdCom[$key]','$precioProdCom[$key]','$idcompra','$idProdCom[$key]')";
			mysqli_query($conexion,$sql5) or die ("Error a Conectar en la BD".mysqli_connect_error());
		}

		
		//////////CAPTURA DATOS PARA BITACORA
		$usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
		$sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Edito una compra')";
		mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
		///////////////////////////////////////////////
		$_SESSION['mensaje'] = "Registro editado exitosamente";
		header("location: /SISAUTO1/view/Compras.php?");

		
	}

	
	if ($bandera == "eliminar") {
		
		$idCom=$_POST["id"];
		$aux = 0;
		$sql1 = "SELECT * from detallecompra  where id_Compra = '$idCom'";
		$detalles=mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());
		
		foreach ($detalles as $detalle) {
			$idProd = $detalle['id_Producto'];
			$cantidad = $detalle['cantidad_DCom'];

			$sql1 = "SELECT SUM(cantidad_DCom) as totalC from detallecompra  where id_Producto = '$idProd'";
			$totalc=mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());
			$totalc = mysqli_fetch_array($totalc);
			print_r($totalc);

			$sql1 = "SELECT SUM(cantidad_DVen) as totalV from detalleventa  where id_Producto = '$idProd'";
			$totalv=mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());
			$totalv = mysqli_fetch_array($totalv);
			print_r($totalv);
			echo $idProd;

			$resta = $totalc["totalC"] - $totalv["totalV"];

			$sql2 = " SELECT * from detallecompra where id_Producto = '$idProd' order by idDetalleCompra desc";
			$resultados = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());

			foreach ($resultados as $resultado) {
				echo "<br>".$resta; 
				echo "<br>".$resultado["cantidad_DCom"];
				if($resta >= $resultado["cantidad_DCom"]){
					$resta = $resta - $resultado["cantidad_DCom"];
				}else{

					$stop = $resultado["idDetalleCompra"];
					$eliminar = $detalle["idDetalleCompra"]; 
					echo "<br>".$stop;
					echo "<br>".$eliminar;

					if($eliminar <= $stop){
						$aux = 1;
						$_SESSION['error'] = "Lo sentimos se han vendido productos de esta compra por lo cual no se puede eliminar";
						header("location: /SISAUTO1/view/Compras.php");
					}
				}
			}

		}

		if($aux == 0){
			foreach ($detalles as $detalle) {
				$idProd = $detalle['id_Producto'];
				$cantidad = $detalle['cantidad_DCom'];
				$precio = $detalle['precio_DCom'];

				$sql2 = " SELECT * from inventario where id_Producto = '$idProd' order by idInventario desc";
				$resultado = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());

				$resultado = mysqli_fetch_array($resultado);

				$existencia = $resultado['nuevaExistencia_Inv'];
				$nuevaExistencia = $existencia-$cantidad;
				$precioActual = $resultado['nuevoPrecio_Inv'];
				$nuevoPrecio = (($existencia*$precioActual) - ($cantidad*$precio))/$nuevaExistencia;

				$sql3 = "INSERT INTO inventario (tipoMovimiento_Inv,existencias_Inv,precioActual_Inv,cantidad_Inv,precio_Inv,fechaMovimiento_Inv,nuevaExistencia_Inv,nuevoPrecio_Inv,id_Producto) VALUES (2,'$existencia','$precioActual','$cantidad','$precio','$fechaCom','$nuevaExistencia','$nuevoPrecio','$idProd')";
				mysqli_query($conexion,$sql3) or die ("Error a Conectar en la BD".mysqli_connect_error());

			}

			$sql1 = "DELETE from detallecompra where id_Compra = '$idCom'";
			mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());

			$sql1 = "DELETE from compra where idCompra = '$idCom'";
			mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());

		//////////CAPTURA DATOS PARA BITACORA
			$usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
			$sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Elimino una compra')";
			mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
		///////////////////////////////////////////////

			$_SESSION['mensaje'] = "Compra eliminada exitosamente";
			header("location: /SISAUTO1/view/Compras.php?");
		}

	}


	//-------------------------------COMPRA DUPLICADA
	if ($bandera == "unnumerofac"){
		$num = $_POST["numerofac"];
		$idprovee = $_POST["idproveedor"];
		$sql = "SELECT * from compra where numFac_Com = '$num' and id_Proveedor = '$idprovee' ";
		$compra = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
		echo mysqli_num_rows($compra);
	}

	if ($bandera =="devolucion") {
		$justificacion = $_POST["justificacion"];
		$id_DC = $_POST["id_detallecompra"];
		$devolucion = $_POST["devolucion"];
		$fecha = date("Y")."-".date("m")."-".date("d");

		$sql = "INSERT INTO devoluciones (fecha_Dev,justificacion_Dev) VALUES ('$fecha','$justificacion ')";
		$dev = mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());
		
		$sql1 = "SELECT * FROM devoluciones order by idDevoluciones desc";
		$resultado = mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());
		$resultado =  mysqli_fetch_array($resultado);
		$id = $resultado['idDevoluciones'];

		foreach ($id_DC as $key => $detallecompra) {
			if($devolucion[$key]!= "" && $devolucion[$key] != 0){
				$sql = "INSERT INTO detalledevoluciones (id_Devoluciones,id_DetalleCompra,cantidad_DDev) VALUES ('$id','$detallecompra','$devolucion[$key]')";
				$dev = mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());


				$sql1 = " SELECT * from detallecompra where idDetalleCompra = '$detallecompra'";
				$resultados = mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD".mysqli_connect_error());
				$resultados =  mysqli_fetch_array($resultados);
				$idproducto = $resultados['id_Producto'];

				$sql2 = " SELECT * from inventario where id_Producto = '$idproducto' order by idInventario desc";
				$inventario = mysqli_query($conexion,$sql2) or die ("Error a Conectar en la BD".mysqli_connect_error());
				$inventario = mysqli_fetch_array($inventario);

				$existencia = $inventario['nuevaExistencia_Inv'];
				$nuevaExistencia = $existencia-$devolucion[$key];
				$precioActual = $inventario['nuevoPrecio_Inv'];
				$nuevoPrecio = (($existencia*$precioActual) - ($cdevolucion[$key]*$resultados['precio_DCom']))/$nuevaExistencia;
				$precio = $resultados['precio_DCom'];

				//Tipo de movimiento = 3 -> para devolucion compra
				$sql3 = "INSERT INTO inventario (tipoMovimiento_Inv,existencias_Inv,precioActual_Inv,cantidad_Inv,precio_Inv,fechaMovimiento_Inv,nuevaExistencia_Inv,nuevoPrecio_Inv,id_Producto) VALUES (3,'$existencia','$precioActual','$devolucion[$key]','$precio','$fecha','$nuevaExistencia','$nuevoPrecio','$idproducto')";
				mysqli_query($conexion,$sql3) or die ("Error a Conectar en la BD".mysqli_connect_error());

			}

		}
	}

}

//----------------------------  AGREGAR AL COMBOBOX DE LOS PRODUCTOS
if(isset($_GET["bandera"])){
	$id = $_GET["id"];
	$cadena='';
	$sql1 = "SELECT * from producto where categoria_Prod = '$id' and tipo_Prod = 1 order by nombre_Prod ASC";
	$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	While ($producto = mysqli_fetch_assoc($productos)){
		if($producto['anioVehiculo_Prod'] == 0){
			$cadena = $cadena.'<option value="'.$producto['idProducto'].'">'.$producto['nombre_Prod'].'  '.$producto['marca_Prod'].'</option>';
		}else{
			$cadena = $cadena.'<option value="'.$producto['idProducto'].'">'.$producto['nombre_Prod'].'  '.$producto['marca_Prod'].' - '.$producto['modeloVehiculo_Prod'].' '.$producto['anioVehiculo_Prod'].'</option>';
		}
	}
	echo $cadena;
}

//-----------------------------------------------------------   VER PRODUCTO EN LA COMPRA
if(isset($_GET["nombre"])){
	$id = $_GET["id"];
	$nom = '';
	$sql1 = "SELECT * from producto where idProducto = '$id' ";
	$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$producto = mysqli_fetch_array($productos);
	$nom = $nom.''.$producto['nombre_Prod'];
	echo $nom;
}

if(isset($_GET["codigo"])){
	$id = $_GET["id"];
	$cod = '';
	$sql1 = "SELECT * from producto where idProducto = '$id' ";
	$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$producto = mysqli_fetch_array($productos);
	$cod = $cod.''.$producto['codigo_Prod'];
	echo $cod;
}

if(isset($_GET["marca"])){
	$id = $_GET["id"];
	$mar = '';
	$sql1 = "SELECT * from producto where idProducto = '$id' ";
	$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$producto = mysqli_fetch_array($productos);
	$mar = $mar.''.$producto['marca_Prod'];
	echo $mar;
}

if(isset($_GET["descripcion"])){
	$id = $_GET["id"];
	$des = '';
	$sql1 = "SELECT * from producto where idProducto = '$id' ";
	$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$producto = mysqli_fetch_array($productos);
	$des = $des.''.$producto['descripcion_Prod'];
	echo $des;
}

if(isset($_GET["modelo"])){
	$id = $_GET["id"];
	$mod = '';
	$sql1 = "SELECT * from producto where idProducto = '$id' ";
	$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$producto = mysqli_fetch_array($productos);
	$mod = $mod.''.$producto['modeloVehiculo_Prod'];
	echo $mod;
}

if(isset($_GET["anio"])){
	$id = $_GET["id"];
	$ani = '';
	$sql1 = "SELECT * from producto where idProducto = '$id' ";
	$productos = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$producto = mysqli_fetch_array($productos);
	$ani = $ani.''.$producto['anioVehiculo_Prod'];
	echo $ani;
}
//-----------------------------------------------------------------------------------------------------

//------------------ PROVEEDOR DE MODIFICAR
if(isset($_GET["provee"])){
	$id = $_GET["id"];
	$pro = '';
	$sql1 = "SELECT * from proveedor where tipo_Prov = 1 and idProveedor = '$id' ";
	$proveedor = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
	$prove = mysqli_fetch_array($proveedor);
	$pro = $pro.''.$prove['nombre_Prov'];
	echo $pro;
}


?>
