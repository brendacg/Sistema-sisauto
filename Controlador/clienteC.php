<?php

  session_start();
include("../confi/Conexion.php");
$conexion = conectarMysql();

$bandera = $_POST["bandera"];

if($bandera=="GuardarCli"){
	$nombreCli = $_POST["NombreC"];
	$direccionCli = $_POST["DireccionC"];
	$telefonoCli = $_POST["TelefonoC"];
	$NRCcli = $_POST["NRC"];
	$NITcli = $_POST["NIT"];
	$sql = "INSERT INTO cliente (nombre_Cli,direccion_Cli,telefono_Cli,nrc_Cli,nit_Cli,tipo_Cli) VALUES ('$nombreCli','$direccionCli','$telefonoCli','$NRCcli','$NITcli',1)";

    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());

    $_SESSION['mensaje'] ="Registro guardado exitosamente";
    header("location: /SISAUTO1/view/Cliente.php");

    //////////CAPTURA DATOS PARA BITACORA
    $usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
    $sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Registró nuevo cliente')";
    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
    ///////////////////////////////////////////////

}

if($bandera=="EditarCli"){

    $nombreCli = $_POST["nombreCli"];
	$direccionCli = $_POST["direccionCli"];
	$telefonoCli = $_POST["telefonoCli"];
	$NRCcli = $_POST["nrcCli"];
	$NITcli = $_POST["nitCli"];
	$descripcion = $_POST["descripcion"];
	$idcliente = $_POST["idcliente"];

	$sql = "UPDATE cliente set nombre_Cli='$nombreCli',direccion_Cli='$direccionCli',telefono_Cli='$telefonoCli',nrc_Cli='$NRCcli',nit_Cli='$NITcli',descripcion_Cli='$descripcion' where idCliente = '$idcliente'";

    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());

    $_SESSION['mensaje'] ="Registro editado exitosamente";
    header("location: /SISAUTO1/view/Cliente.php");

    //////////CAPTURA DATOS PARA BITACORA
    $usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
    $sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Editó datos de un cliente')";
    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
    ///////////////////////////////////////////////
}
if ($bandera=="cambio") {

	$sql = "UPDATE cliente set tipo_Cli='".$_POST["valor"]."' where idCliente = '".$_POST["id"]."'";
	$cliente = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
	if ($_POST["valor"]==1) {
	$aux = 0;
		$_SESSION['mensaje'] ="Cliente dado de alta exitosamente";
    //////////CAPTURA DATOS PARA BITACORA
    $usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
    $sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Dio de alta a un cliente')";
    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
    ///////////////////////////////////////////////
	}else{
		$aux = 1;
		$_SESSION['mensaje'] ="Cliente dado de baja exitosamente";
    //////////CAPTURA DATOS PARA BITACORA
    $usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
    $sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Dio de baja a un cliente')";
    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
	}
    header("location: /SISAUTO1/view/Cliente.php?tipo=".$aux."");
 }
if ($bandera=="nombreC") {
	$sql="SELECT * from cliente where nombre_Cli like '".$_POST["nombre"]."'";
	$cliente = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    echo mysqli_num_rows($cliente);
}

if ($bandera=="telefonoC") {
	$sql="SELECT * from cliente where telefono_Cli like '".$_POST["telefono"]."' ";
	$cliente = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    echo mysqli_num_rows($cliente);
}

if ($bandera=="nitC") {
	$sql="SELECT * from cliente where nit_Cli like '".$_POST["nit"]."' ";
	$cliente = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    echo mysqli_num_rows($cliente);
}

if ($bandera=="nrcC") {
	$sql="SELECT * from cliente where nrc_Cli like '".$_POST["nrc"]."' ";
	$cliente = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    echo mysqli_num_rows($cliente);
}

// ---------------------------------------------------------------------------------------

if ($bandera=="cnombreEditar") {
	$sql="SELECT * from cliente where nombre_Cli like '".$_POST["nombre"]."' AND idCliente<>'".$_POST["idC"]."'";
	$cliente = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    echo mysqli_num_rows($cliente);
}
if ($bandera=="telefonoCEditar") {
	$sql="SELECT * from cliente where telefono_Cli like '".$_POST["telefono"]."' AND idCliente<>'".$_POST["idC"]."' ";
	$cliente = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    echo mysqli_num_rows($cliente);
}

?>
