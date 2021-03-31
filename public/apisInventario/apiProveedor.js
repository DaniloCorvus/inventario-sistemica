let proveedors = [];
let $body = document.querySelector("#bodyTableProveedor");
let btnSaveProveedor = document.getElementById("btnSaveProveedor");
let btnUpdateProveedor = document.getElementById("btnUpdateProveedor");

let formProveedorRegister = document.getElementById('formProveedorRegister');
formProveedorRegister.addEventListener('submit', ajaxFormRegisterProveedors);

let formProveedorUpdate = document.getElementById('formProveedorUpdate');
formProveedorUpdate.addEventListener('submit', ajaxFormUpdateProveedors);


const info = () => {
    if (proveedors.length == 0) {
        const $tr = document.createElement("tr");
        let $cell = document.createElement("td");
        $cell.setAttribute('colspan', 7)
        $cell.setAttribute('id', 'infoTable')
        $cell.textContent = 'Sin datos'
        $tr.appendChild($cell);
        $body.appendChild($tr);
    }
}


const getData = async () => {
    try {
        const response = await axios.get(`${SITEURL}/proveedors`);
        proveedors = Object.values((await response).data)
        await drawTable(proveedors, $body, 'Proveedor');
        if (document.getElementById('infoTable') != null) {
            document.getElementById('infoTable').remove()
        }
    } catch (error) {
        console.error(error);
    }
}


//Envio de datos ajax a crear 
async function ajaxFormRegisterProveedors(event) {
    event.preventDefault();

    btnSaveProveedor.value = "Enviando...";
    btnSaveProveedor.disabled = true

    const bodyRegister = new FormData(formProveedorRegister)
    const register = await axios.post(formProveedorRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formProveedorRegister').trigger("reset");
        $('#modalProveedorsRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formProveedorRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveProveedor").value = "Enviar";
    btnSaveProveedor.disabled = false
}

//Envio de datos ajax a actualizar
async function ajaxFormUpdateProveedors(event) {
    event.preventDefault();

    btnUpdateProveedor.value = "Enviando..."
    btnUpdateProveedor.disabled = true

    const dataUpdate = new FormData(formProveedorUpdate);
    const update = await axios.post(formProveedorUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        console.log(res.data);
        $('#formProveedorUpdate').trigger("reset");
        $('#modalProveedorUpdate').modal('hide');

    }).catch((error) => {
        for (var clave in error.response.data.errors) {
            let container = formProveedorUpdate.elements.namedItem(clave);
            container.classList.add('is-invalid');
            warning = document.createTextNode(`${(error.response.data.errors[clave])}`);
            insertAfter(warning, container);
        }
    })

    document.getElementById("btnUpdateProveedor").value = "Enviar";
    btnUpdateProveedor.disabled = false
}


// Eliminar Proveedors
function eliminarProveedor(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/proveedors/${ente_id}`
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


async function editarProveedor(ente_id) {

    const url = SITEURL + '/proveedors/' + ente_id
    const modelEdit = await axios.get(url)
    console.log(modelEdit);
    switch (modelEdit.status) {
        case 200:
            console.log(modelEdit);
            formProveedorUpdate.id.value = modelEdit.data.id;
            formProveedorUpdate.nombres.value = modelEdit.data.nombres;
            formProveedorUpdate.tipo_identificacion.value = modelEdit.data.tipo_identificacion;
            formProveedorUpdate.identificacion.value = modelEdit.data.identificacion;
            formProveedorUpdate.email.value = modelEdit.data.email;
            formProveedorUpdate.direccion.value = modelEdit.data.direccion;
            formProveedorUpdate.barrio.value = modelEdit.data.barrio;
            formProveedorUpdate.telefono.value = modelEdit.data.telefono;
            formProveedorUpdate.opcional_telefono.value = modelEdit.data.opcional_telefono;
            $('#modalProveedorUpdate').modal('show')
            break;
        default:
            break;
    }
}

const refresh = async (success) => {
    $body.innerHTML = "";
    getData()
    await toastr.remove()
    await toastr.info('Success:', success);
}

if (document.hasFocus()) {
    info()
    getData()
}

