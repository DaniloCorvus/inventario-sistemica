<?php

namespace App\Http\Controllers;
use App\Models\DinerosVenta;
use Illuminate\Http\Request;

class DinerosVentaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index($key)
    {
      /*   dd(DinerosVenta::with('user')->where('venta_id', $key)->latest()->dd()); */
        if (request()->expectsJson()) {
            return datatables(DinerosVenta::with('user')->where('venta_id', $key)->latest())
                ->editColumn('action', function ($dinero) {
                    $button =  '<div class="text-lg-right text-nowrap">';

                   /*  if (Auth::user()->hasRole('admin')) { */
                        $button .=
                            '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarDineroVenta(' . $dinero->id . ')"
                        title="Eliminar">
                        <i class="fa fa-fw fa-trash"></i>
                        </a>';
                   /*  } */
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }
    }

    public function store(Request $request)
    {

        if (request()->expectsJson()) {
         //   dd(request()->all());
            try {
                DinerosVenta::create(request()->all());
                return response()->json('Dinero registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }

    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                DinerosVenta::findOrFail($id)->delete();
                return response()->json('Dinero eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
}
