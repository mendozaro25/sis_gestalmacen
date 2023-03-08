<?php
//Sesion
include("session/grocer-session.php");
//Acceso Denegado
include("session/access-denied.php");
//Usuarios Recientes
$sqlUsu="SELECT * FROM usuario u 
INNER JOIN empleado e ON e.idEmpleado = u.idEmpleado
INNER JOIN area a ON a.idArea = e.idArea
INNER JOIN cargo c ON c.idCargo = e.idCargo
WHERE u.estadoUsuario = 1
ORDER BY u.date_created DESC
LIMIT 5";
$datosUsu=mysqli_query($con,$sqlUsu) or die ('Error en el query database');
//Productos Recientes
$sqlPro="SELECT * FROM producto p 
INNER JOIN categoria c ON c.idCategoria = p.idCategoria
INNER JOIN marca m ON m.idMarca = p.idMarca
WHERE p.estadoProducto = 1
ORDER BY p.date_created DESC
LIMIT 5";
$datosPro=mysqli_query($con,$sqlPro) or die ('Error en el query database');
//Consultas - Box
//Cantidad Movimientos de Almacen
$sqlMov = "SELECT count(idMovAlmacen) as cantidadMov FROM mov_almacen";
$cantidadMov = mysqli_query($con,$sqlMov) or die ('Error en el query database');
//Cantidad Requerimientos
$sqlReq = "SELECT count(idRequerimiento) as cantidadReq FROM requerimiento";
$cantidadReq = mysqli_query($con,$sqlReq) or die ('Error en el query database');
//Cantidad Productos
$sqlPro2 = "SELECT count(idProducto) as cantidadPro FROM producto";
$cantidadPro = mysqli_query($con,$sqlPro2) or die ('Error en el query database');
//Cantidad Usuarios
$sqlUsu2 = "SELECT count(idUsuario) as cantidadUsu FROM usuario";
$cantidadUsu = mysqli_query($con,$sqlUsu2) or die ('Error en el query database');
//Requerimientos Recientes
$sqlReq_ = "SELECT r.idRequerimiento, concat(e.nombres,' ',e.apellidos) as empleado, a.nombreArea, r.estadoRequerimiento, r.date_created
            FROM requerimiento r
            LEFT JOIN usuario u ON u.idUsuario = r.idUsuario
            LEFT JOIN empleado e ON e.idEmpleado = u.idEmpleado
            LEFT JOIN area a ON a.idArea = e.idArea
            WHERE r.estadoRequerimiento = 1
            ORDER BY r.date_created DESC
            LIMIT 5";
$datosReq = mysqli_query($con,$sqlReq_) or die ('Error en el query database');
//Usuarios que más requerimientos realizan
$sqlUsuReq_ = "SELECT COUNT(r.idRequerimiento) as requerimientos, CONCAT(e.nombres,' ',e.apellidos) as empleados, a.nombreArea as area, c.nombreCargo as cargo, u.date_created as fecha
                FROM requerimiento r
                LEFT JOIN usuario u ON u.idUsuario = r.idUsuario
                LEFT JOIN empleado e ON e.idEmpleado = u.idEmpleado
                LEFT JOIN area a ON a.idArea = e.idArea
                LEFT JOIN cargo c ON c.idCargo = e.idCargo
                GROUP BY empleados, a.nombreArea, c.nombreCargo, u.date_created
                ORDER BY requerimientos DESC
                LIMIT 3";
