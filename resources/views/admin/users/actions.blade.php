<div class="text-lg-right text-nowrap">

    <a class="btn btn-primary btn-sm" href="{{route('users.show', $id)}}">
        <i class="fa fa-fw fa-eye"></i>
    </a>

    <a class="btn btn-xs btn-sm btn-default " href="javascript:void(0)" onclick="editarUser({{$id}})"
        data-toggle="tooltip" title="Editar">
        <i class="fa fa-fw fa-pen"></i>
    </a>
    <a class="btn btn-xs btn-sm btn-danger " href="javascript:void(0)" onclick="eliminarUser({{$id}})"
        data-toggle="tooltip" title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>

</div>
