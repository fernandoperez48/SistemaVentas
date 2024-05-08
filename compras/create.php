<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "EyD" || $rol_sesion == "Vendedor" || $rol_sesion == "Almacen") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';
include '../app/controllers/compras/listado_de_compras.php';
include '../app/controllers/almacen/listado_de_productos_por_proveedor.php';
?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de una nueva compra</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- se cuenta la cantidad de compras de la tabla correspondiente
                                 y se le agrega un numero mas para indicar qué numero de compra sera la próxima -->
                                        <?php
                                        $contador_de_compras = 0;
                                        foreach ($compras_datos as $compras_datos) {
                                            $contador_de_compras = $contador_de_compras + 1;
                                        }
                                        ?>
                                        <div style="display: flex;">
                                            <h3 class="card-title"><i class="fa fa-shopping-bag" style="margin-right: 5px; margin-top: 5px;"></i>

                                                <h4>Compra N°</h4>
                                                <input type="text" value="<?php echo $contador_de_compras + 1 ?>" style="text-align: center; margin-left:15px;" disabled>
                                            </h3>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div>
                                            <div style="display: flex;">
                                                <div>
                                                    <label for="">
                                                        <h4>Proveedor:</h4>
                                                    </label>
                                                </div>

                                                <div style="display: flex;">
                                                    <select name="id_proveedor" id="proveedor_select" style="margin-left: 10px;">
                                                        <option value="">Seleccionar proveedor</option> <!--Opción por defecto -->
                                                        <?php
                                                        foreach ($proveedores_datos as $proveedores_datos) { ?>
                                                            <option value="<?php echo $proveedores_datos['id_proveedor']; ?>"><?php echo $proveedores_datos['nombre_proveedor']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <a href="<?php echo $URL; ?>/proveedores" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                </a>

                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div style="display: flex;">
                                    <h4><b>Detalle de la Compra</b></h4>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto" style="margin-left: 15px;">
                                        <i class="fas fa-search"></i>
                                        Buscar Producto
                                    </button>

                                </div>
                                <!-- MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO -->
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
                                                                    <center>Ultimo Precio Compra</center>
                                                                </th>
                                                                <th>
                                                                    <center>Fecha Ingreso</center>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php

                                                            $contador = 0;
                                                            foreach ($productosXproveedor_datos as $productosXproveedor_datos) {
                                                                $id_producto = $productosXproveedor_datos['id_producto']; ?>
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn-info" id="btn_seleccionar<?php echo $productosXproveedor_datos['id_producto']; ?>">Seleccionar</button>
                                                                        <script>
                                                                            $("#btn_seleccionar<?php echo $productosXproveedor_datos['id_producto']; ?>").click(function() {
                                                                                $("#id_producto").val("<?php echo $productosXproveedor_datos['id_producto']; ?>");
                                                                                $("#producto").val("<?php echo $productosXproveedor_datos['nombre']; ?>");
                                                                                $("#detalle").val("<?php echo $productosXproveedor_datos['descripcion']; ?>");
                                                                                $("#ultimo_precio").val("<?php echo $productosXproveedor_datos['precio_compra']; ?>");
                                                                                $('#cantidad').focus();


                                                                                //$("#modal-buscar_producto").modal("hide");
                                                                            });
                                                                        </script>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productosXproveedor_datos['codigo']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productosXproveedor_datos['nombre_categoria']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <img src="<?php echo $URL . "/almacen/img_productos" . $productosXproveedor_datos['imagen']; ?>" width="50px">
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productosXproveedor_datos['nombre']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productosXproveedor_datos['descripcion']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productosXproveedor_datos['stock']; ?>
                                                                    </td>
                                                                    <td>
                                                                        ultimo precio
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $productosXproveedor_datos['fecha_ultimo_ingreso']; ?>
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
                                                                <input type="text" id="precio_unitario" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button style="float: right;" id="btn_registrar_detalle_compra" class="btn btn-primary">Registrar</button>
                                                    <div id="respuesta_detalle_compra"></div>
                                                    <script>
                                                        $("#btn_registrar_detalle_compra").click(function() {
                                                            var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
                                                            var id_producto = $("#id_producto").val();
                                                            var cantidad = $("#cantidad").val();
                                                            var precio_unitario = $("#precio_unitario").val();
                                                            if (id_producto == "") {
                                                                alert("Seleccione un producto");
                                                            } else if (cantidad == "") {
                                                                alert("Ingrese la cantidad");
                                                            } else if (precio_unitario == "") {
                                                                alert("Ingrese el precio unitario");
                                                            } else {
                                                                //alert("listo para el controlador");
                                                                var url = "../app/controllers/compras/registrar_detalle_compra.php";
                                                                $.get(url, {
                                                                    nro_compra: nro_compra,
                                                                    id_producto: id_producto,
                                                                    cantidad: cantidad,
                                                                    precio_unitario: precio_unitario
                                                                }, function(datos) {
                                                                    $('#respuesta_detalle_compra').html(datos);
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
                                                <th style="background-color: #e7e7e7; text-align:center;">Codigo</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Producto</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Detalle</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Proveedor</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Categoria</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Cantidad</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Precio Unitario</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Precio Subtotal</th>
                                                <th style="background-color: #e7e7e7; text-align:center;">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $contador_detalle_compras = 0;
                                            $cantidad_total = 0;
                                            $precio_unitario_total = 0;
                                            $precio_total = 0;

                                            $sql_detalle_compras = "SELECT *, 
                                        pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.codigo as codigo, 
                                        pr.nombre_proveedor as nombre_proveedor,
                                        cat.nombre_categoria as nombre_categoria
                                        from tb_detalle_compras as detcom
                                        inner join tb_almacen as pro on detcom.id_producto = pro.id_producto 
                                        inner join tb_proveedores as pr on pro.id_proveedor = pr.id_proveedor
                                        inner join tb_acategorias as cat on cat.id_categoria = pro.id_categoria
                                        where nro_compra = $contador_de_compras + 1 
                                        order by detcom.id_detalle_compras";
                                            $query_detalle_compras = $pdo->prepare($sql_detalle_compras);
                                            $query_detalle_compras->execute();
                                            $detalle_compras_datos = $query_detalle_compras->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($detalle_compras_datos as $detalle_compras_datos) {
                                                $id_detalle_compras = $detalle_compras_datos['id_detalle_compras'];
                                                $contador_detalle_compras = $contador_detalle_compras + 1;
                                                $cantidad_total = $cantidad_total + $detalle_compras_datos['cantidad_producto'];
                                                $precio_unitario_total = $precio_unitario_total + $detalle_compras_datos['precio_unitario'];
                                                $precio_total = $precio_total + ($detalle_compras_datos['cantidad_producto'] * $detalle_compras_datos['precio_unitario']);
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $contador_detalle_compras; ?></center>
                                                        <input type="text" value="<?php echo $detalle_compras_datos['id_producto']; ?>" id="id_producto<?php echo $contador_detalle_compras; ?>" hidden>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['nombre_producto']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['descripcion']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['nombre_proveedor']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['nombre_categoria']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><span id="cantidad_detalle_compras<?php echo $contador_detalle_compras; ?>"><?php echo $detalle_compras_datos['cantidad_producto']; ?></span></center>
                                                        <input type="text" id="stock_de_inventario<?php echo $contador_detalle_compras; ?>" value="<?php echo $detalle_compras_datos['stock']; ?>" hidden>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $detalle_compras_datos['precio_unitario']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php
                                                            $cantidad_producto = floatval($detalle_compras_datos['cantidad_producto']);
                                                            $precio_unitario = floatval($detalle_compras_datos['precio_unitario']);
                                                            echo $subtotal = $cantidad_producto * $precio_unitario;
                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <form action="../app/controllers/compras/borrar_detalle_compras.php" method="post">
                                                            <center>
                                                                <input type="text" name="id_detalle_compras" value="<?php echo $id_detalle_compras; ?>" hidden>
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>
                                                            </center>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                            <tr>
                                                <th colspan="5" style="background-color: #e7e7e7; text-align:right;">Total</th>
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
                </div>
                <div class="row">
                    <div class="col-md-9">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Detalle de la compra</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php
                                                    $contador_de_compras = 0;
                                                    foreach ($compras_datos as $compras_datos) {
                                                        $contador_de_compras += 1;
                                                    }
                                                    ?>
                                                    <label for="">Numero de la compra</label>
                                                    <input type="text" value="<?php echo $contador_de_compras + 1 ?>" style="text-align: center; margin-left:15px;" disabled>
                                                    <!--  <input type="text" style="text-align: center;" class="form-control" value="<?php echo $contador_de_compras; ?>" disabled>
                                                <input type="text" id="nro_compra" value="<?php echo $contador_de_compras; ?>" hidden>
                                                 -->
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Fecha de la operación</label>
                                                    <input type="date" class="form-control" id="fecha_compra">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Comprobante de la compra</label>
                                                    <input type="text" class="form-control" id="comprobante">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Costo de la compra</label>
                                                    <input type="text" class="form-control" id="precio_compra_controlador" style="text-align: center;">
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Stock actual</label>
                                                    <input type="text" id="stock_actual" class="form-control" style="background-color: #d1c53b; text-align:center" disabled>
                                                    <input type="text" id="stock_actual" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Stock total</label>
                                                    <input type="text" id="stock_total" class="form-control" style="text-align:center" id="fecha_compra" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Cantidad de la compra</label>
                                                    <input type="number" style="text-align: center;" class="form-control" id="cantidad_compra">
                                                </div>
                                                <script>
                                                    $("#cantidad_compra").keyup(function() {
                                                        var stock_actual = $("#stock_actual").val();
                                                        var stock_compra = $("#cantidad_compra").val();
                                                        var total = parseInt(stock_actual) + parseInt(stock_compra);
                                                        $("#stock_total").val(total);
                                                    });
                                                </script>
                                            </div> -->

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text" class="form-control" value="<?php echo $email_session; ?>" disabled>
                                                    <input type="text" id="id_usuario" hidden>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block" id="btn_guardar_compra">
                                                    <i class="fas fa-save"></i>
                                                    Guardar compra
                                                </button>
                                            </div>

                                        </div>
                                        <script>
                                            $("#btn_guardar_compra").click(function() {
                                                var id_producto = $("#id_producto").val();
                                                var nro_compra = $("#nro_compra").val();
                                                var fecha_compra = $("#fecha_compra").val();
                                                var id_proveedor = $("#id_proveedor").val();
                                                var comprobante = $("#comprobante").val();
                                                var id_usuario = '<?php echo $id_usuarios_sesion ?>';
                                                var precio_compra = $("#precio_compra_controlador").val();
                                                var cantidad_compra = $("#cantidad_compra").val();
                                                var stock_total = $("#stock_total").val();

                                                if (id_producto == "") {
                                                    $('#id_producto').focus();
                                                    alert("DEbe llenar todos los campos");
                                                } else if (fecha_compra == "") {
                                                    $('#fecha_compra').focus();
                                                    alert("DEbe llenar todos los campos");
                                                } else if (comprobante == "") {
                                                    $('#comprobante').focus();
                                                    alert("DEbe llenar todos los campos");
                                                } else if (precio_compra == "") {
                                                    $('#precio_compra_controlador').focus();
                                                    alert("DEbe llenar todos los campos");
                                                } else if (cantidad_compra == "") {
                                                    $('#cantidad_compra').focus();
                                                    alert("DEbe llenar todos los campos");
                                                } else {
                                                    var url = "../app/controllers/compras/create.php";
                                                    $.get(url, {
                                                        id_producto: id_producto,
                                                        nro_compra: nro_compra,
                                                        fecha_compra: fecha_compra,
                                                        id_proveedor: id_proveedor,
                                                        comprobante: comprobante,
                                                        id_usuario: id_usuario,
                                                        precio_compra: precio_compra,
                                                        cantidad_compra: cantidad_compra,
                                                        stock_total: stock_total
                                                    }, function(datos) {
                                                        $('#respuesta_create').html(datos);
                                                    });
                                                }
                                            });
                                        </script>
                                    </div>

                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <div id="respuesta_create"></div>

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
                                    <button id="btn_guardar_compra" class="btn btn-primary btn-block">
                                        Guardar compra
                                    </button>
                                    <div id="respuesta_registro_compra"></div>
                                    <script>
                                        $("#btn_guardar_compra").click(function() {
                                            var nro_compra = "<?php echo $contador_de_compras + 1; ?>";
                                            var id_cliente = $("#id_cliente").val();
                                            var total_a_cancelar = $("#total_a_cancelar").val();
                                            if (id_cliente === "") {
                                                alert("Seleccione un cliente");
                                            } else if (parseInt(<?php echo $precio_total; ?>) === 0) {
                                                alert("Seleccione productos");
                                            } else {
                                                actualizar_stock();
                                                guardar_venta();
                                            }

                                            function actualizar_stock() {
                                                var i = 1;
                                                var n = '<?php echo $contador_detalle_compras; ?>';

                                                for (i = 1; i <= n; i++) {
                                                    var a = 'stock_de_inventario' + i;
                                                    var stock_de_inventario = $('#' + a).val();

                                                    var b = 'cantidad_detalle_compras' + i;
                                                    var cantidad_detalle_compras = $('#' + b).text();

                                                    var c = 'id_producto' + i;
                                                    var id_producto = $('#' + c).val();


                                                    var stock_calculado = parseFloat(stock_de_inventario) - parseFloat(cantidad_detalle_compras);

                                                    //alert(stock_de_inventario+" "+cantidad_detalle_compras+" "+stock_calculado+" "+id_producto);

                                                    var url2 = "../app/controllers/compras/actualizar_stock.php";
                                                    $.get(url2, {
                                                        id_producto: id_producto,
                                                        stock_calculado: stock_calculado,
                                                    }, function(datos) {
                                                        guardar_venta();
                                                    });
                                                }
                                            }

                                            function guardar_venta() {
                                                var url = "../app/controllers/compras/registro_de_compras.php";
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
        </div>
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
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Productos",
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

        <script>
            $(document).ready(function() {
                $('#proveedor_select').change(function() {
                    var id_proveedorval = $(this).val(); // Obtiene el valor del proveedor seleccionado
                    console.log("ID del proveedor seleccionado:", id_proveedorval); // Imprime el valor en la consola del navegador
                    // Realiza una petición Ajax enviando solo el valor del proveedor seleccionado
                    var url = "../app/controllers/almacen/listado_de_productos_por_proveedor.php";
                    const data = {
                        id_proveedor: id_proveedorval
                    };

                    $.get(url, data)
                        .done(function(response) {
                            console.log("Respuesta del servidor:", response); // Imprime la respuesta del servidor en la consola del navegador
                        })
                        .fail(function(xhr, status, error) {
                            console.error("Error en la solicitud AJAX:", error); // Imprime un mensaje de error en la consola del navegador si la solicitud AJAX falla
                        });
                });
            });
        </script>