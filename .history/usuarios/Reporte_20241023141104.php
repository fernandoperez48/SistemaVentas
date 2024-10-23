<?php

class Reporte {
    public static function render($roles_datos) {
        ob_start(); // Iniciar el buffer de salida
        ?>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}