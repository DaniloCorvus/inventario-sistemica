<?php

namespace App\Repositories;

use App\Models\Cellar;
use App\Models\Inventario;

class CellarRepository implements InterfazRepository
{

    protected $model;

    /**
     * CellarRepository constructor.
     *
     * @param Cellar $Cellar
     */
    public function __construct(Cellar $Cellar)
    {

        $this->model = $Cellar;
    }

    public function all()
    {

        // $categoriasCache =  Cache::rememberForever('categoriasCache', function () {
        //     return Cellar::all();
        // });

        return datatables($this->model->get(['*']))
            ->editColumn('action', function ($categoria) {

                $button =  '<div class="text-lg-right text-nowrap">';
                 $button .=
                     '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarCellar(' . $categoria->id . ')"
                             title="Editar">
                             <i class="fa fa-edit"></i>
                             </a>';
                 $button .=
                     '<a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)" onclick="eliminarCellar(' . $categoria->id . ')"
                             title="Eliminar">
                             <i class="fa fa-fw fa-trash"></i>
                             </a>';
                 $button .=
                     '<a class="btn btn-circle text-white btn-info delete-cellar" href="/inventario"
                 data-toggle="tooltip" title="ver productos en esta bodega">
                     <i class="fa fa-fw fa-eye"></i>
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

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    public function cantidades($id)
    {
        return Inventario::where('cellar_id', $id)
                            ->where('cantidad_disponible','>',0)
                        ->first();
    }

    public function find($id)
    {
        $Cellar = $this->model->find($id);
        return $Cellar;
    }
}
