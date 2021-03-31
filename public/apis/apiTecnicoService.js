// let btnSaveService = document.getElementById("btnSaveService");
// let btnUpdateService = document.getElementById("btnUpdateService");
// let btnFormPrint = document.getElementById("btnFormPrint");


// let formServiceRegister = document.getElementById('formServiceRegister');
// formServiceRegister.addEventListener('submit', ajaxFormRegisterService);

// let formServiceUpdate = document.getElementById('formServiceUpdate');
// formServiceUpdate.addEventListener('submit', ajaxFormUpdateService);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    // $.fn.dataTable.ext.errMode = 'none';
    dataTableTecnicoServices = await $('#dataTableTecnicoServices').DataTable({
        processing: true,
        serverSide: true,
        // stateSave: true,
        // responsive: true,
        autoWidth: false,

        ajax: SITEURL + `/tecnico/myservices`,

        columns: [
            //     {
            //     data: 'DT_RowIndex',
            //     name: 'DT_RowIndex',
            //     orderable: false,
            //     searchable: false
            // },
            {
                data: 'service',
                name: 'service'
            },
            {
                data: 'radicado',
                name: 'radicado',
                // orderable: false,
                // searchable: false
            },
            {
                data: 'razon.nombre',
                name: 'razon.nombre',
                // orderable: false,
                // searchable: false
            },
            {
                data: 'created_at',
                name: 'created_at',
                
            },

            {
                data: 'user.name',
                name: 'user.name',
                
            },
            {
                data: 'equipo.modelo',
                name: 'equipo.modelo',
                
            },
            {
                data: 'equipo.marca.nombre',
                name: 'equipo.marca.nombre',
                // orderable: false,
                // searchable: false
            },
            {
                data: 'equipo.serie',
                render: function (data, type, row, meta) {
                    return '<a href="javascript:void(0)" class="text text-dark" onclick="editarEquipo(' + row.equipo.id + ')" > ' + data + '</a>';
                },
                
            },

            {
                data: 'cliente.fullname',
                name: 'cliente.fullname',
                orderable: false,
            },

            {
                data: 'cliente.identificacion',
                render: function (data, type, row, meta) {
                    return '<a href="javascript:void(0)" class="text text-dark" onclick="editarCliente(' + row.cliente.id + ')" > ' + data + '</a>';
                },
                // orderable: false,
                // searchable: false
            },

            {
                data: 'cliente.direccion',
                name: 'cliente.direccion',
                
            },
            {
                data: 'estado.nombre',
                name: 'estado.nombre',
            },
            {
                data: 'tipo.nombre',
                name: 'tipo.nombre',
            },
            {
                data: 'modo.nombre',
                name: 'modo.nombre',
            },
            {
                data: 'fecha_finalizado',
                name: 'fecha_finalizado',
                
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
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
        },

        order: [
            [0, 'desc']
        ],

        initComplete: function () {
            this.api().columns([6, 2]).every(function () {
                var column = this;
                var select = $('<select style="font-size: 0.8rem;"><option value=""></option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, true)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });

        },
    });
})

//Envio de datos ajax
function ajaxFormRegisterService(event) {
    event.preventDefault();

    btnSaveService.value = "Enviando...";
    const dataRegister = new FormData(formServiceRegister);

    fetch(formServiceRegister.action, {
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
                        dataTableTecnicoServices.draw();
                        document.getElementById("btnSaveService").value = "Enviar";
                        $('#formServiceRegister').trigger("reset");
                        $('#modalServiceRegister').modal('hide');
                    });
                    document.getElementById("btnSaveService").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            // console.log(clave);
                            let container = formServiceRegister.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnSaveService").value = "Enviar";
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
function editarService(ente_id) {

    const url = SITEURL + '/services/' + ente_id + '/edit'

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
                        formServiceUpdate.id.value = success.id;
                        formServiceUpdate.user_id.value = success.user_id;
                        formServiceUpdate.cliente_id.value = success.cliente_id;
                        formServiceUpdate.estado_id.value = success.estado_id;
                        formServiceUpdate.modo_id.value = success.modo_id;
                        formServiceUpdate.tipo_id.value = success.tipo_id;
                        formServiceUpdate.razon_id.value = success.razon_id;
                        formServiceUpdate.equipo_id.value = success.equipo_id;
                        formServiceUpdate.fecha_inicio.value = success.fecha_inicio;
                        formServiceUpdate.fecha_reparado.value = success.fecha_reparado;
                        formServiceUpdate.fecha_finalizado.value = success.fecha_finalizado;
                        formServiceUpdate.valor_obra.value = success.valor_obra;
                        formServiceUpdate.valor_cotizado.value = success.valor_cotizado;
                        formServiceUpdate.valor_total.value = success.valor_total;
                        formServiceUpdate.valor_aprobado.value = success.valor_aprobado;
                        formServiceUpdate.happycall_estado.value = success.happycall_estado;
                        formServiceUpdate.happycall_calificacion.value = success.happycall_calificacion;
                        formServiceUpdate.observacion.value = success.observacion;
                        formServiceUpdate.reporte.value = success.reporte;
                        $('#modalServiceUpdate').modal('show')
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
function ajaxFormUpdateService(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formServiceUpdate);
    btnUpdateService.value = "Enviando..."

    fetch(formServiceUpdate.action, {
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
                        // toastr.info('Success:', success);
                        console.log('Success:', success);
                        dataTableTecnicoServices.draw();
                        document.getElementById("btnUpdateService").value = "Enviar";
                        $('#formServiceUpdate').trigger("reset");
                        $('#modalServiceUpdate').modal('hide');
                    });
                    document.getElementById("btnUpdateService").value = "Enviar";
                    break;

                case 422:
                    throw response.json().then(error => {
                        for (var clave in error.errors) {
                            let container = formServiceUpdate.elements.namedItem(clave);
                            container.classList.add('is-invalid');
                            toastr.error(`<li> ${error.errors[clave]} </li>`);
                        }
                        document.getElementById("btnUpdateService").value = "Enviar";
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
function eliminarService(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/services/' + ente_id
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
                                    dataTableTecnicoServices.draw();
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


