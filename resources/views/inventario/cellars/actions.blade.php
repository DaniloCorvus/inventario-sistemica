<div class="text-lg-right text-nowrap">
    <a class="btn btn-circle text-white btn-success edit-cellar" href="javascript:void(0)"
        onclick="editarCellar({{$id}})" data-toggle="tooltip" title="Editar">
        <i class="fa fa-edit"></i>
    </a>

    <a class="btn btn-circle text-white btn-danger delete-cellar" href="javascript:void(0)"
        onclick="eliminarCellar({{$id}})" data-toggle="tooltip" title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>

    <a class="btn btn-circle text-white btn-info delete-cellar" href="javascript:void(0)"
        onclick="verProductos({{$id}})" data-toggle="tooltip" title="ver productos en esta bodega">
        <i class="fa fa-fw fa-eye"></i>
    </a>

</div>