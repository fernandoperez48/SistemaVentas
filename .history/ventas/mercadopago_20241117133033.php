<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

// Configuración de token de MercadoPago
MercadoPagoConfig::setAccessToken("APP_USR-5870941258357362-110321-d271d0777a33e2d58a22112cfd61dd5d-2074004027");




// Verificar si se recibe un total por AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['total_a_cancelar'])) {
    $total_a_cancelar = floatval($_POST['total_a_cancelar']);

    $preference_id = crearPreferenciaMP($total_a_cancelar);

    // Devolver el ID de preferencia para su uso en la integración
    echo $preference_id;
}


// Función para crear la preferencia de MercadoPago con el total actualizado
function crearPreferenciaMP($total_a_cancelar)
{
    $client = new PreferenceClient();

    $preference = $client->create([
        "items" => [
            [
                "id" => "DEP-0001",  // Este ID puede ser cualquier identificador único de tu producto o servicio
                "title" => "Compra FAINSUMOS",
                "quantity" => 1,
                "unit_price" => $total_a_cancelar  // Se asigna el total a cancelar
            ]
        ],
        "statement_descriptor" => "Mi Tienda CDP",
        "external_reference" => "CDP001",
    ]);

    return $preference->id;  // Retorna el ID de preferencia generado para su uso en la integración
}
