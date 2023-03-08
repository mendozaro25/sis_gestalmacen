<?php
    //Sesion
    include("session/grocer-session.php");

    $id = $_POST["idMovAlmacen"];

    $tipoMov = $_POST["tipoMov"];

    $items = $_POST["items"];

    $count = count($items["cantidad"]);

    //Sentencia: Update
    for ($i=0; $i<$count; $i++ ) {

        //Valores Producto
    
        $IdProducto = $items["producto"][$i];

        $Cantidad = $items["cantidad"][$i];

        if($tipoMov == 'ingresos'){
            $sqlStock="UPDATE producto SET
            stock = stock - '$Cantidad',
            update_user_id = '$usuarioSesAlm',
            date_update = CURRENT_TIMESTAMP
            WHERE idProducto = '$IdProducto'";

            //Sentencia: Delete    
            $sql="DELETE FROM detalle_mov_almacen WHERE idMovAlmacen = '$id'";
            $sqlMov="DELETE FROM mov_almacen WHERE idMovAlmacen = '$id'";

            //Resultado
            $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
            $resultadoMov=mysqli_query($con,$sqlMov) or die ('Error en el query database');

        }else{            
            $sqlStock="UPDATE producto SET
            stock = stock + '$Cantidad',
            update_user_id = '$usuarioSesAlm',
            date_update = CURRENT_TIMESTAMP
            WHERE idProducto = '$IdProducto'";

            //Sentencia: Delete    
            $sql="DELETE FROM detalle_mov_almacen WHERE idMovAlmacen = '$id'";
            $sqlMov="DELETE FROM mov_almacen WHERE idMovAlmacen = '$id'";

            //Resultado
            $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
            $resultadoMov=mysqli_query($con,$sqlMov) or die ('Error en el query database');

        }

        //Resultado
        $resultadoStock=mysqli_query($con,$sqlStock) or die ('Error en el query database');
    }

    //Cerramos Conexión
    mysqli_close($con);

    //Rediccionar
    $nuevaURL = 'lista-movimiento';
    header('Location: '.$nuevaURL);
?>