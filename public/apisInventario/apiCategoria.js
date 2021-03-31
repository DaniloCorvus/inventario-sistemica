
let categorias = [];
let $body = document.querySelector("#bodyTableCategorias");
let btnSaveCategorias = document.getElementById("btnSaveCategorias");
let btnUpdateCategoria = document.getElementById("btnUpdateCategoria");

let formCategoriaRegister = document.getElementById('formCategoriaRegister');
formCategoriaRegister.addEventListener('submit', ajaxFormRegisterCategorias);

let formCategoriaUpdate = document.getElementById('formCategoriaUpdate');
formCategoriaUpdate.addEventListener('submit', ajaxFormUpdateCategorias);


const info = () => {
    if (categorias.length == 0) {
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
        const response = await axios.get(`${SITEURL}/categorias`);
        categorias = Object.values((await response).data)
        await drawTable(categorias, $body, 'Categoria');
        if (document.getElementById('infoTable') != null) {
            document.getElementById('infoTable').remove()
        }
    } catch (error) {
        console.error(error);
    }
}


//Envio de datos ajax a crear 
async function ajaxFormRegisterCategorias(event) {
    event.preventDefault();

    btnSaveCategorias.value = "Enviando...";
    btnSaveCategorias.disabled = true

    const bodyRegister = new FormData(formCategoriaRegister)
    const register = await axios.post(formCategoriaRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formCategoriaRegister').trigger("reset");
        $('#modalCategoriasRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formCategoriaRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveCategorias").value = "Enviar";
    btnSaveCategorias.disabled = false
}

//Envio de datos ajax a actualizar
async function ajaxFormUpdateCategorias(event) {
    event.preventDefault();

    btnUpdateCategoria.value = "Enviando..."
    btnUpdateCategoria.disabled = true

    const dataUpdate = new FormData(formCategoriaUpdate);
    const update = await axios.post(formCategoriaUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        console.log(res.data);
        $('#formCategoriaUpdate').trigger("reset");
        $('#modalCategoriaUpdate').modal('hide');

    }).catch((error) => {
        for (var clave in error.response.data.errors) {
            let container = formCategoriaUpdate.elements.namedItem(clave);
            container.classList.add('is-invalid');
            warning = document.createTextNode(`${(error.response.data.errors[clave])}`);
            insertAfter(warning, container);
        }
    })

    document.getElementById("btnUpdateCategoria").value = "Enviar";
    btnUpdateCategoria.disabled = false
}


// Eliminar Categorias
function eliminarCategoria(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = `${SITEURL}/categorias/${ente_id}`
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


async function editarCategoria(ente_id) {

    const url = SITEURL + '/categorias/' + ente_id
    const modelEdit = await axios.get(url)
    switch (modelEdit.status) {
        case 200:
            console.log(modelEdit);
            formCategoriaUpdate.id.value = modelEdit.data.id;
            formCategoriaUpdate.nombre.value = modelEdit.data.nombre;
            formCategoriaUpdate.descripcion.value = modelEdit.data.descripcion;
            $('#modalCategoriaUpdate').modal('show')
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
