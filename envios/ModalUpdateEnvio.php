<?php

class ModalUpdateEnvio
{
    public static function render($id_envio, $envios_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <!-- modal para actualizar envio-->
        <div class="modal fade" id="modal-update<?php echo $id_envio; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:darkgreen; color:white">
                        <h4 class="modal-title">Actualizacion del envio</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre del cliente</label>
                                    <input type="text" id="nombre_cliente<?php echo $id_envio; ?>" value="<?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha compra</label>
                                    <input type="text" id="fecha<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['fyh_creacion']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Direccion de envio</label>
                                    <input type="text" id="direccion<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['Direccion']; ?>">
                                    <small style="color:red; display:none" id="lbl_direccion<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Pagado</label>
                                    <input type="text" id="precio<?php echo $id_envio; ?>" class="form-control" value="<?php echo '$' . $envios_datos['total_pagado']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Estado <b>*</b></label>
                                    <select class="form-control" name="estado" id="estado<?php echo $id_envio; ?>" value="<?php echo $envios_datos['estado']; ?>">
                                        <option value="Pendiente de envio">Pendiente de envío</option>
                                        <option value="Enviado">Enviado</option>
                                        <option value="Entregado">Entregado</option>
                                    </select>
                                    <small style="color:red; display:none" id="lbl_estado<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_envio; ?>">Actualizar</button>
                        <div id="respuesta_update"></div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script>
            $('#btn_update<?php echo $id_envio; ?>').click(function() {

                var id_envio = '<?php echo $id_envio; ?>';
                var direccion = $('#direccion<?php echo $id_envio; ?>').val();
                var estado = $('#estado<?php echo $id_envio; ?>').val();

                if (direccion == '') {
                    $('#direccion<?php echo $id_envio; ?>').focus();
                    $('#lbl_direccion<?php echo $id_envio; ?>').css('display', 'block');
                } else if (estado == '') {
                    $('#estado<?php echo $id_envio; ?>').focus();
                    $('#lbl_estado<?php echo $id_envio; ?>').css('display', 'block');
                } else {
                    var url = "../app/controllers/envios/update.php";
                    $.get(url, {
                        id_envio: id_envio,
                        direccion: direccion,
                        estado: estado
                    }, function(datos) {
                        $('#respuesta_update').html(datos);
                    });
                }


            });
        </script>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
