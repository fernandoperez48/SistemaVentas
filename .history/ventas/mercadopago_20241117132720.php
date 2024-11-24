<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

if (class_exists('MercadoPago\SDK')) {
    echo "MercadoPago\SDK está cargado correctamente.";
} else {
    echo "Error: MercadoPago\SDK no está disponible.";
}


use MercadoPago\SDK;
use MercadoPago\Preference;

// Configuración del token de acceso de MercadoPago
SDK::setAccessToken("APP_USR-5870941258357362-110321-d271d0777a33e2d58a22112cfd61dd5d-2074004027");

// Verificar si se recibe un total por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['total_a_cancelar'])) {
    $total_a_cancelar = floatval($_POST['total_a_cancelar']);

    $preference_id = crearPreferenciaMP($total_a_cancelar);

    // Devolver el ID de preferencia para su uso en la integración
    echo $preference_id;
}

// Función para crear la preferencia de MercadoPago con el total actualizado
function crearPreferenciaMP($total_a_cancelar)
{
    $preference = new Preference();

    // Configurar los ítems de la preferencia
    $item = new MercadoPago\Item();
    $item->id = "DEP-0001";  // Identificador único del producto o servicio
    $item->title = "Compra FAINSUMOS";
    $item->quantity = 1;
    $item->unit_price = $total_a_cancelar;

    // Asignar los ítems a la preferencia
    $preference->items = [$item];
    $preference->statement_descriptor = "Mi Tienda CDP";
    $preference->external_reference = "CDP001";

    // Guardar la preferencia
    $preference->save();

    return $preference->id;  // Retorna el ID de preferencia generado para su uso en la integración
}
