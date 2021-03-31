

let btnUpdateVenta = document.getElementById("btnUpdateVenta");

let formVentaUpdate = document.getElementById('formVentaUpdate');
formVentaUpdate.addEventListener('submit', ajaxFormUpdateVenta);

document.addEventListener('DOMContentLoaded', async function () {
    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableVentas = await $('#dataTableVentas').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        retrieve: true,

        ajax: `/ventas`,

        // <th>Observacion</th>
        // <th>Valor/unidad</th>
        // <th>iva</th>
        // <th>Total</th>
        // <th>Aciones</th>

        columns: [
            {
                data: 'observaciones',
                name: 'observaciones',
                orderable: false,
                searchable: false
            },
            {
                data: 'total_bruto',
                name: 'total_bruto',
                orderable: false,
                searchable: false
            },
            {
                data: 'iva',
                name: 'iva',
                orderable: false,
                searchable: false
            },
            {
                data: 'total',
                name: 'total',
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
    })
})

/* 
async function ajaxFormRegisterVentas(event) {
    event.preventDefault();

    btnSaveVenta.value = "Enviando...";
    btnSaveVenta.disabled = true

    const bodyRegister = new FormData(formVentaRegister)
    const register = await axios.post(formVentaRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formVentaRegister').trigger("reset");
        $('#modalVentaRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formVentaRegister);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnSaveVenta").value = "Enviar";
    btnSaveVenta.disabled = false
}
 */
// Traer datos de cliente

async function editarVenta(ente_id) {

    const url = SITEURL + '/ventas/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formVentaUpdate.id.value = edit.data.id;
            formVentaUpdate.nombre.value = edit.data.nombre;
            formVentaUpdate.descripcion.value = edit.data.descripcion;
            $('#modalVentaUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateVenta(event) {
    event.preventDefault();

    btnUpdateVenta.value = "Enviando..."
    btnUpdateVenta.disabled = true

    const dataUpdate = new FormData(formVentaUpdate);
    const update = await axios.post(formVentaUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formVentaUpdate').trigger("reset");
        $('#modalVentaUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            loadErrors(error.response.data.errors, formVentaUpdate);
        }
        console.error(error.response.data);
    })
    document.getElementById("btnUpdateVenta").value = "Enviar";
    btnUpdateVenta.disabled = false
}



// Eliminar Venta
function eliminarVenta(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/ventas/' + ente_id
                try {
                    const success = await axios.delete(url);
                    console.log(success);
                    refresh(success.data)
                } catch (error) {
                    toastr.remove()
                    console.error(error);
                }
            }
            else {
                toastr.remove()
            }
        }
    });
}


const refresh = async (success) => {
    await dataTableVentas.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}

const loadErrors = async (errors, form) => {

    Object.keys(errors).map(async (element) => {
        let container = await form.elements.namedItem(element);
        await container.classList.add('is-invalid');
        await toastr.error(`<li> ${errors[element]} </li>`);
    })
}


// //Envio de datos ajax a crear 
// async function ajaxFormRegisterVentas(event) {
//     event.preventDefault();

//     btnSaveVentas.value = "Enviando...";
//     btnSaveVentas.disabled = true
//     let data = [];
//     data.push({ 'total_bruto': total_bruto.value })
//     data.push({ 'impuesto': impuesto.value })
//     data.push({ 'total': total.value })
//     data.push({ 'cliente_id': formVentaRegister.cliente_id.value })
//     data.push({ 'productos': ventaArray })
//     const register = await axios.post(formVentaRegister.action, data, { responseType: 'blob' },).then(res => {

//         const url = window.URL.createObjectURL(new Blob([res.data]));
//         const link = document.createElement('a');
//         link.href = url;
//         nombre = res.headers["content-disposition"].split("filename=")[1]
//         link.setAttribute('download', nombre);
//         document.body.appendChild(link);
//         link.click();

//         // console.log(res.data);
//         bodyTableCodigos.innerHTML = null;
//         ventaArray = [];
//         toastr.info('Remision guardada correctamente')
//         getInfo();
//         getData();
//         $('#formVentaRegister').trigger("reset");
//         $('#modalVentaRegister').modal('hide');


//     }).catch((error) => {
//         if (error.response.data.errors) {
//             for (var clave in error.response.data.errors) {
//                 let container = formVentaRegister.elements.namedItem(clave);
//                 container.classList.add('is-invalid');
//                 toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
//             }
//             console.error(error.response.data);
//         }
//     })
//     document.getElementById("btnSaveVentas").value = "Enviar";
//     btnSaveVentas.disabled = false
// }
