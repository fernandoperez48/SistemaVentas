<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/categorias/listado_de_categorias.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';

?>
<div class="content-wrapper" style="background-color:gray">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Productos</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Productos registrados</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table id="example1" class="table col-l-12 table-bordered table-striped table-sm">
                                    <thead style="background-color: gray;">
                                        <tr>
                                            <th>
                                                <center>Nro</center>
                                            </th>
                                            <th>
                                                <center>Codigo</center>
                                            </th>
                                            <th>
                                                <center>Categoria</center>
                                            </th>
                                            <th>
                                                <center>Proveedor</center>
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
                                                <center>Talle</center>
                                            </th>
                                            <th>
                                                <center>Color</center>
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
                                                <center>Acciones</center>
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
                                                    <?php echo $productos_datos['id_producto']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['codigo']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['nombre_categoria']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['nombre_proveedor']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Asumiendo que $productos_datos['imagen'] contiene el valor del campo 'imagen'
                                                    $imageSrc = empty($productos_datos['imagen']) || is_null($productos_datos['imagen']) ? $URL . '/almacen/img/img_productossinimagen.jpg' : $URL . '/almacen/img/img_productos' . $productos_datos['imagen'];
                                                    ?>
                                                    <img src="<?php echo $imageSrc; ?>" width="50px" height="50px" data-toggle="modal" data-target="#imageModal<?php echo $productos_datos['id_producto']; ?>">
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="imageModal<?php echo $productos_datos['id_producto']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel<?php echo $productos_datos['id_producto']; ?>">Imagen del Producto</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="<?php echo $imageSrc; ?>" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['nombre']; ?>
                                                </td>
                                                <?php
                                                $descripcion = $productos_datos['descripcion'];
                                                $maxLength = 35; // Número máximo de caracteres que deseas mostrar

                                                if (strlen($descripcion) > $maxLength) {
                                                    $descripcion = substr($descripcion, 0, $maxLength) . '...'; // Agrega '...' al final si el texto es más largo
                                                }
                                                ?>
                                                <td>
                                                    <?php echo $descripcion; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['talle']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['color']; ?>
                                                </td>
                                                <?php
                                                $stock_actual = $productos_datos['stock'];
                                                $stock_maximo = $productos_datos['stock_maximo'];
                                                $stock_minimo = $productos_datos['stock_minimo'];
                                                if ($stock_actual < $stock_minimo) { ?>
                                                    <td class="text-danger">
                                                        <?php echo $productos_datos['stock']; ?>
                                                    </td>
                                                <?php
                                                } else if ($stock_actual > $stock_maximo) { ?>
                                                    <td class="text-success">
                                                        <?php echo $productos_datos['stock']; ?>
                                                    </td>
                                                <?php
                                                } else { ?>
                                                    <td>
                                                        <?php echo $productos_datos['stock']; ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <center>$ <?php echo $productos_datos['precio_compra']; ?></center>
                                                </td>
                                                <td>$ <?php echo $productos_datos['precio_venta']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $productos_datos['fecha_ultimo_ingreso']; ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_producto; ?>">
                                                                <i class="fa fa-eye"></i>
                                                                Ver
                                                            </button>
                                                            <!-- modal para ver proveedores-->
                                                            <div class="modal fade" id="modal-ver<?php echo $id_producto; ?>">
                                                                <div class="modal-dialog" style="max-width: 80%;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:#088da5; color:white">
                                                                            <h4 class="modal-title">Datos del producto</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="row">

                                                                                <div class="col-md-5">
                                                                                    <!-- codigo, categoria, nombre y descripion -->
                                                                                    <div class="row">
                                                                                        <div class="col-md-3">
                                                                                            <div class="form-group">
                                                                                                <label for="">Codigo:</label>
                                                                                                <input type="text" class="form-control" value="<?php echo $productos_datos['codigo']; ?>" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label for="">Categoria:</label>
                                                                                                <div style="display: flex;">
                                                                                                    <input type="text" class="form-control" value="<?php echo $productos_datos['nombre_categoria']; ?>" disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-5">
                                                                                            <div class="form-group">
                                                                                                <label for="">Nombre del producto:</label>
                                                                                                <input type="text" name="nombre" value="<?php echo $productos_datos['nombre']; ?>" class="form-control" disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label for="">Descripcion del producto:</label>
                                                                                                <textarea name="descripcion" id="" cols="40" rows="5" class="form-control" disabled><?php echo $productos_datos['descripcion']; ?></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <div class="row">
                                                                                        <!-- talle, color y proveedor -->
                                                                                        <div class="row container-fluid justify-content-between">
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Talle:</label>
                                                                                                    <input type="text" name="talle" value="<?php echo $productos_datos['talle']; ?>" class="form-control" disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Color:</label>
                                                                                                    <input type="text" name="color" value="<?php echo $productos_datos['color']; ?>" class="form-control" disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Proveedor:</label>
                                                                                                    <input type="text" name="proveedor" value="<?php echo $productos_datos['nombre_proveedor']; ?>" class="form-control" disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- stock, stock minimo, stock maximo y fecah de carga -->
                                                                                        <div class="row container-fluid justify-content-between">
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Stock:</label>
                                                                                                    <input type="number" name="stock" class="form-control" value="<?php echo $productos_datos['stock']; ?>" disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Stock minimo:</label>
                                                                                                    <input type="number" name="stock_minimo" class="form-control" disabled value="<?php echo $stock_minimo; ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Stock maximo:</label>
                                                                                                    <input type="number" name="stock_maximo" class="form-control" disabled value="<?php echo $stock_maximo; ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Fecha de carga:</label>
                                                                                                    <input type="date" name="fecha_carga" class="form-control" disabled value="<?php echo $productos_datos['fecha_carga']; ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- precio compra, precio venta y fecha del ultimo ingreso -->
                                                                                        <div class="row container-fluid justify-content-between">
                                                                                            <div class="col-md-3">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Precio compra:</label>
                                                                                                    <input type="number" name="precio_compra" class="form-control" disabled value="<?php echo $productos_datos['precio_compra']; ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Precio venta:</label>
                                                                                                    <input type="number" name="precio_venta" class="form-control" disabled value="<?php echo $productos_datos['precio_venta']; ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-5">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Fecha del ultimo ingreso :</label>
                                                                                                    <input type="date" name="fecha_ultimo_ingreso" class="form-control" disabled value="<?php echo $productos_datos['fecha_ultimo_ingreso']; ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <!-- imagen -->
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Imagen del producto:</label>
                                                                                                    <center>
                                                                                                        <?php
                                                                                                        // Asumiendo que $productos_datos['imagen'] contiene el valor del campo 'imagen'
                                                                                                        $imageSrc = empty($productos_datos['imagen']) || is_null($productos_datos['imagen']) ? $URL . '/almacen/img/img_productossinimagen.jpg' : $URL . '/almacen/img/img_productos' . $productos_datos['imagen'];
                                                                                                        ?>
                                                                                                        <img src="<?php echo $imageSrc; ?>" width="150px" height="150px" data-toggle="modal" data-target="#imageModal<?php echo $productos_datos['id_producto']; ?>">
                                                                                                        <!-- Modal -->
                                                                                                        <div class="modal fade" id="imageModal<?php echo $productos_datos['id_producto']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                                                <div class="modal-content">
                                                                                                                    <div class="modal-header">
                                                                                                                        <h5 class="modal-title" id="imageModalLabel<?php echo $productos_datos['id_producto']; ?>">Imagen del Producto</h5>
                                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                                        </button>
                                                                                                                    </div>
                                                                                                                    <div class="modal-body">
                                                                                                                        <img src="<?php echo $imageSrc; ?>" class="img-fluid">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </center>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="">Usuario: </label><?php echo $productos_datos['nombres_usuario']; ?>
                                                                                            <input type="text" class="form-control" value="<?php echo $email ?>" hidden>
                                                                                            <input type="text" name="id_usuario" value="<?php echo $id_usuario ?>" hidden>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Encargado de compras") { ?>
                                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_producto; ?>">
                                                                    <i class="fa fa-pencil-alt"></i>
                                                                    Editar
                                                                </button>
                                                                <!-- modal para actualizar proveedores-->
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
                                                                                                        <select name="proveedorupdate" id="proveedorupdate<?php echo $id_producto; ?>" class="form-control" required>
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
                                                                                                    <input type="text" class="form-control" value="<?php echo $email ?>" hidden>
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

                                                                <div id="respuesta_update<?php echo $id_producto; ?>"></div>
                                                            <?php } ?>
                                                            <?php if ($rol_sesion == "Administrador") { ?>
                                                                <a href="delete.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Borrar</a>
                                                            <?php } ?>
                                                        </div>
                                                    </center>
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
        </div>
    </div>