$datosUsuReq = mysqli_query($con,$sqlUsuReq_) or die ('Error en el query database');
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
                        <li class="active">
                            <a href="index"><i class="mdi mdi-gauge"></i> <span>Inicio</span></a>
                        </li>                      
                        <li>
                            <a href="profile"><i class="mdi mdi-account-circle"></i> <span>Mi Perfil</span></a>
                        </li>
                        <li>
                            <h3 class="navigation-title">Gestión</h3>
                        </li>
                        <li class="menu-list"><a href=""><i class="mdi mdi-code-equal"></i> <span>Mov. Almacén</span></a>
                            <ul class="child-list">
                                <li><a href="nuevo-movimiento"> Registrar Mov. Almacén</a></li>
                                <li><a href="lista-movimiento"> Lista de Mov. Almacén</a></li>
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
                        <h4 class="my-2">Inicio</h4>
                    </div>                    
                    
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3">
                                   <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowMov = $cantidadMov->fetch_assoc()) {?>
                                        <a style="color: black;" href="lista-movimiento">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti-eye"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowMov['cantidadMov']; ?></h2>
                                                    <p>Movimientos</p> 
                                                </div>
                                            </div>
                                        </a>                                                        
                                        <?php }?>
                                   </div> 
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                   <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowReq = $cantidadReq->fetch_assoc()) {?>
                                        <a style="color: black;" href="lista-requerimiento">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti ti-wallet"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowReq['cantidadReq']; ?></h2>
                                                    <p>Requerimientos</p> 
                                                </div>
                                            </div>
                                        </a>                                                        
                                        <?php }?>
                                   </div> 
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowPro = $cantidadPro->fetch_assoc()) {?>
                                        <a style="color: black;" href="#">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti-layers-alt"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowPro['cantidadPro']; ?></h2>
                                                    <p>Productos</p> 
                                                </div>
                                            </div>
                                        </a>                                                        
                                        <?php }?>
                                   </div> 
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="widget-box bg-white m-b-30">
                                        <?php  while ($rowUsu = $cantidadUsu->fetch_assoc()) {?>
                                        <a style="color: black;" href="#">
                                            <div class="row d-flex align-items-center text-center">
                                                <div class="col-4">
                                                    <div class="text-center"><i class="ti-user"></i></div>
                                                </div>
                                                <div class="col-4">
                                                    <h2 class="m-0 counter"><?php echo $rowUsu['cantidadUsu']; ?></h2>
                                                    <p>Usuarios</p> 
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
                                    <h5 class="header-title pb-3">Requerimientos recientes</h5>           
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover m-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Empleado</th>
                                                            <th>Nombre del Área</th>
                                                            <th>Estado</th>
                                                            <th>Fecha</th>
                                                            <th>Ir al Requerimiento</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php  while ($rowReq_ = $datosReq->fetch_assoc()) {?>
                                                    <tr>
                                                        <td><?php echo $rowReq_['empleado']; ?></td>
                                                        <td><?php echo $rowReq_['nombreArea']; ?></td>
                                                        <?php
                                                        if($rowReq_['estadoRequerimiento']=='1')
                                                            ?>
                                                            <td style="color: orange; font-weight: 600;" >Registrado</td>
                                                            <?php
                                                        ?>
                                                        <td><?php echo $rowReq_['date_created']; ?></td>  
                                                        <td>
                                                            <div>
                                                                <a type="button" class="btn btn-sm btn-danger" href="modificar-requerimiento?idRequerimiento=<?php echo $rowReq_['idRequerimiento'];?>">
                                                                    <span class="ti-arrow-right" style="color: white;"></span>
                                                                </a>
                                                            </div>
                                                        </td>                                                
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
                        <div class="col-lg-6 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title pb-3">Requerimientos X Usuarios</h5>           
                                    <canvas id="reqXusu"></canvas>              
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title pb-3">Los productos más solicitados</h5>           
                                    <canvas id="prodSol"></canvas>              
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row"><!-- row-->
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title pb-3">Los usuarios que más requerimientos realizan</h5>           
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover m-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Area</th>
                                                            <th>Cargo</th>
                                                            <th>Requerimientos</th>
                                                            <th>F. Registro</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php  while ($rowUsuReq = $datosUsuReq->fetch_assoc()) {?>
                                                    <tr>
                                                        <td><?php echo $rowUsuReq['empleados']; ?></td>
                                                        <td><?php echo $rowUsuReq['area']; ?></td>
                                                        <td><?php echo $rowUsuReq['cargo']; ?></td>
                                                        <td><?php echo $rowUsuReq['requerimientos']; ?></td>
                                                        <td><?php echo $rowUsuReq['fecha']; ?></td>                                                      
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
                                    <h5 class="header-title pb-3">Usuarios Recientes</h5>           
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover m-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Empleado</th>
                                                            <th>Area</th>
                                                            <th>Cargo</th>
                                                            <th>Usuario</th>
                                                            <th>Dni</th>
                                                            <th>Telefono</th>
                                                            <th>Dirección</th>
                                                            <th>F. Registro</th>
                                                            <th>Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  while ($row = $datosUsu->fetch_assoc()) {?>
                                                        <tr>
                                                            <td><?php echo $row['nombres'].' '.$row['apellidos']; ?></td>
                                                            <td><?php echo $row['nombreArea']; ?></td>
                                                            <td><?php echo $row['nombreCargo']; ?></td>
                                                            <td><?php echo $row['usuario']; ?></td>
                                                            <td><?php echo $row['dni']; ?></td>
                                                            <td><?php echo $row['telefono']; ?></td>
                                                            <td><?php echo $row['direccion']; ?></td>
                                                            <td><?php echo $row['date_created']; ?></td>
                                                            <td><?php echo $row['email']; ?></td>
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
                
        <!--Chart js-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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




<script type="text/javascript">
    // Append '4d' to the colors (alpha channel), except for the hovered index
    function handleHover(evt, item, legend) {
        legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
            colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
        });
        legend.chart.update();
    }

    // Removes the alpha channel from background colors
    function handleLeave(evt, item, legend) {
        legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
            colors[index] = color.length === 9 ? color.slice(0, -2) : color;
        });
        legend.chart.update();
    }
    
    const reqXusu = document.getElementById('reqXusu');
    const prodSol = document.getElementById('prodSol');
    
    $(document).ready(function(){
        $.ajax({
            url: "http://sis_gestalmacen.test/admin/actions/charts/reqXusu.php",
            method: "GET",
            success: function(data){
                console.log(data);
                var user = [];
                var req = [];

                for (var i in data){
                    user.push(data[i].usuarios);
                    req.push(data[i].requerimientos);
                }

                
                new Chart(reqXusu, {
                    type: 'pie',
                    data: {
                    labels: user,
                    datasets: [{
                        label: 'Requerimientos',
                        data: req,                        
                        backgroundColor: ['#B23939', '#B28E39', '#40B239', '#39B295', '#396BB2', '#8439B2', '#B2397B'],
                        hoverBackgroundColor: '#CFCFCF',
                        borderWidth: 3
                    }]
                    },options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                onHover: handleHover,
                                onLeave: handleLeave
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    $(document).ready(function(){
        $.ajax({
            url: "http://sis_gestalmacen.test/admin/actions/charts/prodMasSo.php",
            method: "GET",
            success: function(data){
                console.log(data);
                var prod = [];
                var sol = [];

                for (var i in data){
                    prod.push(data[i].producto);
                    sol.push(data[i].requerimientos);
                }

                
                new Chart(prodSol, {
                    type: 'pie',
                    data: {
                    labels: prod,
                    datasets: [{
                        label: 'Solicitudes',
                        data: sol,                        
                        backgroundColor: ['#5A7D77', '#1C034D', '#034D3B', '#144D03', '#4D4203', '#4D1903', '#6D8CD9'],
                        hoverBackgroundColor: '#CFCFCF',
                        borderWidth: 3
                    }]
                    },options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                onHover: handleHover,
                                onLeave: handleLeave,
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>


                    
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