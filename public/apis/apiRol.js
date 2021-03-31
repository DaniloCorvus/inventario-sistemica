document.addEventListener('DOMContentLoaded', async function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    dtRol = await $('#dataTableRol').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,
        dataType: 'jsonp',
        info: false,
        paginate: false,

        ajax: SITEURL + "/user/roles/" + document.getElementById('user_id').value,

        columns: [{
                data: 'name',
                name: 'name',
            },


            {
                data: 'action',
                name: 'action',
                orderable: false
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

function eliminarRol(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + "/user/roles/eliminar-rol/" + ente_id + '/' + document.getElementById('user_id').value
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
                            response.text().then(success => {
                                dtRol.draw();
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
