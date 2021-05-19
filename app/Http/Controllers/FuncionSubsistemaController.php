<?php

namespace App\Http\Controllers;

use App\FuncionSubsistema;
use App\Http\Requests\FuncionSubsistemaSaveRequest;
use App\Parte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class FuncionSubsistemaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $partes = Parte::get(['nombre', 'id']);

        if ($request->expectsJson()) {
            return datatables(FuncionSubsistema::latest())
                ->addColumn('action', 'admin.funcionsubsistemas.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        Log::critical(json_encode(Auth::user()->name));
        return view('admin.funcionsubsistemas.index', compact('partes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuncionSubsistemaSaveRequest $request)
    {

        if ($request->expectsJson()) {
            try {
                FuncionSubsistema::create(request()->all());
                return response('FuncionSubsistema registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  response($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\FuncionSubsistema  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $cliente = FuncionSubsistema::findOrFail($id);
            return response($cliente, 200);
        }
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate(
            [
                'nombre' => 'required',
                'tipo_identificacion' => 'required',
                'identificacion' => 'required|numeric|digits_between:1,10|unique:company.funcionsubsistemas,identificacion,' . $request->id,
                'ciudad' => 'required',
                'departamento' => 'required',
                'direccion' => 'required',
                'telefono' => 'required',

            ],

            [
                'identificacion.digits_between' => 'El numero de identificacion debe contener entre 1 y 10 numeros',
                'identificacion.unique' => 'El numero de identificacion ya se encuentra registrado',
            ]
        );
        if ($request->expectsJson()) {
            try {
                $cliente = FuncionSubsistema::findOrFail($request->id);
                $cliente->update(request()->all());
                if ($cliente) {
                    return response('FuncionSubsistema actualizado correctamente', 200);
                }
                return response('No hemos podido actualizar el cliente', 500);
            } catch (\Throwable $th) {
                return  response($th->getMessage());
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\FuncionSubsistema  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $cliente = FuncionSubsistema::findOrFail($id)->delete();
            return response('FuncionSubsistema deleted successfully.');
        }

        return abort(404);
    }
}
