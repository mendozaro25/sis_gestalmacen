<?php
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Delete
        $id=$_GET['idMarca'];
        $sql="DELETE FROM marca WHERE idMarca = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../marcas/lista-marca';
    header('Location: '.$nuevaURL);
?>