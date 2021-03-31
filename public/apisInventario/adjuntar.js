
let btnBuscarCodigo = document.getElementById("btnBuscarCodigo");



let formCodigoBuscar = document.getElementById('formCodigoBuscar');
formCodigoBuscar.addEventListener('submit', ajaxFormCodigo);


let bodyTableCodigos = document.getElementById('bodyTableCodigos');
let inputCodigo = document.getElementById('codigo');

let total_bruto = document.getElementById('total_bruto')
let impuesto = document.getElementById('impuesto')
let total = document.getElementById('total')


let ventaArray = [];
let producto = [];

//Envio de datos ajax a crear 
async function ajaxFormCodigo(event) {
    event.preventDefault();

    btnBuscarCodigo.value = "Enviando...";
    btnBuscarCodigo.disabled = true


    if (!validarProducto( )) {
           
        const bodyRegister = new FormData(formCodigoBuscar)
        const register = await axios.post(formCodigoBuscar.action, bodyRegister).then(res => {
            if (res.data != "" && res.data != null) {
                ventaArray.push({ 'producto': res.data ,
                                'valorTotal':res.data.costo_venta , 
                                'cantidad':0 , 'serieSelected':''
                                ,'series':[] })
                drawBodyVenta();
                drawValors();
            } 
            inputCodigo.value = null
            formCodigoBuscar.reset()
        }).catch((error) => {
            toastr.error('Error', error.response.data)
        })
    }else{
       
        toastr.error('El producto ya fue registrado con la misma bodega', 'Error')
    }


    document.getElementById("btnBuscarCodigo").value = "Enviar";
    btnBuscarCodigo.disabled = false
}

const validarProducto = () => {
    let codigo = document.getElementById("codigo").value;
    let cellar_id = document.getElementById("cellar_id").value;
    console.log(codigo,'  -  ', cellar_id);

    return  ventaArray.some(d=> d.producto.codigo == codigo && d.producto.inventario[0].cellar_id == cellar_id )

}

const calcular = (pos, elemt) => {
    ventaArray[pos].series = [];
    ventaArray[pos].serieSelected = '';

    if (ventaArray[pos].producto.total <  elemt.value ) {
        toastr.error('Error', 'cantidades insuficientes')
        elemt.value = 0
    }else{
      
     //   return false;
        let cant = 0
        let selecteds = []

        let cantSolicitdata =  parseInt(elemt.value)
        ventaArray[pos].producto.inventario.forEach(inv => {
               let cantidad_disponible = parseInt(inv.cantidad_disponible)
             if ( cant < cantSolicitdata ) {
                
                if (  ( cantSolicitdata - cant ) <= cantidad_disponible ) {
                    valor = cantSolicitdata - cant 
                    cant +=  valor
                    
                    selecteds.push( {'inventario':inv , 'seleccionado': valor} )
                   
                }else{
                    valor = cantidad_disponible
                    cant +=  valor
                    selecteds.push( {'inventario':inv , 'seleccionado': valor } )
                    
                }
                
                ventaArray[pos].serieSelected +=   ` ${inv.serie} - Cant. : ${valor} <br>`
                ventaArray[pos].series = selecteds
            }

        });

    }

    ventaArray[pos].cantidad = elemt.value
        ventaArray[pos].valorTotal = elemt.value * ventaArray[pos].producto.costo_venta
        drawBodyVenta()
        drawValors();
    
}

const reCalcular = (pos, elemt) => {
    console.log(pos,elemt);
    ventaArray[pos].producto.costo_venta = elemt.value
    ventaArray[pos].valorTotal = elemt.value * ventaArray[pos].cantidad
    drawBodyVenta()
    drawValors();
}

const eliminarProducto = (pos, elem) =>{

        ventaArray.splice(pos,1)
        drawBodyVenta()
        drawValors();

}

const drawBodyVenta = () => {
    bodyTableCodigos.innerHTML = null
    ventaArray.forEach((element, index) => {
        bodyTableCodigos.innerHTML += `
        <tr>
        <td>${index + 1}</td>
        <td>${element.producto.descripcion}</td>
        <td>${element.producto.id}</td>
        <td>${element.producto.modelo}</td>
        <td>${element.producto.total}</td>
        <td><input type="text"  class="form-control form-control-sm p-0 m-0 text-center" name="cantidad"
        value="${element.cantidad}" autocomplete="off" onchange ="calcular(${index}, this)"></td>
        <td id="${'serie'+index}"> ${element.serieSelected} </td>
        <td><input id="costo_venta" type="text"  class="form-control form-control-sm p-0 m-0 text-center" name="costo_venta"
        value="${element.producto.costo_venta}" autocomplete="off" onchange="reCalcular(${index}, this)"></td>
        <td>${element.valorTotal}</td>
        <td><a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)" onclick="eliminarProducto(${index},this)"
        title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
        </a></td>

        </tr>`;
    })
}

const drawValors = () => {
    total_bruto.value = 0;
    ventaArray.forEach((element) => {
        total_bruto.value = parseFloat(element.valorTotal) + parseFloat(total_bruto.value)
    })

    if (impuesto.value != "" && impuesto.value != null) {
        total.value = parseFloat(parseFloat((impuesto.value / 100) * total_bruto.value) + parseFloat(total_bruto.value))
    } else {
        total.value = 0;
    }
}


const refresh1 = async (success) => {
    //await dataTableProductox.draw();
  //  await toastr.remove()
    await toastr.info('Success:', 'Producto registrado correctamente');
}