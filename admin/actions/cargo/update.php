<?php
    $id = $_POST["id"];
    $Nombre = $_POST["nombre"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Update
        $sql="UPDATE cargo SET
            nombreCargo = '$Nombre',
            estadoCargo = '$Estado'
            WHERE idCargo = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../cargos/lista-cargo';
    header('Location: '.$nuevaURL);
?>