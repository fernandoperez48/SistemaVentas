<?php

class ModalEditarProducto
{
    public static function render($id_usuario, $id_producto, $productos_datos, $categorias_datos, $proveedores_datos, $descripcion, $URL)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <div class="modal fade" id="modal-update<?php echo $id_producto; ?>">
            <div class="modal-dialog" style="max-width: 80%;">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:darkgreen; color:white">
                        <h4 class="modal-title">Actualizacion del producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="row">
                                <div class="col-md-5">
                                    <!-- codigo, categoria, nombre y descripcion del producto -->
                                    <div class="row">
                                        <!-- codigo -->
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Codigo:</label>
                                                <input type="text" id="codigo<?php echo $id_producto; ?>" value="<?php echo $productos_datos['codigo']; ?>" class="form-control" disabled>
                                                <small style="color:red; display:none" id="lbl_codigo<?php echo $id_producto; ?>">* Este campo es requerido</small>
                                            </div>
                                        </div>
                                        <!-- categoria -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Categoria</label>
                                                <select name="categoriaupdate" id="categoriaupdate<?php echo $id_producto; ?>" class="form-control" required>
                                                    <?php
                                                    // Cambia aquí para obtener el id_categoria del producto actual
                                                    $id_categoria_actual = $productos_datos['id_categoria']; // Cambiado de $categorias_datos a $productos_datos