</div>


<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<script>
    $(document).ready(function() {
        var table = $("#example1").DataTable({
            "pageLength": 5,
            searching: true,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
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
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [{
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
            "dom": '<"top"lfB><"filter-price">rt<"bottom"ip><"clear">',
        });



        // Añadir inputs en los encabezados de las columnas

        $('#example1 thead tr').clone(true).appendTo('#example1 thead');
        $('#example1 thead tr:eq(1) th').each(function(index) {
            var title = $(this).text().trim();
            if (title === 'Codigo' || title === 'Nombre' || title === 'Descripcion' || title === 'Talle') {
                // Crear input de búsqueda para estos títulos
                $(this).html('<input type="text" class="form-control" placeholder="Buscar" style="height: 30px; width: 70px;"/>');
                // Filtro para los inputs de búsqueda (SOLO para estos títulos)
                $(this).find('input').on('keyup change', function() {
                    const columnIndex = $(this).closest('th').index() + ':visible'; // Obtiene el índice de la columna visible
                    table.column(columnIndex).search(this.value).draw();
                });
            } else if (title === 'Nro' || title === 'Imagen' || title === 'Color' || title === 'Stock' || title === 'Acciones') {
                $(this).html(''); // Deja la celda vacía para "Nro", "Imagen", y "Acciones"
            } else if (title === 'Precio Compra') {
                // Crear dos inputs para valor numérico en la misma fila
                $(this).html('<div style="display: flex; gap: 10px;">' +
                    '<input type="number" class="form-control" placeholder="Min Compra" id="minPriceCompra" style="height: 30px; width: 70px;" step="0.01">' +
                    '<input type="number" class="form-control" placeholder="Max Compra" id="maxPriceCompra" style="height: 30px; width: 70px;" step="0.01">' +
                    '</div>');
                // Filtrado para el rango de precios
                $('#minPriceCompra, #maxPriceCompra').on('input', function() {
                    table.draw(); // Redibujar la tabla para aplicar el filtro
                });
            } else if (title === 'Precio Venta') {
                // Crear dos inputs para valor numérico en la misma fila
                $(this).html('<div style="display: flex; gap: 10px;">' +
                    '<input type="number" class="form-control" placeholder="Min Venta" id="minPriceVenta" style="height: 30px; width: 70px;" step="0.01">' +
                    '<input type="number" class="form-control" placeholder="Max Venta" id="maxPriceVenta" style="height: 30px; width: 70px;" step="0.01">' +
                    '</div>');
                // Filtrado para el rango de precios
                $('#minPriceVenta, #maxPriceVenta').on('input', function() {
                    table.draw(); // Redibujar la tabla para aplicar el filtro
                });
            } else if (title === 'Categoria') {
                // Crear select para Categoría
                $(this).html('<select class="form-control" id="selectCategoria" style="width: 80%; height: 30px; font-size: 14px; box-sizing: border-box;"><option value="">...</option></select>');
                // Añadir opciones de categorías desde PHP
                <?php foreach ($categorias_datos as $categoria) { ?>
                    $('#selectCategoria').append('<option value="<?php echo $categoria['nombre_categoria']; ?>"><?php echo $categoria['nombre_categoria']; ?></option>');
                <?php } ?>
            } else if (title === 'Proveedor') {
                // Crear select para Proveedor
                $(this).html('<select class="form-control" id="selectProveedor" style="width: 80%; height: 30px; font-size: 14px; box-sizing: border-box;"><option value="">...</option></select>');
                // Añadir opciones de proveedores desde PHP
                <?php foreach ($proveedores_datos as $proveedor) { ?>
                    $('#selectProveedor').append('<option value="<?php echo $proveedor['nombre_proveedor']; ?>"><?php echo $proveedor['nombre_proveedor']; ?></option>');
                <?php } ?>
            } else if (title === 'Fecha Compra') {
                // Crear dos inputs de tipo date
                $(this).html('<div style="display: flex; gap: 10px;">' +
                    '<input type="date" class="form-control" id="minFechaCompra" style="height: 30px; width: 70px;"/>' +
                    '<input type="date" class="form-control" id="maxFechaCompra" style="height: 30px; width: 70px;"/>' +
                    '</div>');
            }

            // FILTRO PARA EL SELECT DE CATEGORIA
            $('#selectCategoria').on('change', function() {
                var categoriaIndex = $('#selectCategoria').closest('th').index(); // Obtiene el índice de la columna
                table.column(categoriaIndex).search(this.value).draw();
            });

            // FILTRO PAARA EL SELECT DE CATEGORIA
            $('#selectProveedor').on('change', function() {
                var proveedorIndex = $('#selectProveedor').closest('th').index(); // Obtiene el índice de la columna
                table.column(proveedorIndex).search(this.value).draw();
            });

            // FUNCION DE FILTRADO PERSONALIZADO DE DATATABLES PARA RANGOS NUMERICOS ----- COMPRA
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                const minPrice = parseFloat($('#minPriceCompra').val()) || 0; // Mínimo valor por defecto es 0
                const maxPrice = parseFloat($('#maxPriceCompra').val()) || Infinity; // Máximo valor por defecto es Infinito
                const priceCompraIndex = 10; // Ajusta este índice según la posición de la columna "Precio Compra"
                const priceCompra = parseFloat(data[priceCompraIndex].replace('$', '')) || 0;
                return priceCompra >= minPrice && priceCompra <= maxPrice;
                console.log("Índice de la columna 'Precio Compra':", priceCompraIndex);
            });
            // FUNCION DE FILTRADO PERSONALIZADO DE DATATABLES PARA RANGOS NUMERICOS ------ COMPRA
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                const minPrice = parseFloat($('#minPriceVenta').val()) || 0; // Mínimo valor por defecto es 0
                const maxPrice = parseFloat($('#maxPriceVenta').val()) || Infinity; // Máximo valor por defecto es Infinito
                const priceVentaIndex = 11; // Ajusta este índice según la posición de la columna "Precio Compra"
                const priceVenta = parseFloat(data[priceVentaIndex].replace('$', '')) || 0;
                return priceVenta >= minPrice && priceVenta <= maxPrice;
                console.log("Índice de la columna 'Precio Venta':", priceVentaIndex);
            });
            // FUNCION DE FILTRADO PERSONALIZADO PARA RANGO DE FECHAS
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                const minFecha = $('#minFechaCompra').val() ? new Date($('#minFechaCompra').val()) : null; // Fecha mínima
                const maxFecha = $('#maxFechaCompra').val() ? new Date($('#maxFechaCompra').val()) : null; // Fecha máxima
                const fechaCompraIndex = 12; // Ajusta este índice según la posición de la columna "Fecha Compra"
                const fechaCompra = new Date(data[fechaCompraIndex]); // Convierte la fecha de la tabla a objeto Date

                // Comprobar si la fecha está dentro del rango
                if (
                    (minFecha === null || fechaCompra >= minFecha) &&
                    (maxFecha === null || fechaCompra <= maxFecha)
                ) {
                    return true; // La fila cumple con los criterios
                }
                return false; // La fila no cumple con los criterios
            });

            // Redibujar la tabla al cambiar las fechas
            $('#minFechaCompra, #maxFechaCompra').on('change', function() {
                table.draw(); // Redibujar la tabla para aplicar el filtro
            });

        });

        // Aquí definimos que la fila clonada (segunda fila con los inputs) no sea ordenable
        $('#example1 thead tr:eq(1) th').removeClass('sorting').off('click');

        // Añadir los botones a DataTables
        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>