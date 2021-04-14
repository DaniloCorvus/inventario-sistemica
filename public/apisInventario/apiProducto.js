let btnSaveProducto = document.getElementById("btnSaveProducto");

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableProductox = await $('#dataTableProductox').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/productox/",

        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },

        {
            data: 'num_parte',
            name: 'num_parte'
        },
        {
            data: 'modelo',
            name: 'modelo'
        },
        {
            data: 'cod_interno',
            name: 'cod_interno'
        },
        {
            data: 'descripcion',
            name: 'descripcion'
        },
        {
            data: 'estado',
            name: 'estado'
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

async function cambiarEstado(id,estado) {

    let form = new FormData();
    form.append('id',id)
    form.append('estado',estado)
    const register = await axios.post('/productox/estado', form).then(res => {
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

const refresh = async (success) => {
    await dataTableProductox.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}
