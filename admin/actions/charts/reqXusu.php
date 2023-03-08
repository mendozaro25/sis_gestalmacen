<?php
    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost","root","","sisalmacen");

    $sqlQuery = "SELECT COUNT(r.idRequerimiento) as requerimientos, CONCAT(e.nombres,' ',e.apellidos) as usuarios
                FROM requerimiento r
                LEFT JOIN usuario u ON u.idUsuario = r.idUsuario
                LEFT JOIN empleado e ON e.idEmpleado = u.idEmpleado
                LEFT JOIN area a ON a.idArea = e.idArea
                GROUP BY usuarios";

    $result = mysqli_query($conn,$sqlQuery);

    $data = array();
    foreach ($result as $row) {
    $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);
?>
