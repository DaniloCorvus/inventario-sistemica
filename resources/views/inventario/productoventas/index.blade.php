@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row mb-0">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

                        <a href="javascript:history.back()" class="text-white btn btn-circle btn-success mr-1" title="" data-original-title="Regresar">
                            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
                        </a>


                        Ventas
                    </div>
                </h6>
            </div>
            <div class="col-12" style="display: flex; justify-content: space-between ; padding: 0px 30px ">

                <h5 class="card-title" >Cod. Interno : {{$producto->cod_interno}}</h5>
                <h5 class="card-title">Modelo : {{$producto->modelo}}</h5>
                <h5 class="card-title">Num. Parte : {{$producto->num_parte}}</h5>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableProductox">
                    <thead class="thead">
                        <tr>
                            <th  style="text-align: left">Fecha</th>
                            <th>Num. Factura</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                            <th>Cliente</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableProducto">
                        @foreach ($ventas as $venta )
                            <tr>
                                <td style="text-align: left">  {{$venta->fecha}}</td>
                                <td  style="text-align: center">{{$venta->num_factura}}</td>
                                <td style="text-align: right">{{$venta->cantidad}}</td>
                                <td style="text-align: right">{{$venta->precio}}</td>
                                <td style="text-align: right">{{$venta->total}}</td>
                                <td style="text-align: center">{{$venta->cliente}}</td>
                                <td style="text-align: center"> <a href="/detalle-venta/{{$venta->venta_id}}">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a> </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endSection
