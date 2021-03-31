
const evidenciaCharge = async () => {

    try {
        const carga = await axios.get(`/evidencias/service/${service.id}`)
        html = ''
        const bodyEvidencias = document.querySelector('#evidencias')

        await carga.data.map(evidencia => {

            html += `
    <div class="card col-md-4 p-3 ">
        <div class="card-title text-center">
             <h5 class="card-title">${evidencia.descripcion}</h5>
        </div>
        <div class="card-body">
            <a href="${'/file/' + evidencia.img}"  target="_blank" data-lightbox="photos"><img class="img-fluid"
            src="${'/file/' + evidencia.img}">
            </a>
        </div>
        <div class="card-footer bg-white">
            <a class="btn btn-danger delete-documento" href="javascript:void(0)"
            data-toggle="tooltip" title="Eliminar" onClick="eliminarEvidencia(${evidencia.id})">
                <i class="fa fa-fw fa-trash"></i>
            </a>
        </div>
    </div>
    `
        })

        bodyEvidencias.innerHTML = html
    } catch (error) {
        console.log(error);
    }
}
