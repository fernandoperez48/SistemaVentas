<?php

class Reporte
{
    public static function render($id_envio, $envios_datos)
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
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
