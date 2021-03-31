<?php

namespace App\Services;

use App\Clausula;
use App\Marca;
use App\Producto;
use App\Service;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HandlerPrint
{
    public function printOrden($orden)
    {
        try {

            $service = Service::with('cliente', 'users', 'equipo', 'estado', 'modo', 'tipo', 'razon')->findOrfail($orden);
            $servicios = Service::where('equipo_id', $service->equipo->id)->get(['id'])->except(['id' => $service->id]);

            $cantidad = $servicios->count();

            $producto = Producto::find($service->equipo->descripcion);
            $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./img/service.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('A11')->setValue($service->observacion);
            $worksheet->getCell('B5')->setValue($service->equipo->procedencia);
            $worksheet->getCell('B6')->setValue($service->cliente->full_name);
            $worksheet->getCell('B7')->setValue($service->cliente->direccion);
            $worksheet->getCell('B8')->setValue($producto->nombre);
            $worksheet->getCell('B9')->setValue($service->equipo->modelo);
            $worksheet->getCell('E5')->setValue($service->equipo->comprado);
            $worksheet->getCell('E6')->setValue($service->cliente->identificacion);
            $worksheet->getCell('E7')->setValue($service->cliente->barrio);
            $worksheet->getCell('E8')->setValue($marca->nombre);
            $worksheet->getCell('E9')->setValue($service->equipo->serie);
            $worksheet->getCell('G2')->setValue($service->radicado);
            $worksheet->getCell('G5')->setValue($service->modo->nombre);
            $worksheet->getCell('G6')->setValue($service->cliente->telefono);
            $worksheet->getCell('G7')->setValue($service->tipo->nombre);
            $worksheet->getCell('G8')->setValue($service->inicio);

            $worksheet->getCell('F11')->setValue(($service->users()->where('main', true)->first())->name);

            $worksheet->getCell('H4')->setValue('GA -' . $service->id);
            $worksheet->getCell('H9')->setValue($cantidad);

            $worksheet->getCell('A41')->setValue($service->observacion);
            $worksheet->getCell('B25')->setValue($service->accesorio_equipo);
            $worksheet->getCell('B26')->setValue($service->valor_cotizado);
            $worksheet->getCell('B35')->setValue($service->equipo->procedencia);
            $worksheet->getCell('B36')->setValue($service->cliente->full_name);
            $worksheet->getCell('B37')->setValue($service->cliente->direccion);
            $worksheet->getCell('B38')->setValue($producto->nombre);
            $worksheet->getCell('B39')->setValue($service->equipo->modelo);
            $worksheet->getCell('D26')->setValue($service->valor_aprobado);
            $worksheet->getCell('E35')->setValue($service->equipo->comprado);
            $worksheet->getCell('E36')->setValue($service->cliente->identificacion);
            $worksheet->getCell('E37')->setValue($service->cliente->barrio);
            $worksheet->getCell('E38')->setValue($marca->nombre);

            $worksheet->getCell('F4')->setValue(($cantidad > 0) ? 'GA-' . $servicios->implode('id', '|') : 0);
            $worksheet->getCell('F34')->setValue(($cantidad > 0) ? 'GA-' . $servicios->implode('id', '|') : 0);

            $worksheet->getStyle('F4')->getFont()->setSize(8);
            $worksheet->getStyle('F34')->getFont()->setSize(8);

            $worksheet->getStyle('H4')->getFont()->setSize(8);
            $worksheet->getStyle('H34')->getFont()->setSize(8);

            $worksheet->getCell('E39')->setValue($service->equipo->serie);
            $worksheet->getCell('G32')->setValue($service->radicado);
            $worksheet->getCell('H34')->setValue('GA-' . $service->id);
            $worksheet->getCell('G35')->setValue($service->modo->nombre);
            $worksheet->getCell('G36')->setValue($service->cliente->telefono);
            $worksheet->getCell('G37')->setValue($service->tipo->nombre);
            $worksheet->getCell('G38')->setValue($service->inicio);
            $worksheet->getCell('F41')->setValue(($service->users()->where('main', true)->first())->name);
            $worksheet->getCell('H39')->setValue($cantidad);
            $worksheet->getCell('C55')->setValue($service->accesorio_equipo);

            $worksheet->getCell('B56')->setValue($service->valor_cotizado);
            $worksheet->getCell('D56')->setValue($service->valor_aprobado);

            $text = '';
            foreach (Clausula::where('marca_id', $service->equipo->marca)->get() as $clausuala) {
                $text .= $clausuala->descripcion;
            }

            $worksheet->getCell('I7')->setValue($text);
            $worksheet->getCell('I37')->setValue($text);
            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./img/Ordenes/" . $service->id . ".xls");

            return $service->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ReporteInterno($orden)
    {
        try {

            $service = Service::with('cliente', 'users', 'equipo', 'estado', 'modo', 'tipo', 'razon')->findOrfail($orden);
            $cantidad = Service::where('equipo_id', $service->equipo->id)->count();
            $producto = Producto::find($service->equipo->descripcion);
            $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./img/ReporteTecnicoInterno.xls');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('E2')->setValue(Carbon::now()->isoFormat('Y-M-D'));
            $worksheet->getCell('E4')->setValue('GA -' . $service->id);

            $worksheet->getCell('A13')->setValue('
            Este Centro de Servicio recibió para reparación ' . $service->modo->nombre . ' un  
            ' . $producto->nombre . ' vendido al Señor(a) ' . $service->cliente->full_name . ' por el Almacén 
            ' . $service->equipo->procedencia . ' con las siguientes características: ');
            $worksheet->getCell('C17')->setValue($producto->nombre);
            $worksheet->getCell('C18')->setValue($service->equipo->marka->nombre);
            $worksheet->getCell('C19')->setValue($service->equipo->modelo);
            $worksheet->getCell('C20')->setValue($service->equipo->serie);
            $worksheet->getCell('C21')->setValue($service->fecha_inicio);
            $worksheet->getCell('C22')->setValue($service->equipo->fecha_compra);
            $worksheet->getCell('C23')->setValue($service->equipo->procedencia);
            $worksheet->getCell('C24')->setValue($service->radicado);
            $worksheet->getCell('C25')->setValue('GA -' . $service->id);
            $worksheet->getCell('B26')->setValue($service->reporte);

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./img/ReporteInterno/ReporteTecnicoInterno" . $service->id . ".xls");

            return $service->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function formatoHE($orden)
    {
        try {
            $service = Service::with('cliente', 'users', 'equipo', 'estado', 'modo', 'tipo', 'razon')->findOrfail($orden);
            $cantidad = Service::where('equipo_id', $service->equipo->id)->count();
            $producto = Producto::find($service->equipo->descripcion);
            $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./img/FormatoHE.xlsm');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('E5')->setValue($service->cliente->direccion);
            $worksheet->getCell('E8')->setValue(($service->users()->where('main', true)->first())->name);
            $worksheet->getCell('E9')->setValue('COS01931-S-' . ($service->users()->where('main', true)->first())->id);
            $worksheet->getCell('E12')->setValue($service->cliente->full_name);
            $worksheet->getCell('E13')->setValue($service->equipo->procedencia);
            $worksheet->getCell('E17')->setValue($service->tipo->nombre);
            $worksheet->getCell('E18')->setValue($service->equipo->fecha_compra);
            $worksheet->getCell('E19')->setValue($service->equipo->modelo);
            $worksheet->getCell('E20')->setValue($service->equipo->serie);

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./img/FormatoHE/FormatoHE" .  $service->id . ".xls");

            return $service->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function FormatoLGAC($orden)
    {
        try {
            $service = Service::with('cliente', 'users', 'equipo', 'estado', 'modo', 'tipo', 'razon')->findOrfail($orden);
            $cantidad = Service::where('equipo_id', $service->equipo->id)->count();
            $producto = Producto::find($service->equipo->descripcion);
            $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./img/FormatoLGAC.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('S4')->setValue(Carbon::now()->isoFormat('Y-M-D'));
            $worksheet->getCell('H8')->setValue($service->cliente->full_name);
            $worksheet->getCell('H14')->setValue($service->equipo->fecha_compra);
            $worksheet->getCell('H23')->setValue($service->observacion);
            $worksheet->getCell('H26')->setValue($service->reporte);
            $worksheet->getCell('Q10')->setValue(($service->users()->where('main', true)->first())->name);
            $worksheet->getCell('Q12')->setValue($service->equipo->serie);
            $worksheet->getCell('E12')->setValue($service->equipo->modelo);
            $worksheet->getCell('T14')->setValue('GA -' . $service->id);
            $worksheet->getCell('K20')->setValue($service->radicado);
            $worksheet->getCell('V20')->setValue($service->fecha_inicio);


            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./img/FormatoLGAC/FormatoLGAC" .  $service->id . ".xls");

            return $service->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ReciboCarry($orden)
    {
        try {
            $service = Service::with('cliente', 'users', 'equipo', 'estado', 'modo', 'tipo', 'razon')->findOrfail($orden);
            $cantidad = Service::where('equipo_id', $service->equipo->id)->count();
            $producto = Producto::find($service->equipo->descripcion);
            $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./img/ReciboCarry.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->getCell('B7')->setValue('GA -' . $service->id);
            $worksheet->getCell('B8')->setValue(($service->users()->where('main', true)->first())->name);
            $worksheet->getCell('B9')->setValue($producto->nombre);
            $worksheet->getCell('B10')->setValue($service->equipo->modelo);
            $worksheet->getCell('B11')->setValue($service->equipo->serie);
            $worksheet->getCell('B12')->setValue($service->accesorio_equipo);
            $worksheet->getCell('A16')->setValue($service->equipo->created_at);
            $worksheet->getCell('B17')->setValue($service->equipo->v_declarado);

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./img/ReciboCarry/ReciboCarry" .  $service->id . ".xls");

            return $service->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function FormatoGTI($orden)
    {
        try {
            $service = Service::with('cliente', 'users', 'equipo', 'estado', 'modo', 'tipo', 'razon')->findOrfail($orden);
            $cantidad = Service::where('equipo_id', $service->equipo->id)->count();
            $producto = Producto::find($service->equipo->descripcion);
            $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./img/FormatoGTI.xls');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('B23')->setValue($service->observacion);
            $worksheet->getCell('B56')->setValue($service->reporte);
            $worksheet->getCell('X4')->setValue(Carbon::now()->isoFormat('Y-M-D'));
            $worksheet->getCell('X17')->setValue($service->equipo->fecha_compra);
            $worksheet->getCell('I7')->setValue($service->cliente->full_name);
            $worksheet->getCell('E9')->setValue($service->equipo->modelo);
            $worksheet->getCell('E11')->setValue($service->equipo->serie);
            $worksheet->getCell('N9')->setValue('GA-' . $service->id);
            $worksheet->getCell('J15')->setValue(($service->users()->where('main', true)->first())->name);

            $worksheet->getCell('T22')->setValue($service->fecha_inicio);


            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./img/FormatoGTI/FormatoGTI" .  $service->id . ".xls");

            return $service->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function formatoSamsung($orden)
    {
        try {
            $service = Service::with('cliente', 'user', 'equipo', 'estado', 'modo', 'tipo', 'razon')->findOrfail($orden);
            $cantidad = Service::where('equipo_id', $service->equipo->id)->count();
            $producto = Producto::find($service->equipo->descripcion);
            $marca = Marca::find($service->equipo->marca);

            $spreadsheet = IOFactory::load('./img/formatoSamsung.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('X4')->setValue(date('d-m-Y', strtotime($service->created_at)));
            $worksheet->getCell('I7')->setValue($service->cliente->full_name);
            $worksheet->getCell('E9')->setValue($service->equipo->modelo);
            $worksheet->getCell('N9')->setValue('GA -' . $service->id);
            $worksheet->getCell('E11')->setValue($service->equipo->serie);
            $worksheet->getCell('J15')->setValue(($service->users()->where('main', true)->first())->name);
            $worksheet->getCell('X17')->setValue($service->equipo->fecha_compra);

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save("./img/formatoSamsung/" . $service->id . ".xls");

            return $service->id;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
