<?php
    //Sesion
    include("../../config/user-session.php");
    //Valores POST
    $Area = $_POST["area"];
    $Cargo = $_POST["cargo"];
    $Nombre = $_POST["nombre"];
	$Apellido = $_POST["apellido"];
	$Direccion = $_POST["direccion"];
	$Telefono = $_POST["telefono"];
    $Dni = $_POST["dni"];
	$Email = $_POST["email"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Insert
        $sql="INSERT INTO empleado
        (
            idEmpleado,
            idCargo,
            idArea,
            nombres,
            apellidos,
            direccion,
            telefono,
            dni,
            email,
            estadoEmpleado,
            created_user_id,
            date_created,
            update_user_id,
            date_update
        )VALUES 
        (
            null,
            '$Cargo',
            '$Area',
            '$Nombre',
            '$Apellido',
            '$Direccion',
            '$Telefono',
            '$Dni',
            '$Email',
            '$Estado',
            '$usuarioSes',
            CURRENT_TIMESTAMP,
            '$usuarioSes',
            CURRENT_TIMESTAMP
        )";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../empleados/nuevo-empleado';
    header('Location: '.$nuevaURL);
?>