<?php
    //Sesion
    include("../config/user-session.php");
    //Acceso Denegado
    include("../config/access-denied.php");
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
    </head>

    <body class="sticky-header">
        <section>
            <!-- sidebar left start-->
            <div class="sidebar-left">
                <div class="sidebar-left-info">                    

                    <?php include("../template/user-box.php");  ?>   
                                        
                    <!--sidebar nav start-->
                    <ul class="side-navigation">
                        <li>
                            <a href="../index"><i class="mdi mdi-gauge"></i> <span>Inicio</span></a>
                        </li>              
                        <li>
                            <a href="../profile/profile"><i class="mdi mdi-account-circle"></i> <span>Mi Perfil</span></a>
                        </li>
                        <li>
                            <h3 class="navigation-title">Maestros</h3>
                        </li>
                        <li class="menu-list"><a href=""><i class="mdi mdi-buffer"></i> <span>Productos</span></a>
                            <ul class="child-list">
                                <li><a href="../productos/nuevo-producto"> Registrar productos</a></li>
                                <li><a href="../productos/lista-producto"> Lista de productos</a></li>
                            </ul>
                        </li>  
                        <li class="menu-list"><a href=""><i class="mdi mdi-account-circle"></i> <span>Empleados</span></a>
                            <ul class="child-list">
                                <li><a href="../empleados/nuevo-empleado"> Registrar empleados</a></li>
                                <li><a href="../empleados/lista-empleado"> Lista de empleados</a></li>
                            </ul>
                        </li>    
                        <li class="menu-list"><a href=""><i class="mdi mdi-account-plus"></i> <span>Usuarios</span></a>
                            <ul class="child-list">
                                <li><a href="../usuarios/nuevo-usuario"> Registrar usuarios</a></li>
                                <li><a href="../usuarios/lista-usuario"> Lista de usuarios</a></li>
                            </ul>
                        </li>   
                        <li>
                            <h3 class="navigation-title">Gestión</h3>
                        </li>
                        <li class="menu-list"><a href=""><i class="mdi mdi-code-equal"></i> <span>Mov. Almacén</span></a>
                            <ul class="child-list">
                                <li><a href="../movimientosAlm/nuevo-movimiento"> Registrar Mov. Almacén</a></li>
                                <li><a href="../movimientosAlm/lista-movimiento"> Lista de Mov. Almacén</a></li>
                                <li><a href="../movimientosAlm/kardex"> Kardex</a></li>
                            </ul>
                        </li> 
                        <li class="menu-list"><a href=""><i class="mdi mdi-codepen"></i> <span>Requerimientos</span></a>
                            <ul class="child-list">
                                <li><a href="../requerimientos/nuevo-requerimiento"> Registrar Requerimientos</a></li>
                                <li><a href="../requerimientos/lista-requerimiento"> Lista de Requerimientos</a></li>
                            </ul>
                        </li>      
                        <li>
                            <h3 class="navigation-title">Extras</h3>
                        </li>
                        <li class="menu-list"><a href=""><i class="mdi mdi-slack"></i> <span>Categorias</span></a>
                            <ul class="child-list">
                                <li><a href="../categorias/nuevo-categoria"> Registrar categorias</a></li>
                                <li><a href="../categorias/lista-categoria"> Lista de categorias</a></li>
                            </ul>
                        </li> 
                        <li class="menu-list"><a href=""><i class="mdi mdi-credit-card-scan"></i> <span>Marcas</span></a>
                            <ul class="child-list">
                                <li><a href="../marcas/nuevo-marca"> Registrar marcas</a></li>
                                <li><a href="../marcas/lista-marca"> Lista de marcas</a></li>
                            </ul>
                        </li>
                        <li class="menu-list nav-active active"><a href=""><i class="mdi mdi-wallet-membership"></i> <span>Areas</span></a>
                            <ul class="child-list">
                                <li class="active"><a href="../areas/nuevo-area"> Registrar areas</a></li>
                                <li><a href="../areas/lista-area"> Lista de areas</a></li>
                            </ul>
                        </li> 
                        <li class="menu-list"><a href=""><i class="mdi mdi-worker"></i> <span>Cargos</span></a>
                            <ul class="child-list">
                                <li><a href="../cargos/nuevo-cargo"> Registrar cargos</a></li>
                                <li><a href="../cargos/lista-cargo"> Lista de cargos</a></li>
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
                        <a href="../index">
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
                                <a style="color: white;" href="../config/session-close.php">Salir</a>
                            </button>
                        </div><!--right notification end-->
                    </div>
                </div>
                <!-- header section end-->

                <div class="container-fluid">
                    <div class="page-head">
                        <h4 class="my-2">Nuevo Área
                            <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="../areas/lista-area">
                                <i class="mdi mdi-view-list"></i>
                            </a>
                        </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <form action="../actions/area/insert.php" method="post">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Nombre de la Área</label>
                                                    <input type="text" class="form-control" name="nombre" required autofocus placeholder="Nombre"/>
                                                </div>
                                                <div class="col-lg-6">                                                   
                                                    <label>Estado de la Área</label>
                                                    <select class="form-control" name="estado">
                                                        <option value="1" selected>Activo</option>
                                                        <option value="2">Desactivado</option>
                                                    </select>
                                                </div>  
                                            </div>                                            
                                        </div>

                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                    Guardar
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                    Limpiar
                                                </button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    <a style="color:white;" href="./lista-area">Cancelar</a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->                        
                    </div> <!-- end row -->                         
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

        <!-- Parsley js -->
        <script type="text/javascript" src="assets/plugins/parsleyjs/dist/parsley.min.js"></script>

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
        </script>
    </body>
</html>
