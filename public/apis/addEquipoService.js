let btnSaveEquipoServicioServicio = document.getElementById("btnSaveEquipoServicioServicio");
let formRegisterEquipoServicio = document.getElementById('formRegisterEquipoServicio');
formRegisterEquipoServicio.addEventListener('submit', ajaxFormRegisterEquipoServicio);


//Envio de datos ajax
async function ajaxFormRegisterEquipoServicio(event) {
    event.preventDefault();

    btnSaveEquipoServicio.value = "Enviando...";
    btnSaveEquipoServicio.disabled = true

    const bodyRegister = new FormData(formRegisterEquipoServicio)
    const register = await axios.post(formRegisterEquipoServicio.action, bodyRegister).then(res => {
        console.log(res.data);
        toastr.info('Success', res.data)
        document.getElementById("btnSaveEquipoServicio").value = "Enviar";
        $('#formRegisterEquipoServicio').trigger("reset");
        $('#modalRegisterEquipoServicio').modal('hide');
        window.location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formRegisterEquipoServicio.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveEquipoServicio").value = "Enviar";
    btnSaveEquipoServicio.disabled = false
}


const form = document.querySelector('#formRegisterEquipoServicio')

form.referencia.addEventListener('blur', getEquipo);

async function getEquipo(e) {

    form.referencia.classList.remove('is-valid', 'is-invalid')
    const bool = await axios.get('./equipos/consultar/query/' + e.target.value)
    console.log(bool.data);
    if (bool.data) {
        form.referencia.classList.add('is-invalid')
        toastr.error('Error', 'El equipo ya se encuentra registrado')
    }
    else {
        form.referencia.classList.add('is-valid')
    }
}

