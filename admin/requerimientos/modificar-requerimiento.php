<?php
    //Sesion
    include("../config/user-session.php");
    //Acceso Denegado
    include("../config/access-denied.php");
    //Requermiento a modificar
    $id=$_GET['idRequerimiento'];
    $sqlReq="SELECT r.idRequerimiento, r.observacion, r.fecha, r.estadoRequerimiento, e.nombres, e.apellidos, u.idUsuario, e.nombres, e.apellidos FROM detalle_requerimiento d
    INNER JOIN requerimiento r ON r.idRequerimiento = d.idRequerimiento
    INNER JOIN usuario u ON u.idUsuario = r.idUsuario
    INNER JOIN empleado e ON e.idEmpleado = u.idEmpleado
    INNER JOIN producto p ON p.idProducto = d.idProducto
    WHERE d.idRequerimiento = '$id'
    GROUP BY r.idRequerimiento, r.observacion, r.fecha, r.estadoRequerimiento, e.nombres, e.apellidos, r.date_update";
    $datosReq=mysqli_query($con,$sqlReq) or die ('Error en el query database');
    //Usuarios
    $sqlUsu="SELECT * FROM usuario WHERE estadoUsuario = 1";
    $datosUsu=mysqli_query($con,$sqlUsu) or die ('Error en el query database');
    //Productos Detalles
    $sqlProDetalle="SELECT p.idProducto, p.nombreProducto, d.cantidad, p.stock FROM detalle_requerimiento d
    INNER JOIN producto p ON p.idProducto = d.idProducto
    WHERE d.idRequerimiento = '$id'";
    $datosProDetalle=mysqli_query($con,$sqlProDetalle) or die ('Error en el query database');
    //Productos
    $sqlPro="SELECT * FROM producto p 
    INNER JOIN categoria c ON c.idCategoria = p.idCategoria
    INNER JOIN marca m ON m.idMarca = p.idMarca";
    $datosPro=mysqli_query($con,$sqlPro) or die ('Error en el query database');
?>

