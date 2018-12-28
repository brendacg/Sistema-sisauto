<?php

	session_start();
	include("../confi/Conexion.php");
	$conexion = conectarMysql();
	$bandera = $_POST["bandera"];

	if($bandera == "factura"){

		$numeroF = $_POST["numF"];
		$sql = "INSERT INTO numerofactura (numeroInicial_numF) VALUES ('$numeroF')";
	    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());
	    $_SESSION['mensaje'] = "El numero de factura ha sido inicializado";
	    header("location: /SISAUTO1/view/index.php?");
			//////////CAPTURA DATOS PARA BITACORA
			$usuari = $_SESSION['usuarioActivo']['usuario_Usu'];
			$sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Inicio numero de factura')";
			mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
			///////////////////////////////////////////////
	}

?>