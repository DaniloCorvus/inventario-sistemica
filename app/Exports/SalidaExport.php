<?php

namespace App\Exports;

use App\Marca;
use App\Service;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SalidaExport implements FromView, WithEvents, ShouldAutoSize

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

            $salidas = $this->servicios;
            return view('informes.salidas.excel', compact('salidas'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getStyle($cellRange)->getFont()->setSize(10);
                $event->sheet->getColumnDimension('J')->setAutoSize(false);
                $event->sheet->getColumnDimension('J')->setWidth(50);
                $event->sheet->getColumnDimension('K')->setAutoSize(false);
                $event->sheet->getColumnDimension('K')->setWidth(30);
            },
        ];
    }

    public function getServices($modo)
    {

        $inicio = Carbon::createFromDate($this->data['min']);
        $fin = Carbon::createFromDate($this->data['max'])->addDays(1);
        $marca = ($this->data['marca'] == 'null') ? null : Marca::findOrFail($this->data['marca']);



        $this->servicios =  Service::with('cliente', 'users', 'equipo', 'estado', 'equipo.marca', 'modo', 'tipo', 'razon')
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


    // try {
    //     $inicio = Carbon::createFromDate($this->data['min']);
    //     $fin = Carbon::createFromDate($this->data['max'])->addDays(1);

    //     $salidas =  Service::with('users','modo','tipo','equipo')
    //         ->whereNotNull('fecha_finalizado')
    //         ->whereBetween('fecha_finalizado', [$inicio, $fin])
    //         ->orderBy('id')
    //         ->get();

}
