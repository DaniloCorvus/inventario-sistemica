<?php

namespace App\Observers;

use App\Comentario;
use App\Equipo;
use App\Estado;
use App\HappycallEstado;
use App\Modo;
use App\Razon;
use App\Reparacion;
use App\service;
use App\Tipo;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use \Andreshg112\HablameSms\Facade as Hablame;


class ServiceObserver
{
    /**
     * Handle the service "created" event.
     *
     * @param  \App\service  $service
     * @return void
     */

    // https://wa.link/s9cu64

    public function creating(service $service)
    {
        $service->fecha_inicio = Carbon::now();
        $service->estado_id =  Estado::where('nombre', 'Reparacion aceptada')->pluck('id')->first();
        $service->razon_id = Razon::where('nombre', 'Reparacion aceptada')->pluck('id')->first();
    }

    public function created(service $service)
    {
        try {
            $service->users()->attach($service->user_id, ['percent' => 100, 'main' => true]);

            Comentario::create([
                'user' => Auth::user()->name,
                'comentario' => 'El usuario ha creado el servicio ',
                'service_id' => $service->id,
            ]);

            if (request()->get('sendMessage')) {
                $phoneNumbers = 57 . str_replace('-', '', trim(request()->get('telefono')));
                $tipo = $service->tipo->nombre;

                if (preg_match("/Carry In/i", $tipo)) {
                    $sms =  "Bienvenido a Mantenimiento Electrónico Barrancabermeja,  su equipo ingresó con el cod. $service->service , para  mayor información escríbenos a:  https://wa.link/s9cu64";
                } else {
                    $sms =  "Bienvenido a Mantenimiento Electrónico Barrancabermeja,  su equipo ingresó con el cod. $service->service , para  mayor información escríbenos a:  https://wa.link/a1ruxe";
                }

                $response = Hablame::sendMessage($phoneNumbers, $sms);
                $aux = $response['sms'][1]['resultado_t'] == "" ?  1 : 0;

                if ($aux == 1) {

                    Comentario::create([
                        'comentario' => 'Se ha enviado mensaje ' . $sms . ' al numero ' . request()->get('telefono'),
                        'user' => Auth::user()->name,
                        'service_id' => $service->id,
                    ]);
                } else {
                    Comentario::create([
                        'comentario' => 'No se envió mensaje ' . $sms . ' al numero ' . request()->get('telefono') . ' porque ' . $response['sms'][1]['resultado_t'],
                        'user' => Auth::user()->name,
                        'service_id' => $service->id,
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Handle the service "updated" event.
     *
     * @param  \App\service  $service
     * @return void
     */
    public function updated(service $service)
    {

        if ($service->wasChanged()) {

            $cambios = 'Reemplazando el dato ';

            if ($service->isDirty('user_id')) {

                $old_tecnico = User::findOrFail($service->getOriginal('user_id'));
                $new_tecnico = User::findOrFail($service->user_id);
                $cambios .= ' Tecnico ' . $old_tecnico->name . ' por ' . $new_tecnico->name . '  - ';
            }

            if ($service->isDirty('staff_id')) {

                $old_staff = User::findOrFail($service->getOriginal('staff_id'));
                $new_staff = User::findOrFail($service->staff_id);
                $cambios .= ' Encargado de servicio ' .   $old_staff->name . ' por ' . $new_staff->name . '  - ';
            }
            if ($service->isDirty('equipo_id')) {

                $old_equipo = Equipo::findOrFail($service->getOriginal('equipo_id'));
                $new_equipo = Equipo::findOrFail($service->equipo_id);
                $cambios .= ' Equipo ' . $old_equipo->referencia . ' por ' . $new_equipo->referencia . '  - ';
            }
            if ($service->isDirty('estado_id')) {

                $old_estado = Estado::findOrFail($service->getOriginal('estado_id'));
                $new_estado = Estado::findOrFail($service->estado_id);

                $cambios .= ' Estado ' . $old_estado->nombre . ' por ' . $new_estado->nombre . '  - ';
            }
            if ($service->isDirty('modo_id')) {

                $old_modo = Modo::findOrFail($service->getOriginal('modo_id'));
                $new_modo = Modo::findOrFail($service->modo_id);
                $cambios .= ' Modo ' . $old_modo->nombre . ' por ' . $new_modo->nombre . '  - ';
            }

            if ($service->isDirty('tipo_id')) {

                $old_tipo = Tipo::findOrFail($service->getOriginal('tipo_id'));
                $new_tipo = Tipo::findOrFail($service->tipo_id);
                $cambios .= ' Tipo ' . $old_tipo->nombre . ' por ' . $new_tipo->nombre . '  - ';
            }

            if ($service->isDirty('tipo_reparacion')) {

                $old_tipo_reparacion = Reparacion::findOrFail($service->getOriginal('tipo_reparacion'));
                $new_tipo_reparacion = Reparacion::findOrFail($service->tipo_reparacion);
                $cambios .= ' Tipo Reparacion ' . $old_tipo_reparacion->nombre . ' por ' . $new_tipo_reparacion->nombre . '  - ';
            }

            if ($service->isDirty('razon_id')) {

                $old_razon = Razon::findOrFail($service->getOriginal('razon_id'));
                $new_razon = Razon::findOrFail($service->razon_id);
                $cambios .= ' Razon pendiente ' . $old_razon->nombre . ' por ' . $new_razon->nombre . '  - ';
            }

            if ($service->isDirty('fecha_inicio')) {
                $cambios .= ' Fecha  Ingreso ' . $service->getOriginal('fecha_inicio')  . ' por ' . $service->fecha_inicio . '  - ';
            }
            if ($service->isDirty('fecha_reparado')) {
                $cambios .= ' Fecha Reparado ' . $service->getOriginal('fecha_reparado')  . ' por ' . $service->fecha_reparado . '  - ';
            }
            if ($service->isDirty('fecha_finalizado')) {
                $cambios .= ' Fecha Finalizado ' . $service->getOriginal('fecha_finalizado')  . ' por ' . $service->fecha_finalizado . '  - ';
            }
            if ($service->isDirty('valor_obra')) {
                $cambios .= ' Valor mano de obra ' . $service->getOriginal('valor_obra')  . ' por ' . $service->valor_obra . '  - ';
            }
            if ($service->isDirty('valor_aprobado')) {
                $cambios .= ' Valor aprobado ' . $service->getOriginal('valor_aprobado')  . ' por ' . $service->valor_aprobado . '  - ';
            }
            if ($service->isDirty('happycall_estado')) {

                $old_happycall_estado = HappycallEstado::find($service->getOriginal('happycall_estado'));
                $new_happycall_estado = HappycallEstado::findOrFail($service->happycall_estado);

                if ($old_happycall_estado) {
                    $cambios .= ' Happy Call Estado ' . $old_happycall_estado->nombre . ' por ' . $new_happycall_estado->nombre . '  - ';
                } else {
                    $cambios .= ' Happy Call Estado  --- por ' . $new_happycall_estado->nombre . '  - ';
                }
            }
            if ($service->isDirty('happycall_calificacion')) {
                $cambios .= ' Happy Call Calificado ' . $service->getOriginal('happycall_calificacion')  . ' por ' . $service->happycall_calificacion . '  - ';
            }
            if ($service->isDirty('valor_cotizado')) {
                $cambios .= ' Valor cotizado ' . $service->getOriginal('valor_cotizado')  . ' por ' . $service->valor_cotizado . '  - ';
            }

            if ($service->isDirty('valor_total')) {
                $cambios .= ' Valor Total ' . $service->getOriginal('valor_total')  . ' por ' . $service->valor_total . '  - ';
            }

            if ($service->isDirty('valor_repuestos')) {
                $cambios .= ' Total en repuestos ' . $service->getOriginal('valor_repuestos')  . ' por ' . $service->valor_repuestos . '  - ';
            }
            if ($service->isDirty('valor_adicionales')) {
                $cambios .= ' Total en adicionales ' . $service->getOriginal('valor_adicionales')  . ' por ' . $service->valor_adicionales . '  - ';
            }
            if ($service->isDirty('valor_gastos')) {
                $cambios .= ' Total en gastos ' . $service->getOriginal('valor_gastos')  . ' por ' . $service->valor_gastos . '  - ';
            }
            if ($service->isDirty('observacion')) {
                $cambios .= ' Observcion de cliente ' . $service->getOriginal('observacion')  . ' por ' . $service->observacion . '  - ';
            }
            if ($service->isDirty('observacion_happycallestado')) {
                $cambios .= ' Happy Observacion ' . $service->getOriginal('observacion_happycallestado')  . ' por ' . $service->observacion_happycallestado . '  - ';
            }
            if ($service->isDirty('reporte')) {
                $cambios .= ' Reporte tecnico ' . $service->getOriginal('reporte')  . ' por ' . $service->reporte . '  - ';
            }
            if ($service->isDirty('radicado')) {
                $cambios .= ' Radicado ' . $service->getOriginal('radicado')  . ' por ' . $service->radicado . '  - ';
            }

            if ($service->isDirty('fecha_promesa')) {
                $cambios .= ' Fecha promesa ' . $service->getOriginal('fecha_promesa')  . ' por ' . $service->fecha_promesa . '  - ';
            }
            if ($service->isDirty('fecha_autorizado')) {
                $cambios .= ' Fecha autorizado ' . $service->getOriginal('fecha_autorizado')  . ' por ' . $service->fecha_autorizado . '  - ';
            }

            if ($service->isDirty('factura')) {
                $cambios .= ' Factura ' . $service->getOriginal('factura')  . ' por ' . $service->fecha_autorizado . '  - ';
            }

            Comentario::create([
                'user' => Auth::user()->name,
                'comentario' => 'El usuario modifica ' . $cambios,
                'service_id' => $service->id,
            ]);
        }
    }
}
