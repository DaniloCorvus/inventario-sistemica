
(function () {

    cargarEquipo();
    cargarCliente();
    evidenciaCharge();


    let formServiceUpdate = document.getElementById('formServiceUpdate');
    const exampleCheck1 = document.getElementById('exampleCheck1')
    const facturaBlock = document.getElementById('facturaBlock')


    formServiceUpdate.id.value = service.id;

    // console.log(service);

    let opciones = service.users.map(user => {
        return `<li class="list-group-item">${user.name} 
        <small class="text font-weight-bold">  porcentaje : </small> 
         ${user.pivot.percent} 
         <p class="text font-weight-bold">  ${ (user.pivot.main == 1) ? 'Principal' : ''}  </p>
         </li>`
    })
    const users = document.getElementById('users')
    users.innerHTML = opciones


    document.querySelector('.numService').innerHTML = service.id;
    document.getElementById('cliente').innerHTML = `<li class="list-group-item">${service.cliente.fullname}  </li>`;



    formServiceUpdate.staff_id.value = service.staff_id;
    formServiceUpdate.estado_id.value = service.estado_id;
    formServiceUpdate.modo_id.value = service.modo_id;
    formServiceUpdate.tipo_id.value = service.tipo_id;
    formServiceUpdate.tipo_reparacion.value = service.tipo_reparacion;
    formServiceUpdate.razon_id.value = service.razon_id;
    formServiceUpdate.equipo_id.value = service.equipo_id;
    formServiceUpdate.fecha_inicio.value = service.fecha_inicio;
    formServiceUpdate.fecha_reparado.value = service.fecha_reparado;
    formServiceUpdate.fecha_finalizado.value = service.fecha_finalizado;
    formServiceUpdate.valor_aprobado.value = service.valor_aprobado;
    formServiceUpdate.happycall_estado.value = service.happycall_estado;
    formServiceUpdate.happycall_calificacion.value = service.happycall_calificacion;
    formServiceUpdate.observacion.value = service.observacion;
    formServiceUpdate.reporte.value = service.reporte;
    formServiceUpdate.accesorio_equipo.value = service.accesorio_equipo;
    formServiceUpdate.radicado.value = service.radicado;

    formServiceUpdate.fecha_promesa.value = service.fecha_promesa;
    formServiceUpdate.fecha_autorizado.value = service.fecha_autorizado;

    if (service.factura) {
        facturaBlock.style.display = 'block'
        exampleCheck1.checked = 'true'
        formServiceUpdate.factura.value = service.factura;
    }


    if (service.reporte != null) {
        formServiceUpdate.reporte.readOnly = true
    }

    if (service.tipo_id != null) {
        formServiceUpdate.tipo_id.readOnly = true
    }

    if (service.modo_id != null) {
        formServiceUpdate.modo_id.readOnly = true
    }
    if (service.fecha_finalizado != null) {
        formServiceUpdate.fecha_reparado.readOnly = true
        formServiceUpdate.fecha_finalizado.readOnly = true
    }

    formServiceUpdate.valor_obra.value = service.valor_obra;
    formServiceUpdate.valor_cotizado.value = service.valor_cotizado;

    if (service.valor_obra != null) {
        formServiceUpdate.valor_obra.readOnly = true
    }

    if (service.valor_aprobado != null) {
        formServiceUpdate.valor_aprobado.readOnly = true
    }

    if (service.valor_cotizado != null) {
        formServiceUpdate.valor_cotizado.readOnly = true
    }

    formServiceUpdate.observacion_happycallestado.value = service.observacion_happycallestado;

    const avs = (array) => Array.prototype.slice.apply(array)

    if (service.adicionales != null) {
        adicionalesT = avs(service.adicionales).reduce((acumulador, { valor }) => parseFloat(acumulador) + parseFloat(valor), 0)

        formServiceUpdate.valor_adicionales.value = adicionalesT
    }
    if (service.gastos != null) {
        gastosT = avs(service.gastos).reduce((acumulador, { valor }) => parseFloat(acumulador) + parseFloat(valor), 0)
        formServiceUpdate.valor_gastos.value = gastosT

    }

    if (service.repuestos != null) {
        repuestosT = avs(service.repuestos).reduce((acumulador, { costo_venta }) => parseFloat(acumulador) + parseFloat(costo_venta), 0)
        formServiceUpdate.valor_repuestos.value = repuestosT

    }


    if (formServiceUpdate.valor_cargo_cliente.value != service.valor_cargo_cliente) {
        document.getElementById('alert-valor-cliente').innerText = 'Cargo sin guardar por favor de click en el boton enviar '
    }


    fetch(SITEURL + '/totalesdinero/' + service.id, {
        mode: 'cors',
        method: 'GET',
        headers: {
            accept: 'application/json'
        }
    }).then(res => res.json().then(data => {
        document.getElementById('totalesdinero').value = data
        if (formServiceUpdate.valor_cargo_cliente.value == document.getElementById('totalesdinero').value) {
            document.querySelector('.container-custom').classList.add("bg-custom")

            // toastr.options = {
            //     "closeButton": true,
            //     "newestOnTop": true,
            //     "progressBar": true,
            //     "positionClass": "toast-top-full-width",
            //     "preventDuplicates": true,
            // }
            
            // toastr["info"]("Este servicio se encuentra cancelado en su totalidad")

            formServiceUpdate.fecha_finalizado.readOnly = false
        } else {
            formServiceUpdate.fecha_finalizado.readOnly = true
        }
    }))




})();


function copiarAlPortapapeles() {
    const contenido = document.getElementById('reporteTenico');
    var range = document.createRange();
    range.selectNode(contenido);
    window.getSelection().addRange(range);

    try {
        // intentar copiar el contenido seleccionado
        var resultado = document.execCommand('copy');
        console.log(resultado ? 'Contenido copiado' : 'No se pudo copiar el Contenido');
    } catch (err) {
        console.log('ERROR al intentar copiar el Contenido');
    }
}

const eliminarAccesorio = (accesorio, service) => {

    fetch(SITEURL + '/repuestos/eliminar/' + accesorio + '/' + service, {
        mode: 'cors',
        method: 'GET',
        headers: {
            accept: 'application/json'
        }
    }).then(res => res.json().then(data => {
        console.log(data);
        toastr.info('Succes', data)
        location.reload()
    }))
}

/* Función que suma o resta días a una fecha, si el parámetro
   días es negativo restará los días*/
function sumarDias(fecha, dias) {
    fecha.setDate(fecha.getDate() + dias);
    return fecha.toJSON().slice(0, 10);
}

const blockDetails = () => {

    for (const campo of formServiceUpdate.elements) {
        campo.readOnly = false
    }
}


exampleCheck1.addEventListener('change', () => {


    if (exampleCheck1.checked) {
        facturaBlock.style.display = 'block'
        formServiceUpdate.factura.setAttribute('required', true)
    } else {
        formServiceUpdate.factura.removeAttribute('required')
        formServiceUpdate.factura.value = ''
        facturaBlock.style.display = 'none'
    }
})

