<?php

class ModalDeleteEnvio
{
    public static function render($id_envio, $envios_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <!-- modal para borrar Envios-->
        <div class="modal fade" id="modal-delete<?php echo $id_envio; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:red; color:white">
                        <h4 class="modal-title">¿Esta seguro de eliminar al envio?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre del cliente <b>*</b></label>
                                    <input type="text" id="nombre_cliente<?php echo $id_envio; ?>" value="<?php echo $envios_datos['nombre'] . ' ' . $envios_datos['apellido']; ?>" class="form-control" disabled>
                                    <small style="color:red; display:none" id="lbl_nombre<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha compra <b>*</b></label>
                                    <input type="text" id="Fecha<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['fyh_creacion']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_fecha<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Direccion de envio<b>*</b></label>
                                    <input type="text" id="Direccion<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['Direccion']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_fecha<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Pagado<b>*</b></label>
                                    <input type="text" id="precio<?php echo $id_envio; ?>" class="form-control" value="<?php echo '$' . $envios_datos['total_pagado']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_precio<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estado <b>*</b></label>
                                    <input type="text" id="estado<?php echo $id_envio; ?>" class="form-control" value="<?php echo $envios_datos['estado']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_precio<?php echo $id_envio; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_envio; ?>">Eliminar</button>
                        <div id="respuesta_delete<?php echo $id_envio; ?>"></div>
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
