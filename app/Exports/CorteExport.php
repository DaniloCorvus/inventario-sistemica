<?php

namespace App\Exports;

use App\Marca;
use App\service;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CorteExport implements FromView, WithEvents, ShouldAutoSize
{

    use Exportable;

    public $data;


    public function __construct($data)
    {
        $this->data = $data;
    }


    // 3. Poder clasificar si es garantia o no en informe cortes, asi mismo por marca
    // 5. Poder clasificar si es garantia o no en servicios entre fechas, asi mismo por marca
    // 6. Informe de servicios entre fechas toca camiarlo a por fecha de ingreso 



    public function view(): View

    {
        try {
            switch ($this->data['garantia']) {
                case 'IW':

                    $this->getServices('IW');

                    break;
                case 'EW':
                    $this->getServices('EW');

                    break;
                case 'OOW':
                    $this->getServices('OOW');

                    break;

                default:
                    $this->getServices('');
                    break;
            };


            $max = 0;

            foreach ($this->servicios as $servicio) {
                switch ($servicio->modo->nombre) {
                    case ('In Warranty [IW]'):

                        switch ($servicio->tipo->nombre) {
                            case 'In Home':
                                $max += ($servicio->valor_obra * 0.50);
                                break;
                            case 'Carry In Repair':
                                $max += ($servicio->valor_obra * 0.40);

                                break;
                            case 'Pick Up & Delivery':
                                $max += ($servicio->valor_obra * 0.50);

                                break;
                            case 'Carry In Delivery':
                                $max += ($servicio->valor_obra * 0.40);


                                break;
                            case 'Install':
                                $max += ($servicio->valor_obra * 0.50);
                                break;
                        }
                        break;

                    case 'Out Of Warranty [OOW]':
                        switch ($servicio->tipo->nombre) {
                            case 'In Home':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                            case 'Carry In Repair':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);

                                break;
                            case 'Pick Up & Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);

                                break;
                            case 'Carry In Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);

                                break;
                            case 'Install':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                        }
                        break;

                    case 'Supplementary Warranty [SW]':
                        switch ($servicio->tipo->nombre) {
                            case 'In Home':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                            case 'Carry In Repair':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);

                                break;
                            case 'Pick Up & Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);

                                break;
                            case 'Carry In Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);

                                break;
                            case 'Install':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                        }
                        break;

                    case 'Extended warranty [EW]':
                        switch ($servicio->tipo->nombre) {

                            case 'In Home':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                            case 'Carry In Repair':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);

                                break;
                            case 'Pick Up & Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);

                                break;
                            case 'Carry In Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);

                                break;
                            case 'Install':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                        }
                        break;

                    case ('In Warranty [IW-RR]'):
                        switch ($servicio->tipo->nombre) {
                            case 'In Home':
                                $max += ($servicio->valor_obra * 0.50);

                                break;
                            case 'Carry In Repair':
                                $max += ($servicio->valor_obra * 0.40);

                                break;
                            case 'Pick Up & Delivery':
                                $max += ($servicio->valor_obra * 0.50);

                                break;
                            case 'Carry In Delivery':
                                $max += ($servicio->valor_obra * 0.40);


                                break;
                            case 'Install':
                                $max += ($servicio->valor_obra * 0.50);
                                break;
                        }
                        break;

                    case ('Out Of Warranty [OOW-RR]'):
                        switch ($servicio->tipo->nombre) {
                            case 'In Home':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                            case 'Carry In Repair':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);
                                break;
                            case 'Pick Up & Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                            case 'Carry In Delivery':
                                $max += (($servicio->valor_obra / 1.19)  * 0.40);
                                break;
                            case 'Install':
                                $max += (($servicio->valor_obra / 1.19)  * 0.50);
                                break;
                        }
                        break;
                }
            }

            $servicios = $this->servicios;
            return view('informes.corte.excel', compact('servicios', 'max'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getColumnDimension('H')->setAutoSize(false);
                $event->sheet->getColumnDimension('C')->setAutoSize(false);
                $event->sheet->getColumnDimension('T')->setAutoSize(false);
                $event->sheet->getColumnDimension('G')->setAutoSize(false);
                $event->sheet->getStyle($cellRange)->getFont()->setSize(10);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('G')->setWidth(20);
                $event->sheet->getColumnDimension('H')->setWidth(20);
                $event->sheet->getColumnDimension('T')->setWidth(100);
            },
        ];
    }

    public function getServices($modo)
    {

        $inicio = Carbon::createFromDate($this->data['min']);
        $fin = Carbon::createFromDate($this->data['max'])->addDays(1);
        $marca = ($this->data['marca'] == 'null') ? null : Marca::findOrFail($this->data['marca']);


        $this->servicios =  Service::with('cliente', 'users', 'equipo', 'equipo.marca', 'estado', 'modo', 'tipo', 'razon')
            ->whereNotNull('fecha_finalizado')
            ->whereBetween('fecha_finalizado', [$inicio, $fin])
            ->whereHas('equipo', function ($query) use ($marca) {
                return $marca == null ?: $query->where('marca',  $marca->id);
            })
            ->whereHas('modo', function ($query) use ($modo) {
                $query->where('nombre',  'like', "%$modo%");
            })
            ->orderBy('id')
            ->get();
    }
}
