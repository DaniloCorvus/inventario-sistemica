
const selectCliente = document.getElementById('selectionClientesInServiceRegister')
const phones = document.getElementById('sendMessage')

selectCliente.addEventListener('blur', async () => {

    if (selectCliente.value) {

        if (document.getElementById('st')) {
            document.getElementById('st').remove();
        }

        // await toastr.info('Verificando...')
        const verify = await axios.get(`/verify?cliente=${formServiceRegister.cliente_id.value}`)
            .then(res => {

                hmtl = `<div class="form-group col-md-6" id="st">
                        <label class="text-dark">Seleccione Telefono</label>
                        <select class="form-control" name="telefono">
                        <option value="${res.data.cliente.telefono}">${res.data.cliente.telefono}</option>
                        <option value="${res.data.cliente.opcional_telefono}">${res.data.cliente.opcional_telefono}</option>
                        </select>
                        </div>`;

                toastr.info(`El ultimo servicio ingresado es fue : ${res.data.service} En ${res.data.fecha_inicio} 
                     \n Modelo  ${res.data.equipo.modelo} 
                     \n Serie ${res.data.equipo.serie} 
                     \n Equipo ${res.data.equipo.producto.nombre}`);
                // toastr.remove()

                phones.insertAdjacentHTML('afterend', hmtl)

            })
    }

})

const selectEquipo = document.getElementById('selectionEquiposInServiceRegister')

selectEquipo.addEventListener(['blur'], async () => {

    if (selectEquipo.value) {

        const verify = await axios.get(`/verifyequipo?equipo=${formServiceRegister.equipo_id.value}`)
            .then(res => {

                toastr.info(
                    `El equipo tiene ${res.data.data.ingresos} ingresos, 
                \n El ultimo con servicio : ${res.data.data.ultimo.service} 
                \n Fecha : ${res.data.data.ultimo.fecha_inicio}
                \n En ultimos meses  3: ${res.data.data.cantidad} Ingresos`
                )
            })
    }

})
