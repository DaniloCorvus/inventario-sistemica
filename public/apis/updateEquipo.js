let btnUpdateEquipo = document.getElementById("btnUpdateEquipo");
let formEquipoUpdate = document.getElementById('formEquipoUpdate');
formEquipoUpdate.addEventListener('submit', ajaxFormUpdateEquipo);

function cargarEquipo() {

    formEquipoUpdate.id.value = service.equipo.id;
    formEquipoUpdate.num_factura.value = service.equipo.num_factura;
    formEquipoUpdate.fecha_compra.value = service.equipo.fecha_compra;
    formEquipoUpdate.marca.value = service.equipo.marca;
    formEquipoUpdate.modelo.value = service.equipo.modelo;
    formEquipoUpdate.serie.value = service.equipo.serie;
    formEquipoUpdate.imei_uno.value = service.equipo.imei_uno;
    formEquipoUpdate.imei_dos.value = service.equipo.imei_dos;
    formEquipoUpdate.procedencia.value = service.equipo.procedencia;
    formEquipoUpdate.garantia.value = service.equipo.garantia;
    formEquipoUpdate.referencia.value = service.equipo.referencia;
    formEquipoUpdate.descripcion.value = service.equipo.descripcion;
    formEquipoUpdate.observacion.value = service.equipo.observacion;

}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateEquipo(event) {
    event.preventDefault();

    btnUpdateEquipo.value = "Enviando..."
    btnUpdateEquipo.disabled = true

    const dataUpdate = new FormData(formEquipoUpdate);
    const update = await axios.post(formEquipoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formEquipoUpdate').trigger("reset");
        $('#modalEquipoUpdate').modal('hide');
        location.reload();
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formEquipoUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateEquipo").value = "Enviar";
    btnUpdateEquipo.disabled = false
}
