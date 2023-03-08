<?php
    //Sesion
    include("../../config/user-session.php");
    //Valores POST
    $id = $_POST["id"];
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
    //Sentencia: Update
        $sql="UPDATE empleado SET
            idArea = '$Area',
            idCargo = '$Cargo',
            nombres = '$Nombre',
            apellidos = '$Apellido',
            direccion = '$Direccion',
            telefono = '$Telefono',
            dni = '$Dni',
            email = '$Email',
            estadoEmpleado = '$Estado',
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idEmpleado = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../empleados/lista-empleado';
    header('Location: '.$nuevaURL);
?>