<?php

class ModalViewPer
{
    public static function render($id_cliente, $clientesper_datos)
    {
        ob_start(); // Iniciar el buffer de salida
?>
        <!-- modal para ver clientes-->
        <div class="modal fade" id="modal-ver<?php echo $id_cliente; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#088da5; color:white">
                        <h4 class="modal-title">Datos del cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php { ?>
                        <div class="modal-body">

                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre y Apellido</label>
                                        <input type="text" value="<?php echo $clientesper_datos['nombre'] . ' ' . $clientesper_datos['apellido']; ?>" class="form-control text-center" disabled>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DNI</label>
                                        <input type="text" value="<?php echo $clientesper_datos['dni']; ?>" class="form-control text-center" disabled>
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="number" class="form-control text-center" value="<?php echo $clientesper_datos['telefono']; ?>" disabled>
                                    </div>
                                </div>
                            </div>


                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['email']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Condición frente al IVA</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['nombre_iva'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label></label>
                                        <input type="hidden" class="form-control text-center" value="<?php echo $clientesper_datos['email']; ?>" disabled>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <h5>Datos Domicilio</h5>

                            <div class="row justify-content-between">
                                <div class=" col-md-4">
                                    <div class="form-group">
                                        <label>Calle</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['calle']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nro</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['numero']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Piso </label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['piso']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Depto</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['depto']; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Localidad </label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['ciudad']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Provincia</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['provincia']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pais </label>
                                        <input type="text" class="form-control text-center" value="<?php echo $clientesper_datos['pais']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            <?php } ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
