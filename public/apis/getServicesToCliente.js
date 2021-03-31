document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableServices = await $('#dataTableServices').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/clientes/servicios/" + cliente,

        columns: [
            {
                data: 'service',
                name: 'service'
            },
            {
                data: 'radicado',
                name: 'radicado',
            },
            {
                data: 'razon.nombre',
                name: 'razon.nombre',
            },
            {
                data: 'created_at',
                name: 'created_at',

            },

            {
                data: 'users',
                render: function (data) {
                    let tec = data.map(tecnico => {
                        return `<ul><li>${tecnico.name}</li></ul>`
                    });
                    return tec
                },
            },

            {
                data: 'equipo.modelo',
                name: 'equipo.modelo',

            },
            {
                data: 'equipo.marca.nombre',
                name: 'equipo.marca.nombre',
            },
            {
                data: 'equipo.serie',
                name: 'equipo.serie',

            },

            {
                data: 'cliente.fullname',
                name: 'cliente.fullname',
                orderable: false,
            },

            {
                data: 'cliente.identificacion',
                name: 'cliente.identificacion',

            },

            {
                data: 'cliente.direccion',
                name: 'cliente.direccion',

            },
            {
                data: 'estado.nombre',
                name: 'estado.nombre',
            },
            {
                data: 'tipo.nombre',
                name: 'tipo.nombre',
            },
            {
                data: 'fecha_finalizado',
                name: 'fecha_finalizado',

            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
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
        },

        order: [
            [0, 'desc']
        ],


    })
})
