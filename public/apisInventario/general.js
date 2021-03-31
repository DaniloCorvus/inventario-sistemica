const drawTable = async (models, $body, entidad) => {

    console.log(models);

    models.forEach((model) => {

        const $tr = document.createElement("tr");
        Object.keys(models[0]).forEach((key) => {
            if (key != 'id' && key != 'tipo_identificacion' && key != 'created_at' && key != 'updated_at' && key != 'email_verified_at' && key != 'codigo') {
                let $cell = document.createElement("td");
                $cell.textContent = model[key];
                $tr.appendChild($cell);
            }
            if (key == 'id') {
                let $cell = document.createElement("td");
                $cell.innerHTML = `
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <a class="btn rounded-circle btn-sm btn-primary text-white mr-1 " href="javascript:void(0)"
                        onclick="editar${entidad}(${model[key]})" title="Editar">
                        <i class="fa  fa-edit" aria-hidden="true"></i>
                    </a>

                    <a class="btn rounded-circle btn-sm btn-danger text-white mr-1 " href="javascript:void(0)"
                        onclick="eliminar${entidad}(${model[key]})" title="Eliminar">
                        <i class="fa  fa-trash" aria-hidden="true"></i>
                    </a>
                </div>`

                $tr.appendChild($cell);
            }
            if (key == 'codigo') {
                let $cell = document.createElement("td");
                let $conten = document.createElement("img");
                $conten.src = `data:image/png;base64, ${model[key]}`;
                $cell.appendChild($conten)
                $tr.appendChild($cell);
            }
        })

        $body.appendChild($tr);
    });
}

const insertAfter = (newNode, existingNode) => {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}