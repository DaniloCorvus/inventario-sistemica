let btnSaveRazon = document.getElementById("btnSaveRazon");
let btnUpdateRazon = document.getElementById("btnUpdateRazon");

let formRazonRegister = document.getElementById('formRazonRegister');
formRazonRegister.addEventListener('submit', ajaxFormRegisterRazons);

let formRazonUpdate = document.getElementById('formRazonUpdate');
formRazonUpdate.addEventListener('submit', ajaxFormUpdateRazon);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableRazons = await $('#dataTableRazons').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/razons/",

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
async function ajaxFormRegisterRazons(event) {
    event.preventDefault();

    btnSaveRazon.value = "Enviando...";
    btnSaveRazon.disabled = true

    const bodyRegister = new FormData(formRazonRegister)
    const register = await axios.post(formRazonRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formRazonRegister').trigger("reset");
        $('#modalRazonRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formRazonRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveRazon").value = "Enviar";
    btnSaveRazon.disabled = false
}

// Traer datos de cliente

async function editarRazon(ente_id) {

    const url = SITEURL + '/razons/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formRazonUpdate.id.value = edit.data.id;
            formRazonUpdate.nombre.value = edit.data.nombre;
            formRazonUpdate.descripcion.value = edit.data.descripcion;
            $('#modalRazonUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateRazon(event) {
    event.preventDefault();

    btnUpdateRazon.value = "Enviando..."
    btnUpdateRazon.disabled = true

    const dataUpdate = new FormData(formRazonUpdate);
    const update = await axios.post(formRazonUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formRazonUpdate').trigger("reset");
        $('#modalRazonUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formRazonUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateRazon").value = "Enviar";
    btnUpdateRazon.disabled = false
}


// Eliminar Razon
function eliminarRazon(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/razons/' + ente_id
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
    await dataTableRazons.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}