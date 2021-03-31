<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Andreshg112\HablameSms\Facade as Hablame;
use App\Comentario;
use Illuminate\Support\Facades\Auth;

class SMSController extends Controller
{
    public function getBalance()
    {
        $response = Hablame::checkBalance();
        return response($response);
    }

    public function sendMensaje(Request $request)
    {

        try {
            $phoneNumbers = 57 . request()->get('number');
            $sms =  request()->get('body');
            $response = Hablame::sendMessage($phoneNumbers, $sms);
            $aux = $response['sms'][1]['resultado_t'] == "" ?  1 : 0;

            if ($aux) {
                $resp =   Comentario::create([
                    'comentario' => 'Se ha enviado mensaje ' . request()->get('body') . ' al numero ' . request()->get('number'),
                    'user' => Auth::user()->name,
                    'service_id' => request()->get('service_id'),
                ]);
                return ($resp) ? response('Su mensaje ha sido enviado') : response('Error Ingresando registro');
            }
            return response($response['sms'][1]['resultado_t']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
