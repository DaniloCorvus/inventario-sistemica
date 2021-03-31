let btnSaveHistoria = document.getElementById("btnSaveHistoria");
let btnUpdateHistoria = document.getElementById("btnUpdateHistoria");

let formHistoriaRegister = document.getElementById('formHistoriaRegister');
formHistoriaRegister.addEventListener('submit', ajaxFormRegisterHistorias);


document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableHistorias = $('#dataTableHistorias').DataTable({
        retrieve: true,
        processing: true,
        stateSave: true,
        paginate: false,
        searchable: false,
        info: false,

        ajax: "/gethistorias-venta/" + venta.id,

        columns: [
            {
                data: 'user.name',
                name: 'user.name'
            },
            {
                data: 'descripcion',
                name: 'descripcion'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],

        retrieve: true,
        "pageLength": 10,
        "order": [[2, "Desc"]],
        "columnDefs": {

            "visible": false,
            "searchable": true,

        },

        language: {
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
async function ajaxFormRegisterHistorias(event) {
    event.preventDefault();

    btnSaveHistoria.value = "Enviando...";
    btnSaveHistoria.disabled = true

    const bodyRegister = new FormData(formHistoriaRegister)
    const register = await axios.post(formHistoriaRegister.action, bodyRegister).then(res => {
        console.log(res);
        refresh(res.data)
        location.reload()
        $('#formHistoriaRegister').trigger("reset");
        $('#modalHistoriaRegister').modal('hide');
    }).catch((error) => {
        console.log(error);
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formHistoriaRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveHistoria").value = "Enviar";
    btnSaveHistoria.disabled = false
}

const refresh = async (success, table = null) => {

    (table == null) ? '' : table.draw()
    await toastr.remove()
    await toastr.info('Success:', success);
}

// Eliminar Historia
function eliminarHistoria(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/historias-venta/' + ente_id
                try {
                   
                    const success = await axios.delete(url);
                    console.log(success);
                    refresh(success.data)
                    location.reload()
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
