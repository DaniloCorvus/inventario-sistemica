document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableServices = await $('#dataTableServices').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/equipos/servicios/" + equipo,

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'user.identificacion',
                name: 'user.identificacion'
            },
            {
                data: 'cliente.identificacion',
                name: 'cliente.identificacion'
            },
            {
                data: 'razon.nombre',
                name: 'razon.nombre'
            },
            {
                data: 'estado.nombre',
                name: 'estado.nombre'
            },
            {
                data: 'equipo.serie',
                name: 'equipo.serie'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
        ],

        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": " Registros _MENU_ ",
            "sSearch": "Buscar:",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }
    });
})
