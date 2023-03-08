<?php
//Sesion
include("session/employee-session.php");

//Valores Claves
$PasswordOld = $_POST["password-old"];
$PasswordEncry = sha1($PasswordOld);

$PasswordNew = $_POST["password-new"];

$PasswordRepeat = $_POST["password-repeat"];

//Sentencia: SELECT
$sqlClave="SELECT clave FROM usuario WHERE idUsuario = '$usuarioSesEmp'";

//Resultado Clave
$resultadoClave=mysqli_query($con,$sqlClave) or die ('Error en el query database');

while ($rowUsu = $resultadoClave->fetch_assoc()){
    $claveActual = $rowUsu['clave'];
}

if ($PasswordEncry == $claveActual && $PasswordNew == $PasswordRepeat) {
    $sqlUpdate="UPDATE usuario SET
            clave = SHA('$PasswordNew'),
            update_user_id = '$usuarioSesEmp',
            date_update = CURRENT_TIMESTAMP
            WHERE idUsuario = '$usuarioSesEmp'";
    
    $resultadoClave2=mysqli_query($con,$sqlUpdate) or die ('Error en el query database');

    //Cerramos Conexión
    mysqli_close($con);

    header('Location: profile');
} else {
    header("Location: profile?error=Error: Las claves no coinciden, intenta nuevamente.");
}
?>