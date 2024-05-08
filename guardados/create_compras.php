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
            <div class="card-body" style="display: block;">
                <div style="display:flex">
                    <h5>Datos del Producto</h5>
                    <div style="width: 20px;"></div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                        <i class="fas fa-search"></i>
                        Buscar Producto
                    </button>

                    <!-- Modal buscar producto         Modal buscar producto         Modal buscar producto-->
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
                                                                    $("#fecha_ingreso").val("<?php echo $productos_datos['fecha_ultimo_ingreso']; ?>");
                                                                    $("#usuario_producto").val("<?php echo $productos_datos['nombres_usuario']; ?>");
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
                            <input type="text" id="id_producto" hidden>
                            <label for="">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Categoria:</label>
                            <div style="display: flex;">

                                <input type="text" class="form-control" id="categoria" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Nombre del producto:</label>
                            <input type="text" name="nombre" id="nombre_producto" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Imagen del producto:</label>
                            <center>
                                <img src="" id="img_producto" width="50%">
                            </center>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Usuario</label>
                            <input type="text" class="form-control" id="usuario_producto" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Descripcion del producto:</label>
                            <textarea name="descripcion" id="descripcion_producto" cols="30" rows="3" class="form-control" disabled></textarea>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Stock:</label>
                            <input type="number" name="stock" class="form-control" id="stock" disabled style="background-color: #d1c53b;">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Stock minimo:</label>
                            <input type="number" name="stock_minimo" class="form-control" disabled id="stock_minimo">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Stock maximo:</label>
                            <input type="number" name="stock_maximo" class="form-control" disabled id="stock_maximo">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Precio compra:</label>
                            <input type="number" name="precio_compra" class="form-control" disabled id="precio_compra">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Precio venta:</label>
                            <input type="number" name="precio_venta" class="form-control" disabled id="precio_venta">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Fecha de ingreso:</label>
                            <input type="date" name="fecha_ingreso" class="form-control" disabled id="fecha_ingreso">
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
                                <label>Nombre del proveedor </label>
                                <input type="text" id="id_proveedor" class="form-control" disabled>
                                <input type="text" id="id_proveedor" hidden>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Celular</label>
                                <input type="number" id="celular" class="form-control" disabled>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input type="number" id="telefono" class="form-control" disabled>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Empresa<b>*</b></label>
                                <input type="email" id="empresa" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="text" id="email" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Direccion</label>
                                <input type="text" id="direccion" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>