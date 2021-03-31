
let btnBuscarCodigo = document.getElementById("btnBuscarCodigo");
let formCodigoBuscar = document.getElementById('formCodigoBuscar');

formCodigoBuscar.addEventListener('submit', ajaxFormCodigo);

let dataProduct  = document.getElementById("dataProduct");


let formProductoRegister = document.getElementById('formProductoRegister');
let btnSaveProducto  = document.getElementById('btnSaveProducto');
formProductoRegister.style.visibility  = "hidden";
formProductoRegister.addEventListener('submit', ajaxFormRegisterProductos);
let inputCodigo = document.getElementById('codigo');

let producto = {};
//Envio de datos ajax a crear 
async function ajaxFormCodigo(event) {
    event.preventDefault();

    btnBuscarCodigo.value = "Buscando...";
    btnBuscarCodigo.disabled = true

    const bodyRegister = new FormData(formCodigoBuscar)
    const register = await axios.post(formCodigoBuscar.action, bodyRegister).then(res => {

        
        if (res.data != "" && res.data != null) {
            formProductoRegister.style.visibility = "visible";
            producto = res.data;
            drawDataProduct(res.data);
       
        } else {
            alert('Producto No Encontrado ')
            formProductoRegister.style.visibility  = "hidden";
            dataProduct.innerHTML='';
            inputCodigo.value = null
            formCodigoBuscar.reset()
        }


    }).catch((error) => {
        console.error(error);
    })

    document.getElementById("btnBuscarCodigo").value = "Buscar";
    btnBuscarCodigo.disabled = false
}

async function ajaxFormRegisterProductos(event){
    event.preventDefault();

    btnSaveProducto.value = "Enviando...";
    btnSaveProducto.disabled = true

    const bodyRegister = new FormData(formProductoRegister)
    bodyRegister.append('producto', JSON.stringify( producto ));
    const register = await axios.post(formProductoRegister.action, bodyRegister).then(res => {
        refresh(res['data'])
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
    console.log(success,'info');
    await toastr.remove()
    await toastr.info('Success:', success);
}



function drawDataProduct  (data){
    dataProduct.innerHTML = null

        dataProduct.innerHTML += `
        <div class="col-md-2" >
            <div class="form-group">
                <label for="staticEmail" >Cód. interno</label>
                
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="${data.cod_interno}">
               
            </div>  
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="staticEmail" >Modelo</label>
            
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="${data.modelo}">
                
            </div>  
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="staticEmail" >Número parte</label>
            
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="${data.num_parte}">
            
            </div>  
        </div>

        
        <div class="col-md-4">
            <div class="form-group">
                <label for="staticEmail" >Descripción</label>
            
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="${data.descripcion}">
                
            </div>  
        </div>


        `;
   // })
}


