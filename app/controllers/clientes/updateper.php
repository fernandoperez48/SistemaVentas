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
    try {
        // Iniciar transacción
        $pdo->beginTransaction();

        // Actualizar la tabla tb_personas
        $sentenciaPersonas = $pdo->prepare(
            "UPDATE tb_personas
            SET nombre = :nombre,
                apellido = :apellido,
                dni = :dni,
                telefono = :telefono,
                email = :email
            WHERE id_persona = :idPersona"
        );

        $sentenciaPersonas->bindParam(':nombre', $nombre);
        $sentenciaPersonas->bindParam(':apellido', $apellido);
        $sentenciaPersonas->bindParam(':dni', $dni);
        $sentenciaPersonas->bindParam(':telefono', $telefono);
        $sentenciaPersonas->bindParam(':email', $email);
        $sentenciaPersonas->bindParam(':idPersona', $idPersona);
        $sentenciaPersonas->execute();

        // Actualizar la tabla tb_domicilios
        $sentenciaDomicilios = $pdo->prepare(
            "UPDATE tb_domicilios
            SET calle = :calle,
                numero = :numero,
                piso = :piso,
                depto = :depto
            WHERE id_domicilio = (
                SELECT id_domicilio
                FROM tb_personas
                WHERE id_persona = :idPersona
            )"
        );

        $sentenciaDomicilios->bindParam(':calle', $calle);
        $sentenciaDomicilios->bindParam(':numero', $numero);
        $sentenciaDomicilios->bindParam(':piso', $piso);
        $sentenciaDomicilios->bindParam(':depto', $depto);
        $sentenciaDomicilios->bindParam(':idPersona', $idPersona);
        $sentenciaDomicilios->execute();

        // Confirmar la transacción
        $pdo->commit();

        // Redireccionar después de la actualización
        session_start();
        $_SESSION['mensaje'] = "Se actualizó el usuario correctamente";
        $_SESSION['icono'] = "success";
        header('location: ' . $URL . 'clientes/indexper.php');
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        $pdo->rollBack();
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }
}
