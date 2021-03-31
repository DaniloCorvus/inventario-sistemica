
const addTecnicoModal = (id) => {
    document.getElementById('addTecnicoForm').id.value = id
    $('#addTecnicoModal').modal('show')
}

const registerAdicional = (id) => {
    document.getElementById('formAdicionalRegister').service_id.value = id
    $('#modalAdicionalRegister').modal('show')
}
const registerGasto = (id) => {
    document.getElementById('formminus').service_id.value = id
    $('#minusModal').modal('show')
}

const registerDinero = (id) => {
    document.getElementById('formDinero').service_id.value = id
    $('#DineroModal').modal('show')
}

function show(id) {
    if (document.getElementById) { //se obtiene el id
        const el = document.querySelector(`.${id}`); //se define la variable "el" igual a nuestro div
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
    }
}

(function (d) {
    let tabsI = Array.prototype.slice.apply(d.querySelectorAll('.item-custom'))
    let panelsI = Array.prototype.slice.apply(d.querySelectorAll('.panels-item'))

    const tabContainer = d.querySelector('.tabs')
    tabContainer.addEventListener('click', (evt) => {

        if (evt.target.classList.contains('item-custom')) {
            let i = tabsI.indexOf(evt.target)
            tabsI.map(item => {
                item.classList.remove('active-custom')
                tabsI[i].classList.add('active-custom')
            })

            panelsI.map(item => {
                item.classList.remove('active-panels')
                panelsI[i].classList.add('active-panels')
            })
        }

    })


})(document)

