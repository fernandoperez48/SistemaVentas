<?php

class ModalViewEmp
{
    public static function render($id_cliente, $clientesemp_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <!-- modal para ver clientes-->
        <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#088da5; color:white">
                        <h4 class="modal-title">Datos de la empresa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-between">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" value="<?php echo $clientesemp_datos['nombre']; ?>" class="form-control text-center" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Razon Social</label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['razon_social']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> CUIT</label>
                                    <input type="text" value="<?php echo $clientesemp_datos['cuit']; ?>" class="form-control text-center" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input type="number" class="form-control text-center" value="<?php echo $clientesemp_datos['telefono']; ?>" disabled>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['email']; ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Persona Autorizada</label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['persona_autorizada']; ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5>Datos Domicilio</h5>

                        <div class="row justify-content-between">
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label>Calle</label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['calle']; ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Nro</label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['numero']; ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Piso </label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['piso']; ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Depto</label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['depto']; ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Localidad </label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['ciudad']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provincia</label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['provincia']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pais </label>
                                    <input type="text" class="form-control text-center" value="<?php echo $clientesemp_datos['pais']; ?>" disabled>
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
