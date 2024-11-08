    <?php

    class ModalBuscarProducto
    {
        public static function render($productos_datos, $URL, $contador_de_ventas)
        {
            ob_start(); // Iniciar el buffer de salida
    ?>

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
                                                <center>Fecha Ingreso</center>
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
                                                    <center>
                                                        <?php echo $contador += 1; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
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
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $productos_datos['codigo']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $productos_datos['nombre_categoria']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        // Asumiendo que $productos_datos['imagen'] contiene el valor del campo 'imagen'
                                                        if (empty($productos_datos['imagen']) || is_null($productos_datos['imagen'])) {
                                                            // Si el valor de imagen está vacío o es NULL, muestra la imagen predeterminada
                                                            echo '<img src="' . $URL . '/almacen/img/img_productossinimagen.jpg" width="50px">';
                                                        } else {
                                                            // Si el valor de imagen no está vacío ni es NULL, muestra la imagen correspondiente
                                                            echo '<img src="' . $URL . '/almacen/img/img_productos' . $productos_datos['imagen'] . '" width="50px">';
                                                        }
                                                        ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $productos_datos['nombre']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $productos_datos['descripcion']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $productos_datos['stock']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>$ <?php echo $productos_datos['precio_compra']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        $ <?php echo $productos_datos['precio_venta']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $productos_datos['fecha_ultimo_ingreso']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $productos_datos['nombres_usuario']; ?>
                                                    </center>
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
                                    <script>
                                        function allowOnlyNumbers(input) {
                                            input.value = input.value.replace(/[^0-9]/g, '');
                                        }

                                        document.getElementById('cantidad').addEventListener('input', function(e) {
                                            allowOnlyNumbers(e.target);
                                        });
                                    </script>
                                </div>
                                <button style="float: right;" id="btn_registrar_carrito" class="btn btn-primary">Registrar</button>
                                <div id="respuesta_carrito"></div>
                                <script>
                                    $("#btn_registrar_carrito").click(function() {
                                        var nro_venta = "<?php echo $contador_de_ventas + 1; ?>";
                                        var id_producto = $("#id_producto").val();
                                        var cantidad = $("#cantidad").val();
                                        var url_check_stock = "../app/controllers/ventas/verificar_stock.php";

                                        if (id_producto == "") {
                                            alert("Seleccione un producto");
                                        } else if (cantidad == "") {
                                            alert("Ingrese la cantidad");
                                        } else if (cantidad === "0") {
                                            alert("La cantidad no puede ser 0");
                                        } else {
                                            // Verificar el stock antes de registrar
                                            $.get(url_check_stock, {
                                                id_producto: id_producto,
                                                cantidad: cantidad
                                            }, function(response) {
                                                if (response.stock_suficiente) {
                                                    // Proceder con la solicitud de registro si hay stock suficiente
                                                    var url = "../app/controllers/ventas/registrar_carrito.php";
                                                    $.get(url, {
                                                        nro_venta: nro_venta,
                                                        id_producto: id_producto,
                                                        cantidad: cantidad
                                                    }, function(datos) {
                                                        $('#respuesta_carrito').html(datos);
                                                    });
                                                } else {
                                                    alert("No hay suficiente stock disponible para este producto.");
                                                }
                                            }, "json");
                                        }
                                    });
                                </script>

                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
            return ob_get_clean(); // Devolver el contenido del buffer de salida
        }
    }
