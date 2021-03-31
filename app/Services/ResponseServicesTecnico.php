<?php

namespace App\Services;

use App\Clausula;

class ResponseServicesTecnico
{

    public function index()
    {
        // if (request()->expectsJson()) {
        //     return datatables(Service::with('cliente', 'user', 'equipo', 'estado', 'equipo.marca', 'modo', 'tipo', 'razon')
        //         ->where('user_id', Auth::user()->id)->get())
        //         ->addColumn('action', function ($service) {
        //             $button =  '<div class="text-lg-right text-nowrap">';
        //             $button .=
        //                 '<a class="btn btn-circle btn-dark mr-1" href="/tecnico/myservices/' . $service->id . '"
        //             title="Editar">
        //             <i class="fa fa-eye"></i>
        //             </a>';
        //             $button .= '</div>';
        //             return $button;
        //         })
        //         ->setRowClass(function ($service) {

        //             switch ($service->razon->id) {
        //                 case 1:
        //                     return "red";
        //                     break;
        //                 case 2:
        //                     return 'pink';
        //                     break;
        //                 case 3:
        //                     return 'purple ';
        //                     break;
        //                 case 4:
        //                     return 'dee';
        //                     break;
        //                 case 5:
        //                     return 'indigo';
        //                     break;
        //                 case 6:
        //                     return "blue";
        //                     break;
        //                 case 7:
        //                     return 'light-blue';
        //                     break;
        //                 case 8:
        //                     return 'cyan';
        //                     break;
        //                 case 9:
        //                     return 'teal';
        //                     break;
        //                 case 10:
        //                     return 'green';
        //                     break;
        //                 case 11:
        //                     return "light-green";
        //                     break;
        //                 case 12:
        //                     return 'lime';
        //                     break;
        //                 case 13:
        //                     return 'yellow';
        //                     break;
        //                 case 14:
        //                     return 'alert-success';
        //                     break;
        //                 case 15:
        //                     return 'blue-gray';
        //                     break;
        //                 case 16:
        //                     return "deep";
        //                     break;
        //                 case 17:
        //                     return 'brown';
        //                     break;
        //                 case 18:
        //                     return 'gray';
        //                     break;
        //                 case 19:
        //                     // return 'blue-gray';
        //                     break;
        //                 case 20:
        //                     return 'purple';
        //                     break;
        //                 default:
        //                     return 'deep-purple';
        //             }
        //         })
        //         ->rawColumns(['action'])
        //         ->addIndexColumn()
        //         ->toJson();
        // }
        return view('tecnico.services.index');
    }
}
