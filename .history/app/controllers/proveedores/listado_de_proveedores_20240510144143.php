<?php


$sql_proveedores = "SELECT p.*,d.* 
                    FROM tb_proveedores as p
                    INNER JOIN tb_domicilios as d
                    ON p.id_domicilio = d.id_domicilio
                    INNER JOIN tb_condicion_iva as ci 
                    ON ci.id = d.condicion_iva";
$query_proveedores = $pdo->prepare($sql_proveedores);
$query_proveedores->execute();
$proveedores_datos = $query_proveedores->fetchAll(PDO::FETCH_ASSOC);
