// var formClienteRegister = document.getElementById('formClienteRegister');
// formClienteRegister.addEventListener('submit', ajaxFormRegisterClientes);

// var formClienteUpdate = document.getElementById('formClienteUpdate');
// formClienteUpdate.addEventListener('submit', ajaxFormUpdateCliente);

// document.addEventListener('DOMContentLoaded', function () {
//     // datatables settings

//     $.fn.dataTable.ext.errMode = 'none';
//     dtClientes = $('#dataTableClientes').DataTable({
//         processing: true,
//         serverSide: true,
//         stateSave: true,
//         responsive: true,
//         autoWidth: false,

//         ajax: SITEURL + "/clientes/",

//         columns: [{
//                 data: 'DT_RowIndex',
//                 name: 'DT_RowIndex',
//                 orderable: false,
//                 searchable: false
//             },
//             {
//                 data: 'nombre',
//                 name: 'nombre'
//             },
//             {
//                 data: 'email',
//                 name: 'email'
//             },
//             {
//                 data: 'direccion',
//                 name: 'direccion'
//             },
//             {
//                 data: 'barrio',
//                 name: 'barrio'
//             },
//             {
//                 data: 'ciudad',
//                 name: 'ciudad'
//             },
//             {
//                 data: 'departamento',
//                 name: 'departamento'
//             },
//             {
//                 data: 'telefono',
//                 name: 'telefono'
//             },
//             {
//                 data: 'action',
//                 name: 'action',
//                 searchable: false,
//                 orderable: false
//             },
//         ],
//         order: [
//             [0, 'asc']
//         ],

//         language: {
//             paginate: {
//                 first: "",
//                 previous: " ← ",
//                 next: " → ",
//                 last: ""
//             },
//         }

//     });

// });




// //Envio de datos ajax
// function ajaxFormRegisterClientes(event) {

//     event.preventDefault();

//     document.getElementById("btnSaveCliente").value = "Enviando...";

//     const dataRegister = new FormData(formClienteRegister);

//     fetch(formClienteRegister.action, {
//             method: 'POST',
//             body: dataRegister,
//             mode: "cors",
//             headers: {
//                 accept: "application/json",
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         })
//         .then(response => {
//             if (response.ok) {
//                 response.text().then(success => {
//                     toastr.info('Success', success)
//                     dtClientes.draw();
//                     $('#formClienteRegister').trigger("reset");
//                     $('#modalClienteRegister').modal('hide');
//                 })
//                 document.getElementById("btnSaveCliente").value = "Enviar";
//             } else {
//                 response.json().then(error => {
//                     Object.keys(error.errors).forEach(key => {
//                         toastr.error('Error', error.errors[key])
//                     })
//                     // console.log(error);
//                 });
//                 document.getElementById("btnSaveCliente").value = "Enviar";
//             }
//         })
//         .catch(error => {
//             console.log(error);
//         })
// }

// // Traer datos de cliente
// function editarCliente(ente_id) {
//     const url = SITEURL + '/clientes/' + ente_id + '/edit'
//     const formClienteUpdate = document.getElementById('formClienteUpdate');
//     fetch(url, {
//             // method: 'GET',
//             mode: "cors",
//             headers: {
//                 accept: "application/json",
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         })
//         .then(response => {
//             if (response.ok) {
//                 response.json().then(success => {
//                     formClienteUpdate.id.value = success.id;
//                     formClienteUpdate.nombre.value = success.nombre;
//                     formClienteUpdate.apellido.value = success.apellido;
//                     formClienteUpdate.email.value = success.email;
//                     formClienteUpdate.tipo_identificacion.value = success.tipo_identificacion;
//                     formClienteUpdate.identificacion.value = success.identificacion;
//                     formClienteUpdate.direccion.value = success.direccion;
//                     formClienteUpdate.ciudad.value = success.ciudad;
//                     formClienteUpdate.departamento.value = success.departamento;
//                     formClienteUpdate.barrio.value = success.barrio;
//                     formClienteUpdate.telefono.value = success.telefono;
//                     formClienteUpdate.opcional_telefono.value = success.opcional_telefono
//                     $('#modalClienteUpdate').modal('show')
//                 });
//             }
//         })
//         .catch(error => {
//             console.log('request failed');
//         });
// };


// //Envio de datos ajax a actualizar
// function ajaxFormUpdateCliente(event) {
//     event.preventDefault();

//     const dataUpdate = new FormData(formClienteUpdate);
//     document.getElementById("btnUpdateCliente").value = "Enviando...";

//     fetch(formClienteUpdate.action, {
//             method: 'POST',
//             body: dataUpdate,
//             mode: "cors",
//             headers: {
//                 accept: "application/json",
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         })
//         .then(response => {
//             if (response.ok) {
//                 response.text().then(success => {
//                     toastr.info('Success', success)
//                     dtClientes.draw();
//                     $('#formClienteUpdate').trigger("reset");
//                     $('#modalClienteUpdate').modal('hide');
//                     document.getElementById("btnUpdateCliente").value = "Enviar";
//                 })
//             } else {
//                 response.json().then(error => {
//                     console.log(error);
//                     Object.keys(error.errors).forEach(key =>
//                         toastr.error('Error', error.errors[key]))
//                 })

