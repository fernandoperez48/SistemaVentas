<?php

class ModalVerClientes
{
    public static function render($id_cliente, $nombreApellido, $venta)
    {
        ob_start(); // Iniciar el buffer de salida
?>
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
                                        <input type="text" value="<?php echo $nombreApellido ?>" class="form-control text-center" disabled>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php if (!empty($venta['cuit'])) : ?>
                                            <label>CUIT</label>
                                        <?php else : ?>
                                            <label>DNI</label>
                                        <?php endif; ?>
                                        <input type="text" value="<?php echo $venta['cuitDni'] ?>" class="form-control text-center" disabled>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="number" class="form-control text-center" value="<?php echo $venta['telefono'] ?>" disabled>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['email']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php if (!empty($venta['cuit'])) { ?>
                                            <label>Persona Autorizada</label>
                                            <input type="text" class="form-control text-center" value="<?php echo $venta['persona_autorizada']; ?>" disabled>
                                        <?php } else { ?>
                                            <!-- Adding an empty div to maintain structure -->
                                            <div style="visibility: hidden;">
                                                <label>Hidden Label</label>
                                                <input type="text" class="form-control text-center" value="" disabled>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <h5>Datos Domicilio</h5>

                            <div class="row justify-content-between">
                                <div class=" col-md-4">
                                    <div class="form-group">
                                        <label>Calle</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['calle']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nro</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['numero']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Piso </label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['piso']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Depto</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['depto']; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Localidad </label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['ciudad']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Provincia</label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['provincia']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pais </label>
                                        <input type="text" class="form-control text-center" value="<?php echo $venta['pais']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            <?php } ?>
            </div>
            <!-- /.modal-content -->
        </div>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
