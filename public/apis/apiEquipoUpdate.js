        let btnUpdateEquipo = document.getElementById("btnUpdateEquipo");
        let formEquipoUpdate = document.getElementById('formEquipoUpdate');
        formEquipoUpdate.addEventListener('submit', ajaxFormUpdateEquipo);

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
                                formEquipoUpdate.v_declarado.value = success.v_declarado;
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


        //Envio de datos ajax a actualizar
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