//                 document.getElementById("btnUpdateCliente").value = "Enviar";
//             }
//         })
//         .catch(error => {
//             console.log(error);
//         });
// }

// // Eliminar cliente
// function eliminarCliente(ente_id) {
//     toastr.options.preventDuplicates = true;
//     toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
//         allowHtml: true,
//         onclick: function (toast) {
//             value = toast.target.value
//             if (value == 'yes') {
//                 const url = SITEURL + '/clientes/' + ente_id
//                 fetch(url, {
//                         method: 'DELETE',
//                         mode: "cors",
//                         headers: {
//                             accept: "application/json",
//                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         }
//                     })
//                     .then(response => {
//                         if (response.ok) {
//                             response.text().then(success => {
//                                 dtClientes.draw();
//                                 toastr.remove()
//                                 toastr.info('Success:', success);
//                             });
//                         } else {
//                             response.text().then(error => {
//                                 toastr.remove()
//                                 // toastr.error('Error:', error);
//                                 console.log('request failed', error);

//                             })
//                         }
//                     })
//                     .catch(error => {
//                         console.log('request failed', error);
//                     });
//             } else {
//                 toastr.remove()
//             }
//         }
//     });
// }



let clientes = [];
let $body = document.querySelector("#bodyTableCliente");
let btnSaveCliente = document.getElementById("btnSaveCliente");
let btnUpdateCliente = document.getElementById("btnUpdateCliente");

let formClienteRegister = document.getElementById('formClienteRegister');
formClienteRegister.addEventListener('submit', ajaxFormRegisterClientes);

let formClienteUpdate = document.getElementById('formClienteUpdate');
formClienteUpdate.addEventListener('submit', ajaxFormUpdateClientes);


const info = () => {
    if (clientes.length == 0) {
        const $tr = document.createElement("tr");
        let $cell = document.createElement("td");
        $cell.setAttribute('colspan', 7)
        $cell.setAttribute('id', 'infoTable')
        $cell.textContent = 'Sin datos'
        $tr.appendChild($cell);
        $body.appendChild($tr);
    }
}


const getData = async () => {
    try {
        const response = await axios.get(`${SITEURL}/clientes`);
        clientes = Object.values((await response).data)
        await drawTable(clientes, $body, 'Cliente');
        if (document.getElementById('infoTable') != null) {
            document.getElementById('infoTable').remove()
        }
    } catch (error) {
        console.error(error);
    }
}


//Envio de datos ajax a crear 
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
async function ajaxFormUpdateClientes(event) {
    event.preventDefault();

    btnUpdateCliente.value = "Enviando..."
    btnUpdateCliente.disabled = true

    const dataUpdate = new FormData(formClienteUpdate);
    const update = await axios.post(formClienteUpdate.action, dataUpdate).then(res => {
        refresh(res.data)

        $('#formClienteUpdate').trigger("reset");
        $('#modalClienteUpdate').modal('hide');

    }).catch((error) => {
        for (var clave in error.response.data.errors) {
            let container = formClienteUpdate.elements.namedItem(clave);
            container.classList.add('is-invalid');
            warning = document.createTextNode(`${(error.response.data.errors[clave])}`);
            insertAfter(warning, container);
        }
    })

    document.getElementById("btnUpdateCliente").value = "Enviar";
    btnUpdateCliente.disabled = false
}


// Eliminar Clientes
function eliminarCliente(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/clientes/${ente_id}`
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


async function editarCliente(ente_id) {

    const url = SITEURL + '/clientes/' + ente_id
    const modelEdit = await axios.get(url)
    console.log(modelEdit);
    switch (modelEdit.status) {
        case 200:
            console.log(modelEdit);
            formClienteUpdate.id.value = modelEdit.data.id;
            formClienteUpdate.nombres.value = modelEdit.data.nombres;
            formClienteUpdate.apellidos.value = modelEdit.data.apellidos;
            formClienteUpdate.tipo_identificacion.value = modelEdit.data.tipo_identificacion;
            formClienteUpdate.identificacion.value = modelEdit.data.identificacion;
            formClienteUpdate.email.value = modelEdit.data.email;
            // formClienteUpdate.ciudad.value = modelEdit.data.ciudad;
            // formClienteUpdate.departamento.value = modelEdit.data.departamento;
            formClienteUpdate.direccion.value = modelEdit.data.direccion;
            formClienteUpdate.barrio.value = modelEdit.data.barrio;
            formClienteUpdate.telefono.value = modelEdit.data.telefono;
            formClienteUpdate.opcional_telefono.value = modelEdit.data.opcional_telefono;

            $('#modalClienteUpdate').modal('show')
            break;
        default:
            break;
    }
}

const refresh = async (success) => {
    $body.innerHTML = "";
    getData()
    await toastr.remove()
    await toastr.info('Success:', success);
}

if (document.hasFocus()) {
    info()
    getData()
}

