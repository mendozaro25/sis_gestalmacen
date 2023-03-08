<?php
    //Sesion
    include("../config/user-session.php");
    //Acceso Denegado
    include("../config/access-denied.php");
    //Abrimos conexión
    include("../config/connection.php");
    //Productos
    $sqlPro="SELECT * FROM producto p 
    INNER JOIN categoria c ON c.idCategoria = p.idCategoria
    INNER JOIN marca m ON m.idMarca = p.idMarca";
    $datosPro=mysqli_query($con,$sqlPro) or die ('Error en el query database');
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
                        <li class="menu-list nav-active active"><a href=""><i class="mdi mdi-buffer"></i> <span>Productos</span></a>
                            <ul class="child-list">
                                <li><a href="../productos/nuevo-producto"> Registrar productos</a></li>
                                <li class="active"><a href="../productos/lista-producto"> Lista de productos</a></li>
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
                        <h4 class="my-2">Lista de Productos
                            <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="../productos/nuevo-producto">
                                <i class="ti-plus"></i>
                            </a>
                        </h4>
                    </div>                   
                    <div class="data-table">
                    <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body table-responsive">
                                        <div class="table-odd">
                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Nombre del Producto</th>
                                                    <th>Categoria</th>
                                                    <th>Marca</th>
                                                    <th>Precio del Prod.</th>
                                                    <th>Stock</th>
                                                    <th>¿Stock Min?</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  while ($row = $datosPro->fetch_assoc()) {?>
                                                <tr>
                                                    <td><?php echo $row['nombreProducto']; ?></td>
                                                    <td><?php echo $row['nombreCategoria']; ?></td>
                                                    <td><?php echo $row['nombreMarca']; ?></td>
                                                    <td><?php echo 's/. '.number_format($row['precio'], 2, '.', ' '); ?></td>                                                  
                                                    <?php
                                                        if($row['stock']=='0'){
                                                            ?>
                                                            <td><span class="badge badge-danger"><?php echo $row['stock']; ?></span></td>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <td><span class="badge badge-success"><?php echo $row['stock']; ?></span></td>
                                                            <?php
                                                        }
                                                    ?>
                                                        </td>
                                                            <?php
                                                                if($row['stock'] <= $row['stockMin']){
                                                                    ?>
                                                                    <td style="color: red; font-weight: 600;">El stock del producto es inferior a su stock minimo (<?php echo $row['stockMin'];?>).</td>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <td style="color: black; font-weight: 600;">El stock del producto es superior a su stock minimo (<?php echo $row['stockMin'];?>).</td>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                    <?php
                                                        if($row['estadoProducto']=='1'){
                                                            ?>
                                                            <td style="color: green; font-weight: 900;" >Activo</td>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <td style="color: red; font-weight: 900;" >Inactivo</td>
                                                            <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a type="button" class="tabledit-edit-button btn btn-sm btn-info" href="./modificar-producto?idProducto=<?php echo $row['idProducto'];?>">
                                                                <span class="ti-pencil" style="color: white;"></span>
                                                            </a>
                                                            <a type="button" onclick="return confirmDelete();" class="tabledit-delete-button btn btn-sm btn-danger" href="../actions/producto/delete.php?idProducto=<?php echo $row['idProducto'];?>">
                                                                <span class="ti-trash" style="color: white;"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                                </tbody>
                                                <thead>
                                                <tr>
                                                    <th>Nombre del Producto</th>
                                                    <th>Categoria</th>
                                                    <th>Marca</th>
                                                    <th>Precio del Prod.</th>
                                                    <th>Stock</th>
                                                    <th>¿Stock Min?</th>
                                                    <th>Estado</th>
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

        <script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"></script>

        <!--app js-->
        <script src="../assets/js/jquery.app.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                    }
                }); 
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
