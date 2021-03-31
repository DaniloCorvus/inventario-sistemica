var SITEURL = document.location.origin;

document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings Documentos
    dtDocumento = $('#dataTableHistorialRE').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        dataType: 'jsonp',

        ajax: SITEURL + "/historialEjecutado/" + document.getElementById('recomendacion_id').value,

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'fecha',
                name: 'fecha'
            },
            {
                data: 'km_actual',
                name: 'km_actual'
            },

            {
                data: 'observacion',
                name: 'observacion'
            }
        ],
        order: [
            [0, 'desc']
        ]

    });

});
