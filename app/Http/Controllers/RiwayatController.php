<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayats = Riwayat::all();
        return response()->json($riwayats, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_riwayat' => 'required|date',
            'jenis_layanan' => 'required|string|max:255',
            'total_harga' => 'required|numeric',
        ]);

        $riwayat = Riwayat::create($request->all());
        return response()->json([
            'message' => 'Riwayat created successfully',
            'data' => $riwayat,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $riwayat = Riwayat::find($id);

        if (!$riwayat) {
            return response()->json(['message' => 'Riwayat not found'], 404);
        }

        return response()->json($riwayat, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $riwayat = Riwayat::find($id);

        if (!$riwayat) {
            return response()->json(['message' => 'Riwayat not found'], 404);
        }

        $request->validate([
            'tanggal_riwayat' => 'sometimes|date',
            'jenis_layanan' => 'sometimes|string|max:255',
            'total_harga' => 'sometimes|numeric',
        ]);

        $riwayat->update($request->all());

        return response()->json([
            'message' => 'Riwayat updated successfully',
            'data' => $riwayat,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $riwayat = Riwayat::find($id);

        if (!$riwayat) {
            return response()->json(['message' => 'Riwayat not found'], 404);
        }

        $riwayat->delete();

        return response()->json(['message' => 'Riwayat deleted successfully'], 200);
    }
}
