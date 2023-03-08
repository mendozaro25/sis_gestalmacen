<?php
    $Nombre = $_POST["nombre"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Insert
        $sql="INSERT INTO categoria
        (
            idCategoria,
            nombreCategoria,
            estadoCategoria
        )VALUES 
        (
            null,
            '$Nombre',
            '$Estado'
        )";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../categorias/nuevo-categoria';
    header('Location: '.$nuevaURL);
?>