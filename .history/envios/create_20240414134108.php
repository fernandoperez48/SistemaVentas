<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/categorias/listado_de_categorias.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo Envio</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los datos...</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
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
                                            $sql_carrito = "SELECT *,pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto from tb_carrito as carr inner join tb_almacen as pro
                                        on carr.id_producto = pro.id_producto where nro_venta = $contador_de_ventas + 1 order by carr.id_carrito";
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


                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="../app/controllers/almacen/create.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $email_session ?>" disabled>
                                                <input type="text" name="id_usuario" value="<?php echo $id_usuarios_sesion ?>" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Descripcion del Envio:</label>
                                                <textarea name="descripcion" id="" cols="30" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>          
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Codigo Venta</label>
                                                <input type="text" name="precio_compra" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Direccion de envio</label>
                                                <input type="text" name="Direccion" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha de Envio:</label>
                                                <input type="date" name="fecha_ingreso" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" name="estado" id="estado">
                                                <option value="Pendiente de envio">Pendiente de envío</option>
                                                <option value="Enviado">Enviado</option>
                                                <option value="Entregado">Entregado</option>
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <br>
                        <div class="form-group">
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

</div>

<!-- Main content -->

<!-- /.content-wrapper -->
<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>