<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/ventas/mostrar_ventas_con_anuladas.php';
include '../app/controllers/ventas/listado_de_ventas.php';

include_once 'ModalProductos.php';
include_once 'ModalVerClientes.php';
include_once 'Reporte.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Ventas realizadas</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Ventas registradas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm" style="border-color: black;">
                                    <thead style="background-color: gray;">
                                        <tr>
                                            <th>
                                                <center>Nro</center>
                                            </th>
                                            <th>
                                                <center>Nro de venta</center>
                                            </th>
                                            <th>
                                                <center>Productos</center>
                                            </th>
                                            <th>
                                                <center>Cliente</center>
                                            </th>
                                            <th>
                                                <center>Total pagado</center>
                                            </th>
                                            <?php if ($rol_sesion == "Administrador" || $id_rol == 4 || $rol_sesion == "Encargado de Ventas" || $id_rol == 3) { ?>
                                                <th>
                                                    <center>Estado</center>
                                                </th>
                                            <?php } ?>
                                            <th>
                                                <center>Factura</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($rol_sesion == "Administrador" || $id_rol == 4 || $rol_sesion == "Encargado de Ventas" || $id_rol == 3) {

                                            $contador = 0;
                                            foreach ($ventas_datos as $venta) {
                                                $id_venta = $venta['nro_venta'];
                                                $id_cliente = $venta['id_cliente'];
                                                $nombreApellido = $venta['nombre'] . ' ' . $venta['apellido'];
                                                $contador++;
                                        ?>
                                                <tr>
                                                    <td>
                                                        <center> <?php echo $contador; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $venta['nro_venta']; ?></center>
                                                    </td>
                                                    <td><!-- INICIO DE BOTON PRODUCTOS -->
                                                        <center>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_venta; ?>">
                                                                <i class="fa fa-shopping-basket"></i> Productos
                                                            </button>

                                                            <!-- Modal para ver productos-->
                                                            <?php
                                                            // Renderizar el modal utilizando la clase ModalProductos
                                                            echo ModalProductos::render($id_venta, $venta, $mysqli);
                                                            ?>

                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal -->
                                                            <div class="btn-group">
                                                                <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i> <?php echo $nombreApellido ?></a>
                                                                <!-- modal para ver clientes-->
                                                                <?php
                                                                // Renderizar el modal utilizando la clase ModalProductos
                                                                echo ModalVerClientes::render($id_cliente, $nombreApellido, $venta);
                                                                ?>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>$ <?php echo $venta['total_pagado']; ?></center>
                                                    </td>
                                                    <?php if ($rol_sesion == "Administrador" || $id_rol == 4 || $rol_sesion == "Encargado de Ventas" || $id_rol == 3) { ?>
                                                        <td>
                                                            <center>

                                                                <?php if ($venta['estado'] != 'anulada') { ?>
                                                                    <button type="button" class="btn btn-danger" onclick="anularVenta('<?php echo $venta['nro_venta']; ?>')">
                                                                        <i class="fa fa-ban"></i> Anular
                                                                    </button>
                                                                <?php } else { ?>
                                                                    <button type="button" class="btn btn-danger" disabled>
                                                                        <i class="fa fa-check-circle"></i> Anulada
                                                                    </button>
                                                                <?php } ?>

                                                            </center>
                                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                            <script>
                                                                function anularVenta(nro_venta) {
                                                                    if (confirm("¿Está seguro de que desea anular esta venta?")) {
                                                                        $.ajax({
                                                                            url: '../app/controllers/ventas/anular_venta.php',
                                                                            type: 'POST',
                                                                            data: {
                                                                                nro_venta: nro_venta
                                                                            },
                                                                            success: function(response) {
                                                                                alert(response); // Mostrar mensaje de éxito o error
                                                                                location.reload(); // Recargar la página para ver los cambios
                                                                            },
                                                                            error: function(xhr, status, error) {
                                                                                console.error('Error:', error);
                                                                                alert('Ocurrió un error al intentar anular la venta.');
                                                                            }
                                                                        });
                                                                    }
                                                                }
                                                            </script>
                                                        </td>
                                                        <td>
                                                            <a href="factura1.php?nro_venta=<?php echo $nro_venta; ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"> Imprimir</i></a>
                                                        </td>

                                                    <?php } ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                        } else {
                                            $contador = 0;
                                            foreach ($mostrar_ventas_datos as $listado_con_anuladas_venta) {
                                                $id_venta = $listado_con_anuladas_venta['nro_venta'];
                                                $id_cliente = $listado_con_anuladas_venta['id_cliente'];
                                                $nombreApellido = $listado_con_anuladas_venta['nombre'] . ' ' . $listado_con_anuladas_venta['apellido'];
                                                $contador++;
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center> <?php echo $contador; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $listado_con_anuladas_venta['nro_venta']; ?></center>
                                                    </td>
                                                    <td><!-- INICIO DE BOTON PRODUCTOS -->
                                                        <center>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_venta; ?>">
                                                                <i class="fa fa-shopping-basket"></i> Productos
                                                            </button>

                                                            <!-- Modal -->
                                                            <?php
                                                            // Renderizar el modal utilizando la clase ModalProductos
                                                            echo ModalProductos::render($id_venta, $venta, $mysqli);
                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <!-- Button trigger modal -->
                                                            <div class="btn-group">
                                                                <a type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_cliente; ?>"><i class="fa fa-eye"></i> <?php echo $nombreApellido ?></a>
                                                                <!-- modal para ver clientes-->
                                                                <?php
                                                                // Renderizar el modal utilizando la clase ModalProductos
                                                                echo ModalVerClientes::render($id_cliente, $nombreApellido, $venta);
                                                                ?>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>$ <?php echo $listado_con_anuladas_venta['total_pagado']; ?></center>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        <?php

                                        }
                                        ?>
                                    </tbody>


                                </table>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->
<!-- Page specific script -->
<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<?php
// Llamar al método estático render de la clase Reporte -->
echo Reporte::render();
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener todos los elementos de búsqueda y conteo de registros por cada modal de productos
        <?php foreach ($ventas_datos as $ventas_datos) { ?>
            const searchInput<?php echo $ventas_datos['nro_venta']; ?> = document.getElementById('searchInput<?php echo $ventas_datos['nro_venta']; ?>');
            const tabla_productos<?php echo $ventas_datos['nro_venta']; ?> = document.getElementById('tabla_productos<?php echo $ventas_datos['nro_venta']; ?>').getElementsByTagName('tbody')[0];
            const recordCount<?php echo $ventas_datos['nro_venta']; ?> = document.getElementById('recordCount<?php echo $ventas_datos['nro_venta']; ?>');

            searchInput<?php echo $ventas_datos['nro_venta']; ?>.addEventListener('keyup', function() {
                const filter = searchInput<?php echo $ventas_datos['nro_venta']; ?>.value.toLowerCase();
                let visibleRows = 0;

                Array.from(tabla_productos<?php echo $ventas_datos['nro_venta']; ?>.getElementsByTagName('tr')).forEach(function(row) {
                    if (row.classList.contains('total-row')) {
                        return;
                    }
                    const cells = row.getElementsByTagName('td');
                    let match = false;

                    Array.from(cells).forEach(function(cell) {
                        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                        }
                    });

                    if (match) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                recordCount<?php echo $ventas_datos['nro_venta']; ?>.textContent = `Productos encontrados: ${visibleRows}`;
            });

            // Inicializa el contador de registros excluyendo la fila de total
            const initialCount<?php echo $ventas_datos['nro_venta']; ?> = Array.from(tabla_productos<?php echo $ventas_datos['nro_venta']; ?>.getElementsByTagName('tr')).filter(row => !row.classList.contains('total-row')).length;
            recordCount<?php echo $ventas_datos['nro_venta']; ?>.textContent = `Cantidad de Productos: ${initialCount<?php echo $ventas_datos['nro_venta']; ?>}`;
        <?php } ?>
    });
</script>