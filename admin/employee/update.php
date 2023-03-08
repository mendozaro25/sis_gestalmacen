<?php
    //Sesion
    include("session/employee-session.php");

    $id = $_POST["idRequerimiento"];

    //Valores Requerimiento
	$Fecha = $_POST["fecha"];

    //Sentencia: Update
        $sql="UPDATE requerimiento SET
            estadoRequerimiento = 1,
            fecha = '$Fecha',
            update_user_id = '$usuarioSesEmp',
            date_update = CURRENT_TIMESTAMP
            WHERE idRequerimiento = '$id'";

    //Resultado Requerimiento
    $resultadoRequerimiento=mysqli_query($con,$sql) or die ('Error en el query database');

    //Sentencia: Delete Detalle Req
    
    $sqlLimpiarReq = "DELETE FROM detalle_requerimiento WHERE idRequerimiento = '$id'";

    //Resultado Delete Detalle Req

    $resultadoLimpiarReq=mysqli_query($con,$sqlLimpiarReq) or die ('Error en el query database');

    //Contar filas de Item Producto

    $items = $_POST["items"];

    $count = count($items["producto"]);
    
    for ($i=0; $i<$count; $i++ ) {

    //Valores Producto

    $IdProducto = $items["producto"][$i];
    $Cantidad = $items["cantidad"][$i];

    //Sentencia: Insert Detalle Req

    $sqlDetalleReq="INSERT INTO detalle_requerimiento
    (
        idRequerimiento,
        idProducto,
        cantidad,
        created_user_id,
        date_created,
        update_user_id,
        date_update
    )VALUES 
    (
        '$id',
        '$IdProducto',
        '$Cantidad',
        '$usuarioSesEmp',
        '$Fecha',
        '$usuarioSesEmp',
        CURRENT_TIMESTAMP
    )";

    //Resultado Detalle Req

    $resultadoDetalleReq=mysqli_query($con,$sqlDetalleReq) or die ('Error en el query database');

    }

    //Cerramos Conexión

    mysqli_close($con);

    //Rediccionar

    $nuevaURL = 'lista-requerimiento';
    header('Location: '.$nuevaURL);

?>