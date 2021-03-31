<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        //TODO Authorization
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
            return datatables()->of(User::latest())
                ->addColumn('action', 'admin.users.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }
        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserSaveRequest $request)
    {
        if (request()->expectsJson()) {
            try {
                User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'identificacion' => $request['identificacion'],

                ]);
                return response('Usuario creado correctamente');
            } catch (\Throwable $th) {
                return response($th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('rols')->findOrFail($id);

        if (request()->expectsJson()) {
            return datatables()->of($user->rols)
                ->addColumn('action', 'admin.roles.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.users.show', compact('user'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (request()->expectsJson()) {
            return response($user, 200);
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        try {
            $user = User::findOrFail(request()->id);
            $user->update(request()->all());
            return response('Datos actualizados correctamente');
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO optimize delete
        if (request()->expectsJson()) {
            User::findOrFail($id)->delete();
            return response('User eliminado Correctamente.');
        }
        return abort(404);
    }
}
