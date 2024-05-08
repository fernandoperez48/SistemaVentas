<?php


$sql_paises = "SELECT * FROM tb_paises";
$query_paises = $pdo->prepare($sql_paises);
$query_paises->execute();
$paises_datos = $query_paises->fetchAll(PDO::FETCH_ASSOC);
