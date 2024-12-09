<?php
// define('SERVIDOR', 'localhost');
// define('USUARIO', 'root');
// define('PASSWORD', '');
// define('BD', 'sistemadeventas');

define('SERVIDOR', 'sql304.infinityfree.com');
define('USUARIO', 'if0_37610250');
define('PASSWORD', 'rwKVspMR7F');
define('BD', 'if0_37610250_sistemadeventas');

// Crear la conexión con MySQLi
$mysqli = new mysqli(SERVIDOR, USUARIO, PASSWORD, BD);

// Comprobar la conexión
if ($mysqli->connect_error) {
    die("Error al conectar con la base de datos: " . $mysqli->connect_error);
} else {
    // echo "<script>alert('Conectado...')</script>";
}

// Establecer el conjunto de caracteres a utf8
if (!$mysqli->set_charset("utf8")) {
    die("Error al configurar el conjunto de caracteres: " . $mysqli->error);
}

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $URL = "http://localhost/SistemaVentas/";
} else {
    $URL = "http://fainsumos.000.pe/";
}
$URL2 = "http://localhost/SistemaVentas/";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaHora = date("Y-m-d H:i:s");
