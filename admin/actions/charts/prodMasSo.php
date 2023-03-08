<?php
    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost","root","","sisalmacen");

    $sqlQuery = "SELECT p.nombreProducto as producto, COUNT(dm.idRequerimiento) as requerimientos
                FROM detalle_requerimiento dm    
                LEFT JOIN producto p ON p.idProducto = dm.idProducto
                GROUP BY producto
                LIMIT 10";

    $result = mysqli_query($conn,$sqlQuery);

    $data = array();
    foreach ($result as $row) {
    $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);
?>
