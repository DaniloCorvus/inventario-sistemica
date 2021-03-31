<div class="card mb-0">
    <div class="card-body ">
        @foreach ($service->comentarios as $comentario)
        <small class="text text-danger font-weight-bold">{{$comentario->created_at}}</small>
        <span class="text text-black font-weight-bold">{{$comentario->user}}</span>
        <p class="">{{$comentario->comentario}}</p>
        @endforeach
    </div>
</div>