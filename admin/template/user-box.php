<?php
    //Sesion
    include("../config/user-session.php");
    //Acceso Denegado
    include("../config/access-denied.php");
    //Usuario-Foto
    $sqlFoto="SELECT u.foto as foto FROM usuario u    
    WHERE u.idUsuario = '$usuarioSes' AND u.estadoUsuario = 1";
    $datosFoto=mysqli_query($con,$sqlFoto) or die ('Error en el query database');
?>

<div class="user-box">
    <div class="d-flex justify-content-center">
    <?php  while ($rowFoto = $datosFoto->fetch_assoc()) { ?>
        <img src="../profile/photo/<?php echo $rowFoto['foto'];?>" alt="user_foto" class="img-fluid rounded-circle"> 
    <?php } ?>
    </div>
    <?php  while ($rowSes = $datosSes->fetch_assoc()) { ?>
    <div class="text-center text-white mt-2">
        <h6><?php echo $rowSes['nombres'].' '.$rowSes['apellidos'];?></h6>
        <p class="text-muted m-0"><?php echo $rowSes['nombreArea'];?></p>
        <p class="text-muted m-0"><?php echo $rowSes['nombreCargo'];?></p>
    </div>
    <?php } ?>
</div>   