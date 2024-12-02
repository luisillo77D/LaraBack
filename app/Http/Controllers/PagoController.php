<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = Pago::where('prestamo_id', $id)->get();
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
            'prestamo_id' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $pago = Pago::create($request->all());
        if (!$pago) {
            return response()->json(['message' => 'Internal server error'], 500);
        }
        return response()->json($pago, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $data = Pago::with('prestamo')->find($id);

        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }

    //actualizar el estado del prestamo
    public function updateStatus($id)
    {
        $pago = Pago::find($id);
        if (!$pago) {
            return response()->json(['message' => 'No data found'], 404);
        }

        $pago->status = true;
        $pago->save();

        return response()->json($pago, 200);
    }
    
}
