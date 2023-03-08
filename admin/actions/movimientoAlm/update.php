<?php
    //Sesion
    include("../../config/user-session.php");

    $id = $_POST["idMovAlmacen"];
    
    $TipoMov = $_POST["tipoMov"];
    $Movimiento = $_POST["movimiento"];
	$TipoDoc = $_POST["tipoDoc"];
	$Numero = $_POST["numero"];
    $NombreRazon = $_POST["nombreRazon"];
	$Observacion = $_POST["observacion"];
	$Pecosa = $_POST["pecosa"];
	$Estado = $_POST["estado"];

    //Sentencia: Update
        $sql="UPDATE mov_almacen SET
            tipoDoc = '$TipoDoc',
            numDoc = '$Numero',
            nombreRazon = '$NombreRazon',
            observacionMov = '$Observacion',
            pecosa = '$Pecosa',
            estadoMov = '$Estado',
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idMovAlmacen = '$id'";    

    //Sentencia: Update
        $sqlDetalle="UPDATE detalle_mov_almacen SET
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idMovAlmacen = '$id'";

    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
        $resultadoDetalle=mysqli_query($con,$sqlDetalle) or die ('Error en el query database');

    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../movimientosAlm/lista-movimiento';
    header('Location: '.$nuevaURL);
?>