<?php
    //Sesion
    include("session/grocer-session.php");

    if (isset($_POST["submit"]))
    {
        if(is_uploaded_file($_FILES["pdf"]["tmp_name"]) && ($_FILES["pdf"]["type"] == 'application/pdf') ){
            echo "file is valid";
            $Pdf = date("Y-m-d").'-'.rand(1000,10000)."-".$_FILES["pdf"]["name"];
            $PdfTmp = $_FILES["pdf"]["tmp_name"];
            $PdfDir = 'pdf';
            move_uploaded_file($PdfTmp, '../movimientosAlm/'.$PdfDir.'/'.$Pdf);
        }
        else{
            echo "file is not valid type";
        }
    }

    $TipoMov = $_POST["tipoMov"];
    $Movimiento = $_POST["movimiento"];
    date_default_timezone_set("America/Lima");
	$Fecha = date("Y-m-d");
	$TipoDoc = $_POST["tipoDoc"];
	$Numero = $_POST["numero"];
    $NombreRazon = $_POST["nombreRazon"];
	$Observacion = $_POST["observacion"];
	$Pecosa = $_POST["pecosa"];
	$Estado = $_POST["estado"]; 

    //Valores Producto
    $IdProducto = $_POST["producto"];
    $Cantidad = $_POST["cantidad"];
    
    //Sentencia: Insert
        $sql="INSERT INTO mov_almacen
        (
            idMovAlmacen,
            tipoMov,
            movimiento,
            fechaMov,
            tipoDoc,
            numDoc,
            nombreRazon,
            idRequerimiento,
            pecosa,
            pdf,
            observacionMov,
            estadoMov,
            created_user_id,
            date_created,
            update_user_id,
            date_update
        )VALUES 
        (
            null,
            '$TipoMov',
            '$Movimiento',
            '$Fecha',
            '$TipoDoc',
            '$Numero',
            '$NombreRazon',
            '',
            '$Pecosa',
            '$Pdf',
            '$Observacion',
            '$Estado',
            '$usuarioSesAlm',
            CURRENT_TIMESTAMP,
            '$usuarioSesAlm',
            CURRENT_TIMESTAMP
        )";

    //Resultado Movimiento
    $resultadoMov=mysqli_query($con,$sql) or die ('Error en el query database 9');
    $tmp = mysqli_query($con, "select  last_insert_id() as lid;") or die ('Error en el query database 3');

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
            '$usuarioSesAlm',
            CURRENT_TIMESTAMP,
            '$usuarioSesAlm',
            CURRENT_TIMESTAMP
        )";
        //Resultado Detalle Mov
        $resultadoDetalleMov=mysqli_query($con,$sqlDetalleMov) or die ('Error en el query database 1');

         //Sentencia: Update Cantidad Producto

         if($TipoMov == 'ingresos'){
            $sqlStockIngreso="UPDATE producto SET
            stock = stock + '$Cantidad',
            update_user_id = '$usuarioSesAlm',
            date_update = CURRENT_TIMESTAMP
            WHERE idProducto = '$IdProducto'";
        }else{            
            $sqlStockIngreso="UPDATE producto SET
            stock = stock - '$Cantidad',
            update_user_id = '$usuarioSesAlm',
            date_update = CURRENT_TIMESTAMP
            WHERE idProducto = '$IdProducto'";
        }

        //Resultado Detalle Mov Almacen
        $resultadoStockIngreso=mysqli_query($con,$sqlStockIngreso) or die ('Error en el query database 2');
    }

    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = 'nuevo-movimiento';
    header('Location: '.$nuevaURL);
?>