let btnUpdateCliente = document.getElementById("btnUpdateCliente");
let formClienteUpdate = document.getElementById('formClienteUpdate');

const blockNombreUpdate = formClienteUpdate.querySelector('#blockNombre')
const blockApellidoUpdate = formClienteUpdate.querySelector('#blockApellido')

formClienteUpdate.addEventListener('submit', ajaxFormUpdateCliente);

function editarCliente(ente_id) {

    const url = SITEURL + '/clientes/' + ente_id + '/edit'

    fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
        .then(response => {
            switch (response.status) {
                case 200:
                    response.json().then(success => {
                        formClienteUpdate.id.value = success.id;
                        formClienteUpdate.nombre.value = success.nombre;
                        formClienteUpdate.apellido.value = success.apellido;

                        if (success.tipo_identificacion == 'Nit') {
                            formClienteUpdate.apellido.removeAttribute('required')
                            blockApellidoUpdate.style.display = 'none'
                            blockNombreUpdate.classList.replace('col-md-6', 'col-md-12')
                        } else {
                            formClienteUpdate.apellido.setAttribute('required', true)
                            blockApellidoUpdate.style.display = 'block'
                            blockNombreUpdate.classList.replace('col-md-12', 'col-md-6')
                        }

                        formClienteUpdate.email.value = success.email;
                        formClienteUpdate.tipo_identificacion.value = success.tipo_identificacion;
                        formClienteUpdate.identificacion.value = success.identificacion;
                        formClienteUpdate.direccion.value = success.direccion;
                        formClienteUpdate.ciudad.value = success.ciudad;
                        formClienteUpdate.departamento.value = success.departamento;
                        formClienteUpdate.barrio.value = success.barrio;
                        formClienteUpdate.telefono.value = success.telefono;
                        formClienteUpdate.opcional_telefono.value = success.opcional_telefono
                        $('#modalClienteUpdate').modal('show')
                    });
                    break;
                default:
                    throw response.json().then(error => {
                        throw new Error(error); // (*)
                    })
                    break;
            }
        })
        .catch(error => {
            console.log('request failed', error);
        });
}


//Envio de datos ajax a actualizar
function ajaxFormUpdateCliente(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formClienteUpdate);
    btnUpdateCliente.value = "Enviando..."

    fetch(formClienteUpdate.action, {
            method: 'POST',
            body: dataUpdate,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
        .then(response => {
            switch (response.status) {
                case 200:
                    response.json().then(success => {
                        toastr.info('Success:', success);
                        // dataTableClientes.draw();
                        document.getElementById("btnUpdateCliente").value = "Enviar";
                        $('#formClienteUpdate').trigger("reset");
                        $('#modalClienteUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateCliente").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formClienteUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateCliente").value = "Enviar";
                    });
                    break;
                default:
                    throw response.json().then(error => {
                        throw new Error(error); // (*)
                    })
                    break;
            }
        })
        .catch(error => {
            console.log(error);
        });

}
