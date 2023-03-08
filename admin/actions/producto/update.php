<?php
    //Sesion
    include("../../config/user-session.php");
    //Valores POST
    $id = $_POST["id"];
    $Categoria = $_POST["categoria"];
    $Marca = $_POST["marca"];
    $Nombre = $_POST["nombre"];
	$Precio = $_POST["precio"];
    $StockMin = $_POST["stockmin"];
	$Descripcion = $_POST["descripcion"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Update
        $sql="UPDATE producto SET
            idCategoria = '$Categoria',
            idMarca = '$Marca',
            nombreProducto = '$Nombre',
            precio = '$Precio',
            stockMin = '$StockMin',
            descripcion = '$Descripcion',
            estadoProducto = '$Estado',
            update_user_id = '$usuarioSes',
            date_update = CURRENT_TIMESTAMP
            WHERE idProducto = '$id'";
    //Resultado
        $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    //Cerramos Conexión
        mysqli_close($con);
    //Rediccionar
    $nuevaURL = '../../productos/lista-producto';
    header('Location: '.$nuevaURL);
?>