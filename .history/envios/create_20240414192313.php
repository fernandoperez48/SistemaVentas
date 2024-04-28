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

                    <!-- inicio -->
                    <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                                    <i class="fas fa-search"></i>
                                    Buscar Venta
                                </button>


                                <!-- MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO       MODAL PARA BUSCAR PRODUCTO -->
                                <div class="modal fade" id="modal-buscar_producto">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:#446DF6; color:white">
                                                <h4 class="modal-title">Busqueda de ventas</h4>
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
                                                                    <center>Nro Venta</center>
                                                                </th>
                                                                <th>
                                                                    <center>Productos</center>
                                                                </th>
                                                                <th>
                                                                    <center>Cliente</center>
                                                                </th>
                                                                <th>
                                                                    <center>Total Pagado</center>
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