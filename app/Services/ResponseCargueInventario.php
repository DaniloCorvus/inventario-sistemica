<?php

namespace App\Services;
use App\Models\Inventario;

class ResponseCargueInventario
{

    public function index($id)
    {
        $res = Inventario::find($id)->Cargues;
         
        return datatables($res)
        ->editColumn('cambiarEstado', function ($res) {
         //   dd($res);exit;
            $button =  '<div class="text-lg-right text-nowrap">';
            $button .=
                '  
             
                <select onChange="cambiarEstado('.$res->id.',event.target.value)" name="estado" 
                    class="form-contol custom-select" style="width:100%" required>
                    <option value="solicitado" '.($res->estado=='solicitado' ? 'selected' : '').' >Solicitado</option>
                    <option value="cancelado"  '.($res->estado=='cancelado' ? 'selected' : '').' >Cancelado</option>
                    <option value="en backorder"  '.($res->estado=='en backorder' ? 'selected' : '').' >En backorder</option>
                    <option value="reservado"  '.($res->estado=='reservado' ? 'selected' : '').' >Reservado</option>
                    <option value="recibido"  '.($res->estado=='recibido' ? 'selected' : '').' >Recibido</option>
                    <option value="devuelto"  '.($res->estado=='devuelto' ? 'selected' : '').' >Devuelto</option>
                </select>
           ';
            $button .= '</div>';
            return $button;
        })
       /*  ->editColumn('action', function ($res) {
            $button =  '<div class="text-lg-right text-nowrap">';
            $button .=
                '<a class="btn btn-circle btn-primary mr-1" href="#" 
                title="VerHistorial">
                <i class="fa fa-eye"></i>
                </a>';
            $button .= '</div>';
            return $button;
        }) */
        ->rawColumns([/* 'action', */'cambiarEstado'])
        ->addIndexColumn()
        
        
        ->toJson();
    }
}
