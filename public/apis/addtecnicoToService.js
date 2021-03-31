
let btnSaveAddTecnico = document.getElementById("btnSaveAddTecnico");


let addTecnicoForm = document.getElementById('addTecnicoForm');
addTecnicoForm.addEventListener('submit', ajaxFormRegisterAddTecnicos);

//Envio de datos ajax
async function ajaxFormRegisterAddTecnicos(event) {
    event.preventDefault();

    btnSaveAddTecnico.value = "Enviando...";
    btnSaveAddTecnico.disabled = true

    const bodyRegister = new FormData(addTecnicoForm)
    const addTEcnico = await axios.post(addTecnicoForm.action, bodyRegister).then(async res => {
        await refresh(res.data)
        location.reload()
        console.log(res);
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, addTecnicoForm);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveAddTecnico").value = "Enviar";
    btnSaveAddTecnico.disabled = false
}

const refresh = async (success, table = null) => {

    (table == null) ? '' : table.draw()
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

