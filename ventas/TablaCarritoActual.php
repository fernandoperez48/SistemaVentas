    <?php

    class TablaCarritoActual
    {
        public static function render($contador_de_ventas, $mysqli)
        {
            ob_start(); // Iniciar el buffer de salida
            $precio_total = 0; // Definir precio_total dentro del método para poder devolverlo
    ?>


            <table class="table table-bordered table-sm table-hover table-striped">
                <thead style="background-color: gray;">
                    <tr>
                        <th style="background-color: gray; text-align:center;">Nro</th>
                        <th style="background-color: gray; text-align:center;">Producto</th>
                        <th style="background-color: gray; text-align:center;">Detalle</th>
                        <th style="background-color: gray; text-align:center;">Cantidad</th>
                        <th style="background-color: gray; text-align:center;">Precio Unitario</th>
                        <th style="background-color: gray; text-align:center;">Precio Subtotal</th>
                        <th style="background-color: gray; text-align:center;">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contador_carrito = 0;
                    $cantidad_total = 0;
                    $precio_unitario_total = 0;
                    $precio_total = 0;

                    $sql_carrito = "SELECT *,pro.nombre as nombre_producto, pro.descripcion as descripcion, 
                                                pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto 
                    FROM tb_carrito as carr 
                    INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto 
                    WHERE nro_venta = $contador_de_ventas + 1 
                    ORDER BY carr.id_carrito";
                    $resultado_carrito = $mysqli->query($sql_carrito);

                    if ($resultado_carrito) {
                        foreach ($resultado_carrito as $carrito_datos) {
                            $id_carrito = $carrito_datos['id_carrito'];
                            $contador_carrito++;
                            $cantidad_total += $carrito_datos['cantidad'];
                            $precio_unitario_total += $carrito_datos['precio_venta'];
                            $precio_total += ($carrito_datos['cantidad'] * $carrito_datos['precio_venta']);
                    ?>
                            <tr>
                                <td>
                                    <center><?php echo $contador_carrito; ?></center>
                                    <input type="text" value="<?php echo $carrito_datos['id_producto']; ?>" id="id_producto<?php echo $contador_carrito; ?>" hidden>
                                </td>
                                <td>
                                    <center><?php echo $carrito_datos['nombre_producto']; ?></center>
                                </td>
                                <td>
                                    <center><?php echo $carrito_datos['descripcion']; ?></center>
                                </td>
                                <td>
                                    <center><span id="cantidad_carrito<?php echo $contador_carrito; ?>"><?php echo $carrito_datos['cantidad']; ?></span></center>
                                    <input type="text" id="stock_de_inventario<?php echo $contador_carrito; ?>" value="<?php echo $carrito_datos['stock']; ?>" hidden>
                                </td>
                                <td>
                                    <center>$ <?php echo $carrito_datos['precio_venta']; ?></center>
                                </td>
                                <td>
                                    <center>$ <?php
                                                $cantidad = floatval($carrito_datos['cantidad']);
                                                $precio_venta = floatval($carrito_datos['precio_venta']);
                                                echo $subtotal = $cantidad * $precio_venta;
                                                ?>
                                    </center>
                                </td>
                                <td>
                                    <form action="../app/controllers/ventas/borrar_carrito.php" method="post">
                                        <center>
                                            <input type="text" name="id_carrito" value="<?php echo $id_carrito; ?>" hidden>
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>
                                        </center>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "Error al ejecutar la consulta: " . $mysqli->error;
                    }
                    ?>



                    <tr>
                        <th colspan="3" style="background-color: #e7e7e7; text-align:right;">Total</th>
                        <th>
                            <center>
                                <?php
                                echo $cantidad_total;
                                ?>
                            </center>
                        </th>
                        <th>
                            <center>$ <?php
                                        echo $precio_unitario_total;
                                        ?>
                            </center>
                        </th>
                        <th style="background-color: yellow;">
                            <center>$ <?php
                                        echo $precio_total;
                                        ?>
                            </center>
                        </th>
                    </tr>
                </tbody>
            </table>

    <?php
            return [
                'html' => ob_get_clean(), // Captura el HTML generado
                'precio_total' => $precio_total, // Incluye el total calculado
                ob_get_clean() // Devolver el contenido del buffer de salida
            ];
        }
    }
