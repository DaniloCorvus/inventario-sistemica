
document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableInventario = await $('#dataTableInventario').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,
     /*
          <th>Cantidad</th>
                            <th>costo_in</th>
                            <th>impuesto</th>
                            <th>costo_total</th>
                            <th>costo_venta</th>
                            <th>guia:</th>
                            <th>created_at</th>
                             */
        ajax: SITEURL + "/cargue-inventario/"+document.getElementById('inventario_id').value,
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'cantidad',
            name: 'cantidad'
        },
        {
            data: 'costo_in',
            name: 'costo_in'
        },
        {
            data: 'impuesto',
            name: 'impuesto'
        }, 
        {
            data: 'costo_total',
            name: 'costo_total'
        },
        {
            data: 'costo_venta',
            name: 'costo_venta'
        },
        {
            data: 'guia',
            name: 'guia'
        },
        {
            data: 'created_at',
            name: 'created_at'
        },
      
        {
            data: 'cambiarEstado',
            name: 'cambiarEstado',
            orderable: false,
            searchable: false
        },
      /*   {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }, */


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

    
})

// Traer datos de cliente

async function editarProducto(ente_id) {
    window.location = '/productox/' + ente_id + '/edit';
}

async function cambiarEstado(id,estado) {

  let form = new FormData();
  form.append('cargue_inventario_id',id)
  form.append('estado',estado)
  const register = await axios.post('/cargue-inventario/estado', form).then(res => {
   /*  refresh(res['data'])
    $('#formProductoRegister').trigger("reset");
    $('#modalProductoRegister').modal('hide'); */

}).catch((error) => {
  /*   if (error.response.data.errors) {
        for (var clave in error.response.data.errors) {
            console.log(clave);
            let container = formProductoRegister.elements.namedItem(clave);
            container.classList.add('is-invalid');
            toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
        }
        console.error(error.response.data);
    } */
})
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