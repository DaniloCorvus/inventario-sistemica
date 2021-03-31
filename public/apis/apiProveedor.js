let btnSaveProveedor = document.getElementById("btnSaveProveedor");
let btnUpdateProveedor = document.getElementById("btnUpdateProveedor");

let formProveedorRegister = document.getElementById('formProveedorRegister');
formProveedorRegister.addEventListener('submit', ajaxFormRegisterProveedors);

let formProveedorUpdate = document.getElementById('formProveedorUpdate');
formProveedorUpdate.addEventListener('submit', ajaxFormUpdateProveedor);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableProveedors = await $('#dataTableProveedors').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/proveedors/",

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'fullname',
                name: 'fullname'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'direccion',
                name: 'direccion'
            },
            {
                data: 'barrio',
                name: 'barrio'
            },
            {
                data: 'ciudad',
                name: 'ciudad'
            },
            {
                data: 'departamento',
                name: 'departamento'
            },
            {
                data: 'telefono',
                name: 'telefono'
            },
            {
                data: 'action',
                name: 'action',
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
function ajaxFormRegisterProveedors(event) {
    event.preventDefault();

    btnSaveProveedor.value = "Enviando...";
    const dataRegister = new FormData(formProveedorRegister);

    fetch(formProveedorRegister.action, {
            method: 'POST',
            body: dataRegister,
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
                        dataTableProveedors.draw();
                        document.getElementById("btnSaveProveedor").value = "Enviar";
                        $('#formProveedorRegister').trigger("reset");
                        $('#modalProveedorRegister').modal('hide');
                    });
                    document.getElementById("btnSaveProveedor").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formProveedorRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveProveedor").value = "Enviar";
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

// Traer datos de cliente
function editarProveedor(ente_id) {

    const url = SITEURL + '/proveedors/' + ente_id + '/edit'

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
                        formProveedorUpdate.id.value = success.id;
                        formProveedorUpdate.nombre.value = success.nombre;
                        // formProveedorUpdate.apellido.value = success.apellido;
                        formProveedorUpdate.email.value = success.email;
                        formProveedorUpdate.tipo_identificacion.value = success.tipo_identificacion;
                        formProveedorUpdate.identificacion.value = success.identificacion;
                        formProveedorUpdate.direccion.value = success.direccion;
                        formProveedorUpdate.ciudad.value = success.ciudad;
                        formProveedorUpdate.departamento.value = success.departamento;
                        formProveedorUpdate.barrio.value = success.barrio;
                        formProveedorUpdate.telefono.value = success.telefono;
                        formProveedorUpdate.opcional_telefono.value = success.opcional_telefono
                        $('#modalProveedorUpdate').modal('show')
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
function ajaxFormUpdateProveedor(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formProveedorUpdate);
    btnUpdateProveedor.value = "Enviando..."

    fetch(formProveedorUpdate.action, {
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
                        dataTableProveedors.draw();
                        document.getElementById("btnUpdateProveedor").value = "Enviar";
                        $('#formProveedorUpdate').trigger("reset");
                        $('#modalProveedorUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateProveedor").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formProveedorUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateProveedor").value = "Enviar";
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

// Eliminar cliente
function eliminarProveedor(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/proveedors/' + ente_id
                fetch(url, {
                        method: 'DELETE',
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
                                    dataTableProveedors.draw();
                                    toastr.remove()
                                    toastr.info('Success:', success);
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
            } else {
                toastr.remove()
            }
        }
    });
}

