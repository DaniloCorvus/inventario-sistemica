let btnSaveMessage = document.getElementById("btnSaveMessage");
let btnUpdateMessage = document.getElementById("btnUpdateMessage");

let formMessageRegister = document.getElementById('formMessageRegister');
formMessageRegister.addEventListener('submit', ajaxFormRegisterMessages);

let formMessageUpdate = document.getElementById('formMessageUpdate');
formMessageUpdate.addEventListener('submit', ajaxFormUpdateMessage);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableMessages = await $('#dataTableMessages').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/messages/",

        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'body',
            name: 'body'
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
async function ajaxFormRegisterMessages(event) {
    event.preventDefault();

    btnSaveMessage.value = "Enviando...";
    btnSaveMessage.disabled = true

    const bodyRegister = new FormData(formMessageRegister)
    const register = await axios.post(formMessageRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formMessageRegister').trigger("reset");
        $('#modalMessageRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formMessageRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveMessage").value = "Enviar";
    btnSaveMessage.disabled = false
}

// Traer datos de cliente

async function editarMessage(ente_id) {

    const url = SITEURL + '/messages/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formMessageUpdate.id.value = edit.data.id;
            formMessageUpdate.body.value = edit.data.body;
            formMessageUpdate.descripcion.value = edit.data.descripcion;
            $('#modalMessageUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateMessage(event) {
    event.preventDefault();

    btnUpdateMessage.value = "Enviando..."
    btnUpdateMessage.disabled = true

    const dataUpdate = new FormData(formMessageUpdate);
    const update = await axios.post(formMessageUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formMessageUpdate').trigger("reset");
        $('#modalMessageUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formMessageUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateMessage").value = "Enviar";
    btnUpdateMessage.disabled = false
}


// Eliminar Message
function eliminarMessage(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/messages/' + ente_id
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
    await dataTableMessages.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}