<?php

class ReporteDeCreate
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
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Producto",
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
                                extend: 'pdf',
                            }, {
                                extend: 'excel',
                            }, {
                                text: 'Imprimir',
                                extend: 'print'
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

            $(function() {
                $("#example2").DataTable({
                    /* cambio de idiomas de datatable */
                    "pageLength": 5,
                    language: {
                        "emptyTable": "No hay información",
                        "decimal": "",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Clientes",
                        "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Clientes",
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
                            }, {
                                extend: 'csv',
                            }, {
                                extend: 'excel',
                            }, {
                                text: 'Imprimir',
                                extend: 'print'
                            }]
                        },
                        {
                            extend: 'colvis',
                            text: 'Visor de columnas'
                        }
                    ],
                    /*Fin de ajuste de botones*/
                }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

            });



            $(function() {
                $("#example3").DataTable({
                    /* cambio de idiomas de datatable */
                    "pageLength": 5,
                    language: {
                        "emptyTable": "No hay información",
                        "decimal": "",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Clientes",
                        "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Clientes",
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
                            }, {
                                extend: 'csv',
                            }, {
                                extend: 'excel',
                            }, {
                                text: 'Imprimir',
                                extend: 'print'
                            }]
                        },
                        {
                            extend: 'colvis',
                            text: 'Visor de columnas'
                        }
                    ],
                    /*Fin de ajuste de botones*/
                }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

            });
        </script>
        <script>
            function allowOnlyNumbers(input) {
                input.value = input.value.replace(/[^0-9]/g, '');
            }

            document.getElementById('cantidad').addEventListener('input', function(e) {
                allowOnlyNumbers(e.target);
            });
        </script>
<?php
        return ob_get_clean(); // Devolver el contenido del buffer de salida
    }
}
