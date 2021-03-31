<?php

namespace App\Exports;

use App\Dinero;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

// Dinero::with('user')->where('service_id', $key)->latest()

class RecepcionDineroExport implements FromView, WithEvents, ShouldAutoSize
{
    use Exportable;

    public $data;


    public function __construct($data)
    {
        $this->data = $data;

        // dd($this->data);
    }

    public function view(): View

    {
        try {
            $inicio = Carbon::createFromDate($this->data['min']);
            $fin = Carbon::createFromDate($this->data['max'])->addDays(1);

            $dineros =  Dinero::with('user')
                ->whereBetween('fecha', [$inicio, $fin])
                ->orderBy('id')
                ->get();


            return view('informes.dineros.excel', compact('dineros'));
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
