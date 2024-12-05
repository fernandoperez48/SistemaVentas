<?php

class Reporte
{
    public static function render()
    {
        ob_start(); // Iniciar el buffer de salida
?>

        <script>
            $(function() {
                $("#example1").DataTable({
                    /* cambio de idiomas de datatable */
                    "pageLength": 5,
                    language: {
                        "emptyTable": "No hay información",
                        "decimal": "",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Proveedores",
                        "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Proveedores",
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
                            text: 'Exportar',
                            orientation: 'landscape',
                            buttons: [{
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':not(.actions):not(:nth-child(1))'
                                }
                            }, {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':not(.actions)'
                                }
                            }, {
                                text: 'Imprimir',
                                extend: 'print',
                                exportOptions: {
                                    columns: ':not(.actions)'
                                }
                            }]
                        },
                        {
                            extend: 'colvis',
                            text: 'Visor de columnas'


                        }
                    ],
                    // "columnDefs": [{
                    //     "targets": -1,
                    //     "className": "no-export",
                    //     "searchable": false
                    // }]

                    /*Fin de ajuste de botones*/
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
        <!-- FIN SCRIPTSSS DE LA TABLA-->
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
