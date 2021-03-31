(function inicio() {
    const formUpdate = document.querySelector('#formProductoRegister')
    const vBIva = formUpdate.querySelector('[name=costo_antes_iva]')
    const impuesto = formUpdate.querySelector('[name=impuesto]')
    const costoIn = formUpdate.querySelector('[name=costo_in]')
    const cantidad = formUpdate.querySelector('[name=cantidad]')
    const costo_total = formUpdate.querySelector('[name=costo_total]')
    let iva = 0;

    vBIva.addEventListener('keyup', calcular)
    impuesto.addEventListener('keyup', calcular)
    cantidad.addEventListener('keyup', calcular)

    vBIva.addEventListener('change', calcular)
    impuesto.addEventListener('change', calcular)
    cantidad.addEventListener('change', calcular)

    function calcular() {

        // const btnSaveRepuesto = document.getElementById('btnSaveRepuesto')
        // btnSaveRepuesto.disabled = true

        iva = parseFloat(impuesto.value / 100)
        costoIn.value = currencyFormatDE((parseFloat(vBIva.value) + parseFloat(iva * vBIva.value)))
        costo_total.value = currencyFormatDE(parseFloat(cantidad.value * ((parseFloat(vBIva.value) + parseFloat(iva * vBIva.value)))))


        // if (costo_total.value != 'NaN') {
        //     btnSaveRepuesto.disabled = false
        // }

    }

    function currencyFormatDE(num) {
        return (
            num
                .toFixed(2) // always two decimal digits
                .replace('.', ',') // replace decimal point character with ,
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        ) // use . as a separator
    }
})()

