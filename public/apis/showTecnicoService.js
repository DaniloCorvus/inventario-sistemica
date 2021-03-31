

/* Función que suma o resta días a una fecha, si el parámetro
   días es negativo restará los días*/
function sumarDias(fecha, dias) {
    fecha.setDate(fecha.getDate() + dias);
    return fecha.toJSON().slice(0, 10);
}



const validateDateReparado = () => {


    if (formServiceUpdate.fecha_reparado.value > formServiceUpdate.fecha_inicio.value) {
        document.getElementById("btnUpdateService").disabled = false;


        if (formServiceUpdate.fecha_reparado.value > sumarDias(new Date(), 3)) {
            document.getElementById("btnUpdateService").disabled = true;
            toastr.error('Error', 'Fechas incongruentes')
        }

        if (formServiceUpdate.fecha_reparado.value < sumarDias(new Date(), -3)) {
            document.getElementById("btnUpdateService").disabled = true;
            toastr.error('Error', 'Fechas incongruentes')
        }

    } else {
        document.getElementById("btnUpdateService").disabled = true;
        toastr.error('Error', 'Fechas incongruentes')

    }

}


const validateDateEntregado = () => {


    if (formServiceUpdate.fecha_finalizado.value > formServiceUpdate.fecha_inicio.value & formServiceUpdate.fecha_finalizado.value >= formServiceUpdate.fecha_reparado.value) {
        document.getElementById("btnUpdateService").disabled = false;

    } else {
        document.getElementById("btnUpdateService").disabled = true;
        toastr.error('Error', 'Fechas incongruentes')

    }

}

// const blockValores = () => {
//     console.log('activado');
//     if (isNaN(formServiceUpdate.valor_obra.value)) {
//         formServiceUpdate.valor_obra.disabled = true;
//     }
// }


// const btnBlockService = document.getElementById('btnBlockService')
// btnBlockService.addEventListener('click', blockValores)


const evidenciaCharge = () => {

    fetch(SITEURL + '/evidencias/service/' + service.id, {
        mode: 'cors',
        method: 'GET',
        headers: {
            accept: 'application/json'
        }
    }).then(res => res.json().then(data => {

        html = ''
        const bodyEvidencias = document.querySelector('#evidencias')

        data.map(evidencia => {
            html += `
            <div class="card col-md-4 p-3 ">
                <div class="card-title text-center">
                     <h5 class="card-title">${evidencia.descripcion}</h5>
                </div>
                <div class="card-body">
                    <a href="${'/file/' + evidencia.img}"  target="_blank" data-lightbox="photos"><img class="img-fluid"
                    src="${'/file/' + evidencia.img}">
                    </a>
                </div>
                <div class="card-footer bg-white">
                    <a class="btn btn-danger delete-documento" href="javascript:void(0)"
                    data-toggle="tooltip" title="Eliminar" onClick="eliminarEvidencia(${evidencia.id})">
                        <i class="fa fa-fw fa-trash"></i>
                    </a>
                </div>
            </div>
            `
        })

        bodyEvidencias.innerHTML = html

    }))
        .catch(error => console.log(error))

}

