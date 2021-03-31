<div class="text-lg-right text-nowrap">
    <a class="btn btn-success edit-cliente" href="javascript:void(0)" onclick="editarCliente({{$id}})" 
    title="Editar">
        <i class="fa fa-edit"></i>
    </a>

    <a class="btn btn-danger delete-cliente" href="javascript:void(0)" onclick="eliminarCliente({{$id}})"
       
    title="Eliminar">
        <i class="fa fa-fw fa-trash"></i>
    </a>

    <a class="btn btn-primary delete-cliente" href="{{route('clientes.show', $id)}}" 
    title="Datalles">
        <i class="fa fa-fw fa-eye"></i>
    </a>
</div>