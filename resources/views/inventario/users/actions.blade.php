<div class="text-lg-right text-nowrap">

    <a class="btn text-white btn-primary  btn-circle" href="{{route('users.show', $id)}}">
        <i class="fa fa-fw fa-eye"></i>
    </a>

    <a class="btn text-white btn-xs btn-icon btn-danger delete-usser  btn-circle" href="javascript:void(0)" onclick="eliminarUser({{$id}})"
        data-toggle="tooltip" title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>

</div>
