@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container container-fluid">

        <form action="{{route('charts.services')}}" method="get">
            @csrf

            <div class="row w-100">
                <div class="col-md-4">
                    <select name="search" class=" form-control ">

                        <option>No Aplicar</option>
                        <option value="Tipo">Tipo</option>
                        <option value="Modo">Modo</option>
                        <option value="Marca">Marca</option>
                        <option value="Diario">Diario</option>

                    </select>
                </div>

                <div class="col-md-8">
                    <select name="id" class=" form-control ">
                        <option>No Aplicar</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <input type="text" class="form-control" id="min" name="min" placeholder="De:"
                        onfocus="(this.type='date')">
                </div>

                <div class="col-md-6">
                    <input type="text" class="form-control" id="max" name="max" placeholder="Hasta:"
                        onfocus="(this.type='date')">
                </div>


                <div class="col-md-4 m-2">
                    <button type="submit" class="btn btn-success">Filtrar</button>
                </div>

            </div>
        </form>


        <div class="row w-100">
            <div class="col-md-12">
                @if (!empty($serviceChart))

                {!! $serviceChart->container() !!}

                @endif
            </div>
        </div>


    </div>
    @endsection
    @push('scripts')
    <script async src="{{ asset('/js/evalfecha.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    @if (!empty($serviceChart))

    {!! $serviceChart->script() !!}

    @endif
    @endpush