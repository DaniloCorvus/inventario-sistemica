let btnSaveProducto = document.getElementById("btnSaveProducto");
let btnUpdateProducto = document.getElementById("btnUpdateProducto");

let formProductoRegister = document.getElementById('formProductoRegister');
formProductoRegister.addEventListener('submit', ajaxFormRegisterProductos);

let formProductoUpdate = document.getElementById('formProductoUpdate');
formProductoUpdate.addEventListener('submit', ajaxFormUpdateProducto);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableProductos = await $('#dataTableProductos').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/productos/",

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'descripcion',
                name: 'descripcion'
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
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }
    });
})

//Envio de datos ajax
async function ajaxFormRegisterProductos(event) {
    event.preventDefault();

    btnSaveProducto.value = "Enviando...";
    btnSaveProducto.disabled = true

    const bodyRegister = new FormData(formProductoRegister)
    const register = await axios.post(formProductoRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formProductoRegister').trigger("reset");
        $('#modalProductoRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formProductoRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveProducto").value = "Enviar";
    btnSaveProducto.disabled = false
}

// Traer datos de cliente

async function editarProducto(ente_id) {

    const url = SITEURL + '/productos/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formProductoUpdate.id.value = edit.data.id;
            formProductoUpdate.nombre.value = edit.data.nombre;
            formProductoUpdate.descripcion.value = edit.data.descripcion;
            $('#modalProductoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateProducto(event) {
    event.preventDefault();

    btnUpdateProducto.value = "Enviando..."
    btnUpdateProducto.disabled = true

    const dataUpdate = new FormData(formProductoUpdate);
    const update = await axios.post(formProductoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formProductoUpdate').trigger("reset");
        $('#modalProductoUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formProductoUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateProducto").value = "Enviar";
    btnUpdateProducto.disabled = false
}



// Eliminar Producto
function eliminarProducto(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/productos/' + ente_id
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
    await dataTableProductos.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}