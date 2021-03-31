<?php

namespace App\Services;

use App\Service;

use Illuminate\Support\Facades\Cache;

class UpdateService
{

    public function update()
    {
        try {
            $service = Service::findOrFail(request()->get('id'));
            $service->update(request()->all());
            Cache::forget('servicesCache');
            return response()->json('Actualizdo correcto');
        } catch (\Throwable $th) {
            return  response()->json($th->getMessage());
        }
    }
}
