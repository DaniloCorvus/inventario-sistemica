<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteSaveRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Http\Resources\clienteResponse;
use App\Service;
use App\Services\ResponseCliente;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

use function PHPSTORM_META\type;

class ClienteController extends Controller
{
    public function __construct(ResponseCliente $responseCliente)
    {
        $this->middleware('auth');
        $this->middleware(['can:get,App\User']);

        $this->responseCliente = $responseCliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->expectsJson()) {
            return $this->responseCliente->index();
        }

        return new clienteResponse(cliente::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteSaveRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                Cliente::create(request()->all());
                return response()->json('Cliente registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json([
                    'type' => 'error',
                    'error' => 'No se ha podido crear el registro',
                    'code' => 400,
                ], 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        if (request()->expectsJson()) {
            return response($cliente);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */

    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $cliente = Cliente::findOrFail($request->id);
                $cliente->update(request()->all());
                return response()->json('Cliente actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO implementar delete
        if (request()->expectsJson()) {
            try {
                $cliente = Cliente::findOrFail($id);
                if (count($cliente->services()->get()) != 0) {
                    return response()->json('Existen servicios asocciados', 400);
                }
                $cliente->delete();
                return response()->json('Cliente eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    public function servicios($cliente)
    {
        if (request()->expectsJson()) {
            return datatables(Service::where('cliente_id', $cliente)->with('cliente', 'users', 'equipo.marca:id,nombre', 'equipo', 'estado', 'modo', 'tipo', 'razon')->get())
                ->editColumn('action', function ($service) {
                    $button =  '<div class="text-lg-right text-nowrap">';
                    $button .=
                        '<a class="btn btn-circle btn-primary mr-1" href="/services/' . $service->id . '"
                    title="Editar">
                    <i class="fa fa-eye"></i>
                    </a>';
                    $button .=
                        '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarService(' . $service->id . ')"
                    title="Eliminar">
                    <i class="fa fa-fw fa-trash"></i>
                    </a>';
                    $button .= '</div>';
                    return $button;
                })->setRowClass(function ($service) {

                    switch ($service->razon->id) {
                        case 1:
                            return 'bg-info';
                            break;
                        case 2:
                            return 'bg-warning';
                            break;
                        case 3:
                            return 'bg-default ';
                            break;
                        case 4:
                            return 'alert-success ';
                            break;
                        case 5:
                            return 'alert-danger ';
                            break;
                        default:
                            return 'alert-warning ';
                    }
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        $response = new clienteResponse(cliente::class);
        return  $response->services($cliente);
    }
}
