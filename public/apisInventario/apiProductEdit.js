let btnUpdateProducto = document.getElementById("btnUpdateProducto");

let formProductoUpdate = document.getElementById('formProductoUpdate');
formProductoUpdate.addEventListener('submit', ajaxFormUpdateProducto);

//Envio de datos ajax a actualizar
async function ajaxFormUpdateProducto(event) {
    event.preventDefault();

    btnUpdateProducto.value = "Enviando..."
    btnUpdateProducto.disabled = true

    const dataUpdate = new FormData(formProductoUpdate);

    const update = await axios.post(formProductoUpdate.action, dataUpdate).then(res => {
        console.log(res);
        toastr.error(`<li> ${res.data} </li>`);
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formProductoUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateProducto").value = "Enviar";
    btnUpdateProducto.disabled = false
}

document.addEventListener('DOMContentLoaded', async function () {
    console.log(data);
    // formProductoUpdate.cant_disponible.value = data.cant_disponible,
    formProductoUpdate.cantidad.value = data.cantidad
    formProductoUpdate.id.value = data.id
    // formProductoUpdate.codigo.value = 123456789
    formProductoUpdate.cod_interno.value = data.cod_interno
    // formProductoUpdate.cellar_id.value = data.cellar_id,
    formProductoUpdate.confirmacion.value = data.confirmacion,
        formProductoUpdate.cellar_id.value = data.cellar_id,
        formProductoUpdate.costo_in.value = data.costo_in,
        formProductoUpdate.delivery_orden.value = data.delivery_orden,
        formProductoUpdate.costo_antes_iva.value = data.costo_antes_iva,
        formProductoUpdate.orden_compra.value = data.orden_compra,
        // formProductoUpdate.costo_promosion.value = data.costo_promosion,
        formProductoUpdate.costo_total.value = data.costo_total,
        formProductoUpdate.costo_venta.value = data.costo_venta,
        formProductoUpdate.descripcion.value = data.descripcion,
        formProductoUpdate.estado.value = data.estado,
        formProductoUpdate.fecha_compra.value = data.fecha_compra,
        formProductoUpdate.fecha_recibido.value = data.fecha_recibido,
        formProductoUpdate.fecha_solicitud.value = data.fecha_solicitud,
        formProductoUpdate.guia.value = data.guia,
        formProductoUpdate.id.value = data.id,
        formProductoUpdate.impuesto.value = data.impuesto,
        formProductoUpdate.modelo.value = data.modelo,
        formProductoUpdate.num_factura.value = data.num_factura,
        formProductoUpdate.num_parte.value = data.num_parte,
        formProductoUpdate.num_pedido.value = data.num_pedido,
        formProductoUpdate.observacion.value = data.observacion,
        // formProductoUpdate.optimo.value = data.optimo,
        // formProductoUpdate.pedido_id.value = data.pedido_id,
        formProductoUpdate.proveedor_id.value = data.proveedor_id,
        formProductoUpdate.serie.value = data.serie,
        formProductoUpdate.ubicacion.value = data.ubicacion
})