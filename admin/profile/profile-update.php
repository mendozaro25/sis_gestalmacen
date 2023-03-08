<?php
    //Sesion
    include("../config/user-session.php");
    //Valores Usuario
    $Usuario = $_POST["usuario"];
	$Clave = $_POST["clave"];

    // Guardar la imagen en la carpeta especificada    
    $Foto = date("Y-m-d").'_'.$Usuario.'_'.$_FILES["photo"]["name"];
    $target_dir = "photo/";
    $target_file = $target_dir . $Foto;
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "La imagen ". $Foto. " se ha guardado en la carpeta.";
    } else {
        echo "Error al guardar la imagen.";
    }


    //Valores Empleado
    $idEmpleado = $_POST["idEmpleado"];
    $Nombres = $_POST["nombres"];
    $Apellidos = $_POST["apellidos"];
    $Dni = $_POST["dni"];
    $Telefono = $_POST["telefono"];
    $Email = $_POST["email"];
    $Direccion = $_POST["direccion"];

    //Abrimos conexión
	include ("../config/connection.php");

    //Sentencia: Update
        $sqlUsuario="UPDATE usuario SET
            foto = '$Foto',
            usuario = '$Usuario',
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idUsuario = '$usuarioSes'";

    //Sentencia: Update
        $sqlEmpleado="UPDATE empleado SET
            nombres = '$Nombres',
            apellidos = '$Apellidos',
            dni = '$Dni',
            telefono = '$Telefono',
            email = '$Email',
            direccion = '$Direccion',
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idEmpleado = '$idEmpleado'";

    //Resultado Usuario
    $resultadoUsuario=mysqli_query($con,$sqlUsuario) or die ('Error en el query database');
        

    //Resultado Empleado
    $resultadoEmpleado=mysqli_query($con,$sqlEmpleado) or die ('Error en el query database');
        
    //Cerramos Conexión
    mysqli_close($con);
    
    //Rediccionar
    $nuevaURL = 'profile';
    header('Location: '.$nuevaURL);
?>