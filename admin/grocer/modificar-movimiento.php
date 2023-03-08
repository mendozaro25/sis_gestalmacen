<?php
    //Sesion
    include("session/grocer-session.php");
    //Acceso Denegado
    include("session/access-denied.php");
    //Mov_Almacen a modificar
    $id=$_GET['idMovAlmacen'];
    $sqlMov="SELECT d.idMovAlmacen, m.fechaMov, m.estadoMov, m.tipoMov, m.movimiento, m.tipoDoc, m.numDoc, m.nombreRazon, m.observacionMov, m.pecosa, m.pdf FROM detalle_mov_almacen d
    LEFT JOIN mov_almacen m ON m.idMovAlmacen = d.idMovAlmacen
    WHERE d.idMovAlmacen = '$id'    
    GROUP BY d.idMovAlmacen, m.fechaMov, m.estadoMov, m.tipoMov, m.Movimiento, m.tipoDoc, m.numDoc, m.nombreRazon, m.observacionMov, m.pecosa";
    $datosMov=mysqli_query($con,$sqlMov) or die ('Error en el query database');
    //Usuario del Detalle
    $sqlUsuDetalle="SELECT e.nombres, e.apellidos, a.nombreArea FROM detalle_mov_almacen d
    LEFT JOIN mov_almacen m ON m.idMovAlmacen = d.idMovAlmacen
    LEFT JOIN requerimiento r ON r.idRequerimiento = m.idRequerimiento
    LEFT JOIN usuario u ON u.idUsuario = r.idUsuario
    LEFT JOIN empleado e ON e.idEmpleado = u.idEmpleado
    LEFT JOIN area a ON a.idArea = e.idArea
    WHERE d.idMovAlmacen = '$id'
    GROUP BY e.nombres, e.apellidos, a.nombreArea";
    $datosUsuarioDetalle=mysqli_query($con,$sqlUsuDetalle) or die ('Error en el query database');
    //Usuarios
    $sqlUsu="SELECT * FROM usuario WHERE idUsuario='$usuarioSes' AND estadoUsuario = 1";
    $datosUsu=mysqli_query($con,$sqlUsu) or die ('Error en el query database');
    //Productos Detalles
    $sqlProDetalle="SELECT p.idProducto, p.nombreProducto, d.cantidad, p.stock FROM detalle_mov_almacen d
    INNER JOIN producto p ON p.idProducto = d.idProducto
    WHERE d.idMovAlmacen = '$id'";
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
$html_prod_options .= "<option value='{$rowPro["idProducto"]}'>{$rowPro['idProducto']} - {$rowPro['nombreProducto']} - stock: {$rowPro['stock']}</option>";
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
	    
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

        <link href="../assets/plugins/morris-chart/morris.css" rel="stylesheet">

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
                                <li class="active"><a href="nuevo-movimiento"> Registrar Mov. Almacén</a></li>
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
                                <a style="color: white;" href="session/session-close.php">Salir</a>
                            </button>
                        </div><!--right notification end-->
                    </div>
                </div>
                <!-- header section end-->

                <div class="container-fluid">
                    <form onsubmit="return confirm('¿Realmente deseas modificar el movimiento?');" action="updateMov.php" method="post">
                        <?php  while ($rowdetalle = $datosMov->fetch_assoc()) {?>
                        <div class="page-head">
                            <h4 class="my-2">Nuevo Movimiento de Almacén
                                <a style="margin-bottom: 4px;" class="btn btn-sm btn-danger" href="lista-movimiento">
                                    <i class="mdi mdi-view-list"></i>
                                </a>
                                <a style="margin-bottom: 4px; color: white;" type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModalform">
                                    Eliminar movimiento
                                </a>
                            </h4>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="form-group">                                         
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idMovAlmacen" type="hidden" value="<?php echo $rowdetalle['idMovAlmacen'];?>"/>
                                            </div>                                            
                                            <div class="col-lg-1">
                                                <input class="form-control" readonly="readonly" name="idProducto" type="hidden" value="<?php echo $rowdetalle['idProducto'];?>"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Fecha del movimiento</label>
                                                    <input disabled type="date" class="form-control" name="fecha" value="<?php echo $rowdetalle['fechaMov'];?>"/>
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                    <label>Estado del Movimiento</label>
                                                    <select class="form-control" name="estado">
                                                        <option value="<?php echo $rowdetalle['estadoMov'];?>" selected hidden>
                                                        <?php
                                                            if($rowdetalle['estadoMov']=='1'){
                                                                ?>
                                                                <td style="color: black;" >Activo</td>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <td style="color: black;" >Inactivo</td>
                                                                <?php
                                                            }
                                                        ?>
                                                        </option>
                                                        <option value="1">Activo</option>
                                                        <option value="2">Desactivado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if($rowdetalle['movimiento']=='eRequerimiento') {?>
                                            <div class="form-group">                                            
                                            <?php  while ($rowUsuDetalle = $datosUsuarioDetalle->fetch_assoc()) {?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Area</label>
                                                    <input disabled type="text" class="form-control" name="fecha" value="<?php echo $rowUsuDetalle['nombreArea'];?>"/>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Usuario</label>
                                                    <input disabled type="text" class="form-control" name="fecha" value="<?php echo $rowUsuDetalle['nombres'].' '.$rowUsuDetalle['apellidos'];?>"/>
                                                </div>
                                            </div>                                            
                                            <?php } ?>
                                            </div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">                                                    
                                                    <label>Tipo de Movimiento</label>
                                                    <select class="form-control" name="tipoMov" disabled>
                                                        <option value="<?php echo $rowdetalle['tipoMov'];?>" selected>
                                                        <?php
                                                            if($rowdetalle['tipoMov']=='ingresos'){
                                                                ?>
                                                                <td style="color: black;" >Ingreso</td>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <td style="color: black;" >Egreso</td>
                                                                <?php
                                                            }
                                                        ?>
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">                                                    
                                                    <label>Movimiento</label>
                                                    <select class="form-control" name="movimiento" disabled>
                                                        <option value="<?php echo $rowdetalle['movimiento'];?>" selected >
                                                        <?php
                                                            if($rowdetalle['movimiento']=='iCompra'){
                                                                ?>
                                                                <td style="color: black;" >Compra</td>
                                                                <?php
                                                            }
                                                            if($rowdetalle['movimiento']=='iSedCen'){
                                                                ?>
                                                                <td style="color: black;" >Sede Central</td>
                                                                <?php
                                                            }if($rowdetalle['movimiento']=='iAjuste'){
                                                                ?>
                                                                <td style="color: black;" >Ajuste de Stock</td>
                                                                <?php
                                                            }if($rowdetalle['movimiento']=='iOtros'){
                                                                ?>
                                                                <td style="color: black;" >Otros Ingresos</td>
                                                                <?php
                                                            }if($rowdetalle['movimiento']=='eRequerimiento'){
                                                                ?>
                                                                <td style="color: black;" >Requerimiento de Usuario</td>
                                                                <?php
                                                            }if($rowdetalle['movimiento']=='eProDef'){
                                                                ?>
                                                                <td style="color: black;" >Productos Defectuosos</td>
                                                                <?php
                                                            }if($rowdetalle['movimiento']=='eAjuste'){
                                                                ?>
                                                                <td style="color: black;" >Ajuste de Stock</td>
                                                                <?php
                                                            }if($rowdetalle['movimiento']=='eOtros'){
                                                                ?>
                                                                <td style="color: black;" >Otros Egresos</td>
                                                                <?php
                                                            }
                                                        ?>                                                            
                                                        </option>
                                                    </select>
                                                </div> 

                                            </div>
                                        </div>

                                        <?php if($rowdetalle['movimiento']=='iCompra'){?>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">                                                    
                                                        <label>Tipo de Documento</label>
                                                        <select class="form-control" name="tipoDoc">
                                                            <option value="<?php echo $rowdetalle['tipoDoc'];?>" selected hidden>
                                                            <?php
                                                                if($rowdetalle['tipoDoc']=='ruc'){
                                                                    ?>
                                                                    <td style="color: black;" >RUC</td>
                                                                    <?php
                                                                }if($rowdetalle['tipoDoc']=='dni'){
                                                                    ?>
                                                                    <td style="color: black;" >DNI</td>
                                                                    <?php
                                                                }if($rowdetalle['tipoDoc']=='otros'){
                                                                    ?>
                                                                    <td style="color: black;" >Otros</td>
                                                                    <?php
                                                                }if($rowdetalle['tipoDoc'] == ''){
                                                                    ?>
                                                                    <td style="color: black;" >- Seleccionar -</td>
                                                                    <?php                                                               
                                                                }
                                                            ?>
                                                            </option>
                                                            <option value="ruc">RUC</option>
                                                            <option value="dni">DNI</option>
                                                            <option value="otros">Otros</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">                                                    
                                                        <label>Número de Documento</label>
                                                        <?php
                                                        if($rowdetalle['numDoc'] == ''){
                                                            ?>
                                                            <input type="text" class="form-control" maxlength="11" name="numero" placeholder="0000000000"/>
                                                            <?php                                                               
                                                        }else{
                                                            ?>
                                                            <input type="text" class="form-control" maxlength="11" name="numero" value="<?php echo $rowdetalle['numDoc'];?>"  />
                                                            <?php 
                                                        }
                                                        ?>
                                                    </div>                                 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-8">                                                    
                                                        <label>Nombre/Rázon</label>
                                                        <?php
                                                        if($rowdetalle['nombreRazon'] == ''){
                                                            ?>
                                                            <input type="text" class="form-control" name="nombreRazon" placeholder="Manzanas SAC"/>
                                                            <?php                                                               
                                                        }else{
                                                            ?>
                                                            <input type="text" class="form-control" name="nombreRazon" value="<?php echo $rowdetalle['nombreRazon'];?>"  />
                                                            <?php 
                                                        }
                                                        ?>
                                                    </div> 
                                                    <div class="col-lg-4">                                                    
                                                        <label>Archivo (.pdf)</label> <br>
                                                        <a type="button" class="tabledit-edit-button btn btn-sm btn-danger" target="_blank"
                                                            href="../movimientosAlm/pdf/<?php echo $rowdetalle['pdf'];?>">
                                                            <span class="mdi mdi-file-pdf" style="color: white;"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>

                                        <?php if($rowdetalle['movimiento']=='iSedCen'){?>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">                                                    
                                                        <label>Número de Pecosa</label>
                                                        <input type="text" class="form-control" name="pecosa" value="<?php echo $rowdetalle['pecosa'];?>"/>
                                                    </div>  
                                                    <div class="col-lg-6">                                                    
                                                        <label>Archivo (.pdf)</label> <br>
                                                        <a type="button" class="tabledit-edit-button btn btn-sm btn-danger" target="_blank"
                                                            href="../movimientosAlm/pdf/<?php echo $rowdetalle['pdf'];?>">
                                                            <span class="mdi mdi-file-pdf" style="color: white;"></span>
                                                        </a>
                                                    </div>                               
                                                </div>
                                            </div>
                                        <?php }?>
                                            
                                        <div class="form-group">
                                            <label>Observación</label>
                                            <div>
                                                <input type="text" class="form-control" name="observacion" value="<?php echo $rowdetalle['observacionMov'];?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            
                            <div class="col-lg-6 col-sm-12">                            
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th width="90%"> Producto </th>
                                                    <th> Cantidad </th>
                                                    <th> Stock </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tDetail" > 
                                                <?php  while ($rowProDetalle = $datosProDetalle->fetch_assoc()) {?>                                               
                                                <tr>
                                                    <td>  
                                                    <select class="js-product form-control" style="height: 4em;" name="items[producto][]" disabled>    
                                                        <option value="<?php echo $rowProDetalle['idProducto']; ?>"><?php echo $rowProDetalle['idProducto'].' - '.$rowProDetalle['nombreProducto'].' - stock: '.$rowProDetalle['stock']; ?></option>
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
                                <button type="submit" class="btn btn-danger waves-effect waves-light">
                                    Guardar
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Limpiar
                                </button>
                                <button class="btn btn-primary waves-effect waves-light">
                                    <a style="color:white;" href="./lista-movimiento">Cancelar</a>
                                </button>
                            </div>
                        </div>                       

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

        <!-- Mustache js -->
        <script type="text/javascript" src="../assets/js/mustache.min.js"></script>

        <!-- Select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <!-- Parsley js -->
        <script type="text/javascript" src="assets/plugins/parsleyjs/dist/parsley.min.js"></script>

        <!-- Responsive and datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!--app js-->
        <script src="../assets/js/jquery.app.js"></script>
        <script>
            $(document).ready(function() {
                $('form').parsley();
            });

            $(document).ready(function() {
                $('#datatable').DataTable(),
                $('#datatable2').DataTable();  
            } );

            $( function() {
                $("#id_Mov").change( function() {
                    if ($(this).val() === "iCompra") {
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
            }

            var oneTbody = document.querySelector("#datatable tbody"),
            twoTbody = document.querySelector("#selected-product tbody"),
            copy = document.querySelector("#copy"),
            seleccion = [],
            seleccionar = function(event){
                if (event.target.tagName == "TD"){
                    var fila = event.target.parentNode;
                    
                    if (fila.dataset.selected < 1){
                        fila.style.backgroundColor = "red";
                        fila.style.color = "white";
                        fila.dataset.selected = 1;
                        seleccion.push(fila);
                    }
                    else{
                        fila.style.backgroundColor = "";
                        fila.style.color = "";
                        fila.dataset.selected = 0;
                        seleccion.splice(seleccion.indexOf(fila), 1);				
                    }			
                }
            },
            copiar = function(){
                if (seleccion.length){
                    for (var i = 0, l = seleccion.length; i < l; i++){
                        var tr = twoTbody.insertRow(),
                            celdas = seleccion[i].querySelectorAll("td");

                        for (var j = 0, m = celdas.length; j < m; j++){
                            var td = tr.insertCell();				
                            td.innerHTML = celdas[j].innerHTML;
                        }

                        seleccion[i].style.backgroundColor = "";
                        seleccion[i].style.color = "";
                        seleccion[i].dataset.selected = 0;
                    }

                    seleccion.length = 0;
                }
            };

            oneTbody.addEventListener("click", seleccionar, false);
            copy.addEventListener("click", copiar, false);
            
            function notDelete() {
                alert("¡Oh no! El producto ya no se puede eliminar.");
            }

        </script>
    </body>
</html>



<form onsubmit="return confirm('Este movimiento sera eliminado. ¿Aceptar?');" action="deleteMov.php" method="post">
    <!-- Modal -->
    <?php
        //Sesion
        include("session/grocer-session.php");
        //Acceso Denegado
        include("session/access-denied.php");
        //Productos Detalles
        $sqlPro__="SELECT p.idProducto, p.nombreProducto, d.cantidad, p.stock FROM detalle_mov_almacen d
        INNER JOIN producto p ON p.idProducto = d.idProducto
        WHERE d.idMovAlmacen = '$id'";
        $datosProDetails=mysqli_query($con,$sqlPro__) or die ('Error en el query database');
        //Movimientos Detalles
        $sqlMovDet__="SELECT d.idMovAlmacen, m.fechaMov, m.estadoMov, m.tipoMov, m.movimiento, m.tipoDoc, m.numDoc, m.nombreRazon, m.observacionMov FROM detalle_mov_almacen d
        LEFT JOIN mov_almacen m ON m.idMovAlmacen = d.idMovAlmacen
        WHERE d.idMovAlmacen = '$id'    
        GROUP BY d.idMovAlmacen, m.fechaMov, m.estadoMov, m.tipoMov, m.Movimiento, m.tipoDoc, m.numDoc, m.nombreRazon, m.observacionMov";
        $datosMovDetails=mysqli_query($con,$sqlMovDet__) or die ('Error en el query database');
    ?>
    <div class="modal fade" id="exampleModalform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Previsualización de los productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                     
                    <?php  while ($rowProDetails = $datosProDetails->fetch_assoc()) {?>
                        <?php  while ($rowMovDetails = $datosMovDetails->fetch_assoc()) {?>
                            <div class="form-group">
                                <input type="hidden" id="field-1" class="form-control" name="tipoMov" value="<?php echo $rowMovDetails['tipoMov']; ?>"/>
                            </div>                                         
                            <div class="form-group">
                                <input type="hidden" id="field-2" class="form-control" name="idMovAlmacen" value="<?php echo $rowMovDetails['idMovAlmacen'];?>"/>
                            </div>                      
                        <?php }?>
                    <div class="form-group">
                        <input type="hidden" id="field-3" class="form-control" name="items[producto][]" value="<?php echo $rowProDetails['idProducto']; ?>"/>
                        <input type="hidden" id="field-4" class="form-control" name="items[cantidad][]" value="<?php echo $rowProDetails['cantidad']; ?>"/>
                    </div> 
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Nombre del Producto:</label>
                                <input disabled type="text" class="form-control" value="<?php echo $rowProDetails['nombreProducto']; ?>"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Cantidad:</label>
                                <input disabled type="text" class="form-control" value="<?php echo $rowProDetails['cantidad']; ?>"/>
                            </div>
                        </div>
                    </div>
                    <?php }?>  
                </div>                                          
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </div>
            </div>
        </div>
    </div>   
</form>

<style>
    .search-form{
	color: #999;	
    }

    #search {
        width: 150px;
    }

    #ingresos,
    #egresos {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
        
        $("#tipo").change(function(e) {
                hideAll();
                    $(e.target.options).removeClass();
                    var $selectedOption = $(e.target.options[e.target.options.selectedIndex]);
                    $selectedOption.addClass('selected');
                $('#' + $selectedOption.val()).show();
        });
    });

    function hideAll() {
        $("#ingresos").hide();
        $("#egresos").hide();
                
    }

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
                <td>
                    <a class="btn btn-sm btn-danger" onclick="remProd(this)" href="javascript:;" ><i class="fa fa-remove" ></i></a>
                </td>
            </tr>
</script>
