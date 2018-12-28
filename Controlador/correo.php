<?php

include("../confi/Conexion.php");
$conexion = conectarMysql();
session_start();
$correo = $_POST['correo'];

$sql="SELECT * FROM usuario WHERE correo_Usu='$correo' AND estado_Usu=1";
$var= mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());

if ($row= mysqli_fetch_assoc($var)){
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for($i=0;$i<8;$i++)
        {
            $cad .= substr($str,rand(0,62),1);
        }
        $sql = "UPDATE usuario set contrasena_Usu=MD5('$cad') where correo_Usu = '$correo'";
        try {
        	mail($_POST['correo'],"Recuperación de contraseña","Su nueva contraseña es : ".$cad,"SISAUTO");
        	mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD".mysqli_connect_error());
        	$_SESSION['mensaje']="La contraseña fue enviada al correo";
    	    header("location: /SISAUTO1/view/login.php");
        } catch (Exception $e) {
        	$_SESSION['error']="Lo sentimos el correo no pudo ser enviado";
    	    header("location: /SISAUTO1/view/login.php");
        }
	 
    }else{
    	$_SESSION['error']="Lo sentimos el correo ingresado no existe";
    	header("location: /SISAUTO1/view/forgot_password.php");
    }

 ?>