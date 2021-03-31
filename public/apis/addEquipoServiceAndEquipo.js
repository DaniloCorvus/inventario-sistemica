let btnSaveRegisterEquipoAndServicio = document.getElementById("btnSaveRegisterEquipoAndServicio");
let formRegisterEquipoAndServicio = document.getElementById('formRegisterEquipoAndServicio');
formRegisterEquipoAndServicio.addEventListener('submit', ajaxFormRegisterEquipoAndServicio);


//Envio de datos ajax
async function ajaxFormRegisterEquipoAndServicio(event) {
    event.preventDefault();

    btnSaveEquipoAndServicio.value = "Enviando...";
    btnSaveEquipoAndServicio.disabled = true

    const bodyRegister = new FormData(formRegisterEquipoAndServicio)
    const register = await axios.post(formRegisterEquipoAndServicio.action, bodyRegister).then(res => {
        // refresh(res.data)
        toastr.info('Success', res.data)
        document.getElementById("btnSaveEquipoAndServicio").value = "Enviar";
        $('#formRegisterEquipoAndServicio').trigger("reset");
        $('#modalRegisterEquipoAndServicio').modal('hide');
        window.location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formRegisterEquipoAndServicio.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveEquipoAndServicio").value = "Enviar";
    btnSaveEquipoAndServicio.disabled = false
}



// const formEaS = document.getElementById('formRegisterEquipoAndServicio')


// formEaS.referencia.addEventListener('blur', getEquipo);

// async function getEquipo(e) {

//     formEaS.referencia.classList.remove('is-valid', 'is-invalid')
//     const bool = await axios.get('./equipos/consultar/query/' + e.target.value)
//     console.log(bool.data);
//     if (bool.data) {
//         formEaS.referencia.classList.add('is-invalid')
//         toastr.error('Error', 'El equipo ya se encuentra registrado')
//     }
//     else {
//         formEaS.referencia.classList.add('is-valid')
//     }
// }

