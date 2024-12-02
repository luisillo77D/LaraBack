<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Prestamo::with('cliente')->get();
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
        //
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'cliente_id' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $prestamo = Prestamo::create($request->all());

        if (!$prestamo) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
        return response()->json($prestamo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        $data = Prestamo::with('cliente')->find($prestamo->id);
        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $prestamo = Prestamo::find($id);
        if (!$prestamo) {
            return response()->json(['message' => 'No data found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'cliente_id' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $prestamo->update($request->all());
        return response()->json($prestamo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id);
        if (!$prestamo) {
            return response()->json(['message' => 'No data found'], 404);
        }

        $prestamo->delete();
        return response()->json(['message' => 'Data deleted'], 200);
    }
}
