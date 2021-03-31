let btnUpdateService = document.getElementById("btnUpdateService");

let formServiceUpdate = document.getElementById('formServiceUpdate');
formServiceUpdate.addEventListener('submit', ajaxFormUpdateService);

//Envio de datos ajax a actualizar
async function ajaxFormUpdateService(event) {
    event.preventDefault();

    btnUpdateService.value = "Enviando..."
    btnUpdateService.disabled = true

    const dataUpdate = new FormData(formServiceUpdate);
    const update = await axios.post(formServiceUpdate.action, dataUpdate).then(async res => {
        await refresh(res.data)
        $('#formServiceUpdate').trigger("reset");
        $('#modalServiceUpdate').modal('hide');
        location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formServiceUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateService").value = "Enviar";
    btnUpdateService.disabled = false
}
