<?php
session_start();
error_reporting(0);
$usuarioSes = $_SESSION['admin'];
$usuarioSesAlm = $_SESSION['almacenero'];
$usuarioSesEmp = $_SESSION['empleado'];
if($usuarioSes){
	header('Location: ./admin/index');
} if($usuarioSesAlm) {
    header('Location: ./admin/grocer/index');
}   if($usuarioSesEmp) {
    header('Location: ./admin/employee/index');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mannat Themes">
    <meta name="keyword" content="">

    <title>SISGESALM | Sistema de Gestión de Almacén</title>

    <!-- Theme icon -->
    <link rel="shortcut icon" href="/admin/assets/images/sunafil/logo-sunafil.jpg">

    <!-- Theme Css -->
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/assets/css/slidebars.min.css" rel="stylesheet">
    <link href="/admin/assets/css/icons.css" rel="stylesheet">
    <link href="/admin/assets/css/menu.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/style.css" rel="stylesheet">
</head>

<body class="sticky-header">
    <section class="bg-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-box">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="card-title text-center">
                                            <img src="/admin/assets/images/sunafil/logo-sunafil.jpg" alt="" class="">
                                            <h5 class="mt-3"><b>Sistema de Gestión de Almacén | Sunafil</b></h5>
                                        </div>
                                        <form class="form mt-5 contact-form" action="users.php" method="post">
                                            <div class="form-group ">
                                                <div class="col-sm-12">
                                                    <input class="form-control form-control-line" name="usuario" type="text" placeholder="Usuario" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-12">
                                                    <input class="form-control form-control-line" id="clave" name="clave" type="password" placeholder="Clave" required>
                                                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                                                    <button id="show_password" type="button" onclick="showPassword()" class="btn btn-sm btn-danger" style="padding: 2px;border-radius: 50%;width: 31px;margin-top: -31.7%;transform: translateX(1160%);"> 
                                                        <span class="mdi mdi-eye-off icon"></span>
                                                    </button>
                                                </div>
                                            </div>
                                                    
                                                    <?php
                                                    if (isset($_GET["error"])):
                                                    ?>
                                                    <div class="text-danger" style="margin-left: 1em; margin-top: -2em; font-weight: 700;"> <?= $_GET["error"] ?> </div>
                                                    <?php
                                                    endif;
                                                    ?>

                                            <div class="form-group">
                                                <div class="col-sm-12 mt-4">
                                                    <button class="btn btn-primary btn-block" type="submit">
                                                        Iniciar Sesión
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
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
    <script src="/admin/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/admin/assets/js/popper.min.js"></script>
    <script src="/admin/assets/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/jquery-migrate.js"></script>
    <script src="/admin/assets/js/modernizr.min.js"></script>
    <script src="/admin/assets/js/jquery.slimscroll.min.js"></script>
    <script src="/admin/assets/js/slidebars.min.js"></script>


    <!--app js-->
    <script src="/admin/assets/js/jquery.app.js"></script>
    <script>
        function showPassword(){
        var clave = document.getElementById("clave");
            if(clave.type == "password"){
                clave.type = "text";
                $('.icon').removeClass('mdi mdi-eye-off').addClass('mdi mdi-eye');
            }else{
                clave.type = "password";
                $('.icon').removeClass('mdi mdi-eye').addClass('mdi mdi-eye-off');
            }
        } 
        $(document).ready(function () {
            $('#ShowPassword').click(function () {
                $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });
    </script>
</body>

</html>