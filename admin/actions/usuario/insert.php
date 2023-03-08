<?php
    //Sesion
    include("../../config/user-session.php");
    //Valores POST
    $Empleado = $_POST["empleado"];
    $Tipo = $_POST["tipo"];
    $Usuario = $_POST["usuario"];
	$Clave = $_POST["clave"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Insert
        $sql="INSERT INTO usuario
        (
            idUsuario,
            idEmpleado,
            tipoUsuario,
            foto,
            usuario,
            clave,
            estadoUsuario,
            created_user_id,
            date_created,
            update_user_id,
            date_update
        )VALUES 
        (
            null,
            '$Empleado',
            '$Tipo',
            'default.jpg',
            '$Usuario',
            SHA('$Clave'),
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
    $nuevaURL = '../../usuarios/nuevo-usuario';
    header('Location: '.$nuevaURL);
?>