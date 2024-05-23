<?php
include '../../config.php';

// Recuperar los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$depto = $_POST['depto'];
$idPersona = $_POST['idPersona'];

if (!empty($_POST)) {
    // Iniciar conexión a la base de datos
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Conexión fallida: " . $mysqli->connect_error);
    }

    // Iniciar transacción
    $mysqli->autocommit(false);

    try {
        // Actualizar la tabla tb_personas
        $sqlPersonas = "UPDATE tb_personas
                        SET nombre = '$nombre',
                            apellido = '$apellido',
                            dni = '$dni',
                            telefono = '$telefono',
                            email = '$email'
                        WHERE id_persona = $idPersona";

        $mysqli->query($sqlPersonas);

        // Actualizar la tabla tb_domicilios
        $sqlDomicilios = "UPDATE tb_domicilios
                          SET calle = '$calle',
                              numero = '$numero',
                              piso = '$piso',
                              depto = '$depto'
                          WHERE id_domicilio = (
                              SELECT id_domicilio
                              FROM tb_personas
                              WHERE id_persona = $idPersona
                          )";

        $mysqli->query($sqlDomicilios);

        // Confirmar la transacción
        $mysqli->commit();

        // Redireccionar después de la actualización
        session_start();
        $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
        $_SESSION['icono'] = "success";
        header('location: ' . $URL . 'clientes/indexper.php');
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $mysqli->rollback();
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }

    // Cerrar conexión
    $mysqli->close();
}
