<?php
    //Sesion
    include("session/employee-session.php");
    //Acceso Denegado
    include("session/access-denied.php");
    //Requerimientos del Usuario Recientes
    $sqlReq="SELECT r.idRequerimiento, r.observacion, r.fecha, r.estadoRequerimiento, e.nombres, e.apellidos, r.date_update FROM detalle_requerimiento d
    INNER JOIN requerimiento r ON r.idRequerimiento = d.idRequerimiento
    INNER JOIN usuario u ON u.idUsuario = r.idUsuario
    INNER JOIN empleado e ON e.idEmpleado = u.idEmpleado
    INNER JOIN producto p ON p.idProducto = d.idProducto
    WHERE r.idUsuario = '$usuarioSesEmp'
    GROUP BY r.idRequerimiento, r.observacion, r.fecha, r.estadoRequerimiento, e.nombres, e.apellidos, r.date_update";
    $datosReq=mysqli_query($con,$sqlReq) or die ('Error en el query database');
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

        <!-- Responsive and DataTables -->
        <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                        <li>
                            <a href="index"><i class="mdi mdi-gauge"></i> <span>Inicio</span></a>
                        </li>              
                        <li>
                            <a href="profile"><i class="mdi mdi-account-circle"></i> <span>Mi Perfil</span></a>
                        </li>
                        <li>
                            <h3 class="navigation-title">Gestión</h3>
                        </li>
                        <li class="menu-list nav-active active"><a href=""><i class="mdi mdi-codepen"></i> <span>Requerimientos</span></a>
                            <ul class="child-list">
                                <li><a href="nuevo-requerimiento"> Registrar Requerimientos</a></li>
                                <li class="active"><a href="lista-requerimiento"> Lista de Requerimientos</a></li>
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
                        <h4 class="my-2">Lista de Requerimientos
                            <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="nuevo-requerimiento">
                                <i class="ti-plus"></i>
                            </a>
                        </h4>
                    </div>                    
                    <div class="data-table">
                        <div class="row"><!-- row-->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body table-responsive">
                                        <div class="table-odd">
                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Empleado</th>
                                                    <th>Observación</th>
                                                    <th>Estado</th>
                                                    <th>Modificado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  while ($rowReq = $datosReq->fetch_assoc()) {?>
                                                <tr>
                                                    <td><?php echo $rowReq['fecha']; ?></td>  
                                                    <td><?php echo $rowReq['nombres'].' '.$rowReq['apellidos']; ?></td>
                                                    <td><?php echo $rowReq['observacion']; ?></td>
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
                                                    <td><?php echo $rowReq['date_update']; ?></td>  
                                                    <td>
                                                        <div>
                                                            <a type="button" class="tabledit-edit-button btn btn-sm btn-info" href="modificar-requerimiento?idRequerimiento=<?php echo $rowReq['idRequerimiento'];?>">
                                                                <span class="ti-eye" style="color: white;"></span>
                                                            </a>
                                                            <a type="button" onclick="return confirmDelete();" class="tabledit-delete-button btn btn-sm btn-danger" href="delete.php?idRequerimiento=<?php echo $rowReq['idRequerimiento'];?>">
                                                                <span class="ti-trash" style="color: white;"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                                </tbody>
                                                <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Empleado</th>
                                                    <th>Observación</th>
                                                    <th>Estado</th>
                                                    <th>Modificado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
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

        <!-- Responsive and datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!--app js-->
        <script src="../assets/js/jquery.app.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable(),
                $('#datatable2').DataTable();  
            } );

            function confirmDelete() {
                var confirmar = confirm("¿Realmente deseas eliminarlo? ");
                if (confirmar) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>
