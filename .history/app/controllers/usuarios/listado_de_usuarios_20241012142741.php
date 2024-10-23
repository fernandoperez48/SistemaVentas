<?php
/*
$sql_usuarios = "SELECT us.id_usuarios as id_usuarios, us.nombres as nombres, us.email as email, us.imagen as imagen, us.id_rol as id_rol, rol.rol as rol FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol=rol.id_rol";

$result_usuarios = $mysqli->query($sql_usuarios);

$usuarios_datos = [];

if ($result_usuarios) {
    while ($row = $result_usuarios->fetch_assoc()) {
        $usuarios_datos[] = $row;
    }
}*/
