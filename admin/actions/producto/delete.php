<?php
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Delete
        $id=$_GET['idProducto'];
        $sql="DELETE FROM producto WHERE idProducto = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../productos/lista-producto';
    header('Location: '.$nuevaURL);
?>