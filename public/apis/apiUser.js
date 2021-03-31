
let btnSaveUser = document.getElementById("btnSaveUser");
let btnUpdateUser = document.getElementById("btnUpdateUser");

let formUserRegister = document.getElementById('formUserRegister');
formUserRegister.addEventListener('submit', ajaxFormRegisterUsers);

let formUserUpdate = document.getElementById('formUserUpdate');
formUserUpdate.addEventListener('submit', ajaxFormUpdateUser);


document.addEventListener('DOMContentLoaded', async function () {
    $.fn.dataTable.ext.errMode = 'none';

    // datatables settings
    dataTableUsers = await $('#dataTableUsers').DataTable({

        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        autoWidth: false,

        ajax: SITEURL + "/users/",

        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'email',
            name: 'email'
        },

        {
            data: 'action',
            name: 'action',
            orderable: false
        },
        ],
        order: [
            [0, 'asc']
        ],

        language: {
            paginate: {
                first: "",
                previous: " ← ",
                next: " → ",
                last: ""
            },
        }

    });

});

//Envio de datos ajax
async function ajaxFormRegisterUsers(event) {
    event.preventDefault();

    btnSaveUser.value = "Enviando...";
    btnSaveUser.disabled = true

    const bodyRegister = new FormData(formUserRegister)
    const register = await axios.post(formUserRegister.action, bodyRegister).then(res => {
        refresh(res.data)
        $('#formUserRegister').trigger("reset");
        $('#modalUserRegister').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formUserRegister.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnSaveUser").value = "Enviar";
    btnSaveUser.disabled = false
}

// Traer datos de cliente

async function editarUser(ente_id) {

    const url = SITEURL + '/users/' + ente_id + '/edit'
    const edit = await axios.get(url)
    switch (edit.status) {
        case 200:

            formUserUpdate.id.value = edit.data.id;
            formUserUpdate.name.value = edit.data.name
            formUserUpdate.identificacion.value = edit.data.identificacion
            formUserUpdate.estado.value = edit.data.estado
            formUserUpdate.email.value = edit.data.email
            formUserUpdate.tipo_contrato.value = edit.data.tipo_contrato
            formUserUpdate.porcentual_home.value = edit.data.porcentual_home
            formUserUpdate.porcentual_taller.value = edit.data.porcentual_taller
            formUserUpdate.eps.value = edit.data.eps
            formUserUpdate.arl.value = edit.data.arl
            formUserUpdate.ccf.value = edit.data.ccf
            formUserUpdate.fecha_c.value = edit.data.fecha_c
            formUserUpdate.fecha_ingreso.value = edit.data.fecha_ingreso
            formUserUpdate.fecha_retiro.value = edit.data.fecha_retiro
            formUserUpdate.direccion.value = edit.data.direccion
            formUserUpdate.telefono.value = edit.data.telefono


            $('#modalUserUpdate').modal('show')
            break;
        default:
            console.log(edit);
            break;
    }
}


//Envio de datos ajax a actualizar
async function ajaxFormUpdateUser(event) {
    event.preventDefault();

    btnUpdateUser.value = "Enviando..."
    btnUpdateUser.disabled = true

    const dataUpdate = new FormData(formUserUpdate);
    const update = await axios.post(formUserUpdate.action, dataUpdate).then(res => {
        refresh(res.data)
        $('#formUserUpdate').trigger("reset");
        $('#modalUserUpdate').modal('hide');
    }).catch((error) => {
        if (error.response.data.errors) {
            for (var clave in error.response.data.errors) {
                let container = formUserUpdate.elements.namedItem(clave);
                container.classList.add('is-invalid');
                toastr.error(`<li> ${error.response.data.errors[clave]} </li>`);
            }
            console.error(error.response.data);
        }
    })
    document.getElementById("btnUpdateUser").value = "Enviar";
    btnUpdateUser.disabled = false
}



// Eliminar User
function eliminarUser(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: async function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = SITEURL + '/users/' + ente_id
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
    await dataTableUsers.draw();
    await toastr.remove()
    await toastr.info('Success:', success);
}


