<?php
$id_usuario_get = $_GET['id'];
$sql_usuarios = "SELECT us.id_usuarios as id_usuarios, us.nombres as nombres, us.email as email, rol.rol as rol 
                 FROM tb_usuarios as us 
                 INNER JOIN tb_roles as rol 
                 ON us.id_rol = rol.id_rol 
                 WHERE id_usuarios = '$id_usuario_get'";
$resultado_usuarios = $mysqli->query($sql_usuarios);

if ($resultado_usuarios) {
    $usuarios_datos = $resultado_usuarios->fetch_assoc();
    $nombres = $usuarios_datos['nombres'];
    $email = $usuarios_datos['email'];
    $rol = $usuarios_datos['rol'];
}
