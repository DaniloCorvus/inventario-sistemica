let btnSaveEstado = document.getElementById("btnSaveEstado");
let btnUpdateEstado = document.getElementById("btnUpdateEstado");

let formEstadoRegister = document.getElementById('formEstadoRegister');
formEstadoRegister.addEventListener('submit', ajaxFormRegisterEstados);

let formEstadoUpdate = document.getElementById('formEstadoUpdate');
formEstadoUpdate.addEventListener('submit', ajaxFormUpdateEstado);

document.addEventListener('DOMContentLoaded', async () => {

    // datatables settings

    $.fn.dataTable.ext.errMode = 'none';
    dataTableEstados = await $('#dataTableEstados').DataTable({
        retrieve: true,
        processing: true,
        stateSave: true,
        serverSide: true,

        ajax: SITEURL + "/estados/",

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
//Envio de datos ajax
async function ajaxFormRegisterEstados(event) {
    event.preventDefault();

    btnSaveEstado.value = "Enviando...";
    btnSaveEstado.disabled = true

    const bodyRegister = new FormData(formEstadoRegister)
    const register = await axios.post(formEstadoRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formEstadoRegister').trigger("reset");
        $('#modalEstadoRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formEstadoRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveEstado").value = "Enviar";
    btnSaveEstado.disabled = false
}

// Traer datos de cliente

async function editarEstado(ente_id) {

    const url = SITEURL + '/estados/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formEstadoUpdate.id.value = edit.data.id;
            formEstadoUpdate.nombre.value = edit.data.nombre;
            formEstadoUpdate.descripcion.value = edit.data.descripcion;
            $('#modalEstadoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateEstado(event) {
    event.preventDefault();

    btnUpdateEstado.value = "Enviando..."
    btnUpdateEstado.disabled = true

    const dataUpdate = new FormData(formEstadoUpdate);
    const update = await axios.post(formEstadoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formEstadoUpdate').trigger("reset");
        $('#modalEstadoUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formEstadoUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateEstado").value = "Enviar";
    btnUpdateEstado.disabled = false
}



// Eliminar Estado
function eliminarEstado(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/estados/' + ente_id
                try {
                    const success = await axios.delete(url);
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
    await dataTableEstados.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}