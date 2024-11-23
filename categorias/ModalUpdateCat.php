<?php

class ModalUpdateCat
{
    public static function render($id_categoria, $nombre_categoria)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <!-- modal para actualizar categorias-->
        <div class="modal fade" id="modal-update<?php echo $id_categoria; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:darkgreen; color:white">
                        <h4 class="modal-title">Actualizacion de la categoria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre de la categoria</label>
                                    <input type="text" id="nombre_categoria<?php echo $id_categoria; ?>" value="<?php echo $nombre_categoria; ?>" class="form-control">
                                    <small style="color:red; display:none" id="lbl_update<?php echo $id_categoria; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_categoria; ?>">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script>
            $('#btn_update<?php echo $id_categoria; ?>').click(function() {

                var nombre_categoria = $('#nombre_categoria<?php echo $id_categoria; ?>').val();
                var id_categoria = '<?php echo $id_categoria; ?>';

                if (nombre_categoria == '') {
                    $('#nombre_categoria<?php echo $id_categoria; ?>').focus();
                    $('#lbl_update<?php echo $id_categoria; ?>').css('display', 'block');
                } else {
                    var url = "../app/controllers/categorias/update_de_categorias.php";
                    $.get(url, {
                        nombre_categoria: nombre_categoria,
                        id_categoria: id_categoria
                    }, function(datos) {
                        $('#respuesta_update<?php echo $id_categoria; ?>').html(datos);
                    });
                }
            });
        </script>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
