<?php

class ModalEliminarUsuario
{
    public static function render($id_usuario, $usuarios_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <!-- modal para eliminar clientes-->
        <div class="modal fade" id="modal-eliminar<?php echo $id_usuario; ?>">
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
                                    <label>Nombre del Usuario</label>
                                    <input type="text" id="nombre<?php echo $id_usuario; ?>" value="<?php echo $usuarios_datos['nombres']; ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rol</label>
                                    <input type="text" id="rol<?php echo $id_usuario; ?>" value="<?php echo $usuarios_datos['rol']; ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="text" id="ema<?php echo $id_usuario; ?>" class="form-control" value="<?php echo $usuarios_datos['email']; ?>" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_usuario; ?>">Eliminar</button>
                            <div id="respuesta_delete<?php echo $id_usuario; ?>"></div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <script>
                $('#btn_delete<?php echo $id_usuario; ?>').click(function() {

                    var id_usuario = '<?php echo $id_usuario; ?>';

                    var url2 = "../app/controllers/usuarios/delete_usuario.php";
                    $.post(url2, {
                        id_usuario: id_usuario
                    }, function(datos) {
                        $('#respuesta_eliminar<?php echo $id_usuario; ?>').html(datos);
                    });
                });
            </script>
        </div>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
