let btnSaveClausula = document.getElementById("btnSaveClausula");
let btnUpdateClausula = document.getElementById("btnUpdateClausula");

let formClausulaRegister = document.getElementById('formClausulaRegister');
formClausulaRegister.addEventListener('submit', ajaxFormRegisterClausulas);

let formClausulaUpdate = document.getElementById('formClausulaUpdate');
formClausulaUpdate.addEventListener('submit', ajaxFormUpdateClausula);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableClausulas = await $('#dataTableClausulas').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/clausulas/",

        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'marca.nombre',
            name: 'marca.nombre'
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
async function ajaxFormRegisterClausulas(event) {
    event.preventDefault();

    btnSaveClausula.value = "Enviando...";
    btnSaveClausula.disabled = true

    const bodyRegister = new FormData(formClausulaRegister)
    const register = await axios.post(formClausulaRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formClausulaRegister').trigger("reset");
        $('#modalClausulaRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formClausulaRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveClausula").value = "Enviar";
    btnSaveClausula.disabled = false
}

// Traer datos de cliente

async function editarClausula(ente_id) {

    const url = SITEURL + '/clausulas/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formClausulaUpdate.id.value = edit.data.id;
            formClausulaUpdate.nombre.value = edit.data.nombre;
            formClausulaUpdate.descripcion.value = edit.data.descripcion;
            $('#modalClausulaUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateClausula(event) {
    event.preventDefault();

    btnUpdateClausula.value = "Enviando..."
    btnUpdateClausula.disabled = true

    const dataUpdate = new FormData(formClausulaUpdate);
    const update = await axios.post(formClausulaUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formClausulaUpdate').trigger("reset");
        $('#modalClausulaUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formClausulaUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateClausula").value = "Enviar";
    btnUpdateClausula.disabled = false
}



// Eliminar Clausula
function eliminarClausula(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/clausulas/' + ente_id
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
    await dataTableClausulas.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}