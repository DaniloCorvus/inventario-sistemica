<?php

namespace App\Imports;


use App\Models\Producto;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Producto([
            // 'proveedor_id' => $row[0],
            // 'pedido_id' => $row[0],
            // 'cellar_id' => $row[0],
            'serie' => $row['serie'],
            'modelo' => $row['modelo'],
            'num_pedido' => $row['num_pedido'],
            'descripcion' => $row['descripcion'],
            'num_factura' => $row['num_factura'],
            'fecha_compra' => $row['fecha_compra'],
            'fecha_recibido' => $row['fecha_recibido'],
            'fecha_solicitud' => $row['fecha_solicitud'],
            'guia' => $row['guia'],
            'orden_compra' => $row['orden_compra'],
            'cod_interno' => $row['cod_interno'],
            'delivery_orden' => $row['delivery_orden'],
            'confirmacion' => $row['confirmacion'],
            'num_parte' => $row['num_parte'],
            'costo_in' => $row['costo_in'],
            'costo_antes_iva' => $row['costo_antes_iva'],
            'costo_promosion' => $row['costo_promosion'],
            'costo_venta' => $row['costo_venta'],
            'impuesto' => $row['impuesto'],
            'cantidad' => $row['cantidad'],
            'costo_total' => $row['costo_total'],
            'cant_disponible' => $row['cant_disponible'],
            'ubicacion' => $row['ubicacion'],
            'observacion' => $row['observacion'],
            'estado' => $row['estado'],
            'codigo' => $row['codigo']
        ]);
    }
}
