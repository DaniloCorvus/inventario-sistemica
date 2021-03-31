let btnUpdateVenta = document.getElementById("btnUpdateVenta");

let formVentaUpdate = document.getElementById('formVentaUpdate');

formVentaUpdate.addEventListener('submit', ajaxFormUpdateVenta);

//Envio de datos ajax a actualizar
async function ajaxFormUpdateVenta(event) {
    event.preventDefault();
  
  
     btnUpdateVenta.value = "Enviando..."
    btnUpdateVenta.disabled = true

    const dataUpdate = new FormData(formVentaUpdate);
    const update = await axios.post(formVentaUpdate.action, dataUpdate).then(async res => {
        await refresh(res.data)
        $('#formVentaUpdate').trigger("reset");
        $('#modalVentaUpdate').modal('hide');
       location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formVentaUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateVenta").value = "Enviar";
    btnUpdateVenta.disabled = false 
}
