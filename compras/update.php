<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';

include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';
include '../app/controllers/compras/cargar_compra.php';
?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizacion de la compra</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Llene los datos...</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div style="display:flex">
                                        <h5>Datos del Producto</h5>
                                        <div style="width: 20px;"></div>
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
                                                                                        $("#codigo").val("<?php echo $productos_datos['codigo']; ?>");
                                                                                        $("#categoria").val("<?php echo $productos_datos['nombre_categoria']; ?>");
                                                                                        $("#nombre_producto").val("<?php echo $productos_datos['nombre']; ?>");
                                                                                        $("#descripcion_producto").val("<?php echo $productos_datos['descripcion']; ?>");
                                                                                        $("#stock").val("<?php echo $productos_datos['stock']; ?>");

                                                                                        var stock = "<?php echo $productos_datos['stock']; ?>";
                                                                                        $("#stock_actual").val(stock);


                                                                                        $("#stock_minimo").val("<?php echo $productos_datos['stock_minimo']; ?>");
                                                                                        $("#stock_maximo").val("<?php echo $productos_datos['stock_maximo']; ?>");
                                                                                        $("#precio_compra").val("<?php echo $productos_datos['precio_compra']; ?>");
                                                                                        $("#precio_venta").val("<?php echo $productos_datos['precio_venta']; ?>");
                                                                                        $("#fecha_ingreso").val("<?php echo $productos_datos['fecha_ingreso']; ?>");
                                                                                        $("#usuario_producto").val("<?php echo $productos_datos['email']; ?>");
                                                                                        $("#img_producto").attr("src", "<?php echo $URL . "/almacen/img_productos" . $productos_datos['imagen']; ?>");
                                                                                        $("#modal-buscar_producto").modal("hide");
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
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row" style="font-size:12px">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" value="<?php echo $id_producto; ?>" id="id_producto" hidden>
                                                <label for="">Codigo:</label>
                                                <input type="text" value="<?php echo $codigo; ?>" class="form-control" id="codigo" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Categoria:</label>
                                                <div style="display: flex;">

                                                    <input type="text" value="<?php echo $nombre_categoria; ?>" class="form-control" id="categoria" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Nombre del producto:</label>
                                                <input type="text" value="<?php echo $nombre_producto; ?>" name="nombre" id="nombre_producto" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Imagen del producto:</label>
                                                <center>
                                                    <img src="<?php echo $URL . "/almacen/img_productos" . $imagen ?>" id="img_producto" width="50%">
                                                </center>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" value="<?php echo $nombre_usuarios_producto; ?>" class="form-control" id="usuario_producto" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Descripcion del producto:</label>
                                                <textarea name="descripcion" id="descripcion_producto" cols="30" rows="3" class="form-control" disabled><?php echo $descripcion; ?></textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock:</label>
                                                <input type="number" value="<?php echo $stock; ?>" name="stock" class="form-control" id="stock" disabled style="background-color: #d1c53b;">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock minimo:</label>
                                                <input type="number" value="<?php echo $stock_minimo; ?>" name="stock_minimo" class="form-control" disabled id="stock_minimo">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock maximo:</label>
                                                <input type="number" value="<?php echo $stock_maximo; ?>" name="stock_maximo" class="form-control" disabled id="stock_maximo">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio compra:</label>
                                                <input type="number" value="<?php echo $precio_compra_producto; ?>" name="precio_compra" class="form-control" disabled id="precio_compra">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio venta:</label>
                                                <input type="number" value="<?php echo $precio_venta_producto; ?>" name="precio_venta" class="form-control" disabled id="precio_venta">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso:</label>
                                                <input type="date" value="<?php echo $fecha_ingreso; ?>" name="fecha_ingreso" class="form-control" disabled id="fecha_ingreso">
                                            </div>
                                        </div>


                                    </div>

                                    <hr>
                                    <div style="display:flex">
                                        <h5>Datos del Proveedor</h5>
                                        <div style="width: 20px;"></div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_proveedor">
                                            <i class="fas fa-search"></i>
                                            Buscar Proveedor
                                        </button>

                                        <div class="modal fade" id="modal-buscar_proveedor" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color:#446DF6; color:white">
                                                        <h4 class="modal-title">Busqueda de proveedor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table table-responsive">
                                                            <table id="example2" class="table table-bordered table-striped table-md">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <center>Nro</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Seleccionar</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Nombre del proveedor</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Celular</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Telefono</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Empresa</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Email</center>
                                                                        </th>
                                                                        <th>
                                                                            <center>Direccion</center>
                                                                        </th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $contador = 0;
                                                                    foreach ($proveedores_datos as $proveedores_datos) {
                                                                        $id_proveedor = $proveedores_datos['id_proveedor'];
                                                                        $nombre_proveedor = $proveedores_datos['nombre_proveedor']; ?>
                                                                        <tr>
                                                                            <td>
                                                                                <center><?php echo $contador = $contador + 1; ?></center>
                                                                            </td>
                                                                            <td>
                                                                                <button class="btn btn-info" id="btn_seleccionar_proveedor<?php echo $proveedores_datos['id_proveedor']; ?>">Seleccionar</button>
                                                                                <script>
                                                                                    $("#btn_seleccionar_proveedor<?php echo $proveedores_datos['id_proveedor']; ?>").click(function() {
                                                                                        $("#nombre_proveedor").val("<?php echo $proveedores_datos['nombre_proveedor']; ?>");
                                                                                        $("#id_proveedor").val("<?php echo $proveedores_datos['id_proveedor']; ?>");
                                                                                        $("#celular").val("<?php echo $proveedores_datos['celular']; ?>");
                                                                                        $("#telefono").val("<?php echo $proveedores_datos['telefono']; ?>");
                                                                                        $("#empresa").val("<?php echo $proveedores_datos['empresa']; ?>");
                                                                                        $("#email").val("<?php echo $proveedores_datos['email']; ?>");
                                                                                        $("#direccion").val("<?php echo $proveedores_datos['direccion']; ?>");
                                                                                        $("#modal-buscar_proveedor").modal("hide");
                                                                                    });
                                                                                </script>
                                                                            </td>
                                                                            <td><?php echo $nombre_proveedor; ?></td>
                                                                            <td>
                                                                                <a href="http://wa.me/+54<?php echo $proveedores_datos['celular']; ?>" target="_blank" class="btn btn-success">
                                                                                    <i class="fa fa-phone"></i>
                                                                                    <?php echo $proveedores_datos['celular']; ?>
                                                                                </a>
                                                                            </td>
                                                                            <td><?php echo $proveedores_datos['telefono']; ?></td>
                                                                            <td><?php echo $proveedores_datos['empresa']; ?></td>
                                                                            <td><?php echo $proveedores_datos['email']; ?></td>
                                                                            <td><?php echo $proveedores_datos['direccion']; ?></td>


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
                                        <!-- /.modal-content -->
                                    </div>

                                    <hr>
                                    <div class="row" style="font-size: 12px;">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $id_proveedor_tabla; ?>" id="id_proveedor" hidden>
                                                    <label>Nombre del proveedor </label>
                                                    <input type="text" value="<?php echo $nombre_proveedor_tabla; ?>"  id="id_proveedor" class="form-control" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <input type="number" value="<?php echo $celular_proveedor; ?>" id="celular" class="form-control" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Telefono</label>
                                                    <input type="number" value="<?php echo $telefono_proveedor; ?>" id="telefono" class="form-control" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Empresa<b>*</b></label>
                                                    <input type="email" value="<?php echo $empresa_proveedor; ?>" id="empresa" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email </label>
                                                    <input type="text" value="<?php echo $email_proveedor; ?>" id="email" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Direccion</label>
                                                    <input type="text" value="<?php echo $direccion_proveedor; ?>" id="direccion" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-3">



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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Numero de la compra</label>
                                                <input type="text" style="text-align: center;" class="form-control" value="<?php echo $nro_compra; ?>" disabled>
                                                <input type="text" id="nro_compra" value="<?php echo $nro_compra; ?>" hidden>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Fecha de la compra</label>
                                                <input type="date" value="<?php echo $fecha_compra; ?>" class="form-control" id="fecha_compra">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Comprobante de la compra</label>
                                                <input type="text" value="<?php echo $comprobante; ?>" class="form-control" id="comprobante">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Precio de la compra</label>
                                                <input type="text" value="<?php echo $precio_compra_producto; ?>" class="form-control" id="precio_compra_controlador" style="text-align: center;">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Stock actual</label>
                                                <input type="text" value="<?php echo $stock = $stock - $cantidad; ?>" id="stock_actual" class="form-control" style="background-color: #d1c53b; text-align:center" disabled>
                                                <input type="text" id="stock_actual" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Stock total</label>
                                                <input type="text" id="stock_total" class="form-control" style="text-align:center" id="fecha_compra" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Cantidad de la compra</label>
                                                <input type="number" value="<?php echo $cantidad; ?>" style="text-align: center;" class="form-control" id="cantidad_compra">
                                            </div>
                                            <script>
                                                $("#cantidad_compra").keyup(function() {
                                                    sumacantidades();
                                                });
                                                sumacantidades();

                                                function sumacantidades() {
                                                    var stock_actual = $("#stock_actual").val();
                                                    var stock_compra = $("#cantidad_compra").val();
                                                    var total = parseInt(stock_actual) + parseInt(stock_compra);
                                                    $("#stock_total").val(total);
                                                }
                                            </script>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $nombre_usuarios_producto; ?>" disabled>
                                                <input type="text" id="id_usuario" hidden>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-success btn-block" id="btn_actualizar_compra">
                                                <i class="fas fa-save"></i>
                                                Actualizar compra
                                            </button>
                                        </div>

                                    </div>
                                    <script>
                                        $("#btn_actualizar_compra").click(function() {
                                            var id_compra = '<?php echo $id_compra; ?>';
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
                                                alert("Debe llenar todos los campos productos");
                                            } else if (fecha_compra == "") {
                                                $('#fecha_compra').focus();
                                                alert("Debe llenar todos los campos fecha compra");
                                            } else if (comprobante == "") {
                                                $('#comprobante').focus();
                                                alert("Debe llenar todos los campos comprobante");
                                            } else if (precio_compra == "") {
                                                $('#precio_compra_controlador').focus();
                                                alert("Debe llenar todos los campos precio compra");
                                            } else if (cantidad_compra == "") {
                                                $('#cantidad_compra').focus();
                                                alert("Debe llenar todos los campos cantidades");
                                            } else {
                                                var url = "../app/controllers/compras/update.php";
                                                $.get(url, {
                                                    id_compra: id_compra,
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
                                                    $('#respuesta_update').html(datos);
                                                });
                                            }
                                        });
                                    </script>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <div id="respuesta_update"></div>

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