<?php 
$html_prod_options = "";
while ($rowPro = $datosPro->fetch_assoc())
$html_prod_options .= "<option data-stock='{$rowPro["stock"]}' value='{$rowPro["idProducto"]}'>{$rowPro['idProducto']} - {$rowPro['nombreProducto']}</option>";
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

        <link href="../assets/plugins/morris-chart/morris.css" rel="stylesheet">
        <!-- Theme Css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/slidebars.min.css" rel="stylesheet">
        <link href="../assets/css/icons.css" rel="stylesheet">
        <link href="../assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/style.css" rel="stylesheet">
       
       <!-- Select2 -->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
                        <li class="menu-list"><a href=""><i class="mdi mdi-code-equal"></i> <span>Mov. Almacén</span></a>
                            <ul class="child-list">
                                <li><a href="../movimientosAlm/nuevo-movimiento"> Registrar Mov. Almacén</a></li>
                                <li><a href="../movimientosAlm/lista-movimiento"> Lista de Mov. Almacén</a></li>
                                <li><a href="../movimientosAlm/kardex"> Kardex</a></li>
                            </ul>
                        </li> 
                        <li class="menu-list nav-active active"><a href=""><i class="mdi mdi-codepen"></i> <span>Requerimientos</span></a>
                            <ul class="child-list">
                                <li class="active"><a href="../requerimientos/nuevo-requerimiento"> Registrar Requerimientos</a></li>
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
                    <form onsubmit="return confirm('¿Realmente deseas aceptar el requerimiento?');" action="../actions/requerimiento/update.php" method="post">
                        <?php  while ($rowdetalle = $datosReq->fetch_assoc()) { ?>
                        
                        <?php if($rowdetalle['estadoRequerimiento'] == '1'){?>

                        <div class="page-head">
                            <h4 class="my-2">Nuevo Requerimiento
                                <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="../requerimientos/lista-requerimiento">
                                    <i class="mdi mdi-view-list"></i>
                                </a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">                            
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="form-group">                                            
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idRequerimiento" type="hidden" value="<?php echo $rowdetalle['idRequerimiento'];?>"/>
                                            </div>                                            
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idProducto" type="hidden" value="<?php echo $rowdetalle['idProducto'];?>"/>
                                            </div>                                          
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="fecha" type="hidden" value="<?php echo $rowdetalle['fecha'];?>"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Usuario</label>
                                                    <select class="form-control" name="usuario" disabled>
                                                        <option selected value="<?php echo $rowdetalle['idUsuario'];?>"><?php echo $rowdetalle['nombres'].' '.$rowdetalle['apellidos']; ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Fecha del requerimiento</label>
                                                    <input type="date" class="form-control" disabled value="<?php echo $rowdetalle['fecha'];?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">                                                    
                                                    <label>Observación</label>
                                                    <div>
                                                        <input required type="text" class="form-control" name="observacion" value="<?php echo $rowdetalle['observacion'];?>"></input>
                                                    </div>
                                                </div>                             
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-lg-6 col-sm-12">                            
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <a href="javascript:;" style="margin-left: 0.8em;" class="btn btn-sm btn-danger" onclick="addProd()">Agregar Producto <i class="fa fa-plus" ></i></a>
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th> Producto </th>
                                                    <th> Cantidad </th>
                                                    <th> Stock </th>
                                                    <th> Acc. </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tDetail" > 
                                                <?php  while ($rowProDetalle = $datosProDetalle->fetch_assoc()) {?>                                               
                                                <tr>
                                                    <td>  
                                                    <select class="js-product form-control" style="height: 4em;" name="items[producto][]">    
                                                        <option value="<?php echo $rowProDetalle['idProducto']; ?>"><?php echo $rowProDetalle['idProducto'].' - '.$rowProDetalle['nombreProducto']; ?></option>
                                                    </select>    
                                                    </td>
                                                    <td>
                                                    <input type="number" style="width: 4em;" class="form-control" name="items[cantidad][]" value="<?php echo $rowProDetalle['cantidad']; ?>"/>
                                                    </td>
                                                    <td>
                                                    <?php if ($rowProDetalle['stock'] == 0) {
                                                        ?> 
                                                        <span class="badge badge-danger"><?php echo $rowProDetalle['stock']; ?></span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-success"><?php echo $rowProDetalle['stock']; ?></span>
                                                    <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-danger" onclick="remProd(this)" href="javascript:;" ><i class="fa fa-remove" ></i></a>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>      

                        </div> <!-- end row -->   

                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Aceptar
                                </button>
                                <a type="button" style="color: white;" data-toggle="modal" data-target="#exampleModalform" class="btn btn-danger waves-effect waves-light">
                                    Rechazar
                                </a>
                            </div>
                        </div>

                        <?php } else { ?>

                            <div class="page-head">
                            <h4 class="my-2">Nuevo Requerimiento
                                <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="../requerimientos/lista-requerimiento">
                                    <i class="mdi mdi-view-list"></i>
                                </a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">                            
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="form-group">                                            
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idRequerimiento" type="hidden" value="<?php echo $rowdetalle['idRequerimiento'];?>"/>
                                            </div>                                            
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idProducto" type="hidden" value="<?php echo $rowdetalle['idProducto'];?>"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Usuario</label>
                                                    <select class="form-control" name="usuario" disabled>
                                                        <option selected value="<?php echo $rowdetalle['idUsuario'];?>"><?php echo $rowdetalle['nombres'].' '.$rowdetalle['apellidos']; ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Fecha del requerimiento</label>
                                                    <input disabled type="date" class="form-control" name="fecha" value="<?php echo $rowdetalle['fecha'];?>"/>
                                                </div>  
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">                                                    
                                                    <label>Observación</label>
                                                    <div>
                                                        <input disabled type="text" class="form-control" name="observacion" value="<?php echo $rowdetalle['observacion'];?>"></input>
                                                    </div>
                                                </div>                             
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-lg-6 col-sm-12">                            
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th> Producto </th>
                                                    <th> Cantidad </th>
                                                    <th> Stock </th>
                                                    <th> Acc. </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tDetail" > 
                                                <?php  while ($rowProDetalle = $datosProDetalle->fetch_assoc()) {?>                                               
                                                <tr>
                                                    <td>  
                                                    <select class="js-product form-control" style="height: 4em;" name="items[producto][]" disabled>    
                                                        <option value="<?php echo $rowProDetalle['idProducto']; ?>"><?php echo $rowProDetalle['idProducto'].' - '.$rowProDetalle['nombreProducto']; ?></option>
                                                    </select>    
                                                    </td>
                                                    <td>
                                                    <input disabled type="number" style="width: 4em;" class="form-control" name="items[cantidad][]" value="<?php echo $rowProDetalle['cantidad']; ?>"/>
                                                    </td>
                                                    <td>
                                                    <?php if ($rowProDetalle['stock'] == 0) {
                                                        ?> 
                                                        <span class="badge badge-danger"><?php echo $rowProDetalle['stock']; ?></span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="badge badge-success"><?php echo $rowProDetalle['stock']; ?></span>
                                                    <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a disabled style="color:white;" class="btn btn-sm btn-danger" onclick="return notDelete();" ><i class="fa fa-remove" ></i></a>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>      

                        </div> <!-- end row -->   

                        <div class="form-group mb-0">
                            <div>
                                <a class="btn btn-danger waves-effect waves-light" style="color:white;" href="lista-requerimiento"> Volver </a>
                            </div>
                        </div>

                        <?php } ?>
                        
                        <?php }?>                         
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

        <!-- Responsive and datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Mustache js -->
        <script type="text/javascript" src="../assets/js/mustache.min.js"></script>

        <!-- Select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <!-- Parsley js -->
        <script type="text/javascript" src="../assets/plugins/parsleyjs/dist/parsley.min.js"></script>

        <!--app js-->
        <script src="../assets/js/jquery.app.js"></script>

        <script type="text/javascript">

            $(document).ready(function() {
                $('form').parsley();
            });

            $(document).ready(function() {
                $('#datatable').DataTable(),
                $('#datatable2').DataTable();  
            } );

           
            
            window.onload = function(){
            var fecha = new Date();
            var mes = fecha.getMonth()+1;
            var dia = fecha.getDate();
            var ano = fecha.getFullYear();
            if(dia<10)
                dia='0'+dia;
            if(mes<10)
                mes='0'+mes;
            document.getElementById('date').value=ano+"-"+mes+"-"+dia;
            };


            function addProd() {
                var hop = "<?= $html_prod_options ?>";
                var hrow = Mustache.render($("#tplDetailRow").html(), { prod_options: hop } );
                $("#tDetail").append(hrow);
                setTimeout(() => {
                    $('.js-product').select2(); 
                }, 100);
            }

            function remProd(ele) {
                row = $(ele).closest("tr");
                $(row).remove();

            }

        </script>

        <script type="text/javascript">       
            $('.js-product').select2();

            $('.js-users').select2();
        </script>

        <script id="tplDetailRow" type="text/html" >
            <tr>
                <td>  
                <select class="js-product form-control" style="height: 4em;" name="items[producto][]" required>    
                    <option selected disabled hidden>- Seleccionar -</option>                                                                                                                                                                   
                    {{{prod_options}}}
                </select>    
                </td>
                <td>
                <input type="number" style="width: 4em;" class="form-control" placeholder="0" name="items[cantidad][]" required/>
                </td>
                <td class="text-center">
                    <span  class="lblStock badge {{#nostock}}badge-danger{{/nostock}}{{^nostock}}badge-success{{/nostock}}"  >{{stock}}</span>
                </td>
                <td>
                    <a class="btn btn-sm btn-danger" onclick="remProd(this)" href="javascript:;" ><i class="fa fa-remove" ></i></a>
                </td>
            </tr>

        </script>
    </body>
</html>

<script language="JavaScript" type="text/javascript">

    function validMe() {
        var flag = true;
        $("#tDetail tr").each(function(i, e) {
            var qty = parseFloat( $(e).find("input[name*='items[cantidad]']").val() || .0);
            var stock = parseFloat( $(e).find("select[name*='items[producto]']").find("option:selected").data("stock") || .0);

            if ($.isEmptyObject(  $(e).find("select[name*='items[producto]']").val() )  ) {
                alert ("Debe seleccionar un producto en el detalle.");
                flag = false;
                return false;
            }


            if (qty == 0) {
                alert ("Debe ingresar la cantidad de producto.");
                flag = false;
                return false;
            }

          
            if ( qty > stock ) {                
                alert ("La cantidad no debe superar al stock actual del producto, verifique en el detalle de los items.");
                flag = false;
                return false;
            }
        });

        if (!flag) return false;
        
        return confirm('¿Realmente deseas guardar el requerimiento?');
    }

    $(document).ready(function () {

        $(document).on("change", "input[name*='items[cantidad]'], select[name*='items[producto]']", function() {

            if ( $(this).is("input") ) {
                var stock = parseFloat( $(this).closest("tr").find("select[name*='items[producto]']").find("option:selected").data("stock") || .0);
                var _stock = parseFloat($(this).val() || .0);
                if (_stock < 0)
                    $(this).val(stock);   
            } else {
                //console.log($(this));
                var vStock = parseFloat( $(this).find("option:selected").data("stock") || .0);
                
                $(this).closest("tr").find(".lblStock").text( vStock  ).removeClass("badge-success badge-danger");
                if (vStock<=0)
                    $(this).closest("tr").find(".lblStock").addClass("badge-danger");
                else
                    $(this).closest("tr").find(".lblStock").addClass("badge-success");
                

                $(this).closest("tr").find("input[name*='items[cantidad]']").val("").focus();
            }
            
        });


    });
    
</script>


<form onsubmit="return confirm('Este requerimiento sera eliminado. ¿Aceptar?');" action="../actions/requerimiento/decline.php" method="post">
    <!-- Modal -->
    <?php
        //Sesion
        include("../config/user-session.php");
        //Requermiento a rechazar
        $sqlReq__="SELECT r.idRequerimiento, r.observacion, r.fecha, r.estadoRequerimiento, e.nombres, e.apellidos, u.idUsuario, e.nombres, e.apellidos FROM detalle_requerimiento d
        INNER JOIN requerimiento r ON r.idRequerimiento = d.idRequerimiento
        INNER JOIN usuario u ON u.idUsuario = r.idUsuario
        INNER JOIN empleado e ON e.idEmpleado = u.idEmpleado
        INNER JOIN producto p ON p.idProducto = d.idProducto
        WHERE d.idRequerimiento = '$id'
        GROUP BY r.idRequerimiento, r.observacion, r.fecha, r.estadoRequerimiento, e.nombres, e.apellidos, r.date_update";
        $datosReq__=mysqli_query($con,$sqlReq__) or die ('Error en el query database');
    ?>
    <div class="modal fade" id="exampleModalform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Por qué estas rechazando este requerimiento?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                     
                    <?php  while ($rowReqD = $datosReq__->fetch_assoc()) {?>
                    <div class="form-group">
                        <input type="hidden" id="field-3" class="form-control" name="idRequerimiento" value="<?php echo $rowReqD['idRequerimiento']; ?>"/>
                    </div>                       
                    <?php }?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" name="observacion" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>                                          
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-danger">Rechazar</button>
                </div>
            </div>
        </div>
    </div>   
</form>
