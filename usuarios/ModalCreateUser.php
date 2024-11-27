<?php

class ModalAgregarUsuario
{
    public static function render($roles_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <div class="modal fade" id="modal-create">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:blue; color:white">
                        <h4 class="modal-title">Creacion de un nuevo usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-user" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre Usuario<b>*</b></label>
                                        <input type="text" id="nombre_usuario" class="form-control" placeholder="Nombre del Usuario">
                                        <small style="color:red; display:none" id="lbl_nombre">* Este campo es requerido</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" class="form-control" placeholder="Email">
                                        <small style="color:red; display:none" id="lbl_email">* Este campo es requerido</small>
                                        <small style="color:red; display:none" id="lbl_email_invalid">* El email no es válido</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Rol</label>
                                        <select name="rol" id="rol" class="form-control" required>
                                            <?php
                                            foreach ($roles_datos as $roles_datos) { ?>
                                                <option value="<?php echo $roles_datos['id_rol'] ?>"><?php echo $roles_datos['rol'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <small style="color:red; display:none" id="lbl_rol">* Este campo es requerido</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Contraseña<b>*</b></label>
                                        <input type="password" class="form-control" name="password_user" id="contraseña" required>
                                        <small style="color:red; display:none" id="lbl_contraseña">* Este campo es requerido</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Repita la contraseña<b>*</b></label>
                                        <input type="password" class="form-control" name="password_repeat" id="repita_contraseña" required>
                                        <small style="color:red; display:none" id="lbl_repita_contraseña">* Este campo es requerido</small>
                                        <small style="color:red; display:none" id="lbl_contraseña_no_coincide">* Las contraseñas no coinciden</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Imagen del usuario:</label>
                                        <input type="file" name="image" class="form-control" id="file">
                                        <br>
                                        <output id="list"></output>
                                        <script>
                                            function archivo(evt) {
                                                var files = evt.target.files; // FileList object
                                                // Obtenemos la imagen del campo "file".
                                                for (var i = 0, f; f = files[i]; i++) {
                                                    //Solo admitimos imágenes.
                                                    if (!f.type.match('image.*')) {
                                                        continue;
                                                    }
                                                    var reader = new FileReader();
                                                    reader.onload = (function(theFile) {
                                                        return function(e) {
                                                            // Insertamos la imagen
                                                            document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="100%" title="', (theFile.name), '"/>'].join('');
                                                        };
                                                    })(f);
                                                    reader.readAsDataURL(f);
                                                }
                                            }
                                            document.getElementById('file').addEventListener('change', archivo, false);
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn_create">Guardar</button>
                    </div>
                    <div id="respuesta"></div>
                </div>
            </div>
        </div>

        <script>
            $('#btn_create').click(function() {
                // Ocultar mensajes de error al iniciar
                $('small').css('display', 'none');

                let nombre_usuario = $('#nombre_usuario').val();
                let email = $('#email').val();
                let rol = $('#rol').val();
                let contraseña = $('#contraseña').val();
                let repita_contraseña = $('#repita_contraseña').val();
                let file = document.getElementById('file').files[0];

                // Validaciones
                function validarEmail(email) {
                    let re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }

                if (nombre_usuario == '') {
                    $('#nombre_usuario').focus();
                    $('#lbl_nombre').css('display', 'block');
                } else if (email == '') {
                    $('#email').focus();
                    $('#lbl_email').css('display', 'block');
                } else if (!validarEmail(email)) {
                    $('#email').focus();
                    $('#lbl_email_invalid').css('display', 'block');
                } else if (rol == '') {
                    $('#rol').focus();
                    $('#lbl_rol').css('display', 'block');
                } else if (contraseña == '') {
                    $('#contraseña').focus();
                    $('#lbl_contraseña').css('display', 'block');
                } else if (repita_contraseña == '') {
                    $('#repita_contraseña').focus();
                    $('#lbl_repita_contraseña').css('display', 'block');
                } else if (contraseña !== repita_contraseña) {
                    $('#repita_contraseña').focus();
                    $('#lbl_contraseña_no_coincide').css('display', 'block');
                } else {
                    // Verificar si ya existe un usuario con los mismos datos antes de crear
                    $.get('../app/controllers/usuarios/verificar.php', {
                        nombre_usuario: nombre_usuario,
                        email: email
                    }, function(response) {
                        var datos = JSON.parse(response);
                        if (datos.status === 'error') {
                            alert(datos.message);
                        } else {
                            // Si no hay conflictos, proceder con la creación del usuario
                            var formData = new FormData();
                            formData.append('nombre_usuario', nombre_usuario);
                            formData.append('email', email);
                            formData.append('rol', rol);
                            formData.append('contraseña', contraseña);
                            formData.append('repita_contraseña', repita_contraseña);
                            if (file) {
                                formData.append('image', file); // Agregar la imagen
                            }

                            $.ajax({
                                url: '../app/controllers/usuarios/create.php',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(datos) {
                                    if (datos.trim() === "registrado") {
                                        // Mostrar el mensaje de éxito
                                        $('#modal-create').modal('hide');
                                        location.reload();
                                    } else {
                                        alert("No se pudo registrar el usuario");
                                    }
                                }
                            });
                        }
                    });
                }
            });
        </script>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
