let btnUpdateCliente = document.getElementById("btnUpdateCliente");
let formClienteUpdate = document.getElementById('formClienteUpdate');
formClienteUpdate.addEventListener('submit', ajaxFormUpdateCliente);

function cargarCliente() {

    formClienteUpdate.id.value = service.cliente.id;
    formClienteUpdate.nombre.value = service.cliente.nombre;
    if (service.cliente.tipo_identificacion == 'Nit') {
        formClienteUpdate.apellido.removeAttribute('required')
        blockApellidoUpdate.style.display = 'none'
        blockNombreUpdate.classList.replace('col-md-6', 'col-md-12')
    } else {
        formClienteUpdate.apellido.setAttribute('required', true)
        blockApellidoUpdate.style.display = 'block'
        blockNombreUpdate.classList.replace('col-md-12', 'col-md-6')
    }

    formClienteUpdate.apellido.value = service.cliente.apellido;
    formClienteUpdate.email.value = service.cliente.email;
    formClienteUpdate.tipo_identificacion.value = service.cliente.tipo_identificacion;
    formClienteUpdate.identificacion.value = service.cliente.identificacion;
    formClienteUpdate.direccion.value = service.cliente.direccion;
    formClienteUpdate.ciudad.value = service.cliente.ciudad;
    formClienteUpdate.departamento.value = service.cliente.departamento;
    formClienteUpdate.barrio.value = service.cliente.barrio;
    formClienteUpdate.telefono.value = service.cliente.telefono;
    formClienteUpdate.opcional_telefono.value = service.cliente.opcional_telefono

}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateCliente(event) {
    event.preventDefault();

    btnUpdateCliente.value = "Enviando..."
    btnUpdateCliente.disabled = true

    const dataUpdate = new FormData(formClienteUpdate);
    const update = await axios.post(formClienteUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formClienteUpdate').trigger("reset");
        $('#modalClienteUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formClienteUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateCliente").value = "Enviar";
    btnUpdateCliente.disabled = false
}

