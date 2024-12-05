<?php

class ModalUpdateEmp
{
    public static function render($id_cliente, $clientesemp_datos, $id_domicilio)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <!-- modal para actualizar clientes-->
        <div class="modal fade" id="modal-update<?php echo $id_cliente; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:darkgreen; color:white">
                        <h4 class="modal-title">Actualizacion de la Empresa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-between">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre empresa<b>*</b></label>
                                    <input type="text" id="nombre_empresa<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['nombre']; ?>" class="form-control text-center">
                                    <small style="color:red; display:none" id="lbl_nombreE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Razon Social<b>*</b></label>
                                    <input type="text" id="razon_social<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['razon_social']; ?>" class="form-control text-center">
                                    <small style="color:red; display:none" id="lbl_razon_socialE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CUIT<b>*</b></label>
                                    <input type="text" id="cuitE<?php echo $id_cliente; ?>" value="<?php echo $clientesemp_datos['cuit']; ?>" class="form-control text-center">
                                    <small style="color:red; display:none" id="lbl_cuit_invalid">* El cuit no es valido</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="telefonoE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['telefono']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email<b>*</b></label>
                                    <input type="text" id="emailE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['email']; ?>">
                                    <small style="color:red; display:none" id="lbl_email_invalid">* El email no es valido</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Persona Autorizada</label>
                                    <input type="text" id="persona_autorizada<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['persona_autorizada']; ?>">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5>Datos Domicilio</h5>

                        <div class="row justify-content-between">


                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Calle<b>*</b></label>
                                    <input type="text" id="domicilioE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['calle']; ?>">
                                    <small style="color:red; display:none" id="lbl_domicilioE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Nro<b>*</b></label>
                                    <input type="text" id="numeroE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['numero']; ?>">
                                    <small style="color:red; display:none" id="lbl_numeroE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Piso</label>
                                    <input type="text" id="pisoE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['piso']; ?>">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Depto</label>
                                    <input type="text" id="deptoE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['depto']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Localidad<b>*</b></label>
                                    <input type="text" id="localidadE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['ciudad']; ?>">
                                    <small style="color:red; display:none" id="lbl_localidadE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provincia<b>*</b></label>
                                    <input type="text" id="provinciaE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['provincia']; ?>">
                                    <small style="color:red; display:none" id="lbl_provinciaE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pais<b>*</b></label>
                                    <input type="text" id="paisE<?php echo $id_cliente; ?>" class="form-control text-center" value="<?php echo $clientesemp_datos['pais']; ?>">
                                    <small style="color:red; display:none" id="lbl_paisE<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btn_updateE<?php echo $id_cliente; ?>">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script>
            $('#btn_updateE<?php echo $id_cliente; ?>').click(function() {
                console.log("Script cargado y ejecutándose");
                var id_cliente = '<?php echo $id_cliente; ?>';
                var nombre_cliente = $('#nombre_empresa<?php echo $id_cliente; ?>').val();
                var razon_social = $('#razon_social<?php echo $id_cliente; ?>').val();
                var telefono = $('#telefonoE<?php echo $id_cliente; ?>').val();
                var cuit = $('#cuitE<?php echo $id_cliente; ?>').val();
                var email = $('#emailE<?php echo $id_cliente; ?>').val();
                var pais = $('#paisE<?php echo $id_cliente; ?>').val();
                var provincia = $('#provinciaE<?php echo $id_cliente; ?>').val();
                var localidad = $('#localidadE<?php echo $id_cliente; ?>').val();
                var domicilio = $('#domicilioE<?php echo $id_cliente; ?>').val();
                var numero = $('#numeroE<?php echo $id_cliente; ?>').val();
                var piso = $('#pisoE<?php echo $id_cliente; ?>').val();
                var depto = $('#deptoE<?php echo $id_cliente; ?>').val();
                var persona_autorizada = $('#persona_autorizada<?php echo $id_cliente; ?>').val();
                var id_domicilio = '<?php echo $id_domicilio; ?>';

                // Función para validar CUIT
                function validarCUIT(cuit) {
                    // Verificar que el formato sea xx-xxxxxxxx-x
                    var re = /^\d{2}-\d{7,8}-\d$/;
                    if (!re.test(cuit)) {
                        return false; // No cumple con el formato
                    }

                    // Separar las partes del CUIT
                    var partes = cuit.split('-');
                    var dni = partes[1]; // Parte central (DNI)

                    // Verificar que el DNI tenga entre 7 y 8 dígitos
                    var numeroDNI = parseInt(dni, 10);
                    return numeroDNI >= 6000000 && numeroDNI <= 50000000;
                }

                // Función para validar email
                function validarEmail(email) {
                    var re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }
                // Validaciones locales
                var hayError = false;
                // Verificar si todos los campos requeridos están llenos
                if (nombre_cliente === '' || razon_social === '' || cuit === '' || telefono === '' || email === '' || calle === '' || numero === '' || localidad === '' || provincia === '' || pais === '') {
                    alert('Todos los campos marcados con * son obligatorios.');
                    hayError = true;
                } else if (!validarEmail(email)) {
                    alert('Formato invalido de email');
                    hayError = true;
                } else if (!validarCUIT(cuit)) {
                    alert('Formato invalido de cuit');
                    hayError = true;
                }
                // Si no hay errores, valido en el servidor
                if (!hayError) {
                    $.post('../app/controllers/clientes/verificarEmailCuit.php', {
                        email: email,
                        cuit: cuit,
                        id_cliente: id_cliente
                    }, function(response) {
                        var result = JSON.parse(response);

                        if (result.email_exists) {
                            alert('Email ya existente');
                            hayError = true;
                        }
                        if (result.cuit_exists) {
                            alert('CUIT ya existente');
                            hayError = true;
                        }

                        if (!hayError) {
                            // Realizar la solicitud AJAX para enviar los datos actualizados
                            $.ajax({
                                type: "POST", // Cambiar a POST para enviar datos sensibles
                                url: "../app/controllers/clientes/updateemp.php",
                                data: {
                                    id_cliente: id_cliente,
                                    nombre_cliente: nombre_cliente,
                                    razon_social: razon_social,
                                    telefono: telefono,
                                    cuit: cuit,
                                    email: email,
                                    pais: pais,
                                    provincia: provincia,
                                    localidad: localidad,
                                    domicilio: domicilio,
                                    numero: numero,
                                    piso: piso,
                                    depto: depto,
                                    persona_autorizada: persona_autorizada,
                                    id_domicilio: id_domicilio
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
                    });
                }
            });
        </script>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
