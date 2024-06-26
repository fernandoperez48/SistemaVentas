<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/ventas/listado_de_ventas.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/clientes/listado_de_clientes.php';

?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Ventas</h1>
                    <div class="content">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <?php
                                $contador_de_ventas = 0;
                                foreach ($ventas_datos as $ventas_datos) {
                                    $contador_de_ventas = $contador_de_ventas + 1;
                                }
                                ?>
                                <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Venta N°
                                    <input type="text" value="<?php echo $contador_de_ventas + 1 ?>" style="text-align: center;" disabled>
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <b>Carrito</b>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                                    <i class="fas fa-search"></i>
                                    Buscar Producto
                                </button>

                                <div class="modal fade" id="modal-buscar_producto">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#446DF6; color:white">
                                                <h4 class="modal-title">Busqueda del producto</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table table-responsive">
                                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <center>Nro</center>
                                                                </th>
                                                                <th>
                                                                    <center>Seleccionar</center>
                                                                </th>
                                                                <th>
                                                                    <center>Codigo</center>
                                                                </th>
                                                                <th>
                                                                    <center>Categoria</center>
                                                                </th>
                                                                <th>
                                                                    <center>Imagen</center>
                                                                </th>
                                                                <th>
                                                                    <center>Nombre</center>
                                                                </th>
                                                                <th>
                                                                    <center>Descripcion</center>
                                                                </th>
                                                                <th>
                                                                    <center>Stock</center>
                                                                </th>
                                                                <th>
                                                                    <center>Precio Compra</center>
                                                                </th>
                                                                <th>
                                                                    <center>Precio Venta</center>
                                                                </th>
                                                                <th>
                                                                    <center>Fecha Compra</center>
                                                                </th>
                                                                <th>
                                                                    <center>Usuario</center>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $contador = 0;
                                                            foreach ($productos_datos as $productos_datos) {
                                                                $id_producto = $productos_datos['id_producto']; ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $contador += 1; ?>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-info" id="btn_seleccionar<?php echo $productos_datos['id_producto']; ?>">Seleccionar</button>
                                                                        <script>
                                                                            $("#btn_seleccionar<?php echo $productos_datos['id_producto']; ?>").click(function() {
                                                                                $("#id_producto").val("<?php echo $productos_datos['id_producto']; ?>");
                                                                                $("#producto").val("<?php echo $productos_datos['nombre']; ?>");
                                                                                $("#detalle").val("<?php echo $productos_datos['descripcion']; ?>");
                                                                                $("#precio_unitario").val("<?php echo $productos_datos['precio_venta']; ?>");
                                                                                $('#cantidad').focus();


                                                                                //$("#modal-buscar_producto").modal("hide");
                                                                            });
                                                                        </script>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['codigo']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['nombre_categoria']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <img src="<?php echo $URL . "/almacen/img_productos" . $productos_datos['imagen']; ?>" width="50px">
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['nombre']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['descripcion']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['stock']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <center><?php echo $productos_datos['precio_compra']; ?></center>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['precio_venta']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['fecha_ingreso']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productos_datos['email']; ?>
                                                                    </td>

                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>

                                                        </tbody>

                                                    </table>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" id="id_producto" hidden>
                                                                <label for="">Producto</label>
                                                                <input type="text" id="producto" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Detalle</label>
                                                                <input type="text" id="detalle" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="">Cantidad</label>
                                                                <input type="text" id="cantidad" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="">Precio Unitario</label>
                                                                <input type="text" id="precio_unitario" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button style="float: right;" id="btn_registrar_carrito" class="btn btn-primary">Registrar</button>
                                                    <div id="respuesta_carrito"></div>
                                                    <script>
                                                        $("#btn_registrar_carrito").click(function() {
                                                            var nro_venta = "<?php echo $contador_de_ventas + 1; ?>";
                                                            var id_producto = $("#id_producto").val();
                                                            var cantidad = $("#cantidad").val();
                                                            if (id_producto == "") {
                                                                alert("Seleccione un producto");
                                                            } else if (cantidad == "") {
                                                                alert("Ingrese la cantidad");
                                                            } else {
                                                                //alert("listo para el controlador");
                                                                var url = "../app/controllers/ventas/registrar_carrito.php";
                                                                $.get(url, {
                                                                    nro_venta: nro_venta,
                                                                    id_producto: id_producto,
                                                                    cantidad: cantidad
                                                                }, function(datos) {
                                                                    $('#respuesta_carrito').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <br><br>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <br><br>
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
                                                <th style="background-color: #e7e7e7; text-align:center;">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $contador_carrito = 0;
                                            $cantidad_total = 0;
                                            $precio_unitario_total = 0;
                                            $precio_total = 0;
                                            $sql_carrito = "SELECT *, pro.nombre AS nombre_producto, pro.descripcion AS descripcion, pro.precio_venta AS precio_venta, pro.stock AS stock, pro.id_producto AS id_producto 
                                                            FROM tb_carrito AS carr 
                                                            INNER JOIN tb_almacen AS pro ON carr.id_producto = pro.id_producto 
                                                            WHERE nro_venta = $contador_de_ventas + 1
                                                            ORDER BY carr.id_carrito";
                                            $query_carrito = $mysqli->query($sql_carrito);

                                            if ($query_carrito) {
                                                foreach ($query_carrito as $carrito_datos) {
                                                    $id_carrito = $carrito_datos['id_carrito'];
                                                    $contador_carrito += 1;
                                                    $cantidad_total += $carrito_datos['cantidad'];
                                                    $precio_unitario_total += $carrito_datos['precio_venta'];
                                                    $precio_total += ($carrito_datos['cantidad'] * $carrito_datos['precio_venta']);
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
                                                        <td>
                                                            <form action="../app/controllers/ventas/borrar_carrito.php" method="post">
                                                                <center>
                                                                    <input type="text" name="id_carrito" value="<?php echo $id_carrito; ?>" hidden>
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>
                                                                </center>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "Error al ejecutar la consulta: " . $mysqli->error;
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

                            <!-- /.card-body -->
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fa fa-user-check"></i> Datos del Cliente</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <b>Carrito</b>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_cliente">
                                            <i class="fas fa-search"></i>
                                            Buscar Cliente
                                        </button>

                                        <div class="modal fade" id="modal-buscar_cliente">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Busqueda del Cliente </h4>
                                                        <div style="width: 10px;"></div>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-agregar_cliente">
                                                            <i class="fas fa-users"></i>
                                                            Agregar nuevo cliente
                                                        </button>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table table-responsive">
                                                            <table id="example1" class="table table-bordered table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <center>Nro</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Seleccionar</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Nombre</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Nit/CI</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Celular</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Email</center>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $contador_de_clientes = 0;
                                                                    foreach ($clientes_datos as $clientes_datos) {
                                                                        $id_cliente = $clientes_datos['id_cliente'];
                                                                        $contador_de_clientes = $contador_de_clientes + 1; ?>
                                                                        <tr>
                                                                            <td>
                                                                                <center><?php echo $contador_de_clientes; ?></center>
                                                                            </td>
                                                                            <td>
                                                                                <center>
                                                                                    <button class="btn btn-info" id="btn_pasar_cliente<?php echo $id_cliente; ?>">Seleccionar</button>
                                                                                    <script>
                                                                                        $("#btn_pasar_cliente<?php echo $id_cliente; ?>").click(function() {
                                                                                            $("#id_cliente").val("<?php echo $clientes_datos['id_cliente']; ?>");
                                                                                            $("#nombre_cliente").val("<?php echo $clientes_datos['nombre_cliente']; ?>");
                                                                                            $("#nit_ci_cliente").val("<?php echo $clientes_datos['nit_ci_cliente']; ?>");
                                                                                            $("#celular_cliente").val("<?php echo $clientes_datos['celular_cliente']; ?>");
                                                                                            $("#email_cliente").val("<?php echo $clientes_datos['email_cliente']; ?>");
                                                                                            $("#modal-buscar_cliente").modal("hide");
                                                                                        });
                                                                                    </script>
                                                                                </center>
                                                                            </td>
                                                                            <td>
                                                                                <center><?php echo $clientes_datos['nombre_cliente']; ?></center>
                                                                            </td>
                                                                            <td>
                                                                                <center><?php echo $clientes_datos['nit_ci_cliente']; ?></center>
                                                                            </td>
                                                                            <td>
                                                                                <center><?php echo $clientes_datos['celular_cliente']; ?></center>
                                                                            </td>
                                                                            <td>
                                                                                <center><?php echo $clientes_datos['email_cliente']; ?></center>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">

                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->

                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" id="id_cliente" hidden>
                                                    <label for="">Nombre del Cliente</label>
                                                    <input type="text" class="form-control" id="nombre_cliente">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Nit/Ci del Cliente</label>
                                                <input type="text" class="form-control" id="nit_ci_cliente">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Celular del Cliente</label>
                                                <input type="text" class="form-control" id="celular_cliente">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Email del Cliente</label>
                                                <input type="text" class="form-control" id="email_cliente">
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /.card-body -->
                            </div>
                            <div class="col-md-3">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fa fa-shopping-basket"></i> Registrar venta</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Monto a cancelar</label>
                                            <input type="text" class="form-control" id="total_a_cancelar" style="text-align:center; background-color:yellow" value="<?php echo $precio_total; ?>" disabled>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Total pagado</label>
                                                    <input type="text" class="form-control" id="total_pagado">
                                                    <script>
                                                        $("#total_pagado").keyup(function() {
                                                            var total_a_cancelar = $("#total_a_cancelar").val();
                                                            var total_pagado = $("#total_pagado").val();
                                                            var cambio = parseFloat(total_pagado) - parseFloat(total_a_cancelar);
                                                            $("#cambio").val(cambio);
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Cambio</label>
                                                    <input type="text" class="form-control" id="cambio" disabled>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button id="btn_guardar_venta" class="btn btn-primary btn-block">
                                                Guardar venta
                                            </button>
                                            <div id="respuesta_registro_venta"></div>
                                            <script>
                                                $("#btn_guardar_venta").click(function() {
                                                    var nro_venta = "<?php echo $contador_de_ventas + 1; ?>";
                                                    var id_cliente = $("#id_cliente").val();
                                                    var total_a_cancelar = $("#total_a_cancelar").val();
                                                    if (id_cliente == "") {
                                                        alert("Seleccione un cliente");

                                                    } else {

                                                        actualizar_stock();
                                                        guardar_venta();
                                                    }


                                                    function actualizar_stock() {
                                                        var i = 1;
                                                        var n = '<?php echo $contador_carrito; ?>';

                                                        for (i = 1; i <= n; i++) {
                                                            var a = 'stock_de_inventario' + i;
                                                            var stock_de_inventario = $('#' + a).val();

                                                            var b = 'cantidad_carrito' + i;
                                                            var cantidad_carrito = $('#' + b).text();

                                                            var c = 'id_producto' + i;
                                                            var id_producto = $('#' + c).val();


                                                            var stock_calculado = parseFloat(stock_de_inventario) - parseFloat(cantidad_carrito);

                                                            //alert(stock_de_inventario+" "+cantidad_carrito+" "+stock_calculado+" "+id_producto);

                                                            var url2 = "../app/controllers/ventas/actualizar_stock.php";
                                                            $.get(url2, {
                                                                id_producto: id_producto,
                                                                stock_calculado: stock_calculado,
                                                            }, function(datos) {
                                                                guardar_venta();
                                                            });
                                                        }
                                                    }

                                                    function guardar_venta() {
                                                        var url = "../app/controllers/ventas/registro_de_ventas.php";
                                                        $.get(url, {
                                                            nro_venta: nro_venta,
                                                            id_cliente: id_cliente,
                                                            total_a_cancelar: total_a_cancelar
                                                        }, function(datos) {
                                                            $('#respuesta_registro_venta').html(datos);
                                                        });
                                                    }


                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div> <!-- /.card-body -->
                            </div>





                        </div>
                    </div>
                    <!-- /.card -->


                </div>

            </div>
        </div>
    </div>
</div>


<!-- Main content -->

<!-- Main content -->

<!-- /.content-wrapper -->
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 to 0 of 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
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


        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    $(function() {
        $("#example2").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 to 0 of 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
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
<!--modal para visualizar el formulario para agregar clientes -->
<div class="modal fade" id="modal-agregar_cliente">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color:darkorange; color:white">
                <h4 class="modal-title">Nuevo Cliente </h4>
                <div style="width: 10px;"></div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/guardar_clientes.php" method="post">
                    <div class="form-group">
                        <label for="">Nombre del cliente</label>
                        <input type="text" name="nombre_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nit/CI del cliente</label>
                        <input type="text" name="nit_ci_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Celular del cliente</label>
                        <input type="text" name="celular_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Correo del cliente</label>
                        <input type="email" name="email_cliente" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block">Guardar cliente</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

</div>