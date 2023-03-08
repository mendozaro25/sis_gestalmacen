<?php
    //Abrimos conexión
    include("session/employee-session.php");
    //Sentencia: Delete
        $id=$_GET['idRequerimiento'];
        $sql="DELETE FROM detalle_requerimiento WHERE idRequerimiento = '$id'";
        $sqlReq="DELETE FROM requerimiento WHERE idRequerimiento = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
        $resultadoReq=mysqli_query($con,$sqlReq) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = 'lista-requerimiento';
    header('Location: '.$nuevaURL);
?>