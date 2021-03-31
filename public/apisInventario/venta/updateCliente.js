let btnUpdateCliente = document.getElementById("btnUpdateCliente");
let formClienteUpdate = document.getElementById('formClienteUpdate');
formClienteUpdate.addEventListener('submit', ajaxFormUpdateCliente);

function cargarCliente() {

    formClienteUpdate.id.value = venta.cliente.id;
    formClienteUpdate.nombre.value =  venta.cliente.nombre;
    if (venta.cliente.tipo_identificacion == 'Nit') {
        formClienteUpdate.apellido.removeAttribute('required')
        blockApellidoUpdate.style.display = 'none'
        blockNombreUpdate.classList.replace('col-md-6', 'col-md-12')
    } else {
        formClienteUpdate.apellido.setAttribute('required', true)
        blockApellidoUpdate.style.display = 'block'
        blockNombreUpdate.classList.replace('col-md-12', 'col-md-6')
    }

    formClienteUpdate.apellido.value = venta.cliente.apellido;
    formClienteUpdate.email.value = venta.cliente.email;
    formClienteUpdate.tipo_identificacion.value = venta.cliente.tipo_identificacion;
    formClienteUpdate.identificacion.value = venta.cliente.identificacion;
    formClienteUpdate.direccion.value = venta.cliente.direccion;
    formClienteUpdate.ciudad.value = venta.cliente.ciudad;
    formClienteUpdate.departamento.value = venta.cliente.departamento;
    formClienteUpdate.barrio.value = venta.cliente.barrio;
    formClienteUpdate.telefono.value = venta.cliente.telefono;
    formClienteUpdate.opcional_telefono.value = venta.cliente.opcional_telefono

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
        location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formClienteUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateCliente").value = "Enviar";
    btnUpdateCliente.disabled = false
}

