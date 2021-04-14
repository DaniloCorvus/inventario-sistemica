let btnGuardar = document.getElementById("btnGuardar");

let formGuardar = document.getElementById('formGuardar');
formGuardar.addEventListener('submit', ajaxformGuardar);



async function ajaxformGuardar(event) {
    event.preventDefault();
    if (productoArray.length <= 0) {
        return false
    }

    btnGuardar.value = "Enviando...";
    btnGuardar.disabled = true

    let data = new FormData();
    data.append( 'from_cellar_id',document.getElementById('from_cellar_id').value )
    data.append( 'to_cellar_id',document.getElementById('to_cellar_id').value )
    data.append( 'productos',JSON.stringify( productoArray ) )


    const register = await axios.post(formGuardar.action, data, { responseType: 'blob',  },).then(res => {

        if (res.status != 200) {
            toastr.error('Error', res.data)
        } else {
            ventaArray = [];
            toastr.info('Traslado correctamente')
            formGuardar.reset()
            window.location.reload()
        }

    }).catch((error) => {
        // if (error.response.data.errors) {
        //     for (var clave in error.response.data.errors) {
        //         let container = formVentaRegister.elements.namedItem(clave);
        //         container.classList.add('is-invalid');
        //         toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
        //     }
        toastr.error('Error', error.response)
        console.error(error.data);
        // }
    })
    document.getElementById("btnGuardar").value = "Enviar";
    btnGuardar.disabled = false
}
