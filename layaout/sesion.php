<?php
session_start();
if (isset($_SESSION['email'])) {
    //echo "Si existe sesion de ".$_SESSION['email'];
    $email_session = $_SESSION['email'];
    $sql = "SELECT us.id_usuarios as id_usuarios, us.nombres as nombres, us.email as email, rol.rol as rol, rol.id_rol FROM tb_usuarios as us inner join tb_roles as rol on us.id_rol=rol.id_rol WHERE email='$email_session'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario) {
        $id_usuarios_sesion = $usuario['id_usuarios'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
        $id_rol = $usuario['id_rol'];
    }
} else {
    echo "No existe sesion";
    header('location:' . $URL . '/login');
}
