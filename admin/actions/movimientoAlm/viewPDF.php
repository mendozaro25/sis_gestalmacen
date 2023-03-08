<?php
    //Sesion
    include("../../config/user-session.php");

    $Pdf = $_GET['pdf'];

    header("Content-type: application/pdf");

    
    header('Location: '.$nuevaURL);

    echo $Pdf;

?>