<div class="card card-outline card-primary">
    <div class="card-header">
        <form action="../app/controllers/almacen/listado_de_productos_por_proveedor.php" method="post">
            <div class="row">
                <div class="col-md-4">
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
                    <div style="display: flex;">
                        <label for="">
                            <h4>Proveedor:</h4>
                        </label>
                        <select name="id_proveedor" class="form-control" style="margin-left: 10px;" required>
                            <option value="">Seleccionar proveedor</option> <!--Opción por defecto -->
                            <?php
                            foreach ($proveedores_datos as $proveedores_datos) { ?>
                                <option value="<?php echo $proveedores_datos['id_proveedor']; ?>"><?php echo $proveedores_datos['nombre_proveedor']; ?></option> ?>
                            <?php } ?>
                        </select>
                        <a href="<?php echo $URL; ?>/proveedores" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Confirmar selección</button>
                </div>
            </div>
        </form>

    </div>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
    </div>
    <!-- /.card-tools -->
</div>
<!-- /.card-header -->