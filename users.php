<?php
$Usuario = $_POST['usuario'];
$Clave = $_POST['clave'];

session_start();

include("./admin/config/connection.php");

    $sql = "SELECT * FROM usuario WHERE usuario='$Usuario' AND clave=sha('$Clave') AND estadoUsuario=1";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if($row['tipoUsuario'] == 'admin'){

                $_SESSION['admin'] = $row['idUsuario'];

                header('Location: ./admin/index');

            }if($row['tipoUsuario'] == 'almacenero'){

                $_SESSION['almacenero'] = $row['idUsuario'];

                header('Location: ./admin/grocer/index');

            }if($row['tipoUsuario'] == 'empleado'){

                $_SESSION['empleado'] = $row['idUsuario'];

                header('Location: ./admin/employee/index');

            }

        }else{

            header("Location: index?error=Error: Las credenciales son incorrectas, intenta nuevamente.");

        }
    