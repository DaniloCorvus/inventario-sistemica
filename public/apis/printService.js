const showPrintService = (id) => {
    console.log('imprimiendo');
    document.getElementById('formPrint').id.value = id
    $('#printerModal').modal('show')
}

const showPrintServiceDetails = (id) => {
    document.getElementById('formPrint').id.value = id
    $('#printerModal').modal('show')
}