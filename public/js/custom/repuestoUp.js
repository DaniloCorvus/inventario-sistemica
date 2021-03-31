(function inicio() {
    const formRepuestoUpdate = document.querySelector('#formRepuestoUpdate')
    const vBIva = formRepuestoUpdate.querySelector('[name=valor_before_iva]')
    const impuesto = formRepuestoUpdate.querySelector('[name=impuesto]')
    const costoIn = formRepuestoUpdate.querySelector('[name=costo_in]')
    const cantidad = formRepuestoUpdate.querySelector('[name=cantidad]')
    const costo_total = formRepuestoUpdate.querySelector('[name=costo_total]')
    let iva = 0;

    vBIva.addEventListener('keyup', calcular)
    impuesto.addEventListener('keyup', calcular)
    cantidad.addEventListener('keyup', calcular)

    vBIva.addEventListener('change', calcular)
    impuesto.addEventListener('change', calcular)
    cantidad.addEventListener('change', calcular)

function calcular() {
	
			const btnUpdateRepuesto = document.getElementById('btnUpdateRepuesto')
			btnUpdateRepuesto.disabled = true
				
			iva = parseFloat(impuesto.value / 100)
			costoIn.value =         currencyFormatDE((parseFloat(vBIva.value) +  parseFloat(iva * vBIva.value)))
			costo_total.value =     currencyFormatDE(parseFloat(cantidad.value * ((parseFloat(vBIva.value) +  parseFloat(iva * vBIva.value)))))
			
			
			if(costo_total.value != 'NaN'){
				btnUpdateRepuesto.disabled = false

			}
			
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