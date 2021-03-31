let btnSaveTipo = document.getElementById("btnSaveTipo");
let btnUpdateTipo = document.getElementById("btnUpdateTipo");

let formTipoRegister = document.getElementById('formTipoRegister');
formTipoRegister.addEventListener('submit', ajaxFormRegisterTipos);

let formTipoUpdate = document.getElementById('formTipoUpdate');
formTipoUpdate.addEventListener('submit', ajaxFormUpdateTipo);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableTipos = await $('#dataTableTipos').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/tipos/",

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
async function ajaxFormRegisterTipos(event) {
    event.preventDefault();

    btnSaveTipo.value = "Enviando...";
    btnSaveTipo.disabled = true

    const bodyRegister = new FormData(formTipoRegister)
    const register = await axios.post(formTipoRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formTipoRegister').trigger("reset");
        $('#modalTipoRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formTipoRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveTipo").value = "Enviar";
    btnSaveTipo.disabled = false
}

// Traer datos 

async function editarTipo(ente_id) {

    const url = SITEURL + '/tipos/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formTipoUpdate.id.value = edit.data.id;
            formTipoUpdate.nombre.value = edit.data.nombre;
            formTipoUpdate.descripcion.value = edit.data.descripcion;
            $('#modalTipoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateTipo(event) {
    event.preventDefault();

    btnUpdateTipo.value = "Enviando..."
    btnUpdateTipo.disabled = true

    const dataUpdate = new FormData(formTipoUpdate);
    const update = await axios.post(formTipoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formTipoUpdate').trigger("reset");
        $('#modalTipoUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formTipoUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateTipo").value = "Enviar";
    btnUpdateTipo.disabled = false
}



// Eliminar Tipo
function eliminarTipo(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/tipos/' + ente_id
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
    await dataTableTipos.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}