<?php
    //Sesion
    include("session/grocer-session.php");

    //Valores Usuario
    $Usuario = $_POST["usuario"];
	$Clave = $_POST["clave"];

    //Valores Empleado
    $idEmpleado = $_POST["idEmpleado"];
    $Nombres = $_POST["nombres"];
    $Apellidos = $_POST["apellidos"];
    $Dni = $_POST["dni"];
    $Telefono = $_POST["telefono"];
    $Email = $_POST["email"];
    $Direccion = $_POST["direccion"];

    //Abrimos conexión
	include ("../configS/connection.php");

    //Sentencia: Update
        $sqlUsuario="UPDATE usuario SET
            usuario = '$Usuario',
            update_user_id = '$usuarioSesAlm',
            date_update = CURRENT_TIMESTAMP
            WHERE idUsuario = '$usuarioSesAlm'";

    //Sentencia: Update
        $sqlEmpleado="UPDATE empleado SET
            nombres = '$Nombres',
            apellidos = '$Apellidos',
            dni = '$Dni',
            telefono = '$Telefono',
            email = '$Email',
            direccion = '$Direccion',
            update_user_id = '$usuarioSesAlm',
            date_update = CURRENT_TIMESTAMP
            WHERE idEmpleado = '$idEmpleado'";

    //Resultado Usuario
    $resultadoUsuario=mysqli_query($con,$sqlUsuario) or die ('Error en el query database 1 ');
        

    //Resultado Empleado
    $resultadoEmpleado=mysqli_query($con,$sqlEmpleado) or die ('Error en el query database 2');
        
    //Cerramos Conexión
    mysqli_close($con);
    
    //Rediccionar
    $nuevaURL = 'profile';
    header('Location: '.$nuevaURL);
?>