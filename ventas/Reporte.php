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
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Compras",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Compras)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Compras",
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
                    "order": [
                        [0, "desc"]
                    ], // Cambia '0' por el índice de la columna de fecha
                    "buttons": /* Ajuste de botones */ [{
                            extend: 'collection',
                            text: 'Reportes',
                            orientation: 'landscape',
                            buttons: [{
                                text: 'Copiar',
                                extend: 'copy'
                            }, {
                                extend: 'pdf',
                            }, {
                                extend: 'csv',
                            }, {
                                extend: 'excel',
                            }, {
                                text: 'Imprimir',
                                extend: 'print',
                                exportOptions: {
                                    columns: ':not(:nth-child(3)):not(:nth-child(4)):not(:nth-child(6)):not(:nth-child(7))' // Excluir 3ra, 4ta y 6ta columna
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
