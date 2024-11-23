<?php

class ModalVerProv
{
    public static function render($id_proveedor, $nombre_proveedor, $proveedores_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <!-- modal para ver proveedores-->
        <div class="modal fade" id="modal-ver<?php echo $id_proveedor; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#088da5; color:white">
                        <h4 class="modal-title">Datos del proveedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre del proveedor <b>*</b></label>
                                    <input type="text" id="nombre<?php echo $id_proveedor; ?>" value="<?php echo $nombre_proveedor; ?>" class="form-control" disabled>
                                    <small style="color:red; display:none" id="lbl_nombre<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Celular <b>*</b></label>
                                    <input type="number" id="celu<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['celular']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_celular<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" id="tel<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['telefono']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CUIT <b>*</b></label>
                                    <input type="text" id="cui<?php echo $id_proveedor; ?>" value="<?php echo $proveedores_datos['cuit']; ?>" class="form-control" disabled>
                                    <small style="color:red; display:none" id="lbl_cuit<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Condición IVA <b>*</b></label>
                                    <input type="text" id="iv<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['iva']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_iva<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Comercial </label>
                                    <input type="text" id="com<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['responsable_comercial']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Empresa<b>*</b></label>
                                    <input type="texto" id="emp<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['empresa']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_empresa<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="email" id="ema<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['email']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pais<b>*</b></label>
                                    <input type="text" id="pai<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['pais']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_pais<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provincia<b>*</b></label>
                                    <input type="text" id="prov<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['provincia']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_provincia<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Localidad </label>
                                    <input type="text" id="loc<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['ciudad']; ?>" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Domicilio<b>*</b></label>
                                    <input type="text" id="dom<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['calle']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_domicilio<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nro<b>*</b></label>
                                    <input type="text" id="num<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['numero']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_numero<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Piso </label>
                                    <input type="text" id="pis<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['piso']; ?>" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Depto<b>*</b></label>
                                    <input type="text" id="dpto<?php echo $id_proveedor; ?>" class="form-control" value="<?php echo $proveedores_datos['depto']; ?>" disabled>
                                    <small style="color:red; display:none" id="lbl_depto<?php echo $id_proveedor; ?>">* Este campo es requerido</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
