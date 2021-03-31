const customForm = document.querySelector('#formClienteRegister')
const select = customForm.querySelector('[name=tipo_identificacion]')
const apellido = customForm.querySelector('[name=apellido]')
const blocknombre = customForm.querySelector('#blockNombre')
const blockApellido = customForm.querySelector('#blockApellido')

select.addEventListener('change', (e) => {
    if (e.target.value == "Nit") {
        apellido.removeAttribute('required')
        blockApellido.style.display = 'none'
        console.log(1 + e.target.value)
        blocknombre.classList.replace('col-md-6', 'col-md-12')
    } else {
        apellido.setAttribute('required', true)
        blockApellido.style.display = 'block'
        console.log(2 + e.target.value)
        blocknombre.classList.replace('col-md-12', 'col-md-6')
    }
})