(function () {

    let btnUpdateEquipo = document.getElementById("btnUpdateEquipo");
    let formEquipoUpdate = document.getElementById('formEquipoUpdate');
    formEquipoUpdate.addEventListener('submit', ajaxFormUpdateEquipo);


    let btnUpdateCliente = document.getElementById("btnUpdateCliente");
    let formClienteUpdate = document.getElementById('formClienteUpdate');
    formClienteUpdate.addEventListener('submit', ajaxFormUpdateCliente);


    formServiceUpdate.id.value = service.id;
    formServiceUpdate.user_id.value = service.user_id;
    document.querySelector('.numService').innerHTML = service.id;
    formServiceUpdate.cliente_id.value = service.cliente_id;
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
    formServiceUpdate.radicado.value = service.radicado;


    if (service.reporte != null) {
        formServiceUpdate.reporte.disabled = true
    }

    if (service.tipo_id != null) {
        formServiceUpdate.tipo_id.disabled = true
    }

    if (service.modo_id != null) {
        formServiceUpdate.modo_id.disabled = true
    }

    if (service.user_id != null) {
        formServiceUpdate.user_id.disabled = true
    }

    if (service.fecha_finalizado != null) {
        formServiceUpdate.fecha_reparado.disabled = true
        formServiceUpdate.fecha_finalizado.disabled = true
    }


    formServiceUpdate.valor_obra.value = service.valor_obra;
    formServiceUpdate.valor_cotizado.value = service.valor_cotizado;

    if (service.valor_obra != null) {
        formServiceUpdate.valor_obra.disabled = true
    }

    if (service.valor_aprobado != null) {
        formServiceUpdate.valor_aprobado.disabled = true
    }

    if (service.valor_cotizado != null) {
        formServiceUpdate.valor_cotizado.disabled = true
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

   

    editarEquipo(service.equipo_id)
    editarCliente(service.cliente_id)

    // Traer datos de cliente
    function editarEquipo(ente_id) {

        const url = SITEURL + '/equipos/' + ente_id + '/edit'

        fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
            .then(response => {
                switch (response.status) {
                    case 200:
                        response.json().then(success => {
                            formEquipoUpdate.id.value = success.id;
                            formEquipoUpdate.num_factura.value = success.num_factura;
                            formEquipoUpdate.fecha_compra.value = success.fecha_compra;
                            formEquipoUpdate.cliente_id.value = success.cliente_id;
                            formEquipoUpdate.marca.value = success.marca;
                            formEquipoUpdate.modelo.value = success.modelo;
                            formEquipoUpdate.serie.value = success.serie;
                            formEquipoUpdate.imei_uno.value = success.imei_uno;
                            formEquipoUpdate.imei_dos.value = success.imei_dos;
                            formEquipoUpdate.procedencia.value = success.procedencia;
                            formEquipoUpdate.garantia.value = success.garantia;
                            formEquipoUpdate.referencia.value = success.referencia;
                            formEquipoUpdate.descripcion.value = success.descripcion;
                            formEquipoUpdate.observacion.value = success.observacion;
                            $('#modalEquipoUpdate').modal('show')
                        });
                        break;
                    default:
                        throw response.json().then(error => {
                            throw new Error(error); // (*)
                        })
                        break;
                }
            })
            .catch(error => {
                console.log('request failed', error);
            });
    }

    function ajaxFormUpdateEquipo(event) {
        event.preventDefault();

        const dataUpdate = new FormData(formEquipoUpdate);
        btnUpdateEquipo.value = "Enviando..."

        fetch(formEquipoUpdate.action, {
            method: 'POST',
            body: dataUpdate,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
            .then(response => {
                switch (response.status) {
                    case 200:
                        response.json().then(success => {
                            toastr.info('Success:', success);
                            // dataTableEquipos.draw();
                            location.reload();
                            document.getElementById("btnUpdateEquipo").value = "Enviar";

                            $('#formEquipoUpdate').trigger("reset");
                            $('#modalEquipoUpdate').modal('hide');
                            for (const campo of formEquipoUpdate.elements) {
                                campo.classList.remove('is-invalid');
                            }
                        });
                        document.getElementById("btnUpdateEquipo").value = "Enviar";
                        break;

                    case 422:
                        throw response.json().then(error => {
                            for (var clave in error.errors) {
                                let container = formEquipoUpdate.elements.namedItem(clave);
                                container.classList.add('is-invalid');
                                toastr.error(`<li> ${error.errors[clave]} </li>`);
                            }
                            document.getElementById("btnUpdateEquipo").value = "Enviar";
                        });
                        break;
                    default:
                        throw response.json().then(error => {
                            throw new Error(error); // (*)
                        })
                        break;
                }
            })
            .catch(error => {
                console.log(error);
            });

    }
    // Traer datos de cliente
    function editarCliente(ente_id) {

        const url = SITEURL + '/clientes/' + ente_id + '/edit'

        fetch(url, {
            method: 'GET',
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
            .then(response => {
                switch (response.status) {
                    case 200:
                        response.json().then(success => {


                            formClienteUpdate.id.value = success.id;
                            formClienteUpdate.nombre.value = success.nombre;
                            if (success.tipo_identificacion == 'Nit') {
                                formClienteUpdate.apellido.removeAttribute('required')
                                blockApellidoUpdate.style.display = 'none'
                                blockNombreUpdate.classList.replace('col-md-6', 'col-md-12')
                            } else {
                                formClienteUpdate.apellido.setAttribute('required', true)
                                blockApellidoUpdate.style.display = 'block'
                                blockNombreUpdate.classList.replace('col-md-12', 'col-md-6')
                            }

                            formClienteUpdate.apellido.value = success.apellido;
                            formClienteUpdate.email.value = success.email;
                            formClienteUpdate.tipo_identificacion.value = success.tipo_identificacion;
                            formClienteUpdate.identificacion.value = success.identificacion;
                            formClienteUpdate.direccion.value = success.direccion;
                            formClienteUpdate.ciudad.value = success.ciudad;
                            formClienteUpdate.departamento.value = success.departamento;
                            formClienteUpdate.barrio.value = success.barrio;
                            formClienteUpdate.telefono.value = success.telefono;
                            formClienteUpdate.opcional_telefono.value = success.opcional_telefono
                            $('#modalClienteUpdate').modal('show')
                        });
                        break;
                    default:
                        throw response.json().then(error => {
                            throw new Error(error); // (*)
                        })
                        break;
                }
            })
            .catch(error => {
                console.log('request failed', error);
            });
    }

    //Envio de datos ajax a actualizar
    function ajaxFormUpdateCliente(event) {
        event.preventDefault();

        const dataUpdate = new FormData(formClienteUpdate);
        btnUpdateCliente.value = "Enviando..."

        fetch(formClienteUpdate.action, {
            method: 'POST',
            body: dataUpdate,
            mode: "cors",
            headers: {
                accept: "application/json",
                'X-CSRF-TOKEN': document.querySelector('#csrf_token').getAttribute('content')
            }
        })
            .then(response => {
                switch (response.status) {
                    case 200:
                        response.json().then(success => {
                            toastr.info('Success:', success);
                            // dataTableClientes.draw();
                            location.reload();
                            document.getElementById("btnUpdateCliente").value = "Enviar";
                            $('#formClienteUpdate').trigger("reset");
                            $('#modalClienteUpdate').modal('hide');
                        });
                        document.getElementById("btnUpdateCliente").value = "Enviar";
                        break;

                    case 422:
                        throw response.json().then(error => {
                            for (var clave in error.errors) {
                                let container = formClienteUpdate.elements.namedItem(clave);
                                container.classList.add('is-invalid');
                                toastr.error(`<li> ${error.errors[clave]} </li>`);
                            }
                            document.getElementById("btnUpdateCliente").value = "Enviar";
                        });
                        break;
                    default:
                        throw response.json().then(error => {
                            throw new Error(error); // (*)
                        })
                        break;
                }
            })
            .catch(error => {
                console.log(error);
            });

    }

    // document.addEventListener('DOMContentLoaded', async function () {
    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableAccesorios = await $('#dataTableAccesorios').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/accesorios/" + service.id,

        columns: [
            {
                data: 'fecha_solicitud',
                name: 'fecha_solicitud',
                orderable: false,
                searchable: false
            },
            {
                data: 'fecha_recibido',
                name: 'fecha_recibido',
                orderable: false,
                searchable: false
            },
            {
                data: 'num_pedido',
                name: 'num_pedido',
                orderable: false,
                searchable: false
            },
            {
                data: 'num_parte',
                name: 'num_parte'
            },
            {
                data: 'delivery_orden',
                name: 'delivery_orden'
            },
            {
                data: 'cod_interno',
                name: 'cod_interno',
                orderable: false,
                searchable: false
            },
            {
                data: 'num_factura',
                name: 'num_factura'
            },
            {
                data: 'valor_before_iva',
                name: 'valor_before_iva',
                orderable: false,
                searchable: false
            },
            {
                data: 'cantidad',
                name: 'cantidad',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],

        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": " Registros _MENU_ ",
            "sSearch": "Buscar:",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }
    });
    // })
    evidenciaCharge()

    // // const totales = () => {

    // fetch(SITEURL + '/totalesgastosyadicionales/service/' + service.id, {
    //     mode: 'cors',
    //     method: 'GET',
    //     headers: {
    //         accept: 'application/json'
    //     }
    // }).then(res => res.json().then(data => {
    //     // console.log(data);
    //     document.getElementById('tGastos').innerText = data.gastos
    //     document.getElementById('tAdicionales').innerText = data.adicionales
    // }))
    // // }


    fetch(SITEURL + '/totalesdinero/' + service.id, {
        mode: 'cors',
        method: 'GET',
        headers: {
            accept: 'application/json'
        }
    }).then(res => res.json().then(data => {
        document.getElementById('totalesdinero').value = data
        if (formServiceUpdate.valor_cargo_cliente.value == document.getElementById('totalesdinero').value) {
            document.querySelector('.container-custom').classList.add("bg-primary")
            formServiceUpdate.fecha_finalizado.disabled = false
        } else {
            formServiceUpdate.fecha_finalizado.disabled = true
        }
    }))




})();


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