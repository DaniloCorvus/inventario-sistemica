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
                                    dataTableServices.draw();
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
