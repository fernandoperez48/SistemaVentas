<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/ventas/listado_de_ventas.php';



?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
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
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
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
                                        foreach ($ventas_datos as $ventas_datos) {
                                            $id_venta = $ventas_datos['id_venta'];
                                            $id_cliente = $ventas_datos['id_cliente'];
                                            $contador++;
                                        ?>
                                            <tr>
                                                <td>
                                                    <center> <?php echo $contador; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $ventas_datos['nro_venta']; ?></center>
                                                </td>
                                                <td>
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
                                                                        <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $ventas_datos['nro_venta']; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm table-hover table-striped">
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
                                                                                    $nro_venta = $ventas_datos['nro_venta'];
                                                                                    $sql_carrito = "SELECT *,pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto from tb_carrito as carr inner join tb_almacen as pro
                                        on carr.id_producto = pro.id_producto where nro_venta = '$nro_venta' order by carr.id_carrito";
                                                                                    $query_carrito = $pdo->prepare($sql_carrito);
                                                                                    $query_carrito->execute();
                                                                                    $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

                                                                                    foreach ($carrito_datos as $carrito_datos) {
                                                                                        $id_carrito = $carrito_datos['id_carrito'];
                                                                                        $contador_carrito = $contador_carrito + 1;
                                                                                        $cantidad_total = $cantidad_total + $carrito_datos['cantidad'];
                                                                                        $precio_unitario_total = $precio_unitario_total + $carrito_datos['precio_venta'];
                                                                                        $precio_total = $precio_total + ($carrito_datos['cantidad'] * $carrito_datos['precio_venta']);
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <center><?php echo $contador_carrito; ?></center>
                                                                                                <input type="text" value="<?php echo $carrito_datos['id_producto']; ?>" id="id_producto<?php echo $contador_carrito; ?>" hidden>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center><?php echo $carrito_datos['nombre_producto']; ?></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center><?php echo $carrito_datos['descripcion']; ?></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center><span id="cantidad_carrito<?php echo $contador_carrito; ?>"><?php echo $carrito_datos['cantidad']; ?></span></center>
                                                                                                <input type="text" id="stock_de_inventario<?php echo $contador_carrito; ?>" value="<?php echo $carrito_datos['stock']; ?>" hidden>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center><?php echo $carrito_datos['precio_venta']; ?></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <?php
                                                                                                    $cantidad = floatval($carrito_datos['cantidad']);
                                                                                                    $precio_venta = floatval($carrito_datos['precio_venta']);
                                                                                                    echo $subtotal = $cantidad * $precio_venta;
                                                                                                    ?>
                                                                                                </center>
                                                                                            </td>

                                                                                        </tr>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <th colspan="3" style="background-color: #e7e7e7; text-align:right;">Total</th>
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
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal_clientes<?php echo $id_venta; ?>">
                                                        <i class="fa fa-shopping-basket"></i> <?php echo $ventas_datos['nombre'] . ' ' . $ventas_datos['apellido']; ?>
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
                                                                $sql_clientes = "SELECT *, COALESCE(emp.nombre, p.nombre) AS nombre,COALESCE(emp.razon_social, p.apellido) AS apellido
                                                                from tb_clientes as cl
                                                                left JOIN tb_empresas AS emp ON cl.id_empresa = emp.id_empresa
                                                                left JOIN tb_personas AS p ON cl.id_persona = p.id_persona
                                                                where cl.id_cliente = '$id_cliente' ";


                                                                $query_clientes = $pdo->prepare($sql_clientes);
                                                                $query_clientes->execute();
                                                                $clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

                                                                foreach ($clientes_datos as $clientes_datos) {
                                                                    $nombre_cliente = $clientes_datos['nombre'] . ' ' . $clientes_datos['apellido'];
                                                                    $nit_ci_cliente = $clientes_datos['saldo'];
                                                                    $celular_cliente = $clientes_datos['celular_cliente'];
                                                                    $email_cliente = $clientes_datos['email_cliente'];
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
                                                                            <label for="">Correo del cliente</label>
                                                                            <input type="email" value="<?php echo $email_cliente; ?>" name="email_cliente" class="form-control" disabled>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">

                                                                    </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->

                                                    </div>

                                                </td>
                                                <td>
                                                    <center><button class="btn btn-primary" disabled><?php echo "$" . $ventas_datos['total_pagado']; ?></button></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="" class="btn btn-info"><i class="fa fa-eye"></i> Mostrar</a>
                                                        <a href="" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar</a>
                                                    </center>
                                                </td>
                                            </tr>

                                        <?php
                                                                }
                                        ?>
                                    </tbody>
                                <?php
                                        }
                                ?>
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