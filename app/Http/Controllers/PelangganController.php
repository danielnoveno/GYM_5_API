<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return response()->json($pelanggans);
    }

    public function show($id)
    {
        $pelanggans = Pelanggan::find($id);
        if ($pelanggans) {
            return response()->json($pelanggans);
        }
        return response()->json(['message' => 'Pelanggan not found'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'umur' => 'required|integer',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string',
            'email' => 'required|email',
            'id_jadwal' => 'required|integer'
        ]);

        $pelanggans = Pelanggan::create($request->all());

        return response()->json($pelanggans, 201);
    }

    public function update(Request $request, $id)
    {
        $pelanggans = Pelanggan::find($id);
        if ($pelanggans) {
            $pelanggans->update($request->all());
            return response()->json($pelanggans);
        }
        return response()->json(['message' => 'Pelanggan not found'], 404);
    }

    public function destroy($id)
    {
        $pelanggans = Pelanggan::find($id);
        if ($pelanggans) {
            $pelanggans->delete();
            return response()->json(['message' => 'Pelanggan deleted']);
        }
        return response()->json(['message' => 'Pelanggan not found'], 404);
    }
}
