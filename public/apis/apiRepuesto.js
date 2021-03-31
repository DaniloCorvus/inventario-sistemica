let btnSaveRepuesto = document.getElementById("btnSaveRepuesto");
let btnUpdateRepuesto = document.getElementById("btnUpdateRepuesto");
let btnCargaRepuesto = document.getElementById("btnCargaRepuesto");

let formRepuestoRegister = document.getElementById('formRepuestoRegister');
formRepuestoRegister.addEventListener('submit', ajaxFormRegisterRepuestos);

let formRepuestoCarga = document.getElementById('formRepuestoCarga');
formRepuestoCarga.addEventListener('submit', ajaxFormCargaRepuesto);

let formRepuestoUpdate = document.getElementById('formRepuestoUpdate');
formRepuestoUpdate.addEventListener('submit', ajaxFormUpdateRepuesto);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    await $('#dataTableRepuestos thead tr').clone(true).appendTo('#dataTableRepuestos thead');
    await $('#dataTableRepuestos thead tr:eq(1) th').each(function (i) {

        let title = $(this).text();
        $(this).html('<input class="form-control form-control-sm " style="min-width: 80px" type="text" />');

        $('input', this).on('keyup change', function () {
            if (dataTableRepuestos.column(i).search() !== this.value) {
                dataTableRepuestos
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });


    dataTableRepuestos = await $('#dataTableRepuestos').DataTable({
        bProcessing: true,
        deferRender: true,
        autoWidth: false,
        "sAjaxSource": SITEURL + "/repuestos/",
        "aoColumns": [
            {
                mData: 'fecha_solicitud',

            },
            {
                mData: 'proveedor.nombre',

            },
            {
                mData: 'num_parte',

            },
            {
                mData: 'orden_compra',

            },
            {
                mData: 'cantidad',

            },
            {
                mData: 'num_factura',

            },
            {
                mData: 'confirmacion',

            },
            {
                mData: 'cant_disponible',

            },
            {
                mData: 'estado',

            },
            {
                mData: 'service_id',

            },
            {
                mData: 'fecha_recibido',

            },
            {
                mData: 'descripcion',

            },
            {
                mData: 'action',
                orderable: false,
                searchable: false
            }


        ],

        retrieve: true,
        dom: 'Blfrtip',
        "pageLength": 10,
        "order": [[0, "asc"]],
        "columnDefs": {

            "visible": false,
            "searchable": true,

        },

        "language": {

            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "searchPlaceholder": "Escribe aquí para buscar..",
            "sUrl": "",
            "sInfoThousands": ",",
            "oPaginate": {
                
                "sFirst": "",
                "sLast": "",
                "sNext": "→",
                "sPrevious": "←"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }
    });
})


//Envio de datos ajax
async function ajaxFormRegisterRepuestos(event) {
    event.preventDefault();

    btnSaveRepuesto.value = "Enviando...";
    btnSaveRepuesto.disabled = true

    const bodyRegister = new FormData(formRepuestoRegister)
    const register = await axios.post(formRepuestoRegister.action, bodyRegister).then(res => {
        refresh(res.data, dataTableRepuestos)
        $('#formRepuestoRegister').trigger("reset");
        $('#modalRepuestoRegister').modal('hide');
        location.reload()

    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formRepuestoRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveRepuesto").value = "Enviar";
    btnSaveRepuesto.disabled = false
}

// Traer datos de cliente

async function editarRepuesto(ente_id) {

    const url = SITEURL + '/repuestos/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formRepuestoUpdate.id.value = edit.data.id;
            formRepuestoUpdate.id.value = edit.data.id
            formRepuestoUpdate.service_id.value = edit.data.service_id
            formRepuestoUpdate.proveedor_id.value = edit.data.proveedor_id
            formRepuestoUpdate.serie.value = edit.data.serie
            formRepuestoUpdate.modelo.value = edit.data.modelo
            formRepuestoUpdate.num_pedido.value = edit.data.num_pedido
            formRepuestoUpdate.descripcion.value = edit.data.descripcion
            formRepuestoUpdate.num_factura.value = edit.data.num_factura
            formRepuestoUpdate.fecha_solicitud.value = edit.data.fecha_solicitud
            formRepuestoUpdate.fecha_compra.value = edit.data.fecha_compra
            formRepuestoUpdate.fecha_recibido.value = edit.data.fecha_recibido
            formRepuestoUpdate.guia.value = edit.data.guia
            formRepuestoUpdate.orden_compra.value = edit.data.orden_compra
            formRepuestoUpdate.cod_interno.value = edit.data.cod_interno
            formRepuestoUpdate.delivery_orden.value = edit.data.delivery_orden
            formRepuestoUpdate.confirmacion.value = edit.data.confirmacion
            formRepuestoUpdate.num_parte.value = edit.data.num_parte
            formRepuestoUpdate.valor_before_iva.value = edit.data.valor_before_iva
            formRepuestoUpdate.impuesto.value = edit.data.impuesto
            formRepuestoUpdate.costo_total.value = edit.data.costo_total
            formRepuestoUpdate.costo_in.value = edit.data.costo_in
            formRepuestoUpdate.costo_venta.value = edit.data.costo_venta
            formRepuestoUpdate.cantidad.value = edit.data.cantidad
            formRepuestoUpdate.observacion.value = edit.data.observacion
            formRepuestoUpdate.estado.value = edit.data.estado
            formRepuestoUpdate.ubicacion.value = edit.data.ubicacion

            if (edit.data.estado == 'recibido') {
                recibidoClass.style.display = 'block'
                fecha_recibido.setAttribute('required', true)
            } else {
                recibidoClass.style.display = 'none'
                fecha_recibido.removeAttribute('required')
            }

            $('#modalRepuestoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateRepuesto(event) {
    event.preventDefault();

    btnUpdateRepuesto.value = "Enviando..."
    btnUpdateRepuesto.disabled = true

    const dataUpdate = new FormData(formRepuestoUpdate);
    const update = await axios.post(formRepuestoUpdate.action, dataUpdate).then(res => {
        refresh(res.data, dataTableRepuestos)
        $('#formRepuestoUpdate').trigger("reset");
        $('#modalRepuestoUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formRepuestoUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateRepuesto").value = "Enviar";
    btnUpdateRepuesto.disabled = false
}



// Eliminar Repuesto
function eliminarRepuesto(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/repuestos/' + ente_id
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
    await dataTableRepuestos.draw();
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

/**
 * Cargar repuesto ---
 * 
 */


async function cargaRepuesto(ente_id) {

    const url = SITEURL + '/repuestos/' + ente_id + '/edit'

    const update = await axios.get(url).then(res => {
        formRepuestoCarga.id.value = res.data.id
        formRepuestoCarga.service_id.value = res.data.service_id
        formRepuestoCarga.proveedor_id.value = res.data.proveedor_id
        formRepuestoCarga.serie.value = res.data.serie
        formRepuestoCarga.modelo.value = res.data.modelo
        formRepuestoCarga.num_pedido.value = res.data.num_pedido
        formRepuestoCarga.descripcion.value = res.data.descripcion
        formRepuestoCarga.num_factura.value = res.data.num_factura
        formRepuestoCarga.fecha_compra.value = res.data.fecha_compra
        formRepuestoCarga.orden_compra.value = res.data.orden_compra
        formRepuestoCarga.cod_interno.value = res.data.cod_interno
        formRepuestoCarga.delivery_orden.value = res.data.delivery_orden
        formRepuestoCarga.confirmacion.value = res.data.confirmacion
        formRepuestoCarga.num_parte.value = res.data.num_parte
        formRepuestoCarga.observacion.value = res.data.observacion
        formRepuestoCarga.estado.value = res.data.estado
        $('#modalRepuestoCarga').modal('show')
    }).catch((error) => {
        console.error(error.response.data);
    })
}

//Envio de datos ajax a actualizar
async function ajaxFormCargaRepuesto(event) {
    event.preventDefault();

    btnCargaRepuesto.value = "Enviando...";
    btnCargaRepuesto.disabled = true

    const dataCarga = new FormData(formRepuestoCarga);
    const cargar = await axios.post(formRepuestoCarga.action, dataCarga).then(res => {

        toastr.info('Success:', res.data);
        console.log(res.data);
        location.reload()
        document.getElementById("btnCargaRepuesto").value = "Enviar";
        const elements = Array.prototype.slice.apply(formRepuestoCarga.elements)
        elements.map((element) => { element.classList.remove('is-invalid') })
        $('#formRepuestoCarga').trigger("reset");
        $('#modalRepuestoCarga').modal('hide');

    }).catch(async (error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formRepuestoCarga);
        }
        await toastr.error(`<li> ${error.response.data} </li>`);
        console.error(error.response.data);
    })
    btnCargaRepuesto.value = "Enviar";
    btnCargaRepuesto.disabled = false
}

