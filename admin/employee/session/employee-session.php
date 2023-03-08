<?php
session_start();
error_reporting(0);

//Abrimos conexión
include("../config/connection.php");

//Sesión
$usuarioSesEmp = $_SESSION['empleado'];

$sqlSesEmp="SELECT u.usuario as usuario, 
                u.clave as clave, 
                u.estadoUsuario as estadoUsuario, 
                e.nombres as nombres, 
                e.apellidos as apellidos, 
                c.nombreCargo as nombreCargo, 
                a.nombreArea as nombreArea
        FROM usuario u 
        INNER JOIN empleado e ON e.idEmpleado = u.idEmpleado
        INNER JOIN cargo c ON c.idCargo = e.idCargo
        INNER JOIN area a ON a.idArea = e.idArea
        WHERE u.idUsuario='$usuarioSesEmp'";

$datosSesEmp=mysqli_query($con,$sqlSesEmp) or die ('Error en el query database');
?>