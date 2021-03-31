//Envio de datos ajax
async function ajaxFormRegisterModels(event) {
    event.preventDefault();

    btnSaveModel.value = "Enviando...";
    btnSaveModel.disabled = true

    const bodyRegister = new FormData(formModelRegister)
    const register = await axios.post(formModelRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formModelRegister').trigger("reset");
        $('#modalModelRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formModelRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveModel").value = "Enviar";
    btnSaveModel.disabled = false
}

// Traer datos de cliente

async function editarModel(ente_id) {

    const url = SITEURL + '/ruta/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formModelUpdate.id.value = edit.data.id;
            formModelUpdate.nombre.value = edit.data.nombre;
            formModelUpdate.descripcion.value = edit.data.descripcion;
            $('#modalModelUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateModel(event) {
    event.preventDefault();

    btnUpdateModel.value = "Enviando..."
    btnUpdateModel.disabled = true

    const dataUpdate = new FormData(formModelUpdate);
    const update = await axios.post(formModelUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formModelUpdate').trigger("reset");
        $('#modalModelUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formModelUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateModel").value = "Enviar";
    btnUpdateModel.disabled = false
}



// Eliminar Model
function eliminarModel(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/ruta/' + ente_id
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
    await dataTableModels.draw();
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
