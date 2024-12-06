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
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':not(:nth-child(4)):not(:nth-child(5)):not(:nth-child(7)):not(:nth-child(8))' // Excluir 4ta, 5ta, 7ma y 8va columna
                                }
                            }, {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':not(:nth-child(4)):not(:nth-child(5)):not(:nth-child(7)):not(:nth-child(8))' // Excluir 4ta, 5ta, 7ma y 8va columna
                                }
                            }, {
                                text: 'Imprimir',
                                extend: 'print',
                                exportOptions: {
                                    columns: ':not(:nth-child(4)):not(:nth-child(5)):not(:nth-child(7)):not(:nth-child(8))' // Excluir 4ta, 5ta, 7ma y 8va columna
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
