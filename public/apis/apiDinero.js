let btnFormDinero = document.getElementById("btnFormDinero");
const formDineroRegister = document.getElementById('formDinero');

formDineroRegister.addEventListener('submit', ajaxFormRegisterDinero)


document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableDinero = await $('#dataTableDinero').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        retrieve: true,


        ajax: SITEURL + '/dineros/' + service.id + '/index',


        columns: [
            {
                data: 'monto',
                name: 'monto'
            },
            {
                data: 'fecha',
                name: 'fecha'
            },
            {
                data: 'observacion',
                name: 'observacion'
            },
            {
                data: 'user.name',
                name: 'user.name'
            },
            {
                data: 'method_pay',
                name: 'method_pay'
            },
            {
                data: 'action',
                name: 'action'
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
async function ajaxFormRegisterDinero(event) {
    event.preventDefault();

    btnFormDinero.value = "Enviando...";
    btnFormDinero.disabled = true

    const bodyRegisterDinero = new FormData(formDineroRegister)
    const register = await axios.post(formDineroRegister.action, bodyRegisterDinero).then(async res => {
        await refresh(res.data, dataTableDinero)
        $('#formminus').trigger("reset");
        $('#minusModal').modal('hide');
        location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formDineroRegister);
        }
        console.error(error.response.data);
    })
    btnFormDinero.disabled = false
}


// Eliminar Dinero
function eliminarDinero(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/dineros/' + ente_id
                try {
                    const success = await axios.delete(url);
                    console.log(success);
                    await refresh(success.data, dataTableDinero)
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


