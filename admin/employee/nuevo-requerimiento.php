<?php
    //Sesion
    include("session/employee-session.php");
    //Acceso Denegado
    include("session/access-denied.php");
    //Abrimos conexión
    include("../config/connection.php");
    //Usuarios
    $sqlUsu="SELECT * FROM usuario WHERE idUsuario='$usuarioSesEmp' AND estadoUsuario = 1";
    $datosUsu=mysqli_query($con,$sqlUsu) or die ('Error en el query database');
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
                                <li class="active"><a href="requerimientos/nuevo-requerimiento"> Registrar Requerimientos</a></li>
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
                    <form onsubmit="return validMe()" action="insert.php" method="post">
                        <div class="page-head">
                            <h4 class="my-2">Nuevo Requerimiento
                                <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="lista-requerimiento">
                                    <i class="mdi mdi-view-list"></i>
                                </a>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">                            
                                <div class="card m-b-30">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Usuario</label>
                                                    <select class="form-control" name="usuario" disabled>                                                                                                            
                                                        <?php  while ($rowUsu = $datosUsu->fetch_assoc()) {?>
                                                            <option selected value="<?php echo $rowUsu['idUsuario'];?>"><?php echo $rowUsu['usuario']; ?></option>                                                                                                           
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Fecha del requerimiento</label>
                                                    <input disabled type="date" class="form-control" id="date" name="fecha" required/>
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
                                                <!-- render here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                     
                        </div> <!-- end row -->

                        <div class="form-group mb-0">
                            <div>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                    Guardar
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <a style="color:white;" href="./lista-requerimiento">Cancelar</a>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery-migrate.js"></script>
        <script src="../assets/js/modernizr.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/slidebars.min.js"></script>

        <!-- Select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <!-- Responsive and datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Parsley js -->
        <script type="text/javascript" src="../assets/plugins/parsleyjs/dist/parsley.min.js"></script>

        <!-- Mustache js -->
        <script type="text/javascript" src="../assets/js/mustache.min.js"></script>

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

            addProd();
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
                if (_stock > stock || _stock < 0)
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