<?php

class ModalCreatePer
{
    public static function render($condicion_iva_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <!-- modal para registrar clientes-->
        <div class="modal fade" id="modal-create">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:blue; color:white">
                        <h4 class="modal-title">Creacion de un nuevo cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre<b>*</b></label>
                                    <input type="text" id="nombreC" class="form-control" placeholder="Nombre de la persona">
                                    <small style="color:red; display:none" id="lbl_nombreC">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellido<b>*</b></label>
                                    <input type="text" id="apellidoC" class="form-control" placeholder="Apellido">
                                    <small style="color:red; display:none" id="lbl_apellidoC">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="telefonoC" class="form-control" placeholder="Telefono">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="emailC" class="form-control" placeholder="Email">
                                    <small style="color:red; display:none" id="lbl_emailC">* Este campo es requerido</small>
                                    <small style="color:red; display:none" id="lbl_email_invalid">* El email no es válido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DNI</label>
                                    <input type="text" id="dniC" class="form-control" placeholder="XXXXXXXX">
                                    <small style="color:red; display:none" id="lbl_dni_invalid">* El dni no es válido, rango entre 6 y 50 millones</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Condicion frente al IVA</label>
                                    <select name="condicion_iva" id="condicion_iva" class="form-control" required>
                                        <?php
                                        foreach ($condicion_iva_datos as $condicion_iva_dato) { ?>
                                            <option value="<?php echo $condicion_iva_dato['id'] ?>"><?php echo $condicion_iva_dato['nombre'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <small style="color:red; display:none" id="lbl_rol">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="">Domicilio</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="" id="calle" placeholder="Calle">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="" id="numero" placeholder="Numero">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="" id="piso" placeholder="Piso">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="" id="depto" placeholder="Depto">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="" id="localidad" placeholder="Localidad">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="" id="provincia" placeholder="Provincia">
                                    </div>
                                    <br>
                                    <div class="col">
                                        <input type="text" class="form-control" name="" id="pais" placeholder="Pais">
                                    </div>
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->



        <!-- SCRIPTSSS DE LA TABLA-->
        <script>
            $('#btn_create').click(function() {
                var nombre = $('#nombreC').val();
                var apellido = $('#apellidoC').val();
                var telefono = $('#telefonoC').val();
                var email = $('#emailC').val();
                var dni = $('#dniC').val();
                var calle = $('#calle').val();
                var numero = $('#numero').val();
                var piso = $('#piso').val();
                var depto = $('#depto').val();
                var localidad = $('#localidad').val();
                var provincia = $('#provincia').val();
                var pais = $('#pais').val();
                var condicion_iva = $('#condicion_iva').val();
                // Función para validar email
                function validarEmail(email) {
                    var re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }

                // Función para validar DNI
                function validarDNI(dni) {
                    // Verificar que el DNI contiene solo números y está dentro del rango permitido
                    var numeroDNI = parseInt(dni, 10);
                    return /^\d+$/.test(dni) && numeroDNI >= 6000000 && numeroDNI <= 50000000;
                }

                  // Reinicia los mensajes de error
                 $('.form-group small').css('display', 'none');

                // Variables de control
            var hasError = false;

            // Validaciones
            if (nombre === '') {
                $('#lbl_nombreC').css('display', 'block');
                hasError = true;
            }
            if (apellido === '') {
                $('#lbl_apellidoC').css('display', 'block');
                hasError = true;
            }
            if (email === '') {
                $('#lbl_emailC').css('display', 'block');
                hasError = true;
            } else if (!validarEmail(email)) {
                $('#lbl_email_invalid').css('display', 'block');
                hasError = true;
            }
            if (!validarDNI(dni)) {
                $('#lbl_dni_invalid').css('display', 'block');
                hasError = true;
            }

            // Si no hay errores, realiza la solicitud
            if (!hasError) {
                var url = "../app/controllers/clientes/create.php";
                $.get(url, {
                    nombre: nombre,
                    apellido: apellido,
                    telefono: telefono,
                    email: email,
                    dni: dni,
                    calle: calle,
                    numero: numero,
                    piso: piso,
                    depto: depto,
                    localidad: localidad,
                    provincia: provincia,
                    pais: pais,
                    condicion_iva: condicion_iva
                }, function(datos) {
                    $('#respuesta').html(datos);
                });
                }


            });
        </script>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
