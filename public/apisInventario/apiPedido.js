let btnSavePedido = document.getElementById("btnSavePedido");
let btnUpdatePedido = document.getElementById("btnUpdatePedido");

let formPedidoRegister = document.getElementById('formPedidoRegister');
formPedidoRegister.addEventListener('submit', ajaxFormRegisterPedido);

let formPedidoUpdate = document.getElementById('formPedidoUpdate');
formPedidoUpdate.addEventListener('submit', ajaxFormUpdatePedido);

document.addEventListener('DOMContentLoaded', async function () {
    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTablePedido = await $('#dataTablePedidos').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        retrieve: true,

        ajax: `/pedidos`,

        columns: [
            {
                data: 'cantidad',
                name: 'cantidad',
            },
            {
                data: 'cod_interno',
                name: 'cod_interno',
            },
            {
                data: 'confirmacion',
                name: 'confirmacion',
            },
            {
                data: 'costo_antes_iva',
                name: 'costo_antes_iva',
            },
            {
                data: 'costo_in',
                name: 'costo_in',
            },
            {
                data: 'costo_promosion',
                name: 'costo_promosion',
            },
            {
                data: 'costo_venta',
                name: 'costo_venta',
            },
            {
                data: 'delivery_orden',
                name: 'delivery_orden',
            },
            {
                data: 'descripcion',
                name: 'descripcion',
            },
            {
                data: 'estado',
                name: 'estado',
            },
            {
                data: 'fecha_compra',
                name: 'fecha_compra',
            },
            {
                data: 'fecha_recibido',
                name: 'fecha_recibido',
            },
            {
                data: 'fecha_solicitud',
                name: 'fecha_solicitud',
            },
            {
                data: 'guia',
                name: 'guia',
            },
            {
                data: 'impuesto',
                name: 'impuesto',
            },
            {
                data: 'modelo',
                name: 'modelo',
            },
            {
                data: 'num_factura',
                name: 'num_factura',
            },
            {
                data: 'num_parte',
                name: 'num_parte',
            },
            {
                data: 'num_pedido',
                name: 'num_pedido',
            },
            {
                data: 'observacion',
                name: 'observacion',
            },
            {
                data: 'orden_compra',
                name: 'orden_compra',
            },
            {
                data: 'proveedor_id',
                name: 'proveedor_id',
            },
            {
                data: 'serie',
                name: 'serie',
            },
            {
                data: 'ubicacion',
                name: 'ubicacion',
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
        }
    })
})


async function ajaxFormRegisterPedido(event) {
    event.preventDefault();

    btnSavePedido.value = "Enviando...";
    btnSavePedido.disabled = true

    const bodyRegister = new FormData(formPedidoRegister)
    const register = await axios.post(formPedidoRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formPedidoRegister').trigger("reset");
        $('#modalPedidoRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formPedidoRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSavePedido").value = "Enviar";
    btnSavePedido.disabled = false
}

// Traer datos de cliente

async function editarPedido(ente_id) {

    const url = SITEURL + '/pedidos/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formPedidoUpdate.id.value = edit.data.id;
            // formPedidoUpdate.nombre.value = edit.data.nombre;
            // formPedidoUpdate.descripcion.value = edit.data.descripcion;
            $('#modalPedidoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdatePedido(event) {
    event.preventDefault();

    btnUpdatePedido.value = "Enviando..."
    btnUpdatePedido.disabled = true

    const dataUpdate = new FormData(formPedidoUpdate);
    const update = await axios.post(formPedidoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formPedidoUpdate').trigger("reset");
        $('#modalPedidoUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formPedidoUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdatePedido").value = "Enviar";
    btnUpdatePedido.disabled = false
}



// Eliminar Pedido
function eliminarPedido(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/pedidos/' + ente_id
                try {
                    const success = await axios.delete(url);
                    console.log(success);
                    refresh(success.data)
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


const refresh = async (success) => {
    await dataTablePedido.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}

const loadErrors = async (errors, form) => {

    Object.keys(errors).map(async (element) => {
        let container = await form.elements.namedItem(element);
        await container.classList.add('is-invalid');
        await toastr.error(`<li> ${errors[element]} </li>`);
    })
}

