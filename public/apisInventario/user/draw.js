const drawTable = async (models, $body, entidad) => {

    console.log(models);

    models.forEach((model) => {

        const $tr = document.createElement("tr");
        Object.keys(models[0]).forEach((key) => {
            if (key != 'id') {
                let $cell = document.createElement("td");
                $cell.textContent = model[key];
                $tr.appendChild($cell);
            }
            if (key == 'id') {
                let $cell = document.createElement("td");
                $cell.innerHTML = `
                <div class="d-flex flex-row align-items-center justify-content-between">
                        <a class="btn rounded-circle btn-sm btn-danger text-white mr-1 " href="javascript:void(0)"
                            onclick="eliminar${entidad}(${model[key]})" title="Eliminar">
                            <i class="fa  fa-trash" aria-hidden="true"></i>
                        </a>
                </div>`

                $tr.appendChild($cell);
            }
        })

        $body.appendChild($tr);
    });
}

const insertAfter = (newNode, existingNode) => {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}