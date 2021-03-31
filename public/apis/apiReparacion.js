let btnSaveReparacion = document.getElementById("btnSaveReparacion");
let btnUpdateReparacion = document.getElementById("btnUpdateReparacion");

let formReparacionRegister = document.getElementById('formReparacionRegister');
formReparacionRegister.addEventListener('submit', ajaxFormRegisterReparacions);

let formReparacionUpdate = document.getElementById('formReparacionUpdate');
formReparacionUpdate.addEventListener('submit', ajaxFormUpdateReparacion);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableReparacions = await $('#dataTableReparacions').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/tiporeparacions/",

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
async function ajaxFormRegisterReparacions(event) {
    event.preventDefault();

    btnSaveReparacion.value = "Enviando...";
    btnSaveReparacion.disabled = true

    const bodyRegister = new FormData(formReparacionRegister)
    const register = await axios.post(formReparacionRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formReparacionRegister').trigger("reset");
        $('#modalReparacionRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formReparacionRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveReparacion").value = "Enviar";
    btnSaveReparacion.disabled = false
}

// Traer datos de cliente

async function editarReparacion(ente_id) {

    const url = SITEURL + '/tiporeparacions/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formReparacionUpdate.id.value = edit.data.id;
            formReparacionUpdate.nombre.value = edit.data.nombre;
            formReparacionUpdate.descripcion.value = edit.data.descripcion;
            $('#modalReparacionUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateReparacion(event) {
    event.preventDefault();

    btnUpdateReparacion.value = "Enviando..."
    btnUpdateReparacion.disabled = true

    const dataUpdate = new FormData(formReparacionUpdate);
    const update = await axios.post(formReparacionUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formReparacionUpdate').trigger("reset");
        $('#modalReparacionUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formReparacionUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateReparacion").value = "Enviar";
    btnUpdateReparacion.disabled = false
}



// Eliminar Reparacion
function eliminarReparacion(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/tiporeparacions/' + ente_id
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
    await dataTableReparacions.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}