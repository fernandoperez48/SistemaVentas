<?php

class ModalDeleteCat
{
    public static function render($id_categoria, $nombre_categoria, $URL)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <!-- modal para elimnar categorias-->
        <div class="modal fade" id="modal-delete<?php echo $id_categoria; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:red; color:white">
                        <h4 class="modal-title">¿Estas seguro que desea eliminarla?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre de la categoria</label>
                                    <input type="text" id="nombre_categoria<?php echo $id_categoria; ?>" value="<?php echo $nombre_categoria; ?>" class="form-control" readonly>
                                    <small style="color:red; display:none" id="lbl_delete<?php echo $id_categoria; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btn_delete<?php echo $id_categoria; ?>">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#btn_delete<?php echo $id_categoria; ?>').click(function() {
                var id_categoria = '<?php echo $id_categoria; ?>';
                var url2 = "../app/controllers/categorias/delete_de_categorias.php";

                $.get(url2, {
                    id_categoria: id_categoria
                }, function(response) {
                    if (response === "success") {
                        window.location.href = '<?php echo $URL; ?>/categorias/';
                    } else {
                        alert("No se pudo eliminar la categoría. Inténtelo de nuevo.");
                    }
                });
            });
        </script>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
