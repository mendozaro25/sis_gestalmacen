<?php
    $id = $_POST["id"];
    $Nombre = $_POST["nombre"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Update
        $sql="UPDATE categoria SET
            nombreCategoria = '$Nombre',
            estadoCategoria = '$Estado'
            WHERE idCategoria = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../categorias/lista-categoria';
    header('Location: '.$nuevaURL);
?>