<?php
    //Sesion
    include("session/grocer-session.php");
    //Acceso Denegado
    include("session/access-denied.php");
    //Mov. de Almacen
    $sqlMov="SELECT d.idMovAlmacen, m.tipoMov, m.movimiento, m.idRequerimiento, m.fechaMov, m.date_update, concat(e.nombres, ' ',e.apellidos) as empleado,
                (SELECT concat(e2.nombres, ' ',e2.apellidos) as ss
                FROM detalle_mov_almacen d2
                LEFT JOIN mov_almacen m2 ON m2.idMovAlmacen = d2.idMovAlmacen
                LEFT JOIN usuario u2 ON u2.idUsuario = m2.created_user_id
                LEFT JOIN empleado e2 ON e2.idEmpleado = u2.idEmpleado
                LIMIT 1) as encargado
            FROM detalle_mov_almacen d
            LEFT JOIN mov_almacen m ON m.idMovAlmacen = d.idMovAlmacen
            LEFT JOIN producto p ON p.idProducto = d.idProducto
            LEFT JOIN requerimiento r ON r.idRequerimiento = m.idRequerimiento
            LEFT JOIN usuario u ON u.idUsuario = r.created_user_id
            LEFT JOIN empleado e ON e.idEmpleado = u.idEmpleado
            LEFT JOIN area a ON a.idArea = e.idArea
            GROUP BY d.idMovAlmacen";
    $datosMov=mysqli_query($con,$sqlMov) or die ('Error en el query database');
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
                        <?php  while ($rowSes = $datosSesAlm->fetch_assoc()) { ?>
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
                        <li class="menu-list nav-active active"><a href=""><i class="mdi mdi-code-equal"></i> <span>Mov. Almacén</span></a>
                            <ul class="child-list">
                                <li><a href="nuevo-movimiento"> Registrar Mov. Almacén</a></li>
                                <li class="active"><a href="lista-movimiento"> Lista de Mov. Almacén</a></li>
                                <li><a href="kardex"> Kardex</a></li>
                            </ul>
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
                        <h4 class="my-2">Lista de Movimientos Almacén
                            <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="nuevo-movimiento">
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
                                                    <th>Tipo</th>
                                                    <th>Movimiento</th>
                                                    <th>Empleado</th>
                                                    <th>Encargado</th>
                                                    <th>Modificado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  while ($rowMov = $datosMov->fetch_assoc()) {?>
                                                <tr>
                                                    <td><?php echo $rowMov['fechaMov']; ?></td>
                                                    <td><?php echo $rowMov['tipoMov']; ?></td>
                                                    <td><?php echo $rowMov['movimiento']; ?></td>
                                                    <td><?php echo $rowMov['empleado']; ?></td>
                                                    <td><?php echo $rowMov['encargado']; ?></td>
                                                    <td><?php echo $rowMov['date_update']; ?></td>
                                                    <td>
                                                        <div>
                                                            <a type="button" class="tabledit-edit-button btn btn-sm btn-info" href="modificar-movimiento?idMovAlmacen=<?php echo $rowMov['idMovAlmacen'];?>">
                                                                <span class="ti-eye" style="color: white;"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                                </tbody>
                                                <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Tipo</th>
                                                    <th>Movimiento</th>
                                                    <th>Empleado</th>
                                                    <th>Encargado</th>
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
