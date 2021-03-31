let btnSaveModo = document.getElementById("btnSaveModo");
let btnUpdateModo = document.getElementById("btnUpdateModo");

let formModoRegister = document.getElementById('formModoRegister');
formModoRegister.addEventListener('submit', ajaxFormRegisterModos);

let formModoUpdate = document.getElementById('formModoUpdate');
formModoUpdate.addEventListener('submit', ajaxFormUpdateModo);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableModos = await $('#dataTableModos').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/modos/",

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
async function ajaxFormRegisterModos(event) {
    event.preventDefault();

    btnSaveModo.value = "Enviando...";
    btnSaveModo.disabled = true

    const bodyRegister = new FormData(formModoRegister)
    const register = await axios.post(formModoRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formModoRegister').trigger("reset");
        $('#modalModoRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formModoRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveModo").value = "Enviar";
    btnSaveModo.disabled = false
}

// Traer datos de cliente

async function editarModo(ente_id) {

    const url = SITEURL + '/modos/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formModoUpdate.id.value = edit.data.id;
            formModoUpdate.nombre.value = edit.data.nombre;
            formModoUpdate.descripcion.value = edit.data.descripcion;
            $('#modalModoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateModo(event) {
    event.preventDefault();

    btnUpdateModo.value = "Enviando..."
    btnUpdateModo.disabled = true

    const dataUpdate = new FormData(formModoUpdate);
    const update = await axios.post(formModoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formModoUpdate').trigger("reset");
        $('#modalModoUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formModoUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateModo").value = "Enviar";
    btnUpdateModo.disabled = false
}



// Eliminar Modo
function eliminarModo(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/modos/' + ente_id
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
    await dataTableModos.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}