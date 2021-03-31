<?php

namespace App\Http\Controllers;

use App\Evidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class EvidenciaController extends Controller
{
    public function store(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                if ($request->file('file')) {
                    $Evidencia = new Evidencia();
                    $filename =  time() . '.' . $request->file('file')->getClientOriginalExtension();
                    $request->file('file')->move(public_path() . "/file", $filename);
                    $Evidencia->img = $filename;
                    $Evidencia->descripcion = $request->descripcion;
                    $Evidencia->service_id = $request->service_id;
                    $Evidencia->save();
                    return response('Registrado exitosamente', 200);
                }
            } catch (\Throwable $th) {
                return response($th->getMessage());
            }
        }
    }

    public function destroy($evicencia)
    {
        try {
            $delete = Evidencia::findOrFail($evicencia);
            File::delete(public_path('/file/' . $delete->img));
            $delete->delete();
            return response('Recurso eliminado correctamente');
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
}
