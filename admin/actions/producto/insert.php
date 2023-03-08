<?php
    //Sesion
    include("../../config/user-session.php");
    //Valores POST
    $Categoria = $_POST["categoria"];
    $Marca = $_POST["marca"];
    $Nombre = $_POST["nombre"];
	$Precio = $_POST["precio"];
    $StockMin = $_POST["stockmin"];
	$Descripcion = $_POST["descripcion"];
	$Estado = $_POST["estado"];
    //Abrimos conexión
	include ("../../config/connection.php");
    //Sentencia: Insert
        $sql="INSERT INTO producto
        (
            idProducto,
            idCategoria,
            idMarca,
            nombreProducto,
            precio,
            stock,
            stockMin,
            descripcion,
            estadoProducto,
            created_user_id,
            date_created,
            update_user_id,
            date_update
        )VALUES 
        (
            null,
            '$Categoria',
            '$Marca',
            '$Nombre',
            '$Precio',
            0,
            '$StockMin',
            '$Descripcion',
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
    $nuevaURL = '../../productos/nuevo-producto';
    header('Location: '.$nuevaURL);
?>