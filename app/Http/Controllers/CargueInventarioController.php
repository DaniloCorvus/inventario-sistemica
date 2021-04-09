<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\CargueInventario;
use App\Services\ResponseCargueInventario;
use Illuminate\Http\Request;

class CargueInventarioController extends Controller
{
    //
    public function __construct(ResponseCargueInventario $responseCargueInventario )
    {
        //TODO Authorization
        $this->middleware(['auth']);
        // $this->middleware(['can:get,App\User']);
        $this->responseCargueInventario = $responseCargueInventario;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $ids = explode(',',$id);

        //dd($id);
        if (request()->expectsJson()) {
/*
            dd( $this->responseCargueInventario->index($ids)); */
            return $this->responseCargueInventario->index($ids);

        }

        $inventario = Inventario::whereIn('id',$ids)->with('producto')->get();


        return view('inventario.carguesInventario.index',compact('inventario','id'));
    }

    public function actualizarEstado(){
        if (request()->expectsJson()) {


           $cargue = CargueInventario::find(request()->get('cargue_inventario_id'));
            $cargue->estado = request()->get('estado');
            $cargue->save();
            if(request()->get('estado') == 'recibido'){


                $inventario = Inventario::find($cargue->inventario_id);


                $inventario->cantidad_disponible += $cargue->cantidad;
                $inventario->cantidad += $cargue->cantidad;
                $inventario->save();
            }

            return response()->json(['data'=>'actualizado con éxito']);

        }else{
            return abort(404);
        }


    }

}
