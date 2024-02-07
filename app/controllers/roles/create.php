<?php
include '../../config.php';
$rol=$_POST['rol'];

    
    $sentencia = $pdo->prepare("INSERT INTO tb_roles(rol,fyh_creacion) VALUES (:rol,:fyh_creacion);");

    $sentencia->bindParam('rol',$rol);
    $sentencia->bindParam('fyh_creacion',$fechaHora);

    if($sentencia->execute()){
        //echo "Guardado correctamente";
        session_start();
        $_SESSION['mensaje']="Se registro el rol correctamente";
        $_SESSION['icono']="success";
        header('location: '.$URL.'/roles/');
    }else{
        //echo "No se guardo correctamente";
        session_start();
        $_SESSION['mensaje']="No se pudo registrar el rol";
        $_SESSION['icono']="error";
        header('location: '.$URL.'roles/create.php');
    }



?>