<?php
    $Nombre = $_POST["nombre"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Insert
        $sql="INSERT INTO marca
        (
            idMarca,
            nombreMarca,
            estadoMarca
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
    $nuevaURL = '../../marcas/nuevo-marca';
    header('Location: '.$nuevaURL);
?>