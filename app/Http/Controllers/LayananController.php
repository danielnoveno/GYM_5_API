<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return response()->json($layanan);
    }

    public function show($id)
    {
        $layanan = Layanan::find($id);
        if ($layanan) {
            return response()->json($layanan);
        }
        return response()->json(['message' => 'Layanan not found'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string'
        ]);

        $layanan = Layanan::create($request->all());

        return response()->json($layanan, 201);
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        if ($layanan) {
            $layanan->update($request->all());
            return response()->json($layanan);
        }
        return response()->json(['message' => 'Layanan not found'], 404);
    }

    public function destroy($id)
    {
        $layanan = Layanan::find($id);
        if ($layanan) {
            $layanan->delete();
            return response()->json(['message' => 'Layanan deleted']);
        }
        return response()->json(['message' => 'Layanan not found'], 404);
    }
}
