@extends('layouts.app')
@section('content')
<div class="container">
    <div class=" container-fluid">

        <div class="card">
            <h6 class="card-header">Campañas</h6>

            @if (Session::has('success'))
            <div class="alert alert-success px-2">{{Session::get('success')}}</div>
            @endif

            @if (Session::has('error'))
            <div class="alert alert-danger px-2">{{Session::get('error')}}</div>
            @endif


            <form action="{{route('filtrar.clientes')}}" method="GET" id="filterForm" class="card">
                @method('GET')
                @csrf
                <div class="card-body row">

                    <div class="col-md-6">
                        <select name="columna" onchange="cargarList(this)" class="form-control form-control-sm">
                            <option>Selecione</option>
                            <option value="marca">Marca</option>
                            <option value="aparato">Tipo de Aparato</option>
                        </select>
                    </div>

                    <div class="col-md-6" id="list"></div>

                </div>
                <div class="col-md-12 row h-100 justify-content-center align-items-center my-2">
                    <button type="submit" class="btn btn-sm btn-primary text-white"
                        style="cursor: pointer">Filtrar</button>
                </div>
            </form>

        </div>

        <form action="{{route('sendmessage')}}" method="POST" class="card" id="formSendCampa">

            @method('POST')
            @csrf

            <div class="card-body row">

                <div class="col-md-12">
                    <label class="text-dark label-control " class="btn btn-success">
                        Descripcion de la Campaña
                    </label>
                    <input required class="form-control form-control-sm" value="{{old('message')}}" name="descripcion">

                </div>

                <div class="col-md-12 my-2">
                    <label class="text-dark label-control " class="btn btn-success">
                        Mensaje
                    </label>

                    <textarea required id="textAreaMessage" maxlength="160" class="form-control form-control-sm"
                        name="message">{{old('message')}}</textarea>
                </div>

                @foreach ($clientes as $cliente)


                <input type="hidden" name="cliente_id[]" value="{{$cliente->id}}">

                <div class="col-md-1 custom-control custom-switch w-100">
                    <input type="checkbox" class="custom-control-input bg-primary"
                        onchange="chState(this, {{$cliente->id}})" checked id="Select[{{$cliente->id}}]">
                    <input type="hidden" name="enviar[]" value="true" id="enviar{{$cliente->id}}">
                    <label class="custom-control-label" style="cursor:pointer" for="Select[{{$cliente->id}}]"></label>
                </div>

                <div class="col-md-2 w-100">
                    <label class="form-control-label" style="">{{$cliente->last}}</label>
                </div>

                <div class="col-md-3">
                    <label class="text-dark label-control " class="btn btn-success">
                        {{$cliente->fullname}}
                    </label>
                </div>


                <div class="col-md-3">
                    <select name="numero[]" class="select custom-select custom-select-sm">
                        <option value="{{$cliente->telefono}}">{{$cliente->telefono}}</option>
                        <option value="{{$cliente->opcional_telefono}}">{{$cliente->opcional_telefono}}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control form-control-sm" value="{{$cliente->date_last}}">
                </div>

                @endforeach
            </div>

            <div class="col-md-12 row h-100 justify-content-center align-items-center my-2">
                <button type="submit" class="btn btn-sm btn-primary text-white" style="cursor: pointer">Enviar</button>
            </div>

        </form>
        {{-- {{$clientes->render()}} --}}
    </div>
</div>
@endsection

@push('scripts')

<script>
    const marcas = @json($marcas);
    const aparatos = @json($productos);
</script>

<script>
    const formSendCampa = document.getElementById('formSendCampa')
    const textAreaMessage = document.getElementById('textAreaMessage')
    const MIN_LENGTH = 5
    
    function cargarList(element)
    {

        const list = document.getElementById('list')
        const selectFicticio = document.getElementById('selectFicticio')

        if (selectFicticio) {
            selectFicticio.remove();
        }

        if (element.value == "marca") {
            let html = `<select name="filtro"  id="selectFicticio" class="form-control form-control-sm">`
             html += marcas.map((marca) => {
                return `<option value="${marca.id}">${marca.nombre}</option>`
            })
            html += `</select>`

            list.insertAdjacentHTML('beforeEnd', html)

        }
        
        if (element.value == "aparato") {
            let html = `<select name="filtro" id="selectFicticio"   class="form-control form-control-sm">`
             html += aparatos.map((aparato) => {
                return `<option value="${aparato.id}">${aparato.nombre}</option>`
            })
            html += `</select>`
            list.insertAdjacentHTML('beforeEnd', html)
        }
       
    }

    function chState(element, id)
    {
        const input = document.getElementById(`enviar${id}`)
        if(element.checked == true) {
            input.value=true; 
        }else{
            input.value=false; 
        }
    }

        formSendCampa.addEventListener('submit', (event) =>{
            if (textAreaMessage.value.length < MIN_LENGTH) {
                event.preventDefault()
                toastr.error('Advertencia', 'El mensaje es demasiado Corto')
                return false 
            }
            toastr.info('info', 'Espere un momento por favor...')
            return true 
        })

         document.getElementById('filterForm').addEventListener('submit', () =>{
            toastr.info('info', 'Espere un momento por favor...')
         });

</script>

@endpush