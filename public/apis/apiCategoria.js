let btnSaveCategoria = document.getElementById("btnSaveCategoria");
let btnUpdateCategoria = document.getElementById("btnUpdateCategoria");

let formCategoriaRegister = document.getElementById('formCategoriaRegister');
formCategoriaRegister.addEventListener('submit', ajaxFormRegisterCategorias);

let formCategoriaUpdate = document.getElementById('formCategoriaUpdate');
formCategoriaUpdate.addEventListener('submit', ajaxFormUpdateCategoria);

document.addEventListener('DOMContentLoaded', async function () {
    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableCategorias = await $('#dataTableCategorias').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        retrieve: true,

        ajax: `/categorias`,

        columns: [
            {
                data: 'nombre',
                name: 'nombre',
                orderable: false,
                searchable: false
            },
            {
                data: 'descripcion',
                name: 'descripcion',
                orderable: false,
                searchable: false
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
    })
})


async function ajaxFormRegisterCategorias(event) {
    event.preventDefault();

    btnSaveCategoria.value = "Enviando...";
    btnSaveCategoria.disabled = true

    const bodyRegister = new FormData(formCategoriaRegister)
    const register = await axios.post(formCategoriaRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formCategoriaRegister').trigger("reset");
        $('#modalCategoriaRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formCategoriaRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveCategoria").value = "Enviar";
    btnSaveCategoria.disabled = false
}

// Traer datos de cliente

async function editarCategoria(ente_id) {

    const url = SITEURL + '/categorias/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formCategoriaUpdate.id.value = edit.data.id;
            formCategoriaUpdate.nombre.value = edit.data.nombre;
            formCategoriaUpdate.descripcion.value = edit.data.descripcion;
            $('#modalCategoriaUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateCategoria(event) {
    event.preventDefault();

    btnUpdateCategoria.value = "Enviando..."
    btnUpdateCategoria.disabled = true

    const dataUpdate = new FormData(formCategoriaUpdate);
    const update = await axios.post(formCategoriaUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formCategoriaUpdate').trigger("reset");
        $('#modalCategoriaUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formCategoriaUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateCategoria").value = "Enviar";
    btnUpdateCategoria.disabled = false
}



// Eliminar Categoria
function eliminarCategoria(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/categorias/' + ente_id
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
    await dataTableCategorias.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}

const loadErrors = async (errors, form) => {

    Object.keys(errors).map(async (element) => {
        let container = await form.elements.namedItem(element);
        await container.classList.add('is-invalid');
        await toastr.error(`<li> ${errors[element]} </li>`);
    })
}
