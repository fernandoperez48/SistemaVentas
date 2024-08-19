<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion != "Administrador") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/usuarios/listado_de_usuarios.php';
include '../app/controllers/roles/listado_de_roles.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:gray">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Usuarios
                        <button <?php if ($rol_sesion != "Administrador") echo 'disabled'; ?> type="button" class="btn btn-warning ml-3" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>
                    </h1>
                </div>

            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Usuarios registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped table-sm" style="border-color: black;">
                                <thead style=" background-color: gray;">
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombres</center>
                                        </th>
                                        <th>
                                            <center>Correo</center>
                                        </th>
                                        <th>
                                            <center>Rol del usuario</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($usuarios_datos as $usuarios_datos) {
                                        $id_usuario = $usuarios_datos['id_usuarios'];
                                        $nombre_usuario = $usuarios_datos['nombres'];
                                        $imagen_usuario = $usuarios_datos['imagen']; ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1; ?></center>
                                            </td>
                                            <td><?php echo $usuarios_datos['nombres']; ?></td>
                                            <td><?php echo $usuarios_datos['email']; ?></td>
                                            <td><?php echo $usuarios_datos['rol']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-ver<?php echo $id_usuario; ?>">
                                                                <i class="fa fa-eye"></i>
                                                                Ver
                                                            </button>
                                                            <!-- modal para ver usuarios-->
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
                                                                                                <img src="<?php echo $imageSrc; ?>" width="200px" style="display: block; margin: 0 auto;" class="img-fluid" alt="Imagen de <?php echo $nombres_usuario ?>">
                                                                                            </center>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                        </div>
                        <?php if ($rol_sesion == "Administrador") { ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_usuario; ?>">
                                    <i class="fa fa-pencil-alt"></i>
                                    Editar
                                </button>
                                <!-- modal para actualizar usuarios-->
                                <div class="modal fade" id="modal-update<?php echo $id_usuario; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color:darkgreen; color:white">
                                                <h4 class="modal-title">Actualizacion del usuario</h4>
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
                                                                foreach ($roles_datos as $roles_datosupdate) { ?>
                                                                    <option value="<?php echo $roles_datosupdate['id_rol'] ?>"><?php echo $roles_datosupdate['rol'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <small style="color:red; display:none" id="lbl_rolupdate">* Este campo es requerido</small>
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
                                                    <div class="form-group">
                                                        <label for="">Repita la contraseña</label>
                                                        <input type="text" class="form-control" name="password_repeat" id="repita_contraseña<?php echo $id_usuario; ?>" required>
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
                                        var id_usuario = '<?php echo $id_usuario; ?>';
                                        var nombre_usuario = $('#nombre_usuario<?php echo $id_usuario; ?>').val();
                                        var email = $('#email<?php echo $id_usuario; ?>').val();
                                        var rolupdate = $('#rolupdate<?php echo $id_usuario; ?>').val();
                                        var contraseña = $('#contraseña<?php echo $id_usuario; ?>').val();
                                        var repita_contraseña = $('#repita_contraseña<?php echo $id_usuario; ?>').val();
                                        // Verificar si todos los campos requeridos están llenos
                                        if (nombre_usuario === '' || email === '' || rolupdate === '' || contraseña === '' || repita_contraseña === '') {
                                            alert('Todos los campos marcados con * son obligatorios.');
                                        } else if (contraseña !== repita_contraseña) {
                                            // Validar si las contraseñas no coinciden
                                            alert('Las contraseñas no coinciden. Por favor, verifícalas.');
                                        } else {
                                            // Realizar la solicitud AJAX para enviar los datos actualizados
                                            $.ajax({
                                                type: "POST", // Cambiar a POST para enviar datos sensibles
                                                url: "../app/controllers/usuarios/update.php",
                                                data: {
                                                    id_usuario: id_usuario,
                                                    nombre_usuario: nombre_usuario,
                                                    email: email,
                                                    rolupdate: rolupdate,
                                                    contraseña: contraseña,
                                                    repita_contraseña: repita_contraseña
                                                },
                                                success: function(response) {
                                                    // Manejar la respuesta del servidor
                                                    $('#respuesta_update<?php echo $id_usuario; ?>').html(response);
                                                    console.log("Solicitud AJAX exitosa. Respuesta del servidor:", response);
                                                },
                                                error: function(xhr, textStatus, errorThrown) {
                                                    console.log("Error en la solicitud AJAX:");
                                                    console.log("Estado: " + textStatus);
                                                    console.log("Error: " + errorThrown);
                                                    console.log("Respuesta del servidor: " + xhr.responseText);
                                                }
                                            });
                                        }
                                    });
                                </script>
                                <div id="respuesta_update<?php echo $id_usuario; ?>"></div>
                            </div>


                        <?php
                                        }
                        ?>

                    </div>
                    </center>
                    </td>
                    </tr>
                <?php
                                    }
                ?>

                </tbody>

                </table>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
<!-- modal para registrar usuarios-->
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
                            <label for="">Contraseña</label>
                            <input type="passsword" class="form-control" name="password_user" id="contraseña" required>
                            <small style="color:red; display:none" id="lbl_contraseña">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Repita la contraseña</label>
                            <input type="password" class="form-control" name="password_repeat" id="repita_contraseña" required>
                            <small style="color:red; display:none" id="lbl_repita_contraseña">* Este campo es requerido</small>
                            <small style="color:red; display:none" id="lbl_contraseña_no_coincide">* Las contraseñas no coinciden</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Imagen del producto:</label>
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
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar</button>
            </div>
            <div id="respuesta"></div>
        </div>
    </div>
</div>

</div>

<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<script>
    $(function() {
        $("#example1").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 10,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 to 0 of 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            /* fin de idiomas */
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": /* Ajuste de botones */ [{
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    }, {
                        extend: 'pdf',
                    }, {
                        extend: 'csv',
                    }, {
                        extend: 'excel',
                    }, {
                        text: 'Imprimir',
                        extend: 'print'
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
<script>
    $('#btn_create').click(function() {
        // Ocultar todos los mensajes de error al iniciar
        $('small').css('display', 'none');
        var nombre_usuario = $('#nombre_usuario').val();
        var email = $('#email').val();
        var rol = $('#rol').val();
        var contraseña = $('#contraseña').val();
        var repita_contraseña = $('#repita_contraseña').val();

        // Función para validar email
        function validarEmail(email) {
            var re = /\S+@\S+\.\S+/;
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
            // Si todo está bien, hacer la petición AJAX
            $.get('../app/controllers/usuarios/verificar.php', {
                nombre_usuario: nombre_usuario,
                email: email,
                rol: rol,
                contraseña: contraseña,
                repita_contraseña: repita_contraseña
            }, function(response) {
                var datos = JSON.parse(response);
                if (datos.status === 'error') {
                    alert(datos.message);
                } else {
                    var url = "../app/controllers/usuarios/create.php";
                    $.get(url, {
                        nombre_usuario: nombre_usuario,
                        email: email,
                        rol: rol,
                        contraseña: contraseña,
                        repita_contraseña: repita_contraseña
                    }, function(datos) {
                        $('#respuesta').html(datos);
                    });
                }
            });
        }
    });
</script>