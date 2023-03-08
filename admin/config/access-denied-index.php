<?php
session_start();
error_reporting(0);

//Sesion
include("user-session.php");
include("../employee/session/employee-session.php");

if($usuarioSes == null || $usuarioSesEmp){
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
                <meta name="description" content="">
                <meta name="author" content="Mannat Themes">
                <meta name="keyword" content="">

                <title>SISGESALM | Sistema de Gestión de Almacén</title>

                <!-- Theme icon -->
                <link rel="shortcut icon" href="assets/images/sunafil/logo-sunafil.jpg">

                <!-- Theme Css -->
                <link href="assets/css/bootstrap.min.css" rel="stylesheet">
                <link href="assets/css/slidebars.min.css" rel="stylesheet">
                <link href="assets/css/icons.css" rel="stylesheet">
                <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
                <link href="assets/css/style.css" rel="stylesheet">
            </head>

            <body class="sticky-header">
                <section class="bg-error">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mx-auto col-sm-12">
                                <div class="wrapper-page">
                                    <div class="account-pages">
                                        <div class="error-500">
                                            <h2>1020</h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 text-center error-text">
                                                    <h2 class="text-white">ACCESO DENEGADO</h2><br>
                                                    <p class="text-muted">¡Oh no! Usted no tiene permiso para poder visualizar este contenido.</p>
                                                    <a href="/index" class="btn btn-danger"><i class="ti-arrow-left text-white"></i>  Volver</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- jQuery -->
                <script src="assets/js/jquery-3.2.1.min.js"></script>
                <script src="assets/js/popper.min.js"></script>
                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/jquery-migrate.js"></script>
                <script src="assets/js/modernizr.min.js"></script>
                <script src="assets/js/jquery.slimscroll.min.js"></script>
                <script src="assets/js/slidebars.min.js"></script>
                

                <!--app js-->
                <script src="assets/js/jquery.app.js"></script>
            </body>
        </html>
	<?php
	die();
}
?>