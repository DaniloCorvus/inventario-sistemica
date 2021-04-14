
let btnBuscarCodigo = document.getElementById("btnBuscarCodigo");



let formCodigoBuscar = document.getElementById('formCodigoBuscar');
formCodigoBuscar.addEventListener('submit', ajaxFormCodigo);


let bodyTableCodigos = document.getElementById('bodyTableCodigos');
let inputCodigo = document.getElementById('codigo');

let total_bruto = document.getElementById('total_bruto')
let total_impuesto = document.getElementById('impuesto')
let total = document.getElementById('total')
let total_rtFuente = document.getElementById('total_rtFuente')


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
                                'valorTotal':0 ,
                                'valorSubTotal':0,
                                'valorImpuestoSubTotal':0,
                                'valorRtFuente':0,
                                'rtFuente':0,
                                'cantidad':0 , 'serieSelected':'',
                                'impuesto':0 ,'series':[] })
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
            console.log(inv,'in');
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

                ventaArray[pos].serieSelected +=   ` ${inv.serie} (${inv.ubicacion}) : ${valor} <br>`
                ventaArray[pos].series = selecteds
            }

        });

    }

    ventaArray[pos].cantidad = elemt.value
        //ventaArray[pos].valorTotal = elemt.value * ventaArray[pos].producto.costo_venta

        /*  ventaArray[pos].valorTotal = ((elemt.value * ventaArray[pos].producto.costo_venta) +
        (elemt.value * ventaArray[pos].producto.costo_venta * (  ventaArray[pos].impuesto /100) )     ) */
        totalizar(pos);
        drawBodyVenta()
        drawValors();

}



const reCalcular = (pos, elemt) => {
    console.log(pos,elemt);
    ventaArray[pos].producto.costo_venta = elemt.value
    totalizar(pos);
    drawBodyVenta()
    drawValors();
}

const reCalcularImp = (pos, elemt) => {
    console.log(pos,elemt);
    ventaArray[pos].impuesto = elemt.value
    totalizar(pos);
    drawBodyVenta()
    drawValors();
}

const totalizar = (pos) => {

    ventaArray[pos].valorSubTotal =   Number(ventaArray[pos].producto.costo_venta * ventaArray[pos].cantidad).toFixed(2);
    ventaArray[pos].valorImpuestoSubTotal =  Number(ventaArray[pos].producto.costo_venta * ventaArray[pos].cantidad * (ventaArray[pos].impuesto/100) ).toFixed(2)  ;
    ventaArray[pos].valorTotal =   Number(parseFloat( ventaArray[pos].valorSubTotal) + parseFloat( ventaArray[pos].valorImpuestoSubTotal )).toFixed(2)
    reCalcularRTF(pos);
   /*  drawBodyVenta()
    drawValors(); */
}

const eliminarProducto = (pos, elem) =>{

        ventaArray.splice(pos,1)
        drawBodyVenta()
        drawValors();

    }
    const RTF = ( pos , elem) =>{
        console.log(elem.value,'---ggg--');
        ventaArray[pos].rtFuente = elem.value
        reCalcularRTF(pos);
    }

    const reCalcularRTF = ( pos) =>{
        console.log('rt1', ventaArray[pos].rtFuente);
        ventaArray[pos].valorRtFuente =  Number( parseFloat( ventaArray[pos].valorSubTotal) * ( parseFloat( ventaArray[pos].rtFuente / 100) ) ).toFixed(2)
        console.log('rt2', ventaArray[pos].valorRtFuente);
        drawBodyVenta()
        drawValors();
}


const drawBodyVenta = () => {
    bodyTableCodigos.innerHTML = null
    /* <td>${element.producto.descripcion}</td> */
    ventaArray.forEach((element, index) => {
        bodyTableCodigos.innerHTML += `
        <tr>

        <td>${element.producto.id}</td>
        <td>${element.producto.modelo}</td>
        <td>${element.producto.total}</td>
        <td><input type="number"  class="form-control form-control-sm p-0 m-0 text-center" name="cantidad"
        value="${element.cantidad}"  autocomplete="off"  onchange ="calcular(${index}, this)"></td>
        <td id="${'serie'+index}" class="d"> ${element.serieSelected} </td>
        <td><input id="costo_venta" type="number"  class="form-control form-control-sm p-0 m-0 text-center" name="costo_venta"
        value="${element.producto.costo_venta}"  autocomplete="off" onchange="reCalcular(${index}, this)"></td>
        <td><input type="number"  class="form-control form-control-sm p-0 m-0 text-center" name="rt"
        value="${element.rtFuente}" autocomplete="off" onchange="RTF(${index}, this)"></td>
        <td>${element.valorRtFuente}</td>
        <td><input type="number"  class="form-control form-control-sm p-0 m-0 text-center" name="impuesto"
        value="${element.impuesto}" autocomplete="off" onchange ="reCalcularImp(${index}, this)"></td>

        <td>${element.valorImpuestoSubTotal}</td>
        <td>${element.valorSubTotal}</td>
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
        total_bruto.value =  element.valorSubTotal
      //  total_impuesto.value =  parseFloat(element.impuesto) + parseFloat(total_bruto.value)
        total_impuesto.value =   (element.valorImpuestoSubTotal)
        total.value =   (element.valorTotal)
        total_rtFuente.value =   (element.valorRtFuente)
    })


    if (impuesto.value != "" && impuesto.value != null) {
       /*  total.value = (parseFloat( impuesto.value ) + parseFloat(total_bruto.value)) */
    } else {
        total.value = 0;
    }
}


const refresh1 = async (success) => {
    //await dataTableProductox.draw();
  //  await toastr.remove()
    await toastr.info('Success:', 'Producto registrado correctamente');
}


function tipox(event){
    console.log(event);
    var sel = document.getElementById('estado');
    //clear
    var length = sel.options.length;
    for (i = length-1; i >= 0; i--) {
      sel.options[i] = null;
    }
    if(event.target.value == 'Carry In'){
        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode('Pendiente despacho') );
        opt.value = 'Pendiente despacho';
        sel.appendChild(opt);
        opt = document.createElement('option');
        opt.appendChild( document.createTextNode('Despachado') );
        opt.value = 'Despachado';
        sel.appendChild(opt);
        opt = document.createElement('option');
        opt.appendChild( document.createTextNode('Venta en reserva') );
        opt.value = 'Venta en reserva';
        sel.appendChild(opt);
    }else{

        var opt = document.createElement('option');
        opt.appendChild( document.createTextNode('Despachado') );
        opt.value = 'Despachado';
        sel.appendChild(opt);

        opt = document.createElement('option');
        opt.appendChild( document.createTextNode('Venta en reserva') );
        opt.value = 'Venta en reserva';
        sel.appendChild(opt);
    }

}
