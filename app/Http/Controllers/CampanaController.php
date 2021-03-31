<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Comentario;
use App\Marca;
use App\Producto;
use Illuminate\Support\Facades\Auth;
use \Andreshg112\HablameSms\Facade as Hablame;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CampanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::get(['nombre', 'id']);
        $productos = Producto::get(['nombre', 'id']);

        return view('campana.index')
            ->with([
                'clientes' => Cliente::where('accept', 'on')
                    ->paginate(15, ['telefono', 'opcional_telefono', 'id', 'nombre', 'apellido', 'accept', 'last', 'date_last']),
                'marcas' => $marcas, 'productos' => $productos
            ]);
    }


    public function sendMessage()
    {

        define("MESSAGE_REQUEST", request()->get('message'));
        define("NUMEROS_REQUEST", request()->get('numero'));
        define("ACCETPS_REQUEST", request()->get('enviar'));
        define("CLIENTE_ID_REQUEST", request()->get('cliente_id'));
        define("DESCRIPCION_REQUEST", request()->get('descripcion'));

        $clientes = array();

        foreach (ACCETPS_REQUEST as $i => $acepta) {
            array_push($clientes, array(
                'acepta' => $acepta, 'numero' => NUMEROS_REQUEST[$i], 'cliente_id' => CLIENTE_ID_REQUEST[$i]
            ));
        }

        $numbersClientesAccepted = array_filter($clientes, [$this, 'acceptados']);
        $numbersTransformed = array_map([$this, 'transFormNumber'], $numbersClientesAccepted);

        if (!$this->verifyNumbers($numbersTransformed)) {
            return back()->with('error', 'Algunos numeros no cumplen el formato correcto');
        }

        if ($this->sendMessageUnit($numbersTransformed, MESSAGE_REQUEST, DESCRIPCION_REQUEST)) {
            return back()->with('success', 'Mensajes enviado Correctamente');
        }

        return back()->with('error', 'Algunos Mensajes no pudieron ser enviados');
    }


    public function verifyNumbers($numeros): bool
    {
        define('MAX_LENGHT_NUMBERS', 10);

        foreach ($numeros as $numero) {
            if (preg_match("/[A-Z-a-z]/", $numero['numero'])) {
                return false;
            }

            if (strlen($numero['numero']) != MAX_LENGHT_NUMBERS) {
                return false;
            }
        }

        return true;
    }


    public function sendMessageUnit($numbersClienteTransformed, $msg, $descripcion): bool
    {
        try {
            foreach ($numbersClienteTransformed as  $numero) {

                $response = Hablame::sendMessage($numero['numero'], $msg);
                $aux = $response['sms'][1]['resultado_t'] == "" ?  1 : 0;

                if ($aux == 1) {
                    $cliente =  Cliente::find($numero['cliente_id']);
                    $cliente->update(['last' =>  $descripcion, 'date_last' => Carbon::now(), 'accept' => 'on']);
                }
            }

            return true;
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
    }


    public function filtro()
    {

        $marcas = Marca::get(['nombre', 'id']);
        $productos = Producto::get(['nombre', 'id']);

        switch (request()->get('columna')) {
            case 'marca':

                $clientes = Cliente::select(['telefono', 'opcional_telefono', 'id', 'nombre', 'apellido', 'accept', 'last'])
                    ->whereHas('services.equipo',  function ($q) {
                        $q->where('marca', request()->get('filtro'))->select('id');
                    })->where('accept', 'on')->get();

                break;
            case 'aparato':
                $clientes = Cliente::select(['telefono', 'opcional_telefono', 'id', 'nombre', 'apellido', 'accept', 'last'])
                    ->whereHas('services.equipo',  function ($q) {
                        $q->where('descripcion', request()->get('filtro'))->select('nombre');
                    })->where('accept', 'on')->get();
                break;

            default:
                return back();
                break;
        }

        return view('campana.index', compact('clientes', 'marcas', 'productos'));
    }


    public function acceptados($numero)
    {
        if ($numero['acepta'] === "true") {
            return $numero;
        }
    }


    public function transFormNumber($numero)
    {
        $numero['numero'] = str_replace(' ', '', trim(str_replace('-', '', $numero['numero'])));
        return $numero;
    }
}
