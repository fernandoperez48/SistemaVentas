<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion != "Administrador") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/categorias/listado_de_categorias.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo producto</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card card-orange">
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
                                        <form action="../app/controllers/almacen/create.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Codigo:</label>
                                                        <input type="text" name="codigo" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Categoria:</label>
                                                        <div style="display: flex;">
                                                            <select name="id_categoria" id="" class="form-control" required>
                                                                <?php
                                                                foreach ($categorias_datos as $categorias_datos) { ?>
                                                                    <option value="<?php echo $categorias_datos['id_categoria']; ?>"><?php echo $categorias_datos['nombre_categoria']; ?></option>
                                                                    ?>
                                                                <?php } ?>
                                                            </select>
                                                            <a href="<?php echo $URL; ?>/categorias" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Nombre del producto:</label>
                                                        <input type="text" name="nombre" class="form-control" required>
                                                    </div>
                                                </div>


                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="">Talle:</label>
                                                        <input type="text" name="talle" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Color:</label>
                                                        <input type="text" name="color" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Descripcion del producto:</label>
                                                        <textarea name="descripcion" id="" cols="30" rows="3" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Proveedor:</label>
                                                        <div style="display: flex;">
                                                            <select name="id_proveedor" id="" class="form-control" required>
                                                                <?php
                                                                foreach ($proveedores_datos as $proveedores_datos) { ?>
                                                                    <option value="<?php echo $proveedores_datos['id_proveedor']; ?>"><?php echo $proveedores_datos['nombre_proveedor']; ?></option>
                                                                    ?>
                                                                <?php } ?>
                                                            </select>
                                                            <a href="<?php echo $URL; ?>/proveedores" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock minimo:</label>
                                                        <input type="number" name="stock_minimo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock maximo:</label>
                                                        <input type="number" name="stock_maximo" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha de carga:</label>
                                                        <input type="text" name="fecha_carga" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Imagen del producto:</label>
                                                            <input type="file" name="image" class="form-control" id="file">
                                                            <br>
                                                            <output id="list"></output>
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
                                                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="50%" title="', (theFile.name), '"/>'].join('');
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
                                                <div class="col-md-2">
                                                    <div class="form-group">

                                                        <input type="text" class="form-control" value="<?php echo $email_session ?>" hidden>
                                                        <input type="text" name="id_usuario" value="<?php echo $id_usuarios_sesion ?>" hidden>
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
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!--  FIN DE WRAAPPER DE PARTE1.PHP -->


<!-- /.content-wrapper -->
<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>