<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Http\Requests\EquipoSaveRequest;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EquipoServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);

    }


    public function store(EquipoSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                $equipo = Equipo::create(request()->except(['observacion']));
                request()->merge(['equipo_id' => $equipo->id]);
                Service::create(request()->all());
                Cache::forget('equiposCache');
                Cache::forget('servicesCache');
                return response()->json('Equipo registrado correctamente :)');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage());
            }
        }
        return abort(404);
    }
}
