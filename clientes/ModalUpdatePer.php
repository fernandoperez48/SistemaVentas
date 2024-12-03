<?php

class ModalUpdatePer
{
    public static function render($id_cliente, $clientesper_datos, $id_domicilio)
    {
        ob_start(); // Iniciar el buffer de salida
?>


        <!-- modal para actualizar clientes-->
        <div class="modal fade" id="modal-update<?php echo $id_cliente; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:darkgreen; color:white">
                        <h4 class="modal-title">Actualizacion del cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre del cliente <b>*</b></label>
                                    <input type="text" id="nombre_clienteU<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['nombre']; ?>" class="form-control">
                                    <small style="color:red; display:none" id="lbl_nombreU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellido del cliente <b>*</b></label>
                                    <input type="text" id="apellido_clienteU<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['apellido']; ?>" class="form-control">
                                    <small style="color:red; display:none" id="lbl_apellidoU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="telefonoU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['telefono']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DNI <b>*</b></label>
                                    <input type="text" id="dniU<?php echo $id_cliente; ?>" value="<?php echo $clientesper_datos['dni']; ?>" class="form-control">
                                    <small style="color:red; display:none" id="lbl_dni_invalid">* El dni no es válido, rango entre 6 y 50 millones</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="text" id="emailU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['email']; ?>">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Condicion frente al IVA</label>
                                    <select name="" id="condicion_iva<?php echo $id_cliente; ?>" class="form-control" required>
                                        <option value="<?php echo $clientesper_datos['id_iva']; ?>" selected><?php echo $clientesper_datos['nombre_iva']; ?></option>
                                        <option value="1">Consumidor Final</option>
                                        <option value="2">Exento</option>
                                        <option value="3">Exterior</option>
                                        <option value="4">IVA NO Alcanzado</option>
                                        <option value="5">Monotributista</option>
                                        <option value="6">Responsable Inscripto</option>
                                    </select>
                                    <small style="color:red; display:none" id="lbl_rol">* Este campo es requerido</small>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pais<b>*</b></label>
                                    <input type="text" id="paisU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['pais']; ?>">
                                    <small style="color:red; display:none" id="lbl_paisU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provincia<b>*</b></label>
                                    <input type="text" id="provinciaU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['provincia']; ?>">
                                    <small style="color:red; display:none" id="lbl_provinciaU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Localidad </label>
                                    <input type="text" id="localidadU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['ciudad']; ?>">
                                    <small style="color:red; display:none" id="lbl_localidadU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Domicilio<b>*</b></label>
                                    <input type="text" id="domicilioU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['calle']; ?>">
                                    <small style="color:red; display:none" id="lbl_domicilioU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Nro<b>*</b></label>
                                    <input type="text" id="numeroU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['numero']; ?>">
                                    <small style="color:red; display:none" id="lbl_numeroU<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Piso </label>
                                    <input type="text" id="pisoU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['piso']; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Depto<b>*</b></label>
                                    <input type="text" id="deptoU<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientesper_datos['depto']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_cliente; ?>">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script>
            $('#btn_update<?php echo $id_cliente; ?>').click(function() {
                console.log("Script cargado y ejecutándose");
                var id_cliente = '<?php echo $clientesper_datos['id_cliente']; ?>';
                var nombre_cliente = $('#nombre_clienteU<?php echo $id_cliente; ?>').val();
                var apellido_cliente = $('#apellido_clienteU<?php echo $id_cliente; ?>').val();
                var telefono = $('#telefonoU<?php echo $id_cliente; ?>').val();
                var dni = $('#dniU<?php echo $id_cliente; ?>').val();
                var email = $('#emailU<?php echo $id_cliente; ?>').val();
                var pais = $('#paisU<?php echo $id_cliente; ?>').val();
                var provincia = $('#provinciaU<?php echo $id_cliente; ?>').val();
                var localidad = $('#localidadU<?php echo $id_cliente; ?>').val();
                var domicilio = $('#domicilioU<?php echo $id_cliente; ?>').val();
                var numero = $('#numeroU<?php echo $id_cliente; ?>').val();
                var piso = $('#pisoU<?php echo $id_cliente; ?>').val();
                var depto = $('#deptoU<?php echo $id_cliente; ?>').val();
                var id_domicilio = '<?php echo $id_domicilio; ?>';
                var condicion_iva = $('#condicion_iva<?php echo $id_cliente; ?>').val();

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
                // Validaciones locales
                var hayError = false;
                // Verificar si todos los campos requeridos están llenos
                if (nombre_cliente === '' || apellido_cliente === '' || dni === '' || condicion_iva === '' || pais === '' || provincia === '' || localidad === '' || domicilio === '' || numero === '') {
                    alert('Todos los campos marcados con * son obligatorios.');
                    hayError = true;
                } else if (!validarEmail(email)) {
                    alert('Formato invalido de email');
                    hayError = true;
                } else if (!validarDNI(dni)) {
                    $('#lbl_dni_invalid').css('display', 'block');
                    alert('Formato invalido de dni');
                    hayError = true;
                }

                // Si no hay errores, valido en el servidor
                if (!hayError) {
                    $.post('../app/controllers/clientes/verificarEmailDni.php', {
                        email: email,
                        dni: dni,
                        id_cliente: id_cliente
                    }, function(response) {
                        var result = JSON.parse(response);

                        if (result.email_exists) {
                            // $('#lbl_email_exists').css('display', 'block'); // Muestra un mensaje personalizado
                            alert('Email ya existente');
                            hayError = true;
                        }
                        if (result.dni_exists) {
                            alert('DNI ya existente');
                            hayError = true;
                        }

                        if (!hayError) {
                            // Realizar la solicitud AJAX para enviar los datos actualizados
                            $.ajax({
                                type: "POST", // Cambiar a POST para enviar datos sensibles
                                url: "../app/controllers/clientes/updateper.php",
                                data: {
                                    id_cliente: id_cliente,
                                    nombre_cliente: nombre_cliente,
                                    apellido_cliente: apellido_cliente,
                                    telefono: telefono,
                                    dni: dni,
                                    email: email,
                                    pais: pais,
                                    provincia: provincia,
                                    localidad: localidad,
                                    domicilio: domicilio,
                                    numero: numero,
                                    piso: piso,
                                    depto: depto,
                                    id_domicilio: id_domicilio,
                                    condicion_iva: condicion_iva
                                },
                                success: function(response) {
                                    // Manejar la respuesta del servidor
                                    $('#respuesta_update<?php echo $id_cliente; ?>').html(response);
                                    console.log("Solicitud AJAX exitosa. Respuesta del servidor:", response);
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
                                }
                            });
                        }

                    })
                }
            });
        </script>



<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
