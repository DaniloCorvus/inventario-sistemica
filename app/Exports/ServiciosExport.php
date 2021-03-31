<?php

namespace App\Exports;

use App\Marca;
use App\Service;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ServiciosExport implements FromView, WithEvents, ShouldAutoSize

{
    use Exportable;

    public $data;


    public function __construct($data)
    {
        $this->data = $data;
    }

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



            $servicios = $this->servicios;
            return view('informes.entrefechas.excel', compact('servicios'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                // $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V'];
                // foreach ($letras as  $letra) {
                //     $event->sheet->getColumnDimension($letra)->setWidth(15);
                //     if ($letra == 'S') {
                        $event->sheet->getColumnDimension('S')->setAutoSize(false);
                        $event->sheet->getColumnDimension('S')->setWidth(50);
                        $event->sheet->getColumnDimension('C')->setAutoSize(false);
                        $event->sheet->getColumnDimension('C')->setWidth(15);
                        $event->sheet->getColumnDimension('I')->setAutoSize(false);
                        $event->sheet->getColumnDimension('I')->setWidth(15);
                        $event->sheet->getColumnDimension('K')->setAutoSize(false);
                        $event->sheet->getColumnDimension('K')->setWidth(15);
                        $event->sheet->getColumnDimension('L')->setAutoSize(false);
                        $event->sheet->getColumnDimension('L')->setWidth(15);
            //         }
            //         if ($letra == 'A') {
            //             $event->sheet->getColumnDimension('S')->setWidth(5);
            //         }
            //     }
            }
        ];
    }

    public function getServices($modo)
    {

        $inicio = Carbon::createFromDate($this->data['min']);
        $fin = Carbon::createFromDate($this->data['max'])->addDays(1);
        $marca = ($this->data['marca'] == 'null') ? null : Marca::findOrFail($this->data['marca']);



        $this->servicios =  Service::with('cliente', 'users', 'equipo', 'estado', 'equipo.marca', 'modo', 'tipo', 'razon')
            ->whereNotNull('fecha_inicio')
            ->whereBetween('fecha_inicio', [$inicio, $fin])
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
