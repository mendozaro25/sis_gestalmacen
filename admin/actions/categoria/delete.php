<?php
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Delete
        $id=$_GET['idCategoria'];
        $sql="DELETE FROM categoria WHERE idCategoria = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../categorias/lista-categoria';
    header('Location: '.$nuevaURL);
?>