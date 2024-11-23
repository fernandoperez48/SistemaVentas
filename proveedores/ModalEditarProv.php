<?php

class ModalEditarProv
{
    public static function render($id_proveedor, $nombre_proveedor, $proveedores_datos, $id_domicilio)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <!-- modal para actualizar proveedores-->
        <div class="modal fade" id="modal-update<?php echo $id_proveedor; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:darkgreen; color:white">
                        <h4 class="modal-title">Actualizacion del proveedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre del proveedor <b>*</b></label>
                                    <input type="text" id="nombre_proveedor<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control">
                                    <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Numero de contacto <b>*</b></label>
                                    <input type="number" id="celular<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>">
                                    <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="telefono<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CUIT <b>*</b></label>
                                    <input type="text" id="cuit<?php echo $id_proveedor; ?>" value="<?php echo $proveedores_datos['cuit']; ?>" class="form-control">
                                    <small style="color:red; display:none" id="lbl_cuit<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Condición IVA <b>*</b></label>
                                    <select name="" id="iva<?php echo $id_proveedor; ?>" class="form-control" required>
                                        <option value="<?php echo $proveedores_datos['idIva']; ?>" selected><?php echo $proveedores_datos['iva']; ?></option>
                                        <option value="1">Consumidor Final</option>
                                        <option value="2">Exento</option>
                                        <option value="3">Exterior</option>
                                        <option value="4">IVA NO Alcanzado</option>
                                        <option value="5">Monotributista</option>
                                        <option value="6">Responsable Inscripto</option>
                                    </select>
                                    <small style="color:red; display:none" id="lbl_iva<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Comercial </label>
                                    <input type="text" id="comercial<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['responsable_comercial']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Empresa<b>*</b></label>
                                    <input type="email" id="empresa<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>">
                                    <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email <b>*</b></label>
                                    <input type="text" id="email<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pais<b>*</b></label>
                                    <input type="text" id="pais<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['pais']; ?>">
                                    <small style="color:red; display:none" id="lbl_pais<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provincia<b>*</b></label>
                                    <input type="text" id="provincia<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['provincia']; ?>">
                                    <small style="color:red; display:none" id="lbl_provincia<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Localidad <b>*</b></label>
                                    <input type="text" id="localidad<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['ciudad']; ?>">
                                    <small style="color:red; display:none" id="lbl_localidad<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Domicilio<b>*</b></label>
                                    <input type="text" id="domicilio<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['calle']; ?>">
                                    <small style="color:red; display:none" id="lbl_domicilio<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nro<b>*</b></label>
                                    <input type="text" id="numero<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['numero']; ?>">
                                    <small style="color:red; display:none" id="lbl_numero<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Piso </label>
                                    <input type="text" id="piso<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['piso']; ?>">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Depto</label>
                                    <input type="text" id="depto<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['depto']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btn_update<?php echo $id_proveedor; ?>">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <script>
            $('#btn_update<?php echo $id_proveedor; ?>').click(function() {
                var id_proveedor = '<?php echo $id_proveedor; ?>';
                var nombre_proveedor = $('#nombre_proveedor<?php echo $id_proveedor; ?>').val();
                var celular = $('#celular<?php echo $id_proveedor; ?>').val();
                var telefono = $('#telefono<?php echo $id_proveedor; ?>').val();
                var cuit = $('#cuit<?php echo $id_proveedor; ?>').val();
                var iva = $('#iva<?php echo $id_proveedor; ?>').val();
                var comercial = $('#comercial<?php echo $id_proveedor; ?>').val();
                var empresa = $('#empresa<?php echo $id_proveedor; ?>').val();
                var email = $('#email<?php echo $id_proveedor; ?>').val();
                var pais = $('#pais<?php echo $id_proveedor; ?>').val();
                var provincia = $('#provincia<?php echo $id_proveedor; ?>').val();
                var localidad = $('#localidad<?php echo $id_proveedor; ?>').val();
                var domicilio = $('#domicilio<?php echo $id_proveedor; ?>').val();
                var numero = $('#numero<?php echo $id_proveedor; ?>').val();
                var piso = $('#piso<?php echo $id_proveedor; ?>').val();
                var depto = $('#depto<?php echo $id_proveedor; ?>').val();
                var id_domicilio = '<?php echo $id_domicilio; ?>';

                // Función para validar email
                function validarEmail(email) {
                    var re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }

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

                // Verificar si todos los campos requeridos están llenos
                if (nombre_proveedor === '' || celular === '' || cuit === '' || email === '' || iva === '' || empresa === '' || pais === '' || provincia === '' || localidad === '' || domicilio === '' || numero === '') {
                    alert('Todos los campos marcados con * son obligatorios.');
                } else if (!validarEmail(email)) {
                    alert('Formato invalido de email');
                } else if (!validarCUIT(cuit)) {
                    alert('Formato invalido de CUIT');
                } else {
                    // Realizar la solicitud AJAX para enviar los datos actualizados
                    $.ajax({
                        type: "POST", // Cambiar a POST para enviar datos sensibles
                        url: "../app/controllers/proveedores/update.php",
                        data: {
                            id_proveedor: id_proveedor,
                            nombre_proveedor: nombre_proveedor,
                            celular: celular,
                            telefono: telefono,
                            cuit: cuit,
                            iva: iva,
                            comercial: comercial,
                            empresa: empresa,
                            email: email,
                            pais: pais,
                            provincia: provincia,
                            localidad: localidad,
                            domicilio: domicilio,
                            numero: numero,
                            piso: piso,
                            depto: depto,
                            id_domicilio: id_domicilio
                        },
                        success: function(response) {
                            // Manejar la respuesta del servidor
                            $('#respuesta_update<?php echo $id_proveedor; ?>').html(response);
                            console.log("Solicitud AJAX exitosa. Respuesta del servidor:", response);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
                        }
                    });
                }
            });
        </script>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
