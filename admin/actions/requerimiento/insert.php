<?php
    //Sesion
    include("../../config/user-session.php");

	$idUsuario = $_POST["usuario"];
	$Observacion = $_POST["observacion"];
    date_default_timezone_set("America/Lima");
	$Fecha = date("Y-m-d");

    #die(var_dump($_POST["items"]));
    

    //Sentencia: Insert
        $sqlRequerimiento="INSERT INTO requerimiento
        (
            idRequerimiento,
            idUsuario,
            observacion,
            estadoRequerimiento,
            fecha,
            created_user_id,
            date_created,
            update_user_id,
            date_update
        )VALUES 
        (
            null,
            '$idUsuario',
            '$Observacion',
            '1',
            '$Fecha',
            '$usuarioSes',
            CURRENT_TIMESTAMP,
            '$usuarioSes',
            CURRENT_TIMESTAMP
        )";

    //Resultado Requerimiento
    $resultadoUsuario=mysqli_query($con,$sqlRequerimiento) or die ('Error en el query database');
    $tmp = mysqli_query($con, "select  last_insert_id() as lid;") or die ('Error en el query database');

    $id_cab = mysqli_fetch_assoc($tmp)   ;
    $id_cab = $id_cab["lid"];

    $items = $_POST["items"];

    $count = count($items["producto"]);

    # echo var_dump($items);


    for ($i=0; $i<$count; $i++ ) {
        //Valores Producto
        $IdProducto = $items["producto"][$i];
        $Cantidad = $items["cantidad"][$i];

        # echo var_dump($IdProducto, $Cantidad);

        //Sentencia: Insert
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
            '$id_cab',
            '$IdProducto',
            '$Cantidad',
            '$usuarioSes',
            CURRENT_TIMESTAMP,
            '$usuarioSes',
            CURRENT_TIMESTAMP
        )";
        //Resultado Detalle Req
        $resultadoDetalleReq=mysqli_query($con,$sqlDetalleReq) or die ('Error en el query database');
    }

    //Cerramos Conexión
     mysqli_close($con);

    //Rediccionar
    $nuevaURL = '../../requerimientos/nuevo-requerimiento';
    header('Location: '.$nuevaURL);
?>