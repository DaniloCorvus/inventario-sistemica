<?php

namespace App\Services;

use App\Repuesto;

class ResponseRepuesto
{

    public function index()
    {

        return datatables(Repuesto::with('proveedor', 'services')->orderBy('updated_at', 'Desc')->get())
            ->editColumn('action', function ($repuesto) {
                $button =  '<div class="text-lg-right text-nowrap">';
                if ($repuesto->cant_disponible != 0) {
                    $button .=
                        '<a class="btn btn-circle btn-warning mr-1 btn-cargar text-white" javascript:void(0) onclick="cargaRepuesto(' . $repuesto->id . ')"
                        title="Cargar">
                        <i class="fa fa-upload"></i>
                        </a>';
                }
                $button .=
                    '<a class="btn btn-circle btn-primary mr-1 text-white" javascript:void(0) onclick="editarRepuesto(' . $repuesto->id . ')"
                    title="Editar">
                    <i class="fa fa-edit"></i>
                    </a>';
                $button .=
                    '<a class="btn btn-circle btn-dark text-white" javascript:void(0) onclick="eliminarRepuesto(' . $repuesto->id . ')"
                    title="Eliminar">
                    <i class="fa fa-fw fa-trash"></i>
                    </a>';
                $button .= '</div>';
                return $button;
            })->setRowClass(function ($repuesto) {
                switch ($repuesto->estado) {
                    case 'recibido':
                        return "alert-danger";
                        break;
                    case 2:
                        return 'light-blue';
                        break;
                    case 'Disponible':
                        return 'yellow';
                        break;
                    case 'solicitado':
                        return 'alert-success';
                        break;
                    case 'reservado':
                        return 'yellow';
                        break;
                    case 'En stock':
                        return 'purple';
                        break;
                    default:
                        return 'deep-purple';
                }
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
}
