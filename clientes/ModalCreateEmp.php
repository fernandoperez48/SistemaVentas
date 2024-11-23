<?php

class ModalCreateEmp
{
    public static function render()
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
                                    <input type="text" id="nombre_empresa" class="form-control" placeholder="Nombre de la empresa">
                                    <small style="color:red; display:none" id="lbl_nombre">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Razon Social<b>*</b></label>
                                    <input type="text" id="razon_social" class="form-control" placeholder="Razon social">
                                    <small style="color:red; display:none" id="lbl_razon_social">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="telefono" class="form-control" placeholder="Telefono">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="email" class="form-control" placeholder="Email">

                                    <small style="color:red; display:none" id="lbl_email_invalid">* El email no es válido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CUIT</label>
                                    <input type="text" id="cuit" class="form-control" placeholder="XX-XXXXXXXX-X">
                                    <small style="color:red; display:none" id="lbl_cuit_vacio">* El cuit es obligatorio</small>
                                    <small style="color:red; display:none" id="lbl_cuit_invalid">* El cuit no es valido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Persona Autorizada<b>*</b></label>
                                    <input type="text" id="responsable_comercial" class="form-control">
                                    <small style="color:red; display:none" id="lbl_responsable_comercial">* Este campo es requerido</small>
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
                var nombre_empresa = $('#nombre_empresa').val();
                var razon_social = $('#razon_social').val();
                var telefono = $('#telefono').val();
                var email = $('#email').val();
                var cuit = $('#cuit').val();
                var responsable_comercial = $('#responsable_comercial').val();
                var calle = $('#calle').val();
                var numero = $('#numero').val();
                var piso = $('#piso').val();
                var depto = $('#depto').val();
                var localidad = $('#localidad').val();
                var provincia = $('#provincia').val();
                var pais = $('#pais').val();

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

                if (nombre_empresa == '') {
                    $('#nombre_empresa').focus();
                    $('#lbl_nombre').css('display', 'block');
                } else if (razon_social == '') {
                    $('#razon_social').focus();
                    $('#lbl_razon_social').css('display', 'block');
                } else if (!validarEmail(email)) {
                    $('#email').focus();
                    $('#lbl_email_invalid').css('display', 'block');
                } else if (!validarCUIT(cuit)) {
                    $('#cuit').focus();
                    $('#lbl_cuit_invalid').css('display', 'block');
                } else if (cuit == '') {
                    $('#cuit').focus();
                    $('#lbl_cuit_vacio').css('display', 'block');
                } else if (responsable_comercial == '') {
                    $('#responsable_comercial').focus();
                    $('#lbl_responsable_comercial').css('display', 'block');

                } else {

                    var url = "../app/controllers/clientes/createemp.php";
                    $.get(url, {
                        nombre_empresa: nombre_empresa,
                        razon_social: razon_social,
                        telefono: telefono,
                        email: email,
                        cuit: cuit,
                        responsable_comercial: responsable_comercial,
                        calle: calle,
                        numero: numero,
                        piso: piso,
                        depto: depto,
                        localidad: localidad,
                        provincia: provincia,
                        pais: pais
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
