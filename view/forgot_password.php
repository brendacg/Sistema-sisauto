<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SISAUTO | Olvido de contraseña</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../assets/css/animate.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <link href="../assets/pNotify/pnotify.custom.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url("../assets/img/auto.jpg");
        }</style>

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 align="center" class="font-bold">¿Olvidaste tu contraseña?</h2>
                    <br>
                    <div class="text-center">
                       <p>
                           Ingrese su dirección de correo electrónico y le enviaremos su nueva contraseña.
                       </p>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="post" action="../Controlador/correo.php" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" type="text" name="correo" aria-describedby="emailHelp" placeholder="Correo Electrónico" required="">
                                </div>

                                <button type="submit" class="btn btn-success block full-width m-b">Restablecer la contraseña</button>
                                <div class="text-center">
                                        <a href="login.php" ><small>Página de inicio de sesión</small></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <hr/> -->
    </div>
        <script src="../assets/pNotify/pnotify.custom.min.js"></script>

        <script src="../assets/Validaciones/Mensajes.js"></script>
</body>

</html>

<?php
if (isset($_SESSION['error'])) {
     echo ("<script type='text/javascript'>
notaError('".$_SESSION['error']."');
</script>");
 unset($_SESSION['error']);
 }
?>
