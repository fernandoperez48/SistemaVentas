<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "EyD" || $rol_sesion == "Vendedor") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/compras/listado_de_compras.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
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
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
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
                                            <!-- <th>
                                                <center>Acciones</center>
                                            </th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($compras_datos as $compras) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <?php echo $compras['nro_compra']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $compras['fecha_registro']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $compras['fecha_compra_pago']; ?>
                                                    </center>
                                                </td>
                                                <td><!-- INICIO DE BOTON PRODUCTOS -->
                                                    <center>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $compras['nro_compra']; ?>">
                                                            <i class="fa fa-shopping-basket"></i> Productos
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modal_productos<?php echo $compras['nro_compra']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #08c2ec">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Productos de la compra nro
                                                                            <?php echo $compras['nro_compra']; ?>, ingresados al local el día <?php echo $compras['fecha_ingreso_mercaderia']; ?>.</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar...">
                                                                                </div>
                                                                                <div class="col-md-6 text-right">
                                                                                    <span id="recordCount"></span>
                                                                                </div>
                                                                            </div>
                                                                            <table id="tabla_productos" class="table table-bordered table-sm table-hover table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">
                                                                                            Código </th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">
                                                                                            Producto</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">
                                                                                            Descripción</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">
                                                                                            Categoria</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">
                                                                                            Cantidad</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">
                                                                                            Precio Unitario</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">
                                                                                            Precio Subtotal</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $contador_detalle_compras = 0;
                                                                                    $cantidad_total = 0;
                                                                                    $precio_unitario_total = 0;
                                                                                    $precio_total = 0;
                                                                                    $nro_compra = $compras['nro_compra'];
                                                                                    $sql_detalle_compras = "SELECT *, pro.codigo as codigo_producto,pro.stock as stock,
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
                                                                                                    <center>
                                                                                                        <?php echo $detalle_compras['codigo_producto']; ?>
                                                                                                    </center>
                                                                                                    <input type="text" value="<?php echo $detalle_compras['id_producto']; ?>" id="id_producto<?php echo $contador_detalle_compras; ?>" hidden>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center>
                                                                                                        <?php echo $detalle_compras['nombre_producto']; ?>
                                                                                                    </center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center>
                                                                                                        <?php echo $detalle_compras['descripcion']; ?>
                                                                                                    </center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center>
                                                                                                        <?php echo $detalle_compras['nombre_categoria']; ?>
                                                                                                    </center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><span id="cantidad_detalle_compras<?php echo $contador_detalle_compras; ?>"><?php echo $detalle_compras['cantidad_producto']; ?></span>
                                                                                                    </center>
                                                                                                    <!--  <input type="text" id="stock_de_inventario<?php echo $contador_detalle_compras; ?>" value="<?php echo $detalle_compras['stock']; ?>" hidden> -->
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center>
                                                                                                        <?php echo $detalle_compras['precio_unitario']; ?>
                                                                                                    </center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center>
                                                                                                        <?php
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
                                                                                        </trclass>
                                                                                        <th colspan="4" style="background-color: #e7e7e7; text-align:right;">
                                                                                            Total</th>
                                                                                        <th>
                                                                                            <center>
                                                                                                <?php
                                                                                                echo $cantidad_total;
                                                                                                ?>
                                                                                            </center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center>
                                                                                                <?php
                                                                                                echo $precio_unitario_total;
                                                                                                ?>
                                                                                            </center>
                                                                                        </th>
                                                                                        <th style="background-color: yellow;">
                                                                                            <center>
                                                                                                <?php
                                                                                                echo $precio_total;
                                                                                                ?>
                                                                                            </center>
                                                                                        </th>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- Button trigger modal -->
                                                    </center>
                                                </td><!-- FIN DE BOTON PRODUCTOS -->
                                                <td>
                                                    <center>
                                                        <?php echo $compras['nombre_proveedor']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $compras['nro_comprobante']; ?>
                                                    </center>
                                                </td>

                                                <td>
                                                    <center>
                                                        <?php echo $compras['costo']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $compras['nombre_usuario']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $compras['resultado']; ?>
                                                        <?php if ($compras['resultado']) { ?>
                                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#infoModal_<?php echo $compras['nro_compra']; ?>">
                                                                <i class="fas fa-info-circle"></i>
                                                            </button> <?php }; ?>
                                                    </center>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="infoModal_<?php echo $compras['nro_compra']; ?>" tabindex="-1" aria-labelledby="infoModalLabel_<?php echo $compras['nro_compra']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="infoModalLabel_<?php echo $compras['nro_compra']; ?>">Explicación de la Diferencia</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php echo nl2br($compras['explicacion_diferencia']); ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td>
                                                    <center>
                                                        <div class="btn-group">
                                                            <a href="show.php?id=<?php echo $nro_compra; ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>Ver</a>
                                                            <a href="update.php?id=<?php echo $nro_compra; ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                                                            <a href="delete.php?id=<?php echo $nro_compra; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Borrar</a>
                                                        </div>
                                                    </center>
                                                </td> -->
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


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
        const searchInput = document.getElementById('searchInput');
        const tabla_productos = document.getElementById('tabla_productos').getElementsByTagName('tbody')[0];
        const recordCount = document.getElementById('recordCount');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            let visibleRows = 0;

            Array.from(tabla_productos.getElementsByTagName('tr')).forEach(function(row) {
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

            recordCount.textContent = `Productos encontrados: ${visibleRows}`;
        });

        // Inicializa el contador de registros excluyendo la fila de total
        const initialCount = Array.from(tabla_productos.getElementsByTagName('tr')).filter(row => !row.classList.contains('total-row')).length;
        recordCount.textContent = `Cantidad de Productos: ${initialCount}`;
    });
</script>