<?php

class ModalDeletePer
{
    public static function render($id_cliente, $clientesper_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <!-- modal para eliminar clientes-->
        <div class="modal fade" id="modal-delete<?php echo $id_cliente; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:red; color:white">
                        <h4 class="modal-title">¿Esta seguro de eliminar al cliente?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre del cliente <b>*</b></label>
                                    <input type="text" id="nombre<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['nombre']; ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellido del cliente <b>*</b></label>
                                    <input type="text" id="apellido<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['apellido']; ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="tel<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['telefono']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DNI <b>*</b></label>
                                    <input type="text" id="dni<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['dni']; ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="text" id="ema<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['email']; ?>" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pais<b>*</b></label>
                                    <input type="text" id="pai<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['pais']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provincia<b>*</b></label>
                                    <input type="text" id="prov<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['provincia']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Localidad </label>
                                    <input type="text" id="loc<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['ciudad']; ?>" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Domicilio<b>*</b></label>
                                    <input type="text" id="dom<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['calle']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nro<b>*</b></label>
                                    <input type="text" id="num<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['numero']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Piso </label>
                                    <input type="text" id="pis<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['piso']; ?>" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Depto<b>*</b></label>
                                    <input type="text" id="dpto<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['depto']; ?>" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_cliente; ?>">Eliminar</button>
                            <div id="respuesta_delete<?php echo $id_cliente; ?>"></div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <script>
                $('#btn_delete<?php echo $id_cliente; ?>').click(function() {

                    var id_cliente = '<?php echo $id_cliente; ?>';

                    var url2 = "../app/controllers/clientes/delete.php";
                    $.get(url2, {
                        id_cliente: id_cliente
                    }, function(datos) {
                        $('#respuesta_delete<?php echo $id_cliente; ?>').html(datos);
                    });
                });
            </script>
        </div>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
