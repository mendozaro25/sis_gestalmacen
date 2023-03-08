<?php
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Delete
        $id=$_GET['idUsuario'];
        $sql="DELETE FROM usuario WHERE idUsuario = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../usuarios/lista-usuario';
    header('Location: '.$nuevaURL);
?>