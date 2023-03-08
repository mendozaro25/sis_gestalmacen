<?php
    //Sesion
    include("../config/user-session.php");
    //Acceso Denegado
    include("../config/access-denied.php");
    //Abrimos conexión
    include("../config/connection.php");
    //Mov. de Almacen
    $sqlKar="SELECT dm.date_created, concat(ma.tipoMov,' - ',ma.movimiento) as movimiento, pr.nombreProducto, dm.cantidad, ar.nombreArea, CONCAT(em.nombres,' ',em.apellidos) as empleado
    FROM detalle_mov_almacen dm
    LEFT JOIN mov_almacen ma ON ma.idMovAlmacen = dm.idMovAlmacen
    LEFT JOIN requerimiento rq ON rq.idRequerimiento = ma.idRequerimiento
    LEFT JOIN usuario us ON us.idUsuario = rq.created_user_id
    LEFT JOIN empleado em ON em.idEmpleado = us.idEmpleado
    LEFT JOIN area ar ON ar.idArea = em.idArea
    LEFT JOIN producto pr ON pr.idProducto = dm.idProducto
    ORDER BY dm.date_created DESC";
    $datosKar=mysqli_query($con,$sqlKar) or die ('Error en el query database');
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
        <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

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
                                <li><a href="../productos/nuevo-producto"> Registrar producto</a></li>
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
                        <li class="menu-list nav-active active"><a href=""><i class="mdi mdi-code-equal"></i> <span>Mov. Almacén</span></a>
                            <ul class="child-list">
                                <li><a href="../movimientosAlm/nuevo-movimiento"> Registrar Mov. Almacén</a></li>
                                <li><a href="../movimientosAlm/lista-movimiento"> Lista de Mov. Almacén</a></li>
                                <li class="active"><a href="../movimientosAlm/kardex"> Kardex</a></li>
                            </ul>
                        </li> 
                        <li class="menu-list"><a href=""><i class="mdi mdi-codepen"></i> <span>Requerimientos</span></a>
                            <ul class="child-list">
                                <li><a href="../requerimientos/nuevo-requerimiento"> Registrar Requerimientos</a></li>
                                <li><a href="../requerimientos/lista-requerimiento"> Lista de Requerimientos</a></li>
                            </ul>
                        </li> 
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
                        <li class="menu-list"><a href=""><i class="mdi mdi-wallet-membership"></i> <span>Areas</span></a>
                            <ul class="child-list">
                                <li><a href="../areas/nuevo-area"> Registrar areas</a></li>
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
                                <a style="color: white;" href="../config/session-close.php">Salir</a>
                            </button>
                        </div><!--right notification end-->
                    </div>
                </div>
                <!-- header section end-->

                <div class="container-fluid">
                    <div class="page-head">
                        <h4 class="my-2">Reporte Kardex
                            <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="../movimientosAlm/lista-movimiento">
                                <i class="mdi mdi-view-list"></i>
                            </a>
                        </h4>
                    </div>                   
                    <div class="data-table">
                        <div class="row"><!-- row-->
                            <div class="col-lg-12 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body table-responsive">
                                        <div class="table-odd">
                                            <table border="0" cellspacing="5" cellpadding="5">
                                                    <tbody>
                                                        <tr>
                                                            <td>Fecha Inicio:</td>
                                                            <td><input type="text" id="min" name="min"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fecha Final:</td>
                                                            <td><input type="text" id="max" name="max"></td>
                                                        </tr>
                                                    </tbody>
                                            </table>
                                            <br>
                                            <table id="example" class="display nowrap" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Movimiento</th>
                                                    <th>Producto</th>
                                                    <th>Area</th>
                                                    <th>Empleado</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  while ($rowKar = $datosKar->fetch_assoc()) {?>
                                                <tr>
                                                    <td><?php echo $rowKar['date_created']; ?></td>
                                                    <td><?php echo $rowKar['movimiento']; ?></td>
                                                    <td><?php echo $rowKar['nombreProducto']; ?></td>
                                                    <td><?php echo $rowKar['nombreArea']; ?></td>
                                                    <td><?php echo $rowKar['empleado']; ?></td>
                                                    <td><?php echo $rowKar['cantidad'];?></td>
                                                </tr>
                                                <?php }?>
                                                </tbody>
                                                <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Movimiento</th>
                                                    <th>Producto</th>
                                                    <th>Area</th>
                                                    <th>Empleado</th>
                                                    <th>Cantidad</th>
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
        <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
            <script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

        <!--app js-->
        <script src="../assets/js/jquery.app.js"></script>
        <script type="text/javascript">

            var minDate, maxDate;
        
            // Custom filtering function which will search data in column four between two values
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date( data[0] );
            
                    if (
                        ( min === null && max === null ) ||
                        ( min === null && date <= max ) ||
                        ( min <= date   && max === null ) ||
                        ( min <= date   && date <= max )
                    ) {
                        return true;
                    }
                    return false;
                }
            );
            
            $(document).ready(function() {
                // Create date inputs
                minDate = new DateTime($('#min'), {
                    format: 'MMMM Do YYYY'
                });
                maxDate = new DateTime($('#max'), {
                    format: 'MMMM Do YYYY'
                });
            
                // DataTables initialisation
                var table =  $('#example').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf'
                    ]
                } );
            
                // Refilter the table
                $('#min, #max').on('change', function () {
                    table.draw();
                });
            });

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
