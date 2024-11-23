<?php

class ModalCreateProv
{
    public static function render()
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <!-- modal para registrar proveedores-->
        <div class="modal fade" id="modal-create">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:blue; color:white">
                        <h4 class="modal-title">Creacion de un nuevo proveedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre Proveedor<b>*</b></label>
                                    <input type="text" id="nombre_proveedor" class="form-control" placeholder="Nombre del Proveedor">
                                    <small style="color:red; display:none" id="lbl_nombre">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="telefono" class="form-control" placeholder="Telefono">
                                    <small style="color:red; display:none" id="lbl_telefono">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Empresa</label>
                                    <input type="text" id="empresa" class="form-control" placeholder="Empresa">
                                    <small style="color:red; display:none" id="lbl_empresa">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
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
                                    <label>CUIT</label>
                                    <input type="text" id="cuit" class="form-control" placeholder="XX-XXXXXXXX-X">
                                    <small style="color:red; display:none" id="lbl_cuit">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Condicion IVA</label>
                                <select name="" id="condicion_iva" class="form-control" required>
                                    <option value="" selected>Seleccione condición</option>
                                    <option value="1">Consumidor Final</option>
                                    <option value="2">Exento</option>
                                    <option value="3">Exterior</option>
                                    <option value="4">IVA NO Alcanzado</option>
                                    <option value="5">Monotributista</option>
                                    <option value="6">Responsable Inscripto</option>
                                </select>
                                <small style="color:red; display:none" id="lbl_condicion_iva">* Este campo es requerido</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="">Domicilio</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="" id="calle" placeholder="Calle">
                                        <small style="color:red; display:none" id="lbl_calle">* Este campo es requerido</small>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="" id="numero" placeholder="Numero">
                                        <small style="color:red; display:none" id="lbl_numero">* Este campo es requerido</small>
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
                                        <small style="color:red; display:none" id="lbl_localidad">* Este campo es requerido</small>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="" id="provincia" placeholder="Provincia">
                                        <small style="color:red; display:none" id="lbl_provincia">* Este campo es requerido</small>
                                    </div>
                                    <br>
                                    <div class="col">
                                        <input type="text" class="form-control" name="" id="pais" placeholder="Pais">
                                        <small style="color:red; display:none" id="lbl_pais">* Este campo es requerido</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Responsable Comercial<b>*</b></label>
                                    <input type="text" id="responsable_comercial" class="form-control">
                                    <small style="color:red; display:none" id="lbl_responsable_comercial">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono/Celular de R.C.<b>*</b></label>
                                    <input type="number" id="celular" class="form-control">
                                    <small style="color:red; display:none" id="lbl_celular">* Este campo es requerido</small>
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
        <script>
            $('#btn_create').click(function() {
                var nombre_proveedor = $('#nombre_proveedor').val();
                var telefono = $('#telefono').val();
                var empresa = $('#empresa').val();
                var email = $('#email').val();
                var cuit = $('#cuit').val();
                var condicion_iva = $('#condicion_iva').val();
                var calle = $('#calle').val();
                var numero = $('#numero').val();
                var piso = $('#piso').val();
                var depto = $('#depto').val();
                var localidad = $('#localidad').val();
                var provincia = $('#provincia').val();
                var pais = $('#pais').val();
                var responsable_comercial = $('#responsable_comercial').val();
                var celular = $('#celular').val();


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


                if (nombre_proveedor == '') {
                    $('#nombre_proveedor').focus();
                    $('#lbl_nombre').css('display', 'block');
                } else if (telefono == '') {
                    $('#telefono').focus();
                    $('#lbl_telefono').css('display', 'block');
                } else if (empresa == '') {
                    $('#empresa').focus();
                    $('#lbl_empresa').css('display', 'block');
                } else if (email == '') {
                    $('#email').focus();
                    $('#lbl_email').css('display', 'block');
                } else if (!validarEmail(email)) {
                    $('#email').focus();
                    $('#lbl_email_invalid').css('display', 'block');
                } else if (!validarCUIT(cuit)) {
                    $('#cuit').focus();
                    $('#lbl_cuit_invalid').css('display', 'block');
                } else if (cuit == '') {
                    $('#cuit').focus();
                    $('#lbl_cuit').css('display', 'block');
                } else if (condicion_iva == '') {
                    $('#condicion_iva').focus();
                    $('#lbl_condicion_iva').css('display', 'block');
                } else if (calle == '') {
                    $('#calle').focus();
                    $('#lbl_calle').css('display', 'block');
                } else if (numero == '') {
                    $('#numero').focus();
                    $('#lbl_numero').css('display', 'block');
                } else if (localidad == '') {
                    $('#localidad').focus();
                    $('#lbl_localidad').css('display', 'block');
                } else if (provincia == '') {
                    $('#provincia').focus();
                    $('#lbl_provincia').css('display', 'block');
                } else if (pais == '') {
                    $('#pais').focus();
                    $('#lbl_pais').css('display', 'block');
                } else if (responsable_comercial == '') {
                    $('#responsable_comercial').focus();
                    $('#lbl_responsable_comercial').css('display', 'block');
                } else if (celular == '') {
                    $('#celular').focus();
                    $('#lbl_celular').css('display', 'block');
                } else {
                    // Verificar si ya existe un proveedor con los mismos datos
                    $.get('../app/controllers/proveedores/verificar.php', {
                        nombre_proveedor: nombre_proveedor,
                        empresa: empresa,
                        cuit: cuit
                    }, function(response) {
                        var datos = JSON.parse(response);
                        if (datos.status === 'error') {
                            alert(datos.message);
                        } else {
                            // Si no hay conflictos, proceder con la creación del proveedor
                            var url = "../app/controllers/proveedores/create.php";
                            $.get(url, {
                                nombre_proveedor: nombre_proveedor,
                                telefono: telefono,
                                empresa: empresa,
                                email: email,
                                cuit: cuit,
                                condicion_iva: condicion_iva,
                                calle: calle,
                                numero: numero,
                                piso: piso,
                                depto: depto,
                                localidad: localidad,
                                provincia: provincia,
                                pais: pais,
                                responsable_comercial: responsable_comercial,
                                celular: celular
                            }, function(datos) {
                                $('#respuesta').html(datos);
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
