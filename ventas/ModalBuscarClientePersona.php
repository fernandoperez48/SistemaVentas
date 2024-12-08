<?php

class ModalBuscarClientePersona
{
    public static function render($clientesper_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <div class="modal fade" id="modal-buscar_clienteper">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda del Cliente persona</h4>
                        <div style="width: 10px;"></div>
                        <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-agregar_cliente">
                            <i class="fas fa-users"></i>
                            Agregar nuevo cliente
                        </button> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table table-responsive">
                            <table id="example2" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Nro de cliente</center>
                                        </th>
                                        <th>
                                            <center>Seleccionar</center>
                                        </th>
                                        <th>
                                            <center>Nombre</center>
                                        </th>
                                        <th>
                                            <center>DNI</center>
                                        </th>
                                        <th>
                                            <center>Telefono</center>
                                        </th>
                                        <th>
                                            <center>Email</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-body">
                                    <?php
                                    $contador_de_clientesper = 0;
                                    foreach ($clientesper_datos as $clientesper_datos) {

                                        $contador_de_clientesper = $contador_de_clientesper + 1; ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $clientesper_datos['id_cliente']; ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <button class="btn btn-info" id="btn_pasar_cliente<?php echo $clientesper_datos['id_cliente']; ?>">Seleccionar</button>
                                                    <script>
                                                        $("#btn_pasar_cliente<?php echo $clientesper_datos['id_cliente']; ?>").click(function() {
                                                            $("#id_cliente").val("<?php echo $clientesper_datos['id_cliente']; ?>");
                                                            $("#nombre_cliente").val("<?php echo $clientesper_datos['nombre']; ?>");
                                                            $("#nit_ci_cliente").val("<?php echo $clientesper_datos['dni']; ?>");
                                                            $("#celular_cliente").val("<?php echo $clientesper_datos['telefono']; ?>");
                                                            $("#email_cliente").val("<?php echo $clientesper_datos['email']; ?>");
                                                            $("#modal-buscar_clienteper").modal("hide");
                                                            // Guardar en localStorage
                                                            localStorage.setItem('cliente', JSON.stringify({
                                                                id_cliente: "<?php echo $clientesper_datos['id_cliente']; ?>",
                                                                nombre_cliente: "<?php echo $clientesper_datos['nombre']; ?>",
                                                                nit_ci_cliente: "<?php echo $clientesper_datos['dni']; ?>",
                                                                celular_cliente: "<?php echo $clientesper_datos['telefono']; ?>",
                                                                email_cliente: "<?php echo $clientesper_datos['email']; ?>"
                                                            }));

                                                            // Cerrar el modal
                                                            $(".close").click();
                                                        });
                                                    </script>
                                                </center>
                                            </td>
                                            <td>
                                                <center><?php echo $clientesper_datos['nombre']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $clientesper_datos['dni']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $clientesper_datos['telefono']; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $clientesper_datos['email']; ?></center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->

        </div>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
