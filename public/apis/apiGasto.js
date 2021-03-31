let btnSaveGasto = document.getElementById("btnFormGasto");

let formGastoRegister = document.getElementById('formminus');
formGastoRegister.addEventListener('submit', ajaxFormRegisterGastos);


document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableGasto = await $('#dataTableGasto').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        retrieve: true,

        ajax: SITEURL + '/gastos/' + service.id + '/index',


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
                data: 'importeminus',
                name: 'importeminus'
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
async function ajaxFormRegisterGastos(event) {
    event.preventDefault();

    btnSaveGasto.value = "Enviando...";
    btnSaveGasto.disabled = true

    const bodyRegister = new FormData(formGastoRegister)
    const register = await axios.post(formGastoRegister.action, bodyRegister).then(async res => {
        await refresh(res.data, dataTableGasto)
        $('#formminus').trigger("reset");
        $('#minusModal').modal('hide');
        location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formGastoRegister);
        }
        console.error(error.response.data);
    })
    btnSaveGasto.disabled = false
}


// Eliminar Gasto
function eliminarGasto(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/gastos/' + ente_id
                try {
                    const success = await axios.delete(url);
                    console.log(success);
                    await refresh(success.data, dataTableGasto)
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


