<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/categorias/listado_de_categorias.php';
include '../app/controllers/almacen/cargar_producto.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar producto</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-danger">
                    <div class="card-header" style="background-color:orange">
                        <h3 class="card-title">Llene los datos...</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="../app/controllers/almacen/update.php" method="post" enctype="multipart/form-data">
                                    <input type="text" value="<?php echo $id_producto_get; ?>" name="id_producto" hidden>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Codigo:</label>

                                                <input type="text" class="form-control" value="<?php echo $codigo; ?>" disabled>
                                                <input type="text" name="codigo" value="<?php echo $codigo; ?>" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Categoria:</label>
                                                <div style="display: flex;">
                                                    <select name="id_categoria" id="" class="form-control" required>
                                                        <?php
                                                        foreach ($categorias_datos as $categorias_datos) {
                                                            $nombre_categoria_tabla = $categorias_datos['nombre_categoria'];
                                                            $id_categoria = $categorias_datos['id_categoria']; ?>
                                                            <option value="<?php echo $id_categoria ?>" <?php
                                                                                                        if ($nombre_categoria_tabla == $nombre_categoria) { ?> selected="selected" <?php
                                                                                                                                                                                }
                                                                                                                                                                                    ?>><?php echo $nombre_categoria_tabla ?>
                                                            </option>
                                                            ?>
                                                        <?php }
                                                        ?>
                                                        <?php
                                                        foreach ($roles_datos as $roles_datos) {
                                                            $rol_tabla = $roles_datos['rol'];
                                                            $id_rol = $roles_datos['id_rol'] ?>

                                                        <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Nombre del producto:</label>
                                                <input type="text" value="<?php echo $nombre; ?>" name="nombre" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Imagen del producto:</label>
                                                    <input type="file" name="image" class="form-control" id="file">
                                                    <input type="text" name="image_text" value="<?php echo $imagen; ?>" hidden>
                                                    <br>
                                                    <output id="list">
                                                        <img src="<?php echo $URL . "/almacen/img/img_productos" . $productos_datos['imagen']; ?>" width="150px">
                                                    </output>
                                                    <script>
                                                        function archivo(evt) {
                                                            var files = evt.target.files; // FileList object
                                                            // Obtenemos la imagen del campo "file".
                                                            for (var i = 0, f; f = files[i]; i++) {
                                                                //Solo admitimos imágenes.
                                                                if (!f.type.match('image.*')) {
                                                                    continue;
                                                                }
                                                                var reader = new FileReader();
                                                                reader.onload = (function(theFile) {
                                                                    return function(e) {
                                                                        // Insertamos la imagen
                                                                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', (theFile.name), '"/>'].join('');
                                                                    };
                                                                })(f);
                                                                reader.readAsDataURL(f);
                                                            }
                                                        }
                                                        document.getElementById('file').addEventListener('change', archivo, false);
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $email ?>" disabled>
                                                <input type="text" name="id_usuario" value="<?php echo $id_usuario ?>" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Descripcion del producto:</label>
                                                <textarea name="descripcion" id="" cols="30" rows="3" class="form-control"><?php echo $descripcion; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock:</label>
                                                <input type="number" name="stock" class="form-control" required value="<?php echo $stock; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock minimo:</label>
                                                <input type="number" name="stock_minimo" class="form-control" value="<?= $stock_minimo; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Stock maximo:</label>
                                                <input type="number" name="stock_maximo" class="form-control" value="<?= $stock_maximo; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio compra:</label>
                                                <input type="text" name="precio_compra" class="form-control" required value="<?= $precio_compra; ?>" oninput="formatInput(this)">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Precio venta:</label>
                                                <input type="text" name="precio_venta" class="form-control" required value="<?= $precio_venta; ?>" oninput="formatInput(this)">
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


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso:</label>
                                                <input type="date" name="fecha_ingreso" class="form-control" required value="<?= $fecha_ultimo_ingreso; ?>">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <br>
                        <div class="form-group">
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar</button>
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