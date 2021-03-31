document.addEventListener('DOMContentLoaded', async function () {
    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableAccesorios = await $('#dataTableAccesorios').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        retrieve: true,

        ajax: `/accesorios/${service.id}`,

        columns: [
            {
                data: 'fecha_solicitud',
                name: 'fecha_solicitud',
                orderable: false,
                searchable: false
            },
            {
                data: 'fecha_recibido',
                name: 'fecha_recibido',
                orderable: false,
                searchable: false
            },
            {
                data: 'num_pedido',
                name: 'num_pedido',
                orderable: false,
                searchable: false
            },
            {
                data: 'num_parte',
                name: 'num_parte'
            },
            {
                data: 'delivery_orden',
                name: 'delivery_orden'
            },
            {
                data: 'cod_interno',
                name: 'cod_interno',
                orderable: false,
                searchable: false
            },
            {
                data: 'num_factura',
                name: 'num_factura'
            },
            {
                data: 'valor_before_iva',
                name: 'valor_before_iva',
                orderable: false,
                searchable: false
            },
            {
              
                data: 'cantidad',
                render: function (data, row, another) {
                   return another.cantidad[0].cantidad
                },

           
                orderable: false,
                searchable: false
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
        }
    })
})