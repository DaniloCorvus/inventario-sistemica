<?php

namespace App\Services;

use App\Repuesto;
use App\Service;

class AddTecnico
{

    public function addTecnicoToService()
    {
        try {
            $service = Service::with('users')->findOrFail(request()->get('id'));
            if (!$this->existeRelation($service, request()
                ->get('user_id'))) {

                if (request()->get('main')) {
                    $this->deletePrincipal($service);
                    $service->users()->attach(request()
                        ->get('user_id'), ['percent' => 100, 'main' => true]);
                    return response('Tecnico Agregado correctamente');
                }

                $principal = $this->buscarPrincipal($service);

                if ($service->users()->updateExistingPivot($principal->id, ['percent' => ($principal->pivot->percent - request()->get('percent'))])) {
                    $service->users()->attach(request()
                        ->get('user_id'), ['percent' => request()->get('percent'), 'main' => false]);
                }

                return response('Tecnico Agregado correctamente');
            }
            return response('Tecnico antes ya ha sido asignado ');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }



    public function existeRelation($service, $user)
    {
        return $service->users()->where('user_id', $user)->exists();
    }

    public function deletePrincipal($service): void
    {
        $principal = $this->buscarPrincipal($service);
        if ($principal) {
            $service->users()->detach();
        }
    }

    public function buscarPrincipal($service)
    {
        return $service->users()->where('main', true)->first();
    }
}