                                                    // Suponiendo que $categorias_datos contiene la lista de categorías
                                                    foreach ($categorias_datos as $categorias_datosupdate) { ?>
                                                        <option value="<?php echo $categorias_datosupdate['id_categoria']; ?>" <?php echo ($categorias_datosupdate['id_categoria'] == $id_categoria_actual) ? 'selected' : ''; ?>>
                                                            <?php echo $categorias_datosupdate['nombre_categoria']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <small style="color:red; display:none" id="lbl_categoriaupdate<?php echo $id_producto; ?>">* Este campo es requerido</small>
                                            </div>
                                        </div>

                                        <!-- nombre del producto -->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Nombre del producto:</label>
                                                <input type="text" id="nombre_productoupdate<?php echo $id_producto ?>" value="<?php echo $productos_datos['nombre']; ?>" name="nombre" class="form-control" required>

                                            </div>
                                        </div>
                                        <!-- descripcion del producto -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Descripcion del producto:</label>
                                                <textarea name="descripcion" id="descripcionupdate<?php echo $id_producto ?>" cols="30" rows="5" class="form-control"><?php echo $descripcion; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <!-- talle -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Talle:</label>
                                                <input type="text" id="talleupdate<?php echo $id_producto; ?>" name="talle" value="<?php echo $productos_datos['talle']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <!-- color -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Color:</label>
                                                <input type="text" id="colorupdate<?php echo $id_producto; ?>" name="color" value="<?php echo $productos_datos['color']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <!-- proveedor -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Proveedor</label>
                                                <select name="proveedorupdate" id="proveedorupdate<?php echo $id_producto; ?>" class="form-control" disabled>
                                                    <?php
                                                    $id_proveedor_actual = $proveedores_datos['id_proveedor'];
                                                    foreach ($proveedores_datos as $proveedores_datosupdate) { ?>
                                                        <option value="<?php echo $proveedores_datosupdate['nombre_proveedor'] ?>" <?php echo ($proveedores_datosupdate['nombre_proveedor'] == $id_proveedor_actual) ? 'selected' : ''; ?>><?php echo $proveedores_datosupdate['nombre_proveedor'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <small style="color:red; display:none" id="lbl_proveedorupdate<?php echo $id_producto; ?>">* Este campo es requerido</small>
                                            </div>
                                        </div>
                                        <!-- stock -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Stock:</label>
                                                <input type="number" id="stockupdate<?php echo $id_producto; ?>" name="stock" class="form-control" required value="<?php echo $productos_datos['stock']; ?>">
                                            </div>
                                        </div>
                                        <!-- stock minimo -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Stock minimo:</label>
                                                <input type="number" id="stockminimoupdate<?php echo $id_producto; ?>" name="stock_minimo" class="form-control" value="<?= $productos_datos['stock_minimo']; ?>">
                                            </div>
                                        </div>
                                        <!-- stock maximo -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Stock maximo:</label>
                                                <input type="number" id="stockmaximoupdate<?php echo $id_producto; ?>" name="stock_maximo" class="form-control" value="<?= $productos_datos['stock_maximo']; ?>">
                                            </div>
                                        </div>
                                        <!-- precio compra -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Precio compra:</label>
                                                <input type="text" id="precio_compraupdate<?php echo $id_producto; ?>" name=" precio_compra" class="form-control" required value="<?= $productos_datos['precio_compra']; ?>" oninput="formatInput(this)">
                                            </div>
                                        </div>
                                        <!-- precio venta -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Precio venta:</label>
                                                <input type="text" id="precio_ventaupdate<?php echo $id_producto; ?>" name=" precio_venta" class="form-control" required value="<?= $productos_datos['precio_venta']; ?>" oninput="formatInput(this)">
                                            </div>
                                        </div>
                                        <script>
                                            function formatInput(input) {
                                                // Permitir solo números y una coma
                                                input.value = input.value.replace(/[^0-9,]/g, '');
                                                // Asegurarse de que solo haya una coma
                                                if ((input.value.match(/,/g) || []).length > 1) {
                                                    input.value = input.value.slice(0, input.value.length - 1);
                                                }
                                            }
                                        </script>
                                        <!-- fecha de ingreso -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso:</label>
                                                <input type="date" id="fecha_ingresoupdate<?php echo $id_producto; ?>" name=" fecha_ingreso" class="form-control" required value="<?= $productos_datos['fecha_ultimo_ingreso']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- imagen -->

                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Imagen del producto:</label>
                                                <input type="file" name="image" class="form-control" id="fileupdate<?php echo $id_producto; ?>">
                                                <br>
                                                <output id="list<?php echo $id_producto; ?>"></output>
                                                <script>
                                                    function archivo<?php echo $id_producto; ?>(evt) {
                                                        var files = evt.target.files; // FileList object
                                                        // Obtenemos la imagen del campo "fileupdate".
                                                        for (var i = 0, f; f = files[i]; i++) {
                                                            //Solo admitimos imágenes.
                                                            if (!f.type.match('image.*')) {
                                                                continue;
                                                            }
                                                            var reader = new FileReader();
                                                            reader.onload = (function(theFile) {
                                                                return function(e) {
                                                                    // Insertamos la imagen
                                                                    document.getElementById("list<?php echo $id_producto; ?>").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', (theFile.name), '"/>'].join('');
                                                                };
                                                            })(f);
                                                            reader.readAsDataURL(f);
                                                        }
                                                    }
                                                    document.getElementById('fileupdate<?php echo $id_producto; ?>').addEventListener('change', archivo<?php echo $id_producto; ?>, false);
                                                </script>
                                                <output id="list">
                                                    <center>
                                                        <img src="<?php echo $URL . "/almacen/img/img_productos" . $productos_datos['imagen']; ?>" width="150px">
                                                    </center>
                                                </output>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Usuario: </label><?php echo $productos_datos['nombres_usuario']; ?>
                                                                                                    <input type="text" class="form-control" value="<?php echo $productos_datos['email'] ?>" hidden>
                                                                                                    <input type="text" name="id_usuario" value="<?php echo $id_usuario ?>" hidden>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_producto; ?>">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#btn_update<?php echo $id_producto; ?>').click(function() {
                let id_producto = '<?php echo $id_producto; ?>';
                let nombre_producto = $('#nombre_productoupdate<?php echo $id_producto; ?>').val();
                let id_categoria = $('#categoriaupdate<?php echo $id_producto; ?>').val();
                let descripcion = $('#descripcionupdate<?php echo $id_producto; ?>').val();
                let talle = $('#talleupdate<?php echo $id_producto; ?>').val();
                let color = $('#colorupdate<?php echo $id_producto; ?>').val();
                let proveedor = $('#proveedorupdate<?php echo $id_producto; ?>').val();
                let stock = $('#stockupdate<?php echo $id_producto; ?>').val();
                let stockminimo = $('#stockminimoupdate<?php echo $id_producto; ?>').val();
                let stockmaximo = $('#stockmaximoupdate<?php echo $id_producto; ?>').val();
                let precio_compra = $('#precio_compraupdate<?php echo $id_producto; ?>').val();
                let precio_venta = $('#precio_ventaupdate<?php echo $id_producto; ?>').val();
                let fecha_ingreso = $('#fecha_ingresoupdate<?php echo $id_producto; ?>').val();
                let file = document.getElementById('fileupdate<?php echo $id_producto; ?>').files[0];

                // Verificar si todos los campos requeridos están llenos
                if (nombre_producto === '' || id_categoria === '' || proveedor === '' || stock === '' || stockminimo === '' || stockmaximo === '' || precio_compra === '' || precio_venta === '' || fecha_ingreso === '') {
                    alert('Todos los campos marcados con * son obligatorios.');
                } else {
                    // Crear un objeto FormData para enviar los datos
                    let formData = new FormData();
                    formData.append("id_producto", id_producto);
                    formData.append("nombre_producto", nombre_producto);
                    formData.append("id_categoria", id_categoria);
                    formData.append("descripcion", descripcion);
                    formData.append("talle", talle);
                    formData.append("color", color);
                    formData.append("proveedor", proveedor);
                    formData.append("stock", stock);
                    formData.append("stockminimo", stockminimo);
                    formData.append("stockmaximo", stockmaximo);
                    formData.append("precio_compra", precio_compra);
                    formData.append("precio_venta", precio_venta);
                    formData.append("fecha_ingreso", fecha_ingreso);

                    if (file) {
                        formData.append('image', file); // Agregar la imagen
                    }
                    // Enviar los datos con AJAX usando el método POST
                    $.ajax({
                        type: "POST",
                        url: "../app/controllers/almacen/update.php",
                        data: formData,
                        processData: false, // Necesario para enviar FormData correctamente
                        contentType: false, // Necesario para enviar FormData correctamente
                        success: function(datos) {
                            if (datos) {
                                // Mostrar el mensaje de éxito

                                // Cerrar el modal
                                $('#modal-update<?php echo $id_producto; ?>').modal('hide');

                                // Opcional: Recargar la tabla o el contenido que muestra la lista de usuarios
                                location.reload();
                            } else {
                                // Mostrar el mensaje de error
                                alert("No se pudo actualizar el producto aca");
                            }
                        },
                    });
                }
            });
        </script>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
