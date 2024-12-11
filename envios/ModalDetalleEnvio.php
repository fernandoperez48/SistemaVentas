<?php

class ModalDetalleEnvio
{
    public static function render($id_envio, $envios_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <!-- modal para ver detalle de envio-->
        <div class="modal fade" id="modal-detalle<?php echo $id_envio; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#088da5; color:white">
                        <h4 class="modal-title">Detalle de envio</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Detalle</label>
                                        <textarea name="descripcion" id="" cols="80" rows="5" class="form-control" disabled><?php echo $envios_datos['descripcion']; ?></textarea>
                                    </div>
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
