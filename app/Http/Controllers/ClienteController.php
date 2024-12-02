<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cliente::all();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
           $data =[
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
           ];
           return response()->json($data, 400);
        }

        $cliente = Cliente::create($request->all());

        if (!$cliente) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $data = Cliente::find($id);

        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = Cliente::find($id);

        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }
}
