
const validateDateReparado = () => {


    if (formServiceUpdate.fecha_reparado.value >= formServiceUpdate.fecha_inicio.value) {
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


    if (formServiceUpdate.fecha_reparado.value == '') {
        document.getElementById("btnUpdateService").disabled = true;
        toastr.error('Error', 'Debes Completa fecha Reparado')

    } else {
        if (formServiceUpdate.fecha_finalizado.value >= formServiceUpdate.fecha_inicio.value & formServiceUpdate.fecha_finalizado.value >= formServiceUpdate.fecha_reparado.value) {
            document.getElementById("btnUpdateService").disabled = false;

        } else {
            document.getElementById("btnUpdateService").disabled = true;
            toastr.error('Error', 'Fechas incongruentes')

        }
    }
}


