<?php

class ModalProductos
{
    public static function render($id_venta, $venta, $mysqli)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <div class="modal fade" id="Modal_productos<?php echo $id_venta; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #08c2ec">
                        <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $id_venta; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="searchInput<?php echo $venta['nro_venta']; ?>" class="form-control" placeholder="Buscar...">
                                </div>
                                <div class="col-md-6 text-right">
                                    <span id="recordCount<?php echo $venta['nro_venta']; ?>"></span>
                                </div>
                            </div>
                            <table id="tabla_productos<?php echo $venta['nro_venta']; ?>" class="table table-bordered table-sm table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="background-color: #e7e7e7; text-align:center;">Nro</th>
                                        <th style="background-color: #e7e7e7; text-align:center;">Código</th>
                                        <th style="background-color: #e7e7e7; text-align:center;">Producto</th>
                                        <th style="background-color: #e7e7e7; text-align:center;">Detalle</th>
                                        <th style="background-color: #e7e7e7; text-align:center;">Cantidad</th>
                                        <th style="background-color: #e7e7e7; text-align:center;">Precio Unitario</th>
                                        <th style="background-color: #e7e7e7; text-align:center;">Precio Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_carrito = 0;
                                    $cantidad_total = 0;
                                    $precio_unitario_total = 0;
                                    $precio_total = 0;
                                    $nro_venta = $venta['nro_venta'];
                                    $sql_carrito = "SELECT carr.*, pro.nombre as nombre_producto, pro.descripcion as descripcion, 
                                    pro.stock as stock, pro.id_producto as id_producto, pro.codigo as codigo 
                                                                                        FROM tb_carrito as carr 
                                                                                        INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
                                                                                        WHERE nro_venta = '$nro_venta' 
                                                                                        ORDER BY carr.id_carrito";
                                    $resultado_carrito = $mysqli->query($sql_carrito);

                                    if ($resultado_carrito) {
                                        $carrito_datos = $resultado_carrito->fetch_all(MYSQLI_ASSOC);

                                        foreach ($carrito_datos as $carrito) {
                                            $id_carrito = $carrito['id_carrito'];
                                            $contador_carrito++;
                                            $cantidad_total += $carrito['cantidad'];
                                            $precio_unitario_total += $carrito['precio_unitario'];
                                            $precio_total += ($carrito['cantidad'] * $carrito['precio_unitario']);
                                    ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $contador_carrito; ?></center>
                                                    <input type="text" value="<?php echo $carrito['id_producto']; ?>" id="id_producto<?php echo $contador_carrito; ?>" hidden>
                                                </td>
                                                <td>
                                                    <center><?php echo $carrito['codigo']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $carrito['nombre_producto']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $carrito['descripcion']; ?></center>
                                                </td>
                                                <td>
                                                    <center><span id="cantidad_carrito<?php echo $contador_carrito; ?>"><?php echo $carrito['cantidad']; ?></span></center>
                                                    <input type="text" id="stock_de_inventario<?php echo $contador_carrito; ?>" value="<?php echo $carrito['stock']; ?>" hidden>
                                                </td>
                                                <td>
                                                    <center>$ <?php echo $carrito['precio_unitario']; ?></center>
                                                </td>
                                                <td>
                                                    <center>$ <?php echo $subtotal = floatval($carrito['cantidad']) * floatval($carrito['precio_unitario']); ?></center>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "Error en la consulta: " . $mysqli->error;
                                    }
                                    ?>

                                    <tr class="total-row">
                                        <th colspan="4" style="background-color: #e7e7e7; text-align:right;">Total</th>
                                        <th>
                                            <center><?php echo $cantidad_total; ?></center>
                                        </th>
                                        <th>
                                            <center>$ <?php echo $precio_unitario_total; ?></center>
                                        </th>
                                        <th style="background-color: yellow;">
                                            <center>$ <?php echo $precio_total; ?></center>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
