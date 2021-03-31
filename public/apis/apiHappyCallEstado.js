let btnSaveHappyCallEstado = document.getElementById("btnSaveHappyCallEstado");
let btnUpdateHappyCallEstado = document.getElementById("btnUpdateHappyCallEstado");

let formHappyCallEstadoRegister = document.getElementById('formHappyCallEstadoRegister');
formHappyCallEstadoRegister.addEventListener('submit', ajaxFormRegisterHappyCallEstados);

let formHappyCallEstadoUpdate = document.getElementById('formHappyCallEstadoUpdate');
formHappyCallEstadoUpdate.addEventListener('submit', ajaxFormUpdateHappyCallEstado);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableHappyCallEstados = await $('#dataTableHappyCallEstados').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/happycallestados/",

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
async function ajaxFormRegisterHappyCallEstados(event) {
    event.preventDefault();

    btnSaveHappyCallEstado.value = "Enviando...";
    btnSaveHappyCallEstado.disabled = true

    const bodyRegister = new FormData(formHappyCallEstadoRegister)
    const register = await axios.post(formHappyCallEstadoRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formHappyCallEstadoRegister').trigger("reset");
        $('#modalHappyCallEstadoRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formHappyCallEstadoRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveHappyCallEstado").value = "Enviar";
    btnSaveHappyCallEstado.disabled = false
}

// Traer datos de cliente

async function editarHappyCallEstado(ente_id) {

    const url = SITEURL + '/happycallestados/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formHappyCallEstadoUpdate.id.value = edit.data.id;
            formHappyCallEstadoUpdate.nombre.value = edit.data.nombre;
            formHappyCallEstadoUpdate.descripcion.value = edit.data.descripcion;
            $('#modalHappyCallEstadoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateHappyCallEstado(event) {
    event.preventDefault();

    btnUpdateHappyCallEstado.value = "Enviando..."
    btnUpdateHappyCallEstado.disabled = true

    const dataUpdate = new FormData(formHappyCallEstadoUpdate);
    const update = await axios.post(formHappyCallEstadoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formHappyCallEstadoUpdate').trigger("reset");
        $('#modalHappyCallEstadoUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formHappyCallEstadoUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateHappyCallEstado").value = "Enviar";
    btnUpdateHappyCallEstado.disabled = false
}



// Eliminar Estado
function eliminarHappyCallEstado(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/happycallestados/' + ente_id
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
    await dataTableHappyCallEstados.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}