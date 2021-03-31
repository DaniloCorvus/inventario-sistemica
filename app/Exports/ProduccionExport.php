<?php
// 'servicios', 'inicio', 'fin', 'requestTecnico'
namespace App\Exports;

use Illuminate\Contracts\View\View;

// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProduccionExport implements FromView, WithEvents, ShouldAutoSize
{
    use Exportable;

    public $servicio, $inicio, $fin, $requestTecnico;

    public function __construct($servicios, $inicio, $fin, $requestTecnico)
    {
        $this->servicios = $servicios;
        $this->inicio = $inicio;
        $this->fin = $fin;
        $this->requestTecnico = $requestTecnico;
    }

    public function view(): View
    {
        try {

            $servicios = $this->servicios;
            $inicio = $this->inicio;
            $fin = $this->fin;
            $requestTecnico = $this->requestTecnico;

            return view('informes.produccion.excel', compact('servicios', 'inicio', 'fin', 'requestTecnico'));
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
            },
        ];
    }
}
