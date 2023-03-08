<?php
    //Sesion

    include("session/grocer-session.php");

    //Requermiento a rechazar

    $Id=$_POST['idRequerimiento'];

    $Observacion=$_POST['observacion'];

    //Sentencia: Update
        $sql="UPDATE requerimiento SET
            observacion = '$Observacion',
            estadoRequerimiento = 3,
            update_user_id = '$usuarioSesAlm',
            date_update = CURRENT_TIMESTAMP
            WHERE idRequerimiento = '$Id'";

    //Resultado Update Req

    $resultado=mysqli_query($con,$sql) or die ('Error en el query database');

    //Cerramos Conexión

    mysqli_close($con);

    //Rediccionar

    $nuevaURL = 'lista-requerimiento';

    header('Location: '.$nuevaURL);
?>