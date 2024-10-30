<?php

class ModalEditarUsuario
{
    public static function render($id_usuario, $nombre_usuario, $usuarios_datos, $roles_datos, $id_rol_usuario)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <div class="modal fade" id="modal-update<?php echo $id_usuario; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:darkgreen; color:white">
                        <h4 class="modal-title">Actualización del usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre del usuario <b>*</b></label>
                                    <input type="text" id="nombre_usuario<?php echo $id_usuario; ?>" value="<?php echo $nombre_usuario; ?>" class="form-control">
                                    <small style="color:red; display:none" id="lbl_nombre<?php echo $id_usuario; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="email" id="email<?php echo $id_usuario; ?>" class="form-control" value="<?php echo $usuarios_datos['email']; ?>">
                                    <small style="color:red; display:none" id="lbl_email<?php echo $id_usuario; ?>">* Este campo es requerido</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Rol</label>
                                    <select name="rolupdate" id="rolupdate<?php echo $id_usuario; ?>" class="form-control" required>
                                        <?php
                                        $rol_usuario_actual = $id_rol_usuario; // Asegúrate de que $usuario tenga el rol actual

                                        foreach ($roles_datos as $roles_datosupdate) { ?>
                                            <option value="<?php echo $roles_datosupdate['id_rol'] ?>" <?php echo ($roles_datosupdate['id_rol'] == $rol_usuario_actual) ? 'selected' : ''; ?>><?php echo $roles_datosupdate['rol'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <small style="color:red; display:none" id="lbl_rolupdate<?php echo $id_usuario; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <input type="text" class="form-control" name="password_user" id="contraseña<?php echo $id_usuario; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Repita la contraseña</label>
                                    <input type="text" class="form-control" name="password_repeat" id="repita_contraseña<?php echo $id_usuario; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Imagen del usuario:</label>
                                    <input type="file" name="image" class="form-control" id="fileupdate<?php echo $id_usuario; ?>">
                                    <br>
                                    <output id="list<?php echo $id_usuario; ?>"></output>
                                    <script>
                                        function archivo<?php echo $id_usuario; ?>(evt) {
                                            var files = evt.target.files; // FileList object
                                            // Obtenemos la imagen del campo "fileupdate".
                                            for (var i = 0, f; f = files[i]; i++) {
                                                //Solo admitimos imágenes.
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function(theFile) {
                                                    return function(e) {
                                                        // Insertamos la imagen
                                                        document.getElementById("list<?php echo $id_usuario; ?>").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', (theFile.name), '"/>'].join('');
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('fileupdate<?php echo $id_usuario; ?>').addEventListener('change', archivo<?php echo $id_usuario; ?>, false);
                                    </script>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_usuario; ?>">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <script>
            $('#btn_update<?php echo $id_usuario; ?>').click(function() {
                let id_usuario = '<?php echo $id_usuario; ?>';
                let nombre_usuario = $('#nombre_usuario<?php echo $id_usuario; ?>').val();
                let email = $('#email<?php echo $id_usuario; ?>').val();
                let rolupdate = $('#rolupdate<?php echo $id_usuario; ?>').val();
                let contraseña = $('#contraseña<?php echo $id_usuario; ?>').val();
                let repita_contraseña = $('#repita_contraseña<?php echo $id_usuario; ?>').val();
                let file = document.getElementById('fileupdate<?php echo $id_usuario; ?>').files[0];


                // Validaciones
                function validarEmail(email) {
                    let re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }

                // Verificar si todos los campos requeridos están llenos
                if (nombre_usuario === '' || email === '' || rolupdate === '' || contraseña === '' || repita_contraseña === '') {
                    alert('Todos los campos marcados con * son obligatorios.');
                } else if (contraseña !== repita_contraseña) {
                    // Validar si las contraseñas no coinciden
                    alert('Las contraseñas no coinciden. Por favor, verifícalas.');
                } else {

                    // Crear el objeto FormData
                    let formData = new FormData();
                    formData.append('id_usuario', id_usuario);
                    formData.append('nombre_usuario', nombre_usuario);
                    formData.append('email', email);
                    formData.append('rolupdate', rolupdate);
                    formData.append('contraseña', contraseña);
                    formData.append('repita_contraseña', repita_contraseña);
                    if (file) {
                        formData.append('image', file); // Agregar la imagen
                    }

                    $.ajax({
                        url: '../app/controllers/usuarios/update.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(datos) {
                            if (datos) {
                                // Mostrar el mensaje de éxito

                                // Cerrar el modal
                                $('#modal-update<?php echo $id_usuario; ?>').modal('hide');

                                // Opcional: Recargar la tabla o el contenido que muestra la lista de usuarios
                                location.reload();
                            } else {
                                // Mostrar el mensaje de error
                                alert("No se pudo registrar el usuario aca");
                            }
                        },

                    });
                }
            });
        </script>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
