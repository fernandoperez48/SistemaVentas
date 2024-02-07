<?php
include '../../config.php';
$rol=$_POST['rol'];
$id_rol=$_POST['id_rol'];
     
        $sentencia = $pdo->prepare("UPDATE tb_roles 
         SET rol=:rol,
            fyh_actualizacion=:fyh_actualizacion
         WHERE id_rol=:id_rol;");
        
    
        $sentencia->bindParam('rol',$rol);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_rol',$id_rol);
        
        if($sentencia->execute()){
            //echo "guardado";
            session_start();
            $_SESSION['mensaje']="Se actualizo el rol correctamente";
            $_SESSION['icono']="success";
            header('location: '.$URL.'/roles/');
        }else{
            //echo "no guardado";
            session_start();
            $_SESSION['mensaje']="No se actualizo el rol correctamente";
            $_SESSION['icono']="error";
            header('location: '.$URL.'roles/update.php?id='.$id_rol.'');
        }
?>