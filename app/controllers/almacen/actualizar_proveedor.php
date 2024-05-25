<?php
session_start();

if (isset($_POST['id_proveedor'])) {
    $id_proveedorDelSelect = $_POST['id_proveedor'];
    $_SESSION['id_proveedorDelSelect'] = $id_proveedorDelSelect;
    echo 'Proveedor actualizado a ' . $id_proveedorDelSelect;
} else {
    echo 'No se ha recibido ningún proveedor.';
}
