

<?php
$sql_ventas = "SELECT *,cl.id_cliente as id_cliente, COALESCE(emp.nombre, p.nombre) AS nombre,COALESCE(emp.razon_social, p.apellido) AS apellido
             from tb_ventas as ve 
             inner join tb_clientes as cl on cl.id_cliente=ve.id_cliente
             left JOIN tb_empresas AS emp ON cl.id_empresa = emp.id_empresa
             left JOIN tb_personas AS p ON cl.id_persona = p.id_persona ";



$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);
