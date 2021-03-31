<?php

namespace App\Services;

use App\Models\Categoria;
use App\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ResponseCategoria
{

    public function index()
    {
        // $categoriasCache =  Cache::rememberForever('categoriasCache', function () {
        //     return Categoria::all();
        // });

        return datatables(Categoria::all())
            ->editColumn('action', function ($categoria) {

                $button =  '<div class="text-lg-right text-nowrap">';
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarCategoria(' . $categoria->id . ')"
                            title="Editar">
                            <i class="fa fa-edit"></i>
                            </a>';
                $button .=
                    '<a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)" onclick="eliminarCategoria(' . $categoria->id . ')"
                            title="Eliminar">
                            <i class="fa fa-fw fa-trash"></i>
                            </a>';
                $button .= '</div>';

                return $button;
            })
            ->rawColumns(['action'])
            // ->addColumn('relaciones', function ($categoria) {
            //     return Service::where('categoria_id', $categoria->id)->get();
            // })
            ->addIndexColumn()
            ->toJson();
    }
}
