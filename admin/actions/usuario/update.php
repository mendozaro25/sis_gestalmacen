<?php
    //Sesion
    include("../../config/user-session.php");
    //Valores POST
    $id = $_POST["id"];
    $Empleado = $_POST["empleado"];
    $Tipo = $_POST["tipo"];
    $Usuario = $_POST["usuario"];
	$Clave = $_POST["clave"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Update
        $sql="UPDATE usuario SET
            idEmpleado = '$Empleado',
            tipoUsuario = '$Tipo',
            usuario = '$Usuario',
            estadoUsuario = '$Estado',
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idUsuario = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../usuarios/lista-usuario';
    header('Location: '.$nuevaURL);
?>