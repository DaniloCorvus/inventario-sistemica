let btnSaveService = document.getElementById("btnSaveService");


let formServiceRegister = document.getElementById('formServiceRegister');
formServiceRegister.addEventListener('submit', ajaxFormRegisterServices);



//Envio de datos ajax
async function ajaxFormRegisterServices(event) {
    event.preventDefault();

    btnSaveService.value = "Enviando...";
    btnSaveService.disabled = true

    const bodyRegister = new FormData(formServiceRegister)
    const register = await axios.post(formServiceRegister.action, bodyRegister).then(res => {
        toastr.info('Success', res.data)
        console.log(res.data);
        $('#formServiceRegister').trigger("reset");
        $('#modalServiceRegister').modal('hide');
        location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formServiceRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveService").value = "Enviar";
    btnSaveService.disabled = false
}
