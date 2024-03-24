<?php
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','sistemadeventasFA');

$servidor= "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD,
    array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "<script>alert('Conectado...')</script>";
}catch(PDOException $e){
     echo "Error al conectar con la base de datos";
}

$URL="http://localhost/SistemaVentas/";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaHora = date("Y-m-d H:i:s");



?>