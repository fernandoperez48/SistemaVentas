<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/ventas/listado_de_ventas.php';



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

                                            <th>
                                                <center>Acciones</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($ventas_datos as $venta) {
                                            $id_venta = $venta['nro_venta'];
                                            $id_cliente = $venta['id_cliente'];
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

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modal_productos<?php echo $id_venta; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="background-color: #08c2ec">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $id_venta; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input type="text" id="searchInput<?php echo $venta['nro_venta']; ?>" class="form-control" placeholder="Buscar...">
                                                                                </div>
                                                                                <div class="col-md-6 text-right">
                                                                                    <span id="recordCount<?php echo $venta['nro_venta']; ?>"></span>
                                                                                </div>
                                                                            </div>
                                                                            <table id="tabla_productos<?php echo $venta['nro_venta']; ?>" class="table table-bordered table-sm table-hover table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">Nro</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">Producto</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">Detalle</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">Cantidad</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">Precio Unitario</th>
                                                                                        <th style="background-color: #e7e7e7; text-align:center;">Precio Subtotal</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $contador_carrito = 0;
                                                                                    $cantidad_total = 0;
                                                                                    $precio_unitario_total = 0;
                                                                                    $precio_total = 0;
                                                                                    $nro_venta = $venta['nro_venta'];
                                                                                    $sql_carrito = "SELECT carr.*, pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto 
                                                                FROM tb_carrito as carr 
                                                                INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
                                                                WHERE nro_venta = '$nro_venta' 
                                                                ORDER BY carr.id_carrito";
                                                                                    $resultado_carrito = $mysqli->query($sql_carrito);

                                                                                    if ($resultado_carrito) {
                                                                                        $carrito_datos = $resultado_carrito->fetch_all(MYSQLI_ASSOC);

                                                                                        foreach ($carrito_datos as $carrito) {
                                                                                            $id_carrito = $carrito['id_carrito'];
                                                                                            $contador_carrito++;
                                                                                            $cantidad_total += $carrito['cantidad'];
                                                                                            $precio_unitario_total += $carrito['precio_venta'];
                                                                                            $precio_total += ($carrito['cantidad'] * $carrito['precio_venta']);
                                                                                    ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <center><?php echo $contador_carrito; ?></center>
                                                                                                    <input type="text" value="<?php echo $carrito['id_producto']; ?>" id="id_producto<?php echo $contador_carrito; ?>" hidden>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><?php echo $carrito['nombre_producto']; ?></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><?php echo $carrito['descripcion']; ?></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><span id="cantidad_carrito<?php echo $contador_carrito; ?>"><?php echo $carrito['cantidad']; ?></span></center>
                                                                                                    <input type="text" id="stock_de_inventario<?php echo $contador_carrito; ?>" value="<?php echo $carrito['stock']; ?>" hidden>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><?php echo $carrito['precio_venta']; ?></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <center><?php echo $subtotal = floatval($carrito['cantidad']) * floatval($carrito['precio_venta']); ?></center>
                                                                                                </td>
                                                                                            </tr>
                                                                                    <?php
                                                                                        }
                                                                                    } else {
                                                                                        echo "Error en la consulta: " . $mysqli->error;
                                                                                    }
                                                                                    ?>

                                                                                    <tr class="total-row">
                                                                                        <th colspan="3" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                                                                        <th>
                                                                                            <center><?php echo $cantidad_total; ?></center>
                                                                                        </th>
                                                                                        <th>
                                                                                            <center><?php echo $precio_unitario_total; ?></center>
                                                                                        </th>
                                                                                        <th style="background-color: yellow;">
                                                                                            <center><?php echo $precio_total; ?></center>
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
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal_clientes<?php echo $id_venta; ?>">
                                                        <i class="fa fa-shopping-basket"></i>
                                                        <?php echo $venta['nombre'] . ' ' . $venta['apellido']; ?>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="Modal_clientes<?php echo $id_venta; ?>">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color:darkorange; color:white">
                                                                    <h4 class="modal-title">Cliente </h4>
                                                                    <div style="width: 10px;"></div>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <?php
                                                                $sql_clientes = "SELECT *, COALESCE(emp.nombre, p.nombre) AS nombre, COALESCE(emp.razon_social, p.apellido) AS apellido,
                                             COALESCE(emp.telefono, p.telefono) AS telefono, COALESCE(emp.email, p.email) AS email, COALESCE(emp.cuit, p.dni) AS cuit
                                             FROM tb_clientes as cl
                                             LEFT JOIN tb_empresas AS emp ON cl.id_empresa = emp.id_empresa
                                             LEFT JOIN tb_personas AS p ON cl.id_persona = p.id_persona
                                             WHERE cl.id_cliente = '$id_cliente'";

                                                                $resultado_clientes = $mysqli->query($sql_clientes);
                                                                $clientes_datos = array();
                                                                while ($fila = $resultado_clientes->fetch_assoc()) {
                                                                    $clientes_datos[] = $fila;
                                                                }

                                                                foreach ($clientes_datos as $cliente) {
                                                                    $nombre_cliente = $cliente['nombre'] . ' ' . $cliente['apellido'];
                                                                    $nit_ci_cliente = $cliente['cuit'];
                                                                    $celular_cliente = $cliente['telefono'];
                                                                    $email_cliente = $cliente['email'];
                                                                ?>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="">Nombre del cliente</label>
                                                                            <input type="text" value="<?php echo $nombre_cliente; ?>" name="nombre_cliente" class="form-control" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Nit/CI del cliente</label>
                                                                            <input type="text" value="<?php echo $nit_ci_cliente; ?>" name="nit_ci_cliente" class="form-control" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Celular del cliente</label>
                                                                            <input type="text" value="<?php echo $celular_cliente; ?>" name="celular_cliente" class="form-control" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Email del cliente</label>
                                                                            <input type="text" value="<?php echo $email_cliente; ?>" name="email_cliente" class="form-control" disabled>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button type="button" class="btn btn-danger btn_borrar_venta" data-toggle="modal" data-target="#borrar_venta<?php echo $id_venta; ?>"><i class="fa fa-trash"></i></button>
                                                    </center>
                                                </td>
                                            </tr>
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