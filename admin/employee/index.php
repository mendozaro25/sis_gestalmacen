<?php
//Sesion
include("session/employee-session.php");
//Acceso Denegado
include("session/access-denied.php");
//Requerimientos del Usuario Recientes
$sqlReq="SELECT * FROM detalle_requerimiento d
INNER JOIN requerimiento r ON r.idRequerimiento = d.idRequerimiento
INNER JOIN usuario u ON u.idUsuario = r.idUsuario
INNER JOIN empleado e ON e.idEmpleado = u.idEmpleado
INNER JOIN producto p ON p.idProducto = d.idProducto
WHERE u.idUsuario = '$usuarioSesEmp'
ORDER BY r.idRequerimiento DESC
LIMIT 5";
$datosReq=mysqli_query($con,$sqlReq) or die ('Error en el query database');
//Productos Recientes
$sqlPro="SELECT * FROM producto p 
INNER JOIN categoria c ON c.idCategoria = p.idCategoria
INNER JOIN marca m ON m.idMarca = p.idMarca
WHERE estadoProducto = 1
ORDER BY idProducto DESC
LIMIT 5";
$datosPro=mysqli_query($con,$sqlPro) or die ('Error en el query database');
//Consultas - Box
//Cantidad Requerimientos Registrados
$sqlReqReg = "SELECT count(d.idRequerimiento) as cantidadReqReg FROM detalle_requerimiento d INNER JOIN requerimiento r ON r.idRequerimiento = d.idRequerimiento INNER JOIN usuario u ON u.idUsuario = r.idUsuario WHERE u.idUsuario = '$usuarioSesEmp' AND r.estadoRequerimiento = 1";
$cantidadReqReg = mysqli_query($con,$sqlReqReg) or die ('Error en el query database');
//Cantidad Requerimiento Atentidos
$sqlReqAnt = "SELECT count(idRequerimiento) as cantidadReqAnt FROM requerimiento WHERE idUsuario = '$usuarioSesEmp' AND estadoRequerimiento = 2";
$cantidadReqAnt = mysqli_query($con,$sqlReqAnt) or die ('Error en el query database');
//Cantidad Requerimiento Rechazados
$sqlReqRec = "SELECT count(idRequerimiento) as cantidadReqRec FROM requerimiento WHERE idUsuario = '$usuarioSesEmp' AND estadoRequerimiento = 3";
$cantidadReqRec = mysqli_query($con,$sqlReqRec) or die ('Error en el query database');
//Cantidad Productos
$sqlPro2 = "SELECT count(idProducto) as cantidadPro FROM producto ";
$cantidadPro = mysqli_query($con,$sqlPro2) or die ('Error en el query database');
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
                        <li class="active">
                            <a href="index"><i class="mdi mdi-gauge"></i> <span>Inicio</span></a>
                        </li>                      
                        <li>
                            <a href="profile"><i class="mdi mdi-account-circle"></i> <span>Mi Perfil</span></a>
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
                    <div class="page-head">
                        <h4 class="my-2">Inicio</h4>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3">
                                   <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowReg = $cantidadReqReg->fetch_assoc()) {?>
                                        <a style="color: black;" href="lista-requerimiento">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti-receipt"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowReg['cantidadReqReg']; ?></h2>
                                                    <p>Mis Req. Registrados</p>
                                                </div>
                                            </div>
                                        </a>                                                        
                                        <?php }?>
                                   </div> 
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                   <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowAnt = $cantidadReqAnt->fetch_assoc()) {?>
                                        <a style="color: black;" href="lista-requerimiento">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti-face-smile"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowAnt['cantidadReqAnt']; ?></h2>
                                                    <p>Mis Req. Atendidos</p>
                                                </div>
                                            </div>
                                        </a>                                                        
                                        <?php }?>
                                   </div> 
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowRec = $cantidadReqRec->fetch_assoc()) {?>
                                        <a style="color: black;" href="lista-requerimiento">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti-face-sad"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowRec['cantidadReqRec']; ?></h2>
                                                    <p>Mis Req. Rechazados</p> 
                                                </div>
                                            </div>
                                        </a>                                                        
                                        <?php }?>
                                   </div> 
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowPro = $cantidadPro->fetch_assoc()) {?>
                                        <a style="color: black;" href="">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti-layers-alt"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowPro['cantidadPro']; ?></h2>
                                                    <p>Productos Activos</p> 
                                                </div>
                                            </div>
                                        </a>                                                        
                                        <?php }?>
                                   </div> 
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->   

                    <div class="row"><!-- row-->
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title pb-3">Mis Requerimientos Recientes</h5>           
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover m-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Empleado</th>
                                                            <th>Observación</th>
                                                            <th>Producto</th>
                                                            <th>Estado</th>
                                                            <th>Fecha</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php  while ($rowReq = $datosReq->fetch_assoc()) {?>                                                    
                                                    <tr>
                                                        <td><?php echo $rowReq['nombres'].' '.$rowReq['apellidos']; ?></td>
                                                        <td><?php echo $rowReq['observacion']; ?></td>
                                                        <td><?php echo $rowReq['nombreProducto']; ?></td>
                                                        <?php
                                                            if($rowReq['estadoRequerimiento']=='1'){
                                                                ?>
                                                                <td style="color: orange; font-weight: 600;" >Registrado</td>
                                                                <?php
                                                            }if($rowReq['estadoRequerimiento']=='2'){
                                                                ?>
                                                                <td style="color: green; font-weight: 600;" >Atendido</td>
                                                                <?php
                                                            }if($rowReq['estadoRequerimiento']=='3'){
                                                                ?>
                                                                <td style="color: red; font-weight: 600;" >Rechazado</td>
                                                                <?php
                                                            }
                                                        ?>
                                                        <td><?php echo $rowReq['fecha']; ?></td>                                                        
                                                    </tr>
                                                    <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>              
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row"><!-- row-->
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title pb-3">Productos Recientes</h5>           
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover m-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre del Producto</th>
                                                            <th>Categoria</th>
                                                            <th>Marca</th>
                                                            <th>Precio</th>
                                                            <th>F. Registro</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php  while ($rowDato = $datosPro->fetch_assoc()) {?>
                                                    <tr>
                                                        <td><?php echo $rowDato['nombreProducto']; ?></td>
                                                        <td><?php echo $rowDato['nombreCategoria']; ?></td>
                                                        <td><?php echo $rowDato['nombreMarca']; ?></td>
                                                        <td><?php echo 's/. '.number_format($rowDato['precio'], 2, '.', ' '); ?></td>
                                                        <td><?php echo $rowDato['date_created']; ?></td>                                                        
                                                    </tr>
                                                    <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>              
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->  
                    
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

        <!--plugins js-->
        <script src="../assets/plugins/counter/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/sparkline-chart/jquery.sparkline.min.js"></script>
        <script src="../assets/pages/jquery.sparkline.init.js"></script>

        <script src="../assets/plugins/chart-js/Chart.bundle.js"></script>
        <script src="../assets/plugins/morris-chart/raphael-min.js"></script>
        <script src="../assets/plugins/morris-chart/morris.js"></script>
        <script src="../assets/pages/dashboard-init.js"></script>


        <!--app js-->
        <script src="../assets/js/jquery.app.js"></script>
        <script>
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                delay: 100,
                time: 1200
                });
            });
        </script>
    </body>
</html>


                    
<style>

/* Employee Box*/

.widget-box .ti-receipt,
.grad-progress-4,
.bg-gradient .bg-grad-4 {
    background: -webkit-linear-gradient(315deg, orange -10%, white 180%);
}

.widget-box .ti-face-smile,
.grad-progress-4,
.bg-gradient .bg-grad-4 {
    background: -webkit-linear-gradient(315deg, green -10%, white 180%);
}

.widget-box .ti-face-sad,
.grad-progress-4,
.bg-gradient .bg-grad-4 {
    background: -webkit-linear-gradient(315deg, red -10%, white 180%);
}

</style>