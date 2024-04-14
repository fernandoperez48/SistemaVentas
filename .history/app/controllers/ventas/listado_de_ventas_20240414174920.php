

<?php
$sql_ventas = "SELECT *,cl.id_cliente as id_cliente
             from tb_ventas as ve inner join tb_clientes as cl on cl.id_cliente=ve.id_cliente";



$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);
