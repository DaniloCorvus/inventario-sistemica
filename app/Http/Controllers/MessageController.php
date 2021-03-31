<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageSaveRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        //TODO: Authorization
        $this->middleware(['auth']);
        $this->middleware(['can:get,App\User']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {

            return datatables(Message::latest())
                ->editColumn('action', function ($message) {
                    $button =  '<div class="text-lg-right text-nowrap">';
                    $button .=
                        '<a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" onclick="editarMessage(' . $message->id . ')"
                    title="Editar">
                    <i class="fa fa-edit"></i>
                    </a>';
                    $button .=
                        '<a class="btn btn-circle btn-danger" href="javascript:void(0)" onclick="eliminarMessage(' . $message->id . ')"
                    title="Eliminar">
                    <i class="fa fa-fw fa-trash"></i>
                    </a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.messages.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageSaveRequest $request)
    {

        if (request()->expectsJson()) {
            try {
                Message::create(request()->all());
                return response()->json('Message registrado correctamente');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $Message)
    {
        if (request()->expectsJson()) {
            return response($Message);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Message  $Message
     * @return \Illuminate\Http\Response
     */

    public function show(Message $Message)
    {
        return view('admin.messages.show', compact('Message'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(MessageUpdateRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                $Message = Message::findOrFail($request->id);
                $Message->update(request()->all());
                return response()->json('Message actualizado correctamente');
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 400);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                $Message = Message::findOrFail($id);
                $Message->delete();
                return response()->json('Message eliminado correctamente.');
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 400);
            }
        }
    }

    public function getmessages()
    {

        // if (request()->expectsJson()) {
        return response()->json(Message::all());
        // }
        // return abort(404);
    }
}
