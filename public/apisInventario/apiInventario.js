let btnSaveProducto = document.getElementById("btnSaveProducto");

document.addEventListener('DOMContentLoaded', async function () {
   
    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableInventario = await $('#dataTableInventario').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/inventario/",

        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'cod_interno',
            name: 'cod_interno'
        },
        {
            data: 'num_parte',
            name: 'num_parte'
        },
        {
            data: 'cellar',
            name: 'cellar'
        }, 
        {
            data: 'modelo',
            name: 'modelo'
        },
        {
            data: 'serie',
            name: 'serie'
        },
        {
            data: 'costo_venta',
            name: 'costo_venta'
        },
        {
            data: 'cantidad_disponible',
            name: 'cantidad_disponible'
        },
      
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },


        {

            data: 'codigo',
            render: function (data, row, another) {
                return `<img src="data:image/png;base64,${data}" alt="">`
            },
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
    });

    l
})

// Traer datos de cliente

async function editarProducto(ente_id) {
    window.location = '/productox/' + ente_id + '/edit';
}


// Eliminar Producto
function eliminarProducto(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/productox/' + ente_id
                try {
                    const success = await axios.delete(url);
                    console.log(success);
                    refresh(success.data)
                } catch (error) {
                    toastr.remove()
                    console.error(error);
                }
            }
            else {
                toastr.remove()
            }
        }
    });
}


const refresh = async (success) => {
    await dataTableProductox.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}