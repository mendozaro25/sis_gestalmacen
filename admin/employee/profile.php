<?php
    //Sesion
    include("session/employee-session.php");
    //Acceso Denegado
    include("session/access-denied.php");
    //Usuarios
    $sqlUsu="SELECT * FROM usuario u
            INNER JOIN empleado e ON e.idEmpleado = u.idEmpleado
            INNER JOIN area a ON a.idArea = e.idArea
            INNER JOIN cargo c ON c.idCargo = e.idArea
            WHERE u.idUsuario = '$usuarioSesEmp' AND u.estadoUsuario = 1";
    $datosUsu=mysqli_query($con,$sqlUsu) or die ('Error en el query database');
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
        <link rel="shortcut icon" href="../assets/images/sunafil/logo-sunafil.jpg">

        <link href="../assets/plugins/morris-chart/morris.css" rel="stylesheet">
        <!-- Theme Css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/slidebars.min.css" rel="stylesheet">
        <link href="../assets/css/icons.css" rel="stylesheet">
        <link href="../assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/style.css" rel="stylesheet">

        <!--animation-->
        <link href="assets/css/animate.css" rel="stylesheet">

    </head>

    <body class="sticky-header">
        <section>
            <!-- sidebar left start-->
            <div class="sidebar-left">
                <div class="sidebar-left-info">

                    <div class="user-box">
                        <?php  while ($rowSes = $datosSesEmp->fetch_assoc()) { ?>
                        <div class="text-center text-white mt-2">
                            <h6><?php echo $rowSes['nombres'].' '.$rowSes['apellidos'];?></h6>
                            <p class="text-muted m-0"><?php echo $rowSes['nombreArea'];?></p>
                            <p class="text-muted m-0"><?php echo $rowSes['nombreCargo'];?></p>
                        </div>
                        <?php } ?>
                    </div>   
                                        
                    <!--sidebar nav start-->
                    <ul class="side-navigation">
                        <li>
                            <a href="index"><i class="mdi mdi-gauge"></i> <span>Inicio</span></a>
                        </li>                      
                        <li class="active">
                            <a href="profile.php"><i class="mdi mdi-account-circle"></i> <span>Mi Perfil</span></a>
                        </li>  
                        <li>
                            <h3 class="navigation-title">Gestión</h3>
                        </li>
                        <li class="menu-list"><a href=""><i class="mdi mdi-codepen"></i> <span>Requerimientos</span></a>
                            <ul class="child-list">
                                <li><a href="nuevo-requerimiento"> Registrar Requerimientos</a></li>
                                <li><a href="lista-requerimiento"> Lista de Requerimientos</a></li>
                            </ul>
                        </li>                    
                    </ul><!--sidebar nav end-->
                </div>
            </div><!-- sidebar left end-->

            <!-- body content start-->
            <div class="body-content">
                <!-- header section start-->
                <div class="header-section">
                    <!--logo and logo icon start-->
                    <div class="logo">
                        <a href="index">
                            <span class="logo-img">
                                <img src="../assets/images/sunafil/logo-sunafil.jpg" alt="sunafil" style="width: 2em; height: 2em;">
                            </span>                           
                            <!--<i class="fa fa-maxcdn"></i>-->
                            <span class="brand-name">SISGESALM</span>
                        </a>
                    </div>

                    <!--toggle button start-->
                    <a class="toggle-btn"><i class="ti ti-menu"></i></a>
                    <!--toggle button end-->

                    <div class="notification-wrap">
                        <!--right notification start-->
                        <div class="right-notification">
                            <button style="margin-top: 17.2px; margin-right: 28px;" class="btn btn-sm btn-danger">
                                <a style="color: white;" href="session/session-close.php">Salir</a>
                            </button>
                        </div><!--right notification end-->
                    </div>
                </div>
                <!-- header section end-->

                <div class="container-fluid">
                    <form action="profile-update.php" method="post">
                        <div class="page-head">
                            <h4 class="my-2">Mi Perfil</h4>
                        </div>
                        <?php  while ($rowUsu = $datosUsu->fetch_assoc()) {?>
                        <div class="row">
                            <div class="col-lg-5 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="form-group">                                           
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idUsuario" type="hidden" value="<?php echo $row['idUsuario'];?>"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Tipo de Usuario</label>
                                                    <input class="form-control" name="tipo" readonly value="<?php echo $rowUsu['tipoUsuario'];?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">                                                    
                                                    <label>Usuario</label>
                                                    <input type="text" class="form-control" name="usuario" value="<?php echo $rowUsu['usuario'];?>"/>
                                                </div>
                                                <div class="col-lg-6">                                                  
                                                    <label>Clave</label>
                                                    <input disabled type="password" class="form-control" id="clave" value="<?php echo $rowUsu['clave'];?>"/>
                                                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                                                    <button id="show_password" type="button" onclick="showPassword()" class="btn btn-sm btn-danger" style="padding: 2px;border-radius: 50%;width: 31px;margin-top: -64.7%;transform: translateX(130%);"> 
                                                        <span class="mdi mdi-eye-off icon"></span>
                                                    </button>
                                                </div>                                  
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalform">
                                                    Cambiar contraseña
                                                    </button>
                                                </div>                                  
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <?php
                                                    if (isset($_GET["error"])):
                                                    ?>
                                                    <div class="text-danger" style="font-weight: 700;"> <?= $_GET["error"] ?> </div>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </div>                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-lg-7 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body">                                        
                                        <div class="form-group">                                          
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idEmpleado" type="hidden" value="<?php echo $rowUsu['idEmpleado'];?>"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Área</label>
                                                    <input class="form-control" name="area" readonly value="<?php echo $rowUsu['nombreArea'];?>"/>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Cargo</label>
                                                    <input class="form-control" name="cargo" readonly value="<?php echo $rowUsu['nombreCargo'];?>"/>
                                                </div>
                                            </div>
                                        </div>                                       
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Nombres</label>
                                                    <input class="form-control" name="nombres" value="<?php echo $rowUsu['nombres'];?>"/>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Apellidos</label>
                                                    <input class="form-control" name="apellidos" value="<?php echo $rowUsu['apellidos'];?>"/>
                                                </div>
                                            </div>
                                        </div>                                       
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label>Dni</label>
                                                    <input class="form-control" name="dni" value="<?php echo $rowUsu['dni'];?>"/>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Telefono</label>
                                                    <input class="form-control" name="telefono" value="<?php echo $rowUsu['telefono'];?>"/>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Email</label>
                                                    <input class="form-control" name="email" value="<?php echo $rowUsu['email'];?>"/>
                                                </div>
                                            </div>
                                        </div>                                   
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Dirección</label>
                                                    <input class="form-control" name="direccion" value="<?php echo $rowUsu['direccion'];?>"/>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>                                
                            </div>
                        </div>                                                    
                        <?php }?>
                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" onclick="return confirmUpdate();" class="btn btn-danger waves-effect waves-light">
                                    Guardar
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <a style="color:white;" href="index">Volver</a>
                                </button>
                            </div>
                        </div> 
                    </form>                     
                </div><!--end container-->

                <!--footer section start-->
                <footer class="footer">
                    2023 &copy; SISGESALM | Todos los derechos reservados.
                </footer>
                <!--footer section end-->
            </div>
            <!--end body content-->
        </section>

        <!-- jQuery -->
        <script src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery-migrate.js"></script>
        <script src="../assets/js/modernizr.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/slidebars.min.js"></script>

        <script src="../assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
        <script src="../assets/plugins/tiny-editable/numeric-input-example.js"></script>
        <script src="../assets/plugins/tabledit/jquery.tabledit.js"></script>

        <!-- Parsley js -->
        <script type="text/javascript" src="../assets/plugins/parsleyjs/dist/parsley.min.js"></script>

        <!--app js-->
        <script src="../assets/js/jquery.app.js"></script>
        <script>
            $(document).ready(function() {
                $('form').parsley();
            });

            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                delay: 100,
                time: 1200
                });
            });

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

            $( function() {
                $("#id_Mov").change( function() {
                    if ($(this).val() === "1") {
                        $("#doc").prop("disabled", false);
                        $("#num").prop("disabled", false);
                        $("#nomRaz").prop("disabled", false);
                    } else {
                        $("#doc").prop("disabled", true);
                        $("#num").prop("disabled", true);
                        $("#nomRaz").prop("disabled", true);
                    }
                });
            });

            $('#my-table').Tabledit({
                  columns: {
                    identifier: [0, 'id'],                    
                    editable: [[1, 'col1']]
                  }
                });

            $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();

            function confirmUpdate() {
                var confirmar = confirm("¿Realmente deseas modificar tus datos? ");
                if (confirmar) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>


<form onsubmit="return confirm('¿Realmente deseas actualizar tu contraseña?');" action="new-password.php" method="post">
    <!-- Modal -->
    <div class="modal fade" id="exampleModalform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Contraseña actual</label>
                                <input type="password" name="password-old" class="form-control" id="field-1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Contraseña nueva</label>
                                <input type="password" name="password-new" class="form-control" id="field-2" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Vuelva a repetir la contraseña nueva</label>
                                <input type="password" name="password-repeat" class="form-control" id="field-3" required>
                            </div>
                        </div>
                    </div>
                </div>                                          
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>   
</form>
