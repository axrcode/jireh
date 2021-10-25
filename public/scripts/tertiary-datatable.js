$(function () {
    $('#tertiary').DataTable({
        "paging": false,
        "pageLength": 10,
        "pagingType": "simple",
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "aaSorting": [],
        "info": true,
        "autoWidth": false,
        "responsive": {
            details: {
				display: $.fn.dataTable.Responsive.display.childRowImmediate,
				type: 'none',
				target: ''
			}
        },
        "language": {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "",
            "infoEmpty": "",
            "infoFiltered": "(Filtrado de _MAX_ resultados en total)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Resultados",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
});
