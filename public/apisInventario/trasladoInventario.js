

let idInv = '';

let form = document.getElementById('formTraslado')
let btnTraslado = document.getElementById('btnTraslado')

form.addEventListener('submit', ajaxForm);
function abrirTranslado(inv){
    idInv = inv;
    console.log(idInv);
}

async function ajaxForm(event) {
    event.preventDefault();

    btnTraslado.value = "Guardando...";
    btnTraslado.disabled = true

    const bodyRegister = new FormData(form)
    bodyRegister.append('id_inventario',idInv)
    console.log(bodyRegister,'body');

    const register = await axios.post(form.action, bodyRegister).then(res => {

        form.reset();
        $("#modalHistoriaRegister").modal("toggle");
        refresh2('Traslado exitoso','success')

        window.location.reload()

    }).catch((error) => {

        //console.error(error.response.data.errors);
        refresh2(error.response.data.errors,'error')
    })
    document.getElementById("btnTraslado").value = "Guardar";
    btnTraslado.disabled = false
}




const refresh2 = async (msj,tipo) => {
   // await dataTableProductox.draw();
    await toastr.remove()
    await toastr[tipo](tipo, msj);
}









