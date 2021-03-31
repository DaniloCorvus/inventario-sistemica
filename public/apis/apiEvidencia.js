const formEvidenciaRegister = document.getElementById('formEvidenciaRegister');
formEvidenciaRegister.addEventListener('submit', ajaxFormRegisterEvidencias);

//Envio de datos ajax
async function ajaxFormRegisterEvidencias(event) {
    event.preventDefault();

    btnSaveEvidencia.value = "Enviando...";
    btnSaveEvidencia.disabled = true

    const bodyRegister = new FormData(formEvidenciaRegister)
    const register = await axios.post(formEvidenciaRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formEvidenciaRegister').trigger("reset");
        $('#modalEvidenciaRegister').modal('hide');
        evidenciaCharge();
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formEvidenciaRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveEvidencia").value = "Enviar";
    btnSaveEvidencia.disabled = false
}



// Eliminar Evidencia
function eliminarEvidencia(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/evidencias/' + ente_id
                try {
                    const success = await axios.delete(url);
                    console.log(success);
                    refresh(success.data)
                    evidenciaCharge();
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
