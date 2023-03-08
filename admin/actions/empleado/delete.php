<?php
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Delete
        $id=$_GET['idEmpleado'];
        $sql="DELETE FROM empleado WHERE idEmpleado = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../empelados/lista-empleado';
    header('Location: '.$nuevaURL);
?>