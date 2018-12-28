<?php
include("../confi/Conexion.php");
$conexion = conectarMysql();
session_start();
//////////CAPTURA DATOS PARA BITACORA
$usuari=$_SESSION['usuarioActivo']['usuario_Usu'];
$sql = "INSERT INTO bitacora (usuario_Usu,sesionInicio,actividad) VALUES ('$usuari',now(),'Cerro Sesión')";
mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
unset($_SESSION['usuarioActivo']);
header("location: /SISAUTO1/view/login.php");
///////////////////////////////////////////////
 ?>
