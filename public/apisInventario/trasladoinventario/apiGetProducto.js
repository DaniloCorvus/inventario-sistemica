let btnBuscarCodigo = document.getElementById("btnBuscarCodigo");

let formCodigoBuscar = document.getElementById('formCodigoBuscar');
formCodigoBuscar.addEventListener('submit', ajaxFormCodigo);

let bodyTableCodigos = document.getElementById('bodyTableCodigos');
productoArray = [];



async function ajaxFormCodigo(event) {
    event.preventDefault();



    btnBuscarCodigo.value = "Enviando...";
    btnBuscarCodigo.disabled = true


    if (!validarProducto( )) {

        const bodyRegister = new FormData(formCodigoBuscar)
        const register = await axios.post(formCodigoBuscar.action, bodyRegister).then(res => {
            if (res != "" && res.data != null) {
                console.log(res);
                productoArray = res.data
                drawBodyVenta();
                //drawValors();
            }

            formCodigoBuscar.reset()
        }).catch((error) => {
            console.log(error);
            /* toastr.error('Error', error.response.data) */
        })
    }else{

        toastr.error('El producto ya fue registrado con la misma bodega', 'Error')
    }


    document.getElementById("btnBuscarCodigo").value = "Enviar";
    btnBuscarCodigo.disabled = false


}

function validarProducto() {
    return false
}

const drawBodyVenta = () => {
    bodyTableCodigos.innerHTML = null
    /* <td>${element.producto.descripcion}</td> */
    console.log(productoArray,'prod');
    productoArray.forEach((element, index) => {
        bodyTableCodigos.innerHTML += `
        <tr>

        <td>${element.serie}</td>
        <td>${element.ubicacion}</td>
        <td>${element.cantidad_disponible}</td>
        <td><input type="number"  class="form-control form-control-sm p-0 m-0 text-center" name="nueva_cantidad"
        value="0"  autocomplete="off"  onchange ="calcular(${index}, this)"></td>
        </td>
        <td><input type="text"  class="form-control form-control-sm p-0 m-0 text-center" name="ubicacion" onchange ="ubicar(${index}, this)"
        value=""  autocomplete="off" ></td></td>


        </tr>`;
    })
}

function calcular(index,cantidad) {
    console.log(index,cantidad);
    let cantidadx = parseInt( cantidad.value )
    let prod = productoArray[index];
    if(cantidadx > prod.cantidad_disponible){
        toastr.error('La cantidad es insuficiente', 'Error')
        cantidad.value = 0;
    }else{
        productoArray[index].nueva_cantidad = cantidadx
    }
}

function ubicar(index,cantidad) {



        productoArray[index].nueva_ubicacion = cantidad.value

}
