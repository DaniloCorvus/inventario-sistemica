document.addEventListener('DOMContentLoaded', async function () {

    const register = await axios.get(SITEURL + '/empresa/').then(res => {
        if (res.data != "" && res.data != null) {
            formEmpresaRegister.id.value = res.data.id;
            formEmpresaRegister.nombre.value = res.data.nombre;
            formEmpresaRegister.nit.value = res.data.nit;
            formEmpresaRegister.email.value = res.data.email;
            formEmpresaRegister.direccion.value = res.data.direccion;
            formEmpresaRegister.telefono.value = res.data.telefono;
            formEmpresaRegister.publicidad.value = res.data.publicidad;
        }
    }).catch((error) => {
        console.error(error);
    })
});

const formEmpresaRegister = document.getElementById('formEmpresaRegister');
formEmpresaRegister.addEventListener('submit', ajaxFormRegisterEmpresas);



//Envio de datos ajax
async function ajaxFormRegisterEmpresas(event) {
    event.preventDefault();

    btnSaveEmpresa.value = "Enviando...";
    btnSaveEmpresa.disabled = true

    const bodyRegister = new FormData(formEmpresaRegister)
    const register = await axios.post(formEmpresaRegister.action, bodyRegister).then(res => {
        refresh(res.data)
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formEmpresaRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveEmpresa").value = "Enviar";
    btnSaveEmpresa.disabled = false
}

const refresh = async (success) => {
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

