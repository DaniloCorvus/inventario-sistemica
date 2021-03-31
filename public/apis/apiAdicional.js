let btnSaveAdicional = document.getElementById("btnSaveAdicional");
btnSaveAdicional.addEventListener('click', ajaxFormRegisterAdicionals);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableAdicional = await $('#dataTableAdicional').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        retrieve: true,

        ajax: SITEURL + '/adicionales/' + service.id + '/index',

        columns: [
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'valor',
                name: 'valor'
            },
            {
                data: 'importeplus',
                name: 'importeplus'
            },
            {
                data: 'descripcion',
                name: 'descripcion'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
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
})

//Envio de datos ajax
async function ajaxFormRegisterAdicionals(event) {
    event.preventDefault();

    btnSaveAdicional.value = "Enviando...";
    btnSaveAdicional.disabled = true

    const bodyRegister = new FormData(formAdicionalRegister)
    const register = await axios.post(formAdicionalRegister.action, bodyRegister).then(async res => {
        await refresh(res.data, dataTableAdicional)
        $('#formAdicionalRegister').trigger("reset");
        $('#modalAdicionalRegister').modal('hide');
        location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formAdicionalRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveAdicional").value = "Enviar";
    btnSaveAdicional.disabled = false
}


// Eliminar Adicional
function eliminarAdicional(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/adicionales/' + ente_id
                try {
                    const success = await axios.delete(url);
                    await refresh(success.data, dataTableAdicional)
                    console.log(success);
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

