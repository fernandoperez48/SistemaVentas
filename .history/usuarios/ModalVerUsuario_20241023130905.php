<?php

class ModalVerUsuario {
    public static function render($id_usuario,$nombre_usuario) {
        ob_start(); // Iniciar el buffer de salida
        ?>
                                                            <div class="modal fade" id="modal-ver<?php echo $id_usuario; ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="background-color:#088da5; color:white">
                                                                            <h4 class="modal-title">Datos del usuario</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Nombre del usuario</label>
                                                                                            <input type="text" id="nombre<?php echo $id_usuario; ?>" value="<?php echo $nombre_usuario; ?>" class="form-control" disabled>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Email </label>
                                                                                            <input type="email" id="ema<?php echo $id_usuario; ?>" class="form-control" value="<?php echo $usuarios_datos['email']; ?>" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Rol de Usuario</label>
                                                                                            <input type="text" id="rol<?php echo $id_usuario; ?>" class="form-control" value="<?php echo $usuarios_datos['rol']; ?>" disabled>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="">Imagen del usuario:</label>
                                                                                            <?php $imageSrc = empty($imagen_usuario) || is_null($imagen_usuario) ? $URL . '/usuarios/img/img_usuariossinimagen.jpg' : $URL . '/usuarios/img/img_usuarios' . $imagen_usuario; ?>
                                                                                            <center>
                                                                                                <img src="<?php echo $imageSrc; ?>" width="200px" style="display: block; margin: 0 auto;" class="img-fluid" alt="Imagen de <?php echo $nombre_usuario ?>">
                                                                                            </center>
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