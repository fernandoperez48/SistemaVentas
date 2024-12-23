<?php
include '../app/config.php';
include '../layaout/sesion.php';
include '../layaout/parte1.php';
include '../app/controllers/almacen/listado_de_productos.php';
include '../app/controllers/categorias/listado_de_categorias.php';
include '../app/controllers/proveedores/listado_de_proveedores.php';

// Incluir el archivo de la clase del modal
include_once 'ModalEditarProducto.php';
include_once 'ModalVerProducto.php';
include_once 'Reporte.php';
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
                                <table id="example1" class="table table-bordered table-striped table-sm">
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
                                                $id_usuario = $productos_datos['id_usuario'];
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
                                                            <button type="button" id="btn-editar-<?php echo $id_producto; ?>" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_producto; ?>">
                                                                <i class="fa fa-eye"></i>
                                                                Ver
                                                            </button>
                                                            <!-- modal para ver productos-->
                                                            <?php
                                                            // Renderizar el modal utilizando la clase ModalVerProducto
                                                            echo ModalVerProducto::render($id_producto, $productos_datos, $stock_minimo, $stock_maximo, $URL);
                                                            ?>


                                                            <?php if ($rol_sesion == "Administrador" || $rol_sesion == "Encargado de compras") { ?>


                                                                <button type="button" class="btn btn-outline-success"
                                                                    data-toggle="modal"
                                                                    data-target="#modal-update<?php echo $id_producto; ?>"

                                                                    <i class="fa fa-pencil-alt"></i>
                                                                    Editar
                                                                </button>
                                                                <!-- modal para actualizar productos-->
                                                                <?php
                                                                // Llamar al método estático render de la clase ModalEditarUsuario -->
                                                                echo ModalEditarProducto::render($id_usuario, $id_producto, $productos_datos, $categorias_datos, $proveedores_datos, $descripcion, $URL);
                                                                ?>
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

</div>
<!--  FIN DE WRAAPPER DE PARTE1.PHP -->

<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>


<?php
// Llamar al método estático render de la clase Reporte -->
echo Reporte::render($categorias_datos, $proveedores_datos);

?>