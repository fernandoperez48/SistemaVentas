<?php
include '../app/config.php';
include '../layaout/sesion.php';
if ($rol_sesion == "EyD") {
    header('Location: ..//index.php');
}
include '../layaout/parte1.php';
include '../app/controllers/categorias/listado_de_categorias.php';
include_once 'ModalDeleteCat.php';
include_once 'ModalUpdateCat.php';


?>

<div class="content-wrapper" style="background-color:gray">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Categorias

                        <button <?php if ($rol_sesion != "Administrador" && $id_usuarios_sesion != "4") echo 'disabled'; ?> type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i>
                            Agregar Nuevo
                        </button>

                    </h1>


                </div><!-- /.col -->

            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-danger">
                        <div class="card-header" style="background-color:orange">
                            <h3 class="card-title">Categorias registradas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombre de la Categoria</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($categorias_datos as $categorias_dato) {
                                        $id_categoria = $categorias_dato['id_categoria'];
                                        $nombre_categoria = $categorias_dato['nombre_categoria']; ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador = $contador + 1; ?></center>
                                            </td>
                                            <td><?php echo $categorias_dato['nombre_categoria']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <button <?php if ($rol_sesion != "Administrador" && $rol_sesion != "Almacen") echo 'disabled'; ?> type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-update<?php echo $id_categoria; ?>">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            Editar
                                                        </button>
                                                        <!-- modal para actualizar clientes personas-->
                                                        <?php echo ModalUpdateCat::render($id_categoria, $nombre_categoria); ?>
                                                        <div id="respuesta_update<?php echo $id_categoria; ?>"></div>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button <?php if ($rol_sesion != "Administrador" && $rol_sesion != "Almacen") echo 'disabled'; ?> type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-delete<?php echo $id_categoria; ?>">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            Eliminar
                                                        </button>
                                                        <!-- modal para eliminar clientes personas-->
                                                        <?php echo ModalDeleteCat::render($id_categoria, $nombre_categoria, $URL); ?>
                                                        <div id="respuesta_update<?php echo $id_categoria; ?>"></div>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                            </>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!--  FIN DE WRAAPPER DE PARTE1.PHP -->


<?php include '../layaout/mensajes.php'; ?>
<?php include '../layaout/parte2.php'; ?>

<script>
    $(function() {
        $("#example1").DataTable({
            /* cambio de idiomas de datatable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorias",
                "infoEmpty": "Mostrando 0 to 0 of 0 Categorias",
                "infoFiltered": "(Filtrado de _MAX_ total Categorias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Categorias",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            /* fin de idiomas */
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": /* Ajuste de botones */ [{
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    }, {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye la última columna
                        }
                    }, {
                        extend: 'csv',
                    }, {
                        extend: 'excel',
                    }, {
                        text: 'Imprimir',
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluye la última columna
                        }
                    }]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

<!-- modal para registrar categorias-->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:orange; color:white">
                <h4 class="modal-title">Creacion de una nueva categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nombre de la categoria <b>*</b></label>
                            <input type="text" id="nombre_categoria" class="form-control">
                            <small style="color:red; display:none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $('#btn_create').click(function() {
        var nombre_categoria = $('#nombre_categoria').val();

        if (nombre_categoria == '') {
            $('#nombre_categoria').focus();
            $('#lbl_create').css('display', 'block');
        } else {
            var url = "../app/controllers/categorias/registro_de_categorias.php";
            $.get(url, {
                nombre_categoria: nombre_categoria
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }


    });
</script>
<div id="respuesta"></div>