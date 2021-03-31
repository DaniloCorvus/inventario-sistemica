<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'staff_id',
        'cliente_id',
        'equipo_id',
        'estado_id',
        'modo_id',
        'accesorio_equipo',
        'tipo_id',
        'tipo_reparacion',
        'razon_id',
        'fecha_inicio',
        'fecha_reparado',
        'fecha_finalizado',
        'fecha_promesa',
        'fecha_autorizado',
        'valor_obra',
        'valor_aprobado',
        'happycall_estado',
        'happycall_calificacion',
        'valor_cotizado',
        'valor_total',
        'valor_cargo_fabrica',
        'valor_cargo_cliente',
        'valor_repuestos',
        'valor_adicionales',
        'valor_gastos',
        'observacion',
        'observacion_happycallestado',
        'reporte',
        'factura',
        'radicado'
    ];

    protected $appends = ['inicio', 'service'];

    public function getInicioAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['fecha_inicio']));
    }

    public function getServiceAttribute()
    {
        return 'GA-' . $this->attributes['id'];
    }

    public function getCreatedAtAttribute()
    {
        return  $this->attributes['created_at'];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('percent', 'main');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function modo()
    {
        return $this->belongsTo(Modo::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
    public function razon()
    {
        return $this->belongsTo(Razon::class);
    }

    public function repuestos()
    {
        return $this->belongsToMany(Repuesto::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function adicionales()
    {
        return $this->hasMany(Adicional::class);
    }

    public function dineros()
    {
        return $this->hasMany(Dinero::class);
    }

    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class);
    }

    public function happycallestado()
    {
        return $this->belongsTo(HappycallEstado::class, 'happycall_estado');
    }


    function customRepuestos($repuestos)
    {
        $total =  $repuestos->reduce(function ($count, $repuesto) {

            return $count + ($repuesto->cantidad * $repuesto->costo_venta);
        }, 0);

        return $total;
    }

    function customAdicionales($adicionales)
    {
        $total =  $adicionales->reduce(function ($count, $adicional) {

            return $count +  $adicional->valor;
        }, 0);

        return $total;
    }

    //TODO mover esta wea de aqui

    public function getValorCargoFabrica($modo)
    {
        switch ($modo) {
            case 'In Warranty [IW]':
                return $this->valor_obra + $this->customAdicionales($this->adicionales) + $this->customRepuestos($this->repuestos);
                break;
            case 'Out Of Warranty [OOW]':
                return 0;
                break;
            case 'Supplementary Warranty [SW]':
                return  $this->customAdicionales($this->adicionales) + $this->customRepuestos($this->repuestos);
                break;
            case 'Extended warranty [EW]':
                return $this->valor_obra + $this->customAdicionales($this->adicionales) + $this->customRepuestos($this->repuestos);
                break;
            case 'In Warranty [IW-RR]':
                return $this->valor_obra + $this->customAdicionales($this->adicionales) + $this->customRepuestos($this->repuestos);
                break;
            case 'Out Of Warranty [OOW-RR]':
                return 0;
                break;
            default:
                return;
                break;
        }
    }

    public function getValorCargoCliente($modo)
    {

        switch ($modo) {
            case 'In Warranty [IW]':
                return 0;
                break;
            case 'Out Of Warranty [OOW]':
                return $this->valor_obra + $this->customAdicionales($this->adicionales) + $this->customRepuestos($this->repuestos);
                break;
            case 'Supplementary Warranty [SW]':
                return $this->valor_obra;
                break;
            case 'Extended warranty [EW]':
                return 0;
                break;
            case 'In Warranty [IW-RR]':
                return 0;
                break;
            case 'Out Of Warranty [OOW-RR]':
                return $this->valor_obra + $this->customAdicionales($this->adicionales) + $this->customRepuestos($this->repuestos);
                break;
            default:
                return;
                break;
        }
    }


    //TODO Arregla esta wea sacar esto de aca
    public static function getRepuestos($key)
    {
        $total = 0;

        foreach (Service::findOrFail($key)->repuestos as  $repuesto) {

            $aux = Accesorio::where('service_id', $key)
                ->where('repuesto_id', $repuesto->id)->first();

            if ($aux) {


                $total +=  $aux->cantidad * $repuesto->costo_venta;
            }
        }

        return $total;
    }


    public static function getGastos($key)
    {

        $gastos = Service::with(
            [
                'gastos' => function ($query) {
                    $query->where('importeminus', 'on');
                }

            ]
        )->findOrFail($key)->gastos->sum('valor');

        return $gastos;
    }
    public static function getAdicionales($key)
    {

        $adicionales = Service::with(
            [
                'adicionales' => function ($query) {
                    $query->where('importeplus', 'on');
                }

            ]
        )->findOrFail($key)->adicionales->sum('valor');

        return $adicionales;
    }


    public static function getRepuestosAll($key)
    {

        $accesorios = array();

        foreach (Service::findOrFail($key)->repuestos as  $repuesto) {

            array_push($accesorios, (Accesorio::where('service_id', $key)
                ->where('repuesto_id', $repuesto->id)->get()));
        }

        return  array_unique($accesorios);
    }

    public static function totalRecibido($key)
    {
        return Dinero::where('service_id', $key)->get()->sum('monto');
    }

    public static function getPorcentaje($porcentaje)
    {
        return (float) $porcentaje / 100;
    }

    public function getBase($gastos, $adicionales)
    {
        $totalGasto = 0;
        $totalGasto = $gastos->reduce(function ($count, $gasto) {
            return $count +=  $gasto->valor;
        });

        $totalAdicional = 0;
        $totalAdicional = $adicionales->reduce(function ($count, $adicionale) {
            return $count +=  $adicionale->valor;
        });

        return $totalAdicional - $totalGasto;
    }

    public  function getMAnoObra()
    {

        $tecnico = $this->users->first();

        switch ($this->modo->nombre) {
            case 'In Warranty [IW]':

                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return  $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return  $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return  $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return   $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return   $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;

            case 'Out Of Warranty [OOW]':

                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'Supplementary Warranty [SW]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'Extended warranty [EW]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return ($this->valor_obra / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'In Warranty [IW-RR]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return  $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return  $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return  $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return   $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return   $this->valor_obra * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'Out Of Warranty [OOW-RR]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return ($this->valor_obra / 1.19)  * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return ($this->valor_obra / 1.19)  * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return ($this->valor_obra / 1.19)  * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return ($this->valor_obra / 1.19)  * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return ($this->valor_obra / 1.19)  * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
        }
    }

    public  function getAdds()
    {
        $tecnico = $this->users->first();

        switch ($this->modo->nombre) {
            case 'In Warranty [IW]':

                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;

            case 'Out Of Warranty [OOW]':

                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'Supplementary Warranty [SW]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'Extended warranty [EW]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'In Warranty [IW-RR]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return ($this->getBase(collect($this->gastos), collect($this->adicionales))) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
            case 'Out Of Warranty [OOW-RR]':
                switch ($this->tipo->nombre) {
                    case 'In Home':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Repair':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Pick Up & Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Carry In Delivery':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_taller) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                    case 'Install':
                        return (($this->getBase(collect($this->gastos), collect($this->adicionales))) / 1.19) * $this->getPorcentaje($tecnico->porcentual_home) * $this->getPorcentaje($tecnico->pivot->percent);
                        break;
                }
                break;
        }
    }


    public  function getApagar()
    {
        return $this->getAdds() + $this->getMAnoObra();
    }
}
