var SITEURL = document.location.origin;

var formCellarRegister = document.getElementById('formCellarRegister');
formCellarRegister.addEventListener('submit', ajaxFormRegisterCellar);

var formCellarUpdate = document.getElementById('formCellarUpdate');
formCellarUpdate.addEventListener('submit', ajaxFormUpdateCellar);

document.addEventListener('DOMContentLoaded', function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    dtCellar = $('#dataTableCellars').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,
        searchable: true,
        orderable: true,

        ajax: SITEURL + "/cellars",

        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'nombre',
            name: 'nombre'
        },
        {
            data: 'direccion',
            name: 'direccion'
        },
        {
            data: 'action',
            name: 'action',
            searchable: false,
            orderable: true
        },
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

const verProductos = (id)=>{
    window.location = `productos-bodega/${id}`
}

//Envio de datos ajax
function ajaxFormRegisterCellar(event) {

    event.preventDefault();

    document.getElementById("btnSaveCellar").value = "Enviando...";

    const dataRegister = new FormData(formCellarRegister);

    fetch(formCellarRegister.action, {
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
                    dtCellar.draw();
                    $('#formCellarRegister').trigger("reset");
                    $('#modalCellarRegister').modal('hide');
                })
                document.getElementById("btnSaveCellar").value = "Enviar";
            } else {
                response.json().then(error => {
                    Object.keys(error.errors).forEach(key => {
                        toastr.error('Error', error.errors[key])
                    })
                    // console.log(error);
                });
                document.getElementById("btnSaveCellar").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        })
}

// Traer datos de Cellar
function editarCellar(ente_id) {
    const url = SITEURL + '/cellars/' + ente_id + '/edit'
    const formCellarUpdate = document.getElementById('formCellarUpdate');
    fetch(url, {
        // method: 'GET',
        mode: "cors",
        headers: {
            accept: "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
        .then(response => {
            if (response.ok) {
                response.json().then(success => {
                    formCellarUpdate.id.value = success.id;
                    formCellarUpdate.nombre.value = success.nombre;
                    formCellarUpdate.direccion.value = success.direccion;
                    $('#modalCellarUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};


//Envio de datos ajax a actualizar
function ajaxFormUpdateCellar(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formCellarUpdate);
    document.getElementById("btnUpdateCellar").value = "Enviando...";

    fetch(formCellarUpdate.action, {
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
                    dtCellar.draw();
                    $('#formCellarUpdate').trigger("reset");
                    $('#modalCellarUpdate').modal('hide');
                    document.getElementById("btnUpdateCellar").value = "Enviar";
                })
            } else {
                response.json().then(error => {
                    console.log(error);
                    Object.keys(error.errors).forEach(key =>
                        toastr.error('Error', error.errors[key]))
                })

                document.getElementById("btnUpdateCellar").value = "Enviar";
            }
        })
        .catch(error => {
            console.log(error);
        });
}

// Eliminar Cellar
function eliminarCellar(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/cellars/' + ente_id
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
                                dtCellar.draw();
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
