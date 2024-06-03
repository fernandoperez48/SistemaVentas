<?php

$sql_roles = "SELECT * FROM tb_roles";

$result_roles = $mysqli->query($sql_roles);

$roles_datos = [];

if ($result_roles) {
    while ($row = $result_roles->fetch_assoc()) {
        $roles_datos[] = $row;
    }
}
