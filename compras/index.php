<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "EyD" || $rol_sesion == "Vendedor") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/compras/listado_de_compras.php';

?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Compras</h1>
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
                            <h3 class="card-title">Compras registradas</h3>

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
                                                <center>N° de compra</center>
                                            </th>
                                            <th>
                                                <center>Fecha de pago</center>
                                            </th>
                                            <th>
                                                <center>Fecha de registro</center>
                                            </th>
                                            <th>
                                                <center>Detalle</center>
                                            </th>
                                            <th>
                                                <center>Proveedor</center>
                                            </th>
                                            <th>
                                                <center>Comprobante</center>
                                            </th>
                                            <th>
                                                <center>Costo</center>
                                            </th>
                                            <th>
                                                <center>Usuario de carga</center>
                                            </th>
                                            <th>
                                                <center>Descuento/recarga</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $contador = 0;
                                        foreach ($compras_datos as $compras) {
                                            $id_compra = $compras['nro_compra'];
                                            $contador++;
                                        ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $compras['nro_compra']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $compras['fecha_registro']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $compras['fecha_compra_pago']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_compra; ?>">
                                                            <i class="fa fa-shopping-basket"></i> Productos
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modal_productos<?php echo $id_compra; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color:orange">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Productos de la compra nro <?php echo $compras['nro_compra']; ?>, ingresados al local el día <?php echo $compras['fecha_ingreso_mercaderia']; ?>.
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input type="text" id="searchInput<?php echo $compras['nro_compra']; ?>" class="form-control" placeholder="Buscar...">
                                                                                </div>
                                                                                <div class="col-md-6 text-right">
                                                                                    <span id="recordCount<?php echo $compras['nro_compra']; ?>"></span>
                                                                                </div>
                                                                            </div>
                                                                            <table id="tabla_productos<?php echo $compras['nro_compra']; ?>" class="table table-bordered table-sm table-hover table-striped">
                                                                                <thead style="background-color:gray">
                                                                                    <tr>
                                                                                        <th>Código</th>
                                                                                        <th>Producto</th>
                                                                                        <th>Descripción</th>
                                                                                        <th>Categoría</th>
                                                                                        <th>Cantidad</th>
                                                                                        <th>Precio Unitario</th>
                                                                                        <th>Precio Subtotal</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $contador_detalle_compras = 0;
                                                                                    $cantidad_total = 0;
                                                                                    $precio_unitario_total = 0;
                                                                                    $precio_total = 0;
                                                                                    $nro_compra = $compras['nro_compra'];
                                                                                    $sql_detalle_compras = "SELECT *, pro.codigo as codigo_producto, pro.stock as stock,
                                    pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.id_producto as id_producto,
                                    cat.nombre_categoria as nombre_categoria
                                    FROM tb_detalle_compras as det_com
                                    INNER JOIN tb_almacen as pro ON det_com.id_producto = pro.id_producto 
                                    INNER JOIN tb_acategorias as cat ON cat.id_categoria = pro.id_categoria 
                                    WHERE nro_compra = '$nro_compra' 
                                    ORDER BY det_com.id_detalle_compras";
                                                                                    $resultado_detalle_compras = $mysqli->query($sql_detalle_compras);

                                                                                    if ($resultado_detalle_compras) {
                                                                                        $detalle_compras_datos = $resultado_detalle_compras->fetch_all(MYSQLI_ASSOC);

                                                                                        foreach ($detalle_compras_datos as $detalle_compras) {
                                                                                            $id_detalle_compras = $detalle_compras['id_detalle_compras'];
                                                                                            $contador_detalle_compras++;
                                                                                            $cantidad_total += $detalle_compras['cantidad_producto'];
                                                                                            $precio_unitario_total += $detalle_compras['precio_unitario'];
                                                                                            $precio_total += ($detalle_compras['cantidad_producto'] * $detalle_compras['precio_unitario']);
                                                                                    ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <center><?php echo $detalle_compras['codigo_producto']; ?></center>
                                                                                                    <input type="text" value="<?php echo $detalle_compras['id_producto']; ?>" id="id_producto<?php echo $contador_detalle_compras; ?>" hidden>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><?php echo $detalle_compras['nombre_producto']; ?></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><?php echo $detalle_compras['descripcion']; ?></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><?php echo $detalle_compras['nombre_categoria']; ?></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><span id="cantidad_detalle_compras<?php echo $contador_detalle_compras; ?>"><?php echo $detalle_compras['cantidad_producto']; ?></span></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center>$ <?php echo $detalle_compras['precio_unitario']; ?></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center>$ <?php
                                                                                                                $cantidad = floatval($detalle_compras['cantidad_producto']);
                                                                                                                $precio_unitario = floatval($detalle_compras['precio_unitario']);
                                                                                                                echo $subtotal = $cantidad * $precio_unitario;
                                                                                                                ?>
                                                                                                    </center>
                                                                                                </td>
                                                                                            </tr>
                                                                                    <?php
                                                                                        }
                                                                                    } else {
                                                                                        echo "Error en la consulta: " . $mysqli->error;
                                                                                    }
                                                                                    ?>
                                                                                    <tr class="total-row">
                                                                                        <th colspan="4" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                                                                        <th>
                                                                                            <center><?php echo $cantidad_total; ?></center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>$ <?php echo $precio_unitario_total; ?></center>
                                                                                        </th>
                                                                                        <th style="background-color: yellow;">
                                                                                            <center>$ <?php echo $precio_total; ?></center>
                                                                                        </th>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center><?php echo $compras['nombre_proveedor']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $compras['nro_comprobante']; ?></center>
                                                </td>
                                                <td>
                                                    <center>$ <?php echo $compras['costo']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $compras['nombre_usuario']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $compras['resultado']; ?>
                                                        <?php if ($compras['explicacion_diferencia']) { ?>
                                                            <button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($compras['explicacion_diferencia'], ENT_QUOTES); ?>">
                                                                <i class="fas fa-question-circle"></i>
                                                            </button>
                                                        <?php }; ?>
                                                    </center>
                                                </td>

                                            </tr>
                                        <?php
                                            $contador++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- /.content-wrapper -->
<!-- Page specific script -->
<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<script>
    $(function() {
        $("#example1").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Compras",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            /* fin de idiomas */
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": /* Ajuste de botones */ [{
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    }, {
                        extend: 'pdf',
                    }, {
                        extend: 'csv',
                    }, {
                        extend: 'excel',
                    }, {
                        text: 'Imprimir',
                        extend: 'print'
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener todos los elementos de búsqueda y conteo de registros por cada modal de productos
        <?php foreach ($compras_datos as $compra) { ?>
            const searchInput<?php echo $compra['nro_compra']; ?> = document.getElementById('searchInput<?php echo $compra['nro_compra']; ?>');
            const tabla_productos<?php echo $compra['nro_compra']; ?> = document.getElementById('tabla_productos<?php echo $compra['nro_compra']; ?>').getElementsByTagName('tbody')[0];
            const recordCount<?php echo $compra['nro_compra']; ?> = document.getElementById('recordCount<?php echo $compra['nro_compra']; ?>');

            searchInput<?php echo $compra['nro_compra']; ?>.addEventListener('keyup', function() {
                const filter = searchInput<?php echo $compra['nro_compra']; ?>.value.toLowerCase();
                let visibleRows = 0;

                Array.from(tabla_productos<?php echo $compra['nro_compra']; ?>.getElementsByTagName('tr')).forEach(function(row) {
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

                recordCount<?php echo $compra['nro_compra']; ?>.textContent = `Productos encontrados: ${visibleRows}`;
            });

            // Inicializa el contador de registros excluyendo la fila de total
            const initialCount<?php echo $compra['nro_compra']; ?> = Array.from(tabla_productos<?php echo $compra['nro_compra']; ?>.getElementsByTagName('tr')).filter(row => !row.classList.contains('total-row')).length;
            recordCount<?php echo $compra['nro_compra']; ?>.textContent = `Cantidad de Productos: ${initialCount<?php echo $compra['nro_compra']; ?>}`;
        <?php } ?>
    });
</script>