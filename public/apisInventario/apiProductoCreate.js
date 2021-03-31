let btnSaveProducto = document.getElementById("btnSaveProducto");

let formProductoRegister = document.getElementById('formProductoRegister');

formProductoRegister.addEventListener('submit', ajaxFormRegisterProductos);


//Envio de datos ajax
async function ajaxFormRegisterProductos(event) {
    event.preventDefault();

    btnSaveProducto.value = "Enviando...";
    btnSaveProducto.disabled = true

    const bodyRegister = new FormData(formProductoRegister)
    const register = await axios.post(formProductoRegister.action, bodyRegister).then(res => {
     
        refresh(res.data)
        $('#formProductoRegister').trigger("reset");
        $('#modalProductoRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                console.log(clave);
                let container = formProductoRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    btnSaveProducto.value = "Enviar...";
    btnSaveProducto.disabled = false
}


const refresh = async (success) => {
    await toastr.remove()
    await toastr.info('Success:', success);
}


