let btnSaveMarca = document.getElementById("btnSaveMarca");
let btnUpdateMarca = document.getElementById("btnUpdateMarca");

let formMarcaRegister = document.getElementById('formMarcaRegister');
formMarcaRegister.addEventListener('submit', ajaxFormRegisterMarcas);

let formMarcaUpdate = document.getElementById('formMarcaUpdate');
formMarcaUpdate.addEventListener('submit', ajaxFormUpdateMarca);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableMarcas = await $('#dataTableMarcas').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/marcas/",

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
async function ajaxFormRegisterMarcas(event) {
    event.preventDefault();

    btnSaveMarca.value = "Enviando...";
    btnSaveMarca.disabled = true

    const bodyRegister = new FormData(formMarcaRegister)
    const register = await axios.post(formMarcaRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formMarcaRegister').trigger("reset");
        $('#modalMarcaRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formMarcaRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveMarca").value = "Enviar";
    btnSaveMarca.disabled = false
}

// Traer datos de cliente

async function editarMarca(ente_id) {

    const url = SITEURL + '/marcas/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formMarcaUpdate.id.value = edit.data.id;
            formMarcaUpdate.nombre.value = edit.data.nombre;
            formMarcaUpdate.descripcion.value = edit.data.descripcion;
            $('#modalMarcaUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateMarca(event) {
    event.preventDefault();

    btnUpdateMarca.value = "Enviando..."
    btnUpdateMarca.disabled = true

    const dataUpdate = new FormData(formMarcaUpdate);
    const update = await axios.post(formMarcaUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formMarcaUpdate').trigger("reset");
        $('#modalMarcaUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formMarcaUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateMarca").value = "Enviar";
    btnUpdateMarca.disabled = false
}



// Eliminar Marca
function eliminarMarca(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/marcas/' + ente_id
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
    await dataTableMarcas.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}