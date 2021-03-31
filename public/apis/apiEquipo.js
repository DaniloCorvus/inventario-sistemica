let btnSaveEquipo = document.getElementById("btnSaveEquipo");
let btnUpdateEquipo = document.getElementById("btnUpdateEquipo");


let formEquipoRegister = document.getElementById('formEquipoRegister'); formEquipoRegister.addEventListener('submit', ajaxFormRegisterEquipos);

let formEquipoUpdate = document.getElementById('formEquipoUpdate'); formEquipoUpdate.addEventListener('submit', ajaxFormUpdateEquipo);

document.addEventListener('DOMContentLoaded', async function () {

    // datatables settings
    $.fn.dataTable.ext.errMode = 'none';
    dataTableEquipos = await $('#dataTableEquipos').DataTable({
       
        autoWidth: false,
       

        ajax: SITEURL + "/equipos/",

        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'producto.nombre',
                name: 'producto.nombre'
            },

            {
                data: 'modelo',
                name: 'modelo'
            },

            {
                data: 'serie',
                render: function (data, type, row, meta) {
                    return '<a href="javascript:void(0)" onclick="editarEquipo(' + row.id + ')" > ' + data + '</a>';
                }
            },

            {
                data: 'services',
                render: function (data) {
                    return data.map(service => {
                        return `<span>${' GA-' + service.id}</span>`
                    })
                }
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
        },
        order: [[0, 'Desc'], [1, 'Desc']]
    });
})


//Envio de datos ajax
async function ajaxFormRegisterEquipos(event) {
    event.preventDefault();

    btnSaveEquipo.value = "Enviando...";
    btnSaveEquipo.disabled = true

    const bodyRegister = new FormData(formEquipoRegister)
    const register = await axios.post(formEquipoRegister.action, bodyRegister).then(res => {
        toastr.info('Success', res.data)
        $('#formEquipoRegister').trigger("reset");
        $('#modalEquipoRegister').modal('hide');
        window.location.reload()
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formEquipoRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveEquipo").value = "Enviar";
    btnSaveEquipo.disabled = false
}

// Traer datos de cliente

async function editarEquipo(ente_id) {

    const url = SITEURL + '/equipos/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:
            formEquipoUpdate.id.value = edit.data.id;
            formEquipoUpdate.num_factura.value = edit.data.num_factura;
            formEquipoUpdate.fecha_compra.value = edit.data.fecha_compra;
            formEquipoUpdate.cliente_id.value = edit.data.cliente_id;
            formEquipoUpdate.marca.value = edit.data.marca_id;
            formEquipoUpdate.modelo.value = edit.data.modelo;
            formEquipoUpdate.serie.value = edit.data.serie;
            formEquipoUpdate.imei_uno.value = edit.data.imei_uno;
            formEquipoUpdate.imei_dos.value = edit.data.imei_dos;
            formEquipoUpdate.procedencia.value = edit.data.procedencia;
            formEquipoUpdate.garantia.value = edit.data.garantia;
            formEquipoUpdate.referencia.value = edit.data.referencia;
            formEquipoUpdate.v_declarado.value = edit.data.v_declarado;
            formEquipoUpdate.descripcion.value = edit.data.descripcion;
            formEquipoUpdate.observacion.value = edit.data.observacion;
            $('#modalEquipoUpdate').modal('show')
            $('#modalEquipoUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateEquipo(event) {
    event.preventDefault();

    btnUpdateEquipo.value = "Enviando..."
    btnUpdateEquipo.disabled = true

    const dataUpdate = new FormData(formEquipoUpdate);
    const update = await axios.post(formEquipoUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formEquipoUpdate').trigger("reset");
        $('#modalEquipoUpdate').modal('hide');
    }).catch((error) => {
        console.log(error);
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formEquipoUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateEquipo").value = "Enviar";
    btnUpdateEquipo.disabled = false
}



// Eliminar Equipo
function eliminarEquipo(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/equipos/' + ente_id
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

