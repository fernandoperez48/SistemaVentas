<?php

class ModalVerProducto
{
    public static function render($id_producto, $productos_datos, $stock_minimo, $stock_maximo, $URL)
    {
        ob_start(); // Iniciar el buffer de salida
?>
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
                                        <input type="text" class="form-control" value="<?php echo $productos_datos['email'] ?>" hidden>
                                        <input type="text" name="id_usuario" value="<?php echo $productos_datos['id_usuario'] ?>" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
