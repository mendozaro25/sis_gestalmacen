<?php
    //Sesion
    include("../../config/user-session.php");

    //Id Requerimiento

    $id = $_POST["idRequerimiento"];

    //Valores Requerimiento

	$Observacion = $_POST["observacion"];
	$Fecha = $_POST["fecha"];

    //Sentencia: Update Requerimiento

        $sql="UPDATE requerimiento SET
            observacion = '$Observacion',
            estadoRequerimiento = 2,
            fecha = '$Fecha',
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idRequerimiento = '$id'";

    //Resultado Update Requerimiento

    $resultadoRequerimiento=mysqli_query($con,$sql) or die ('Error en el query database 1');

    //Sentencia: Insert Mov Almacen

    $sqlMovimiento="INSERT INTO mov_almacen
    (
        idMovAlmacen,
        tipoMov,
        movimiento,
        fechaMov,
        tipoDoc,
        numDoc,
        nombreRazon,
        pecosa,
        pdf,
        idRequerimiento,
        observacionMov,
        estadoMov,
        created_user_id,
        date_created,
        update_user_id,
        date_update
    )VALUES 
    (
        null,
        'egresos',
        'eRequerimiento',
        '$Fecha',
        '',
        '',
        '',
        '',
        '',
        '$id',
        '',
        1,
        '$usuarioSes',
        CURRENT_TIMESTAMP,
        '$usuarioSes',
        CURRENT_TIMESTAMP
    )";

    //Resultado Movimiento

    $resultadoMovimiento=mysqli_query($con,$sqlMovimiento) or die ('Error en el query database 2');

    //Id Movimiento Creado

    $tmp = mysqli_query($con, "select  last_insert_id() as lid;") or die ('Error en el query database 3');

    $id_cab = mysqli_fetch_assoc($tmp)   ;
    $id_cab = $id_cab["lid"];

    //Sentencia: Delete Detalle Req
    
    $sqlLimpiarReq = "DELETE FROM detalle_requerimiento WHERE idRequerimiento = '$id'";

    //Resultado Delete Detalle Req

    $resultadoLimpiarReq=mysqli_query($con,$sqlLimpiarReq) or die ('Error en el query database 4');

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
        '$usuarioSes',
        '$Fecha',
        '$usuarioSes',
        CURRENT_TIMESTAMP
    )";

    //Resultado Detalle Req

    $resultadoDetalleReq=mysqli_query($con,$sqlDetalleReq) or die ('Error en el query database 5');

    //Sentencia: Insert Detalle Mov

    $sqlDetalleMov="INSERT INTO detalle_mov_almacen
    (
        idMovAlmacen,
        idProducto,
        cantidad,
        created_user_id,
        date_created,
        update_user_id,
        date_update
    )VALUES 
    (
        '$id_cab',
        '$IdProducto',
        '$Cantidad',
        '$usuarioSes',
        CURRENT_TIMESTAMP,
        '$usuarioSes',
        CURRENT_TIMESTAMP
    )";

    //Resultado Detalle Movimiento

    $resultadoDetalleMov=mysqli_query($con,$sqlDetalleMov) or die ('Error en el query database 6');

    //Sentencia: Update Cantidad Producto 
                
    $sqlStockIngreso="UPDATE producto SET
    stock = stock - '$Cantidad',
    update_user_id = '$usuarioSes',
    date_update = CURRENT_TIMESTAMP
    WHERE idProducto = '$IdProducto'";

    $resultadoStockIngreso=mysqli_query($con,$sqlStockIngreso) or die ('Error en el query database 7');
    
    }

    //Cerramos Conexión

    mysqli_close($con);

    //Rediccionar

    $nuevaURL = '../../requerimientos/lista-requerimiento';
    header('Location: '.$nuevaURL);
?>