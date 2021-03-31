<?php

namespace App\Services;

class PrintService
{

    public function __construct(HandlerPrint $handlerprint)
    {
        $this->handlerprint = $handlerprint;
    }

    public function printservice()
    {

        try {

            if (request()->get('LGHE')) {
                $orden = "./img/FormatoHE/FormatoHE" . $this->handlerprint->formatoHE(request()->get('id')) . ".xls";
                return response()->download($orden)->deleteFileAfterSend(true);
            }
            if (request()->get('formatoGTI')) {
                $orden = "./img/FormatoGTI/FormatoGTI" . $this->handlerprint->FormatoGTI(request()->get('id')) . ".xls";
                return response()->download($orden)->deleteFileAfterSend(true);
            }

            if (request()->get('orden')) {
                $orden = "./img/Ordenes/" . $this->handlerprint->printOrden(request()->get('id')) . ".xls";
                return response()->download($orden)->deleteFileAfterSend(true);
            }


            if (request()->get('FormatoLGAC')) {
                $orden = "./img/FormatoLGAC/FormatoLGAC" . $this->handlerprint->FormatoLGAC(request()->get('id')) . ".xls";
                return response()->download($orden)->deleteFileAfterSend(true);
            }

            if (request()->get('ReciboCarry')) {
                $orden = "./img/ReciboCarry/ReciboCarry" . $this->handlerprint->ReciboCarry(request()->get('id')) . ".xls";
                return response()->download($orden)->deleteFileAfterSend(true);
            }

            if (request()->get('ReporteInterno')) {
                $ReporteInterno = "./img/ReporteInterno/ReporteTecnicoInterno" . $this->handlerprint->ReporteInterno(request()->get('id')) . ".xls";
                return response()->download($ReporteInterno)->deleteFileAfterSend(true);
            }

            if (request()->get('informeTecnicoLG')) {
                $informeTecnicoLG = "./img/ReporteLG/" . $this->handlerprint->ReporteLG(request()->get('id')) . ".xls";
                return response()->download($informeTecnicoLG)->deleteFileAfterSend(true);
            }

            if (request()->get('formatoSamsung')) {
                $formatoSamsung = "./img/formatoSamsung/" . $this->handlerprint->formatoSamsung(request()->get('id')) . ".xls";
                return response()->download($formatoSamsung)->deleteFileAfterSend(true);
            }


            return back();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
