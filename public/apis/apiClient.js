let btnSaveCliente = document.getElementById("btnSaveCliente");
let btnUpdateCliente = document.getElementById("btnUpdateCliente");

let formClienteRegister = document.getElementById('formClienteRegister');
formClienteRegister.addEventListener('submit', ajaxFormRegisterClientes);

let formClienteUpdate = document.getElementById('formClienteUpdate');
formClienteUpdate.addEventListener('submit', ajaxFormUpdateCliente);

const blockNombreUpdate = formClienteUpdate.querySelector('#blockNombre')
const blockApellidoUpdate = formClienteUpdate.querySelector('#blockApellido')

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableClientes = await $('#dataTableClientes').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/clientes/",

        columns: [
            {
                data: 'identificacion',
                name: 'identificacion'
            },
            {
                data: 'nombre',
                name: 'nombre',
            },
            {
                data: 'apellido',
                name: 'apellido',
                // render: function(data, row, another){
                // console.log([data, row, another])
                // }
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'direccion',
                name: 'direccion',
                searchable: false

            },
            {
                data: 'ciudad',
                name: 'ciudad',
                searchable: false

            },
            {
                data: 'barrio',
                name: 'barrio',
                searchable: false

            },
            {
                data: 'telefono',
                name: 'telefono',
                searchable: true

            },
            {
                data: 'action',
                name: 'action',
                searchable: false,
                orderable: false
            },
        ],

        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": " Registros _MENU_ ",
            "sSearch": "Buscar:",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }
    });
})


//Envio de datos ajax
async function ajaxFormRegisterClientes(event) {
    event.preventDefault();

    btnSaveCliente.value = "Enviando...";
    btnSaveCliente.disabled = true

    const bodyRegister = new FormData(formClienteRegister)
    const register = await axios.post(formClienteRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formClienteRegister').trigger("reset");
        $('#modalClienteRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formClienteRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveCliente").value = "Enviar";
    btnSaveCliente.disabled = false
}

//Envio de datos ajax a actualizar
async function ajaxFormUpdateCliente(event) {
    event.preventDefault();

    btnUpdateCliente.value = "Enviando..."
    btnUpdateCliente.disabled = true

    const dataUpdate = new FormData(formClienteUpdate);
    const update = await axios.post(formClienteUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        console.log(res.data);
        $('#formClienteUpdate').trigger("reset");
        $('#modalClienteUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formClienteUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateCliente").value = "Enviar";
    btnUpdateCliente.disabled = false
}



// Eliminar Cliente
function eliminarCliente(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/clientes/' + ente_id
                try {
                    const success = await axios.delete(url);
                    console.log(success);
                    refresh(success.data)
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


const refresh = async (success) => {
    await dataTableClientes.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}

// Traer datos de cliente

async function editarCliente(ente_id) {

    const url = SITEURL + '/clientes/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:

            formClienteUpdate.id.value = edit.data.id;
            formClienteUpdate.nombre.value = edit.data.nombre;
            if (edit.data.tipo_identificacion == 'Nit') {
                formClienteUpdate.apellido.removeAttribute('required')
                blockApellidoUpdate.style.display = 'none'
                blockNombreUpdate.classList.replace('col-md-6', 'col-md-12')
            } else {
                formClienteUpdate.apellido.setAttribute('required', true)
                blockApellidoUpdate.style.display = 'block'
                blockNombreUpdate.classList.replace('col-md-12', 'col-md-6')
            }

            formClienteUpdate.apellido.value = edit.data.apellido;
            formClienteUpdate.email.value = edit.data.email;
            formClienteUpdate.tipo_identificacion.value = edit.data.tipo_identificacion;
            formClienteUpdate.identificacion.value = edit.data.identificacion;
            formClienteUpdate.direccion.value = edit.data.direccion;
            formClienteUpdate.ciudad.value = edit.data.ciudad;
            formClienteUpdate.departamento.value = edit.data.departamento;
            formClienteUpdate.barrio.value = edit.data.barrio;
            formClienteUpdate.telefono.value = edit.data.telefono;
            formClienteUpdate.opcional_telefono.value = edit.data.opcional_telefono


            if (edit.data.accept == 'on') {
                formClienteUpdate.accept.value = edit.data.accept
                document.getElementById('acceptSelect').checked = true
            }

            $('#modalClienteUpdate').modal('show')
            break;
        default:
            break;
    }
}
