var SITEURL = document.location.origin;

document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    dtHistoria = $('#dataTableHistoria').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        dataType: 'jsonp',


        ajax: SITEURL + "/orders/historias/" + orden,

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'user.name',
                name: 'user.name',
            },

            {
                data: 'accion',
                name: 'accion',
            },

            {
                data: 'order.estado',
                name: 'order.estado',
            },

            {
                data: 'created_at',
                name: 'created_at',
            },
            // {
            //     data: 'action',
            //     name: 'action',
            //     orderable: false
            // },
        ],
        order: [
            [0, 'asc']
        ],

        language: {
            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }

    });

});




//Envio de datos ajax
function ajaxFormRegisterHistoria(event) {

    event.preventDefault();

    document.getElementById("btnSaveHistoria").value = "Enviando...";

    const dataRegister = new FormData(formHistoriaRegister);

    fetch(formHistoriaRegister.action, {
            method: 'POST',
            body: dataRegister,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success', success)
                    dtHistoria.draw();
                    $('#formHistoriaRegister').trigger("reset");
                    $('#modalHistoriaRegister').modal('hide');
                })
                document.getElementById("btnSaveHistoria").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveHistoria").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de Historia
function editarHistoria(ente_id) {
    const url = SITEURL + '/historias/' + ente_id + '/edit'
    const formHistoriaUpdate = document.getElementById('formHistoriaUpdate');
    fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.json().then(success => {
                    formHistoriaUpdate.id.value = success.id;
                    formHistoriaUpdate.user_id.value = success.user_id;
                    formHistoriaUpdate.cliente_id.value = success.cliente_id;
                    formHistoriaUpdate.referencia.value = success.referencia;
                    formHistoriaUpdate.serial.value = success.serial;
                    formHistoriaUpdate.acciones.value = success.acciones;
                    formHistoriaUpdate.estado.value = success.estado;
                    formHistoriaUpdate.observaciones.value = success.observaciones;
                    formHistoriaUpdate.diagnostico.value = success.diagnostico;
                    $('#modalHistoriaUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};


//Envio de datos ajax a actualizar
function ajaxFormUpdateHistoria(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formHistoriaUpdate);
    document.getElementById("btnUpdateHistoria").value = "Enviando...";

    fetch(formHistoriaUpdate.action, {
            method: 'POST',
            body: dataUpdate,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success', success)
                    dtHistoria.draw();
                    $('#formHistoriaUpdate').trigger("reset");
                    $('#modalHistoriaUpdate').modal('hide');
                    document.getElementById("btnUpdateHistoria").value = "Enviar";
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                    Object.keys(error.errors).forEach(key =>
                        toastr.error('Error', error.errors[key]))
                })

                document.getElementById("btnUpdateHistoria").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Eliminar Historia
function eliminarHistoria(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/historias/' + ente_id
                fetch(url, {
                        method: 'DELETE',
                        mode: "cors",
                        headers: {
                            accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            response.text().then(success => {
                                dtHistoria.draw();
                                toastr.remove()
                                toastr.info('Success:', success);
                            });
                        } else {
                            response.text().then(error => {
                                toastr.remove()
                                // toastr.error('Error:', error);
                                console.log('request failed', error);

                            })
                        }
                    })
                    .catch(error => {
                        console.log('request failed', error);
                    });
            } else {
                toastr.remove()
            }
        }
    });
}